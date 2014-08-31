<?php

/**
 * Component. Abstract base controller.
 *
 * Работа контроллеров реализована с помощью чанков.
 * Чанками можно управлиать. Их можно переопределиать.
 * Выполнение действий с учетом прав
 * Механизм сообщений о результатах действий
 *
 * @package Zero.Component
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 */
abstract class Zero_Controller
{
    /**
     * Массив сообщений системы
     *
     * @var array
     */
    private static $_Message = [];

    /**
     * Обрабатываемая модель (объект)
     *
     * @var Zero_Model
     */
    protected $Model = null;

    /**
     * Представление
     *
     * @var Zero_View
     */
    protected $View = null;

    /**
     * Служебный массив длиа хранения и доступа к различной служебной информации.
     *
     * Особенно удобно при хранении контроллера в сессии
     *
     * @var array
     */
    protected $Params = [];

    /**
     * Фабрика по созданию контроллеров.
     *
     * @param string $class_name имиа контроллера эекземплиар которого создаетсиа
     * @param array $properties входные параметры плагина
     * @return Zero_Controller
     * @throws Exception
     */
    public static function Make($class_name, $properties = [])
    {
        $Controller = new $class_name();
        foreach ($properties as $property => $value)
        {
            $Controller->Params[$property] = $value;
        }
        return $Controller;
    }

    /**
     * Фабрика по созданию контроллеров.
     *
     * Работает через сессию. Индекс: $класс_наме
     *
     * @param string $class_name имиа контроллера эекземплиар которого создаетсиа
     * @param array $properties входные параметры плагина
     * @return Zero_Controller
     */
    public static function Factory($class_name, $properties = [])
    {
        if ( !$result = Zero_Session::Get($class_name) )
        {
            $result = self::Make($class_name, $properties);
            Zero_Session::Set($class_name, $result);
        }
        return $result;
    }

    /**
     * Получение массива сообщений о результате действий пользователиа.
     *
     * S uchetom perevoda
     *
     * @return array сообщения
     */
    public function Get_Message()
    {
        foreach (self::$_Message as $message => $row)
        {
            if ( 1 == count($row) )
            {
                self::$_Message[$message][] = Zero_I18n::Controller(get_class($this), $message);
            }
        }
        return self::$_Message;
    }

    /**
     * Добавление сообщений о результате действий пользователиа.
     *
     * @param string $message soobshchenie
     * @param int $code kod soobshcheniia
     * @return int
     */
    public function Set_Message($message = '', $code = 1)
    {
        if ( !$message && !$code )
            self::$_Message = [];
        else
            self::$_Message[$message] = [$code];
        return $code ? false : true;
    }

    /**
     * Выполнение действий
     *
     * @return Zero_View or string
     */
    public function Action_Default()
    {
        $this->View = 'Controller -> ' . get_class($this);
        return $this->View;
    }
}
