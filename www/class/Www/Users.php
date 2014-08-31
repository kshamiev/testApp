<?php

/**
 * Model. Users.
 *
 * @package Www.Users.Model
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 */
class Www_Users extends Zero_Users
{
    /**
     * Получение справочника городов
     *
     * @return array
     */
    public static function DB_GetDirectoryCitys()
    {
        $sql = "SELECT Id, Name FROM `Citys` ORDER BY 2";
        return Zero_DB::Sel_Array($sql);
    }

    /**
     * Получение справочника образований
     *
     * @return array
     */
    public static function DB_GetDirectoryEducation()
    {
        $sql = "SELECT Id, Name FROM `Education` ORDER BY 2";
        return Zero_DB::Sel_Array($sql);
    }

    /**
     * Получение пользователей и их данных
     *
     * С учетом условий по образованию и городам
     * А также полное бехусловное получение всех данных
     *
     * @param array $params условия
     * @return array
     */
    public static function DB_GetData($params)
    {
        $index = 'UsersApi';
        $index .= '/Education' . implode('/', $params['EducationId']);
        $index .= '/Citys' . implode('/', $params['CitysId']);
        $index .= '/data' . $params['Page'];

        if ( false === $result = Zero_Cache::Get_Data($index, Zero_Cache::TIME_H1) )
        {
            if ( 0 < count($params['EducationId']) )
            {
                $where = Zero_DB::Escape(implode(', ', $params['EducationId']));
                $sql_education = "
                  INNER JOIN `UsersEducation` AS ue
                    ON u.`Id` = ue.`Users_Id`
                  INNER JOIN `Education` AS e
                    ON ue.`Education_Id` = e.`Id` AND e.`Id` IN (" . $where . ")
                ";
            }
            else
            {
                $sql_education = "
                  LEFT JOIN `UsersEducation` AS ue
                    ON u.`Id` = ue.`Users_Id`
                  LEFT JOIN `Education` AS e
                    ON ue.`Education_Id` = e.`Id`
                ";
            }
            if ( 0 < count($params['CitysId']) )
            {
                $where = Zero_DB::Escape(implode(', ', $params['CitysId']));
                $sql_city = "
                  INNER JOIN `UsersCitys` AS uc
                    ON u.`Id` = uc.`Users_Id`
                  INNER JOIN `Citys` AS c
                    ON uc.`Citys_Id` = c.`Id` AND c.`Id` IN (" . implode(', ', $params['CitysId']) . ")
                ";
            }
            else
            {
                $sql_city = "
                  LEFT JOIN `UsersCitys` AS uc
                    ON u.`Id` = uc.`Users_Id`
                  LEFT JOIN `Citys` AS c
                    ON uc.`Citys_Id` = c.`Id`
                ";
            }
            $sql_limit = 'LIMIT ' . (($params['Page'] - 1) * 10) . ', ' . 10;

            $sql = "
            SELECT
              COUNT(DISTINCT u.`Id`)
            FROM `Users` AS u {$sql_education} {$sql_city}
            ";
            $result_cnt = intval(Zero_DB::Sel_Agg($sql));
            $sql = "
            SELECT
              u.`Name` AS UserName,
              GROUP_CONCAT(DISTINCT e.`Name` ORDER BY 1) AS EducationName,
              GROUP_CONCAT(DISTINCT c.`Name` ORDER BY 1) AS CityName
            FROM `Users` AS u {$sql_education} {$sql_city}
            GROUP BY 1
            ORDER BY 1
            {$sql_limit}
            ";
            $result_data = Zero_DB::Sel_Array($sql);
            $result = [$result_data, $result_cnt, $params['Page']];
            Zero_Cache::Set_Data($index, $result, Zero_Cache::TIME_H1);
        }
        return $result;
    }
}
