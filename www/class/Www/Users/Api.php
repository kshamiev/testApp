<?php

/**
 * Базовая работа с пользователем.
 *
 * @package Www.Users.Controller
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 */
class Www_Users_Api extends Zero_Controller
{
    /**
     * Управляющий метод (API).
     */
    public function Action_Default()
    {
        $this->View = new Zero_View();
        switch ( $_SERVER['REQUEST_METHOD'] )
        {
            case 'GET':
                $this->Chunk_GET();
                break;
            case 'POST':
                $this->Chunk_POST();
                break;
            case 'PUT':
                $this->Chunk_PUT();
                break;
            case 'DELETE':
                $this->Chunk_DELETE();
                break;
            case 'OPTIONS':
                $this->Chunk_OPTIONS();
                break;
        }
        Zero_App::ResponseJson($_SERVER['REQUEST_METHOD'], 409, "Метод запроса не определен");
    }

    /**
     * Получение (GET).
     *
     * Получение текущего пользователя.
     */
    protected function Chunk_GET()
    {
        if ( !isset(Zero_App::$Route->ApiUrlSegment[3]) )
            Zero_App::ResponseJson("", 409, "Операция не определена");
        else if ( 'citys' == Zero_App::$Route->ApiUrlSegment[3] )
            Zero_App::ResponseJson(Www_Users::DB_GetDirectoryCitys(), 200, "");
        else if ( 'education' == Zero_App::$Route->ApiUrlSegment[3] )
            Zero_App::ResponseJson(Www_Users::DB_GetDirectoryEducation(), 200, "");
    }

    /**
     * Добавление (POST).
     *
     * Регистрация пользователя
     */
    protected function Chunk_POST()
    {
        if ( !isset($_POST['EducationId']) )
            $_POST['EducationId'] = [];
        if ( !isset($_POST['CitysId']) )
            $_POST['CitysId'] = [];
        if ( !isset($_POST['Page']) || $_POST['Page'] < 1 )
            $_POST['Page'] = 1;
        Zero_App::ResponseJson(Www_Users::DB_GetData($_POST), 200, "");
    }

    /**
     * Изменение (PUT).
     *
     * Авторизация пользователя
     * Выход пользователя
     * Профиль пользователя
     * Восстановление реквизитов пользователя
     */
    protected function Chunk_PUT()
    {
        Zero_App::ResponseJson("", 409, "Операция не определена");
    }

    /**
     * Удаление (DELETE).
     */
    protected function Chunk_DELETE()
    {
        Zero_App::ResponseJson("", 409, "Операция не определена");
    }

    /**
     * Получение опций (OPTIONS).
     */
    protected function Chunk_OPTIONS()
    {
        Zero_App::ResponseJson("", 409, "Операция не определена");
    }
}
