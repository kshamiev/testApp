<?php
/**
 * The entry point to the application.
 * Initialize and run.
 */

// Including the class App
require __DIR__ . '/class/Zero/App.php';

Zero_App::Init('web', 'application');

Zero_App::Execute();

// Генерация случайных связей пользователей с их данными
/*
$arrCity = Zero_DB::Sel_List("SELECT Id FROM Citys");
$arrUsers = Zero_DB::Sel_List("SELECT Id FROM Users");
$arrEducation = Zero_DB::Sel_List("SELECT Id FROM Education");

$sql = "DELETE FROM `UsersCitys`";
Zero_DB::Set($sql);
$sql = "DELETE FROM `UsersEducation`";
Zero_DB::Set($sql);

foreach ($arrUsers as $id)
{
    shuffle($arrCity);
    shuffle($arrCity);
    shuffle($arrCity);

    $i = 0;
    foreach ($arrCity as $id1)
    {
        $sql = "INSERT UsersCitys SET Users_Id = {$id}, Citys_Id = {$id1}";
        Zero_DB::Ins($sql);
        $i++;
        if ( $i > 5 )
            break;
    }

    shuffle($arrEducation);
    shuffle($arrEducation);
    shuffle($arrEducation);

    $i = 0;
    foreach ($arrEducation as $id1)
    {
        $sql = "INSERT UsersEducation SET Users_Id = {$id}, Education_Id = {$id1}";
        Zero_DB::Ins($sql);
        $i++;
        if ( $i > 2 )
            break;
    }
}
*/
