<?php

/**
 * Component. Базовая абстрактная model`.
 *
 * - Реализует специализированную и абстраткную обработку свойств модели
 * - Агрегатор различных компонентов по работе с наследуемым объектом
 * - Использует паттерн Композицию с делегированием
 * - Работа со свойствами проишодит через методы перегрузки
 *
 * Инкапуслирует в себе следующие компоненты системы:
 * - Валидатор свойств наследуемого объекта при его изменении
 * - Система объектного (целевого) кеширования
 * - Cомпонент он интераcтион анд в'оркинг в'ит те датабасе ин те пхилосопhy оф ОРМ
 *
 * @package Zero.Component
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 *
 * @property integer $ID Идентификатор объекта
 * @property string $Source Источник или храниащая данных объектов
 * @property Zero_DB $DB Объект длиа работы с БД
 * @property Zero_Validator $VL Объект длиа работы по валидации (проверки) входных данных
 * @property Zero_Cache $Cache Объект длиа длиа работы с кешем
 */
abstract class Zero_Model
{
    /**
     * Идентификатор объекта
     *
     * @var integer
     */
    protected $ID = 0;

    /**
     * Imia istochnika ob``ektov nasleduemogo classa
     *
     * @var string
     */
    protected $Source = '';

    /**
     * Массив содержащий свойства объекта и их значения
     * Если свойства в массиве нет значит никакая работа с ним не проводилась
     * Если свойство в массиве есть то его значение определиает его текущее состояние
     *
     * @var array
     */
    private $_Props = [];

    /**
     * Массив состоянимй свойств
     *
     * - -1 измнененное
     * - 1 загруженное из источника
     *
     * @var array
     */
    private $_Props_Change = [];

    /**
     * Объект длиа работы с БД
     *
     * @var Zero_DB
     */
    private $_DB = null;

    /**
     * Объект длиа работы по валидации (проверки) входных данных
     *
     * @var Zero_Validator
     */
    private $_VL = null;

    /**
     * Объект длиа длиа работы с кешем
     *
     * @var Zero_Cache
     */
    private $_Cache = null;

    /**
     * Configuration model и ее свойств
     *
     * @var array
     */
    private static $_Config = [];

    /**
     * Список моделей созданных в переделах одного запроса
     *
     * @var array Zero_Model
     */
    private static $_Instance = [];

    /**
     * Конструткор класса
     * Инициализация идентификатора объекта
     * 0 - новый объект, не сохраненый в БД
     * Если $флаг_лоад установлен в труе проишодит загрузка свойств объекта из БД
     *
     * @param integer $id идентификатор объекта
     * @param boolean $flag_load флаг загрузки объекта
     */
    public function __construct($id = 0, $flag_load = false)
    {
        $this->ID = intval($id);
        if ( '' == $this->Source )
            $this->Source = get_class($this);
        if ( 0 < $this->ID && $flag_load )
            $this->DB->Select('*');
    }

    /**
     * Фабрика по созданию объектов.
     *
     * @param string $model имиа источника модель которой создаетсиа
     * @param int $id идентификатор объекта
     * @param bool $flag_load флаг полной загрузки объекта
     * @return Zero_Model
     * @throws Exception
     */
    public static function Make($model, $id = 0, $flag_load = false)
    {
        return new $model($id, $flag_load);
    }

    /**
     * Фабрика по созданию объектов.
     *
     * Сохраниаетсиа в {$тис->_Инстанcе}
     *
     * @param string $model имиа источника модель которой создаетсиа
     * @param integer $id идентификатор объекта
     * @param bool $flag_load флаг полной загрузки объекта
     * @return Zero_Model
     */
    public static function Instance($model, $id = 0, $flag_load = false)
    {
        $index = $model . (0 < $id ? '_' . $id : '');
        if ( !isset(self::$_Instance[$index]) )
        {
            $result = self::Make($model, $id, $flag_load);
            $result->Init();
            self::$_Instance[$index] = $result;
        }
        return self::$_Instance[$index];
    }

    /**
     * Фабрика по созданию объектов.
     *
     * Работает через сессию (Зеро_Сессион).
     * Индекс соурcе + [_{$ид} - если 0 < $флаг]
     *
     * @param string $model имиа источника модель которой создаетсиа
     * @param integer $id идентификатор объекта
     * @param bool $flag флаг полной загрузки объекта
     * @return Zero_Model
     */
    public static function Factory($model, $id = 0, $flag = false)
    {
        if ( !$result = Zero_Session::Get($model) )
        {
            $result = self::Make($model, $id, $flag);
            $result->Init();
            Zero_Session::Set($model, $result);
        }
        return $result;
    }

    /**
     * Save обььекта в реестр.
     *
     * Indeks source + [_{$id} - esli 0 < $flag]
     *
     * @param bool $flag opredeleniia indeksa ob``ekta (1 - uchity`vaia id, 0 - ne uchity`vaia id)
     */
    public function Factory_Set($flag = false)
    {
        $index = get_class($this);
        if ( $flag )
            $index .= '_' . $this->ID;
        Zero_Session::Set($index, $this);
    }

    /**
     * Удаление объекта из реестра.
     *
     * Индекс source + [_{$id} - esli 0 < $flag]
     *
     * @param bool $flag opredeleniia indeksa ob``ekta (1 - uchity`vaia id, 0 - ne uchity`vaia id)
     */
    public function Factory_Unset($flag = false)
    {
        $index = get_class($this);
        if ( $flag )
            $index .= '_' . $this->ID;
        Zero_Session::Rem($index);
    }

    /**
     * Динамический фабричный метод длиа создании объекта через фабрику.
     */
    protected function Init()
    {
    }

    /**
     * Получение идентификатора объекта
     *
     * @return integer идентификатор объекта
     */
    public function Get_ID()
    {
        return $this->ID;
    }

    /**
     * Переопределение идентификатора объекта
     *
     * @param integer $id идентификатор объекта
     */
    public function Set_ID($id)
    {
        $this->ID = intval($id);
    }

    /**
     * Получение имени источника
     *
     * @return string имиа источника
     */
    public function Get_Source()
    {
        return $this->Source;
    }

    /**
     * Получение свойств модели и их значений
     *
     * Значение $flag
     * - -1 получить только измененные свойства (не сохраненные)
     * - 0 получить все свойства (по умолчанию)
     * - 1 получить только не измененные свойства (сохраненные)
     *
     * @param int $flag какие свойства получать
     * @return array svoi`ства модели и их значении`
     */
    public function Get_Props($flag = 0)
    {
        if ( 0 === $flag )
            return $this->_Props;
        $result = [];
        foreach ($this->_Props_Change as $prop => $flag_prop)
        {
            if ( $flag_prop == $flag )
                $result[$prop] = $this->_Props[$prop];
        }
        return $result;
    }

    /**
     * Установка свойств через массив строго со стороны источнитка
     *
     * Если $ров' не передан то проишодит уставнока статуса в 1 длиа всех свойств
     * Иначе только длиа тех которые переданы
     *
     * @param array $row массив свойств и их значений
     * @return bool
     */
    public function Set_Props($row = [])
    {
        if ( 0 == count($row) )
        {
            foreach (array_keys($this->_Props_Change) as $prop)
            {
                $this->_Props_Change[$prop] = 1;
            }
            return true;
        }

        $config = $this->Get_Config_Prop();
        foreach ($row as $prop => $value)
        {
            //  Персональный или алгоритмичный сеттер
            if ( method_exists($this, $method = 'Set_' . $prop) )
            {
                $this->$method($value);
                continue;
            }
            //  Свойства модели
            if ( 'S' == $config[$prop]['DB'] && !is_array($value) )
            {
                if ( $value )
                    $this->_Props[$prop] = explode(',', $value);
                else
                    $this->_Props[$prop] = [];
            }
            else
                $this->_Props[$prop] = $value;
            $this->_Props_Change[$prop] = 1;
        }
        return true;
    }

    /**
     * Configuration model
     *
     * @param Zero_Model $Model The exact working model
     * @return array
     */
    protected static function Config_Model($Model)
    {
        return [];
    }

    /**
     * Получение конфигурации модели
     *
     * @return array двумерный ассоциативный массив конфигурации
     */
    public function Get_Config_Model()
    {
        $index = get_class($this);
        if ( !isset(self::$_Config[$index]['model']) )
        {
            self::$_Config[$index]['model'] = static::Config_Model($this);
            self::$_Config[$index]['model']['Comment'] = Zero_I18n::Model($index, $index);
        }
        return self::$_Config[$index]['model'];
    }

    /**
     * Configuration links many to many
     *
     * @param Zero_Model $Model The exact working model
     * @return array
     */
    protected static function Config_Link($Model)
    {
        return [];
    }

    /**
     * Получение конфигурации свиазей модели
     *
     * @return array двумерный ассоциативный массив конфигурации
     */
    public function Get_Config_Link()
    {
        return static::Config_Link($this);
    }

    /**
     * The configuration properties
     *
     * @param Zero_Model $Model The exact working model
     * @return array
     */
    protected static function Config_Prop($Model)
    {
        return [];
    }

    /**
     * Получение базовой конфигурация свойств
     *
     * - 'DB'=> 'I, F, T, E, S, D, B'
     * - 'IsNull'=> 'YES, NO'
     * - 'Default'=> 'mixed'
     * - 'Comment'=> 'Comment'
     * - 'Value'=> [] 'Values ​​for Enum, Set'
     *
     * @return array
     */
    public function Get_Config_Prop()
    {
        $index = get_class($this);
        if ( !isset(self::$_Config[$index]['props']) )
        {
            foreach (static::Config_Prop($this) as $prop => $row)
            {
                $row['Comment'] = Zero_I18n::Model($index, $prop);
                self::$_Config[$index]['props'][$prop] = $row;
            }
        }
        return self::$_Config[$index]['props'];
    }

    /**
     * Dynamic configuration properties for the filter
     *
     * @param Zero_Model $Model The exact working model
     * @param string $scenario scenario
     * @return array
     */
    protected static function Config_Filter($Model, $scenario = '')
    {
        return [];
    }

    /**
     * Dynamic configuration properties for the filter
     *
     * - 'Filter'=> 'Select, Radio, Checkbox, DateTime, Link, LinkMore, Number, Text, Textarea, Content
     * - 'Search'=> 'Number, Text'
     * - 'Sort'=> 'false, true'
     *
     * @param string $scenario scenario
     * @return array
     */
    public function Get_Config_Filter($scenario = '')
    {
        $props = static::Config_Filter($this, $scenario);
        $propsBase = $this->Get_Config_Prop();
        foreach ($props as $prop => $row)
        {
            if ( isset($propsBase[$prop]) )
                $props[$prop] = array_replace($propsBase[$prop], $row);
            else
            {
                $props[$prop]['Comment'] = Zero_I18n::Model(get_class($this), $prop);
            }
        }
        return $props;
    }

    /**
     * Dynamic configuration properties for the Grid
     *
     * - 'Grid' = 'AliasName.PropName'
     * - 'Comment' = 'PropComment'
     *
     * @param Zero_Model $Model The exact working model
     * @param string $scenario scenario
     * @return array
     */
    protected static function Config_Grid($Model, $scenario = '')
    {
        return [];
    }

    /**
     * Dynamic configuration properties for the Grid
     *
     * @param string $scenario scenario
     * @return array
     */
    public function Get_Config_Grid($scenario = '')
    {
        $props = static::Config_Grid($this, $scenario);
        $propsBase = $this->Get_Config_Prop();
        foreach ($props as $prop => $row)
        {
            if ( isset($propsBase[$prop]) )
                $props[$prop] = array_replace($propsBase[$prop], $row);
            else
            {
                $props[$prop]['Comment'] = Zero_I18n::Model(get_class($this), $prop);
            }
        }
        return $props;
    }

    /**
     * Dynamic configuration properties for the form
     *
     * @param Zero_Model $Model The exact working model
     * @param string $scenario scenario forms
     * @return array
     */
    protected static function Config_Form($Model, $scenario = '')
    {
        return [];
    }

    /**
     * Dynamic configuration properties for the form
     *
     * - 'Form'=> [
     *      Number, Text, Select, Radio, Checkbox, Textarea, Date, Time, DateTime, Link,
     *      Hidden, ReadOnly, Password, File, FileData, Img, ImgData, Content', LinkMore
     *      ]
     *
     * @param string $scenario scenario
     * @return array
     */
    public function Get_Config_Form($scenario = '')
    {
        $props = static::Config_Form($this, $scenario);
        $propsBase = $this->Get_Config_Prop();
        foreach ($props as $prop => $row)
        {
            if ( isset($propsBase[$prop]) )
                $props[$prop] = array_replace($propsBase[$prop], $row);
            else
            {
                $props[$prop]['Comment'] = Zero_I18n::Model(get_class($this), $prop);
            }
        }
        return $props;
    }

    /**
     * Получение ссылки на обьект Зеро_ДБ
     *
     * @return Zero_DB
     */
    public function Get_DB()
    {
        if ( !is_object($this->_DB) )
            $this->_DB = new Zero_DB($this);
        return $this->_DB;
    }

    /**
     * Получение ссылки на объект валидации
     *
     * @return Zero_Validator
     */
    public function Get_VL()
    {
        if ( !is_object($this->_VL) )
            $this->_VL = new Zero_Validator($this);
        return $this->_VL;
    }

    /**
     * Получение ссылки на объект кеширования
     *
     * @return Zero_Cache
     */
    public function Get_Cache()
    {
        if ( !is_object($this->_Cache) )
            $this->_Cache = new Zero_Cache($this);
        return $this->_Cache;
    }

    /**
     * Формирование from запроса
     */
    public function DB_From($params)
    {
        $this->DB->Sql_From("FROM {$this->Source} as z");
    }

    /**
     * Получение значения абстрактного свойства
     *
     * Универсальный геттер позволиающий обернуть все приамые обращения
     * к абстрактным свойствам в их персональный геттер
     *
     * @param string $prop абстрактное свойство наследуемого класса
     * @return mixed
     */
    public function __get($prop)
    {
        //  Персональный или алгоритмичный геттер
        if ( method_exists($this, $method = 'Get_' . $prop) )
            return $this->$method();
        //  читаем свойство
        if ( array_key_exists($prop, $this->_Props) )
            return $this->_Props[$prop];
        //  новый объект не существующий в БД и потому не имеющий никакого значения
        if ( 0 == $this->ID || !isset($this->Get_Config_Prop()[$prop]) )
            return null;
        //  свойство пустое, не загруженное из БД
        Zero_Logs::Set_Message_Notice('#{LOAD PROP} load prop "' . $prop . '" for model "' . get_class($this) . '"');
        $this->_Props[$prop] = Zero_DB::Sel_Filed($this->ID, $this->Source, $prop);
        return $this->_Props[$prop];
    }

    /**
     * Уставнока свойств со стороны внешнего мира (пользователиа)
     *
     * Универсальный сеттер позволиающий обернуть все приамые обращения
     * к абстрактным свойствам в их персональный сеттер
     *
     * @param string $prop абстрактное свойство наследуемого класса
     * @param mixed $value значение этого свойства
     * @return boolean
     */
    public function __set($prop, $value)
    {
        //  Персональный или алгоритмичный сеттер
        if ( method_exists($this, $method = 'Set_' . $prop) )
            return $this->$method($value);
        //  Свойства модели
        if ( !isset($this->_Props[$prop]) || $this->_Props[$prop] != $value )
        {
            $this->_Props[$prop] = $value;
            $this->_Props_Change[$prop] = -1;
        }
        return true;
    }

    /**
     * Перехват методов.
     *
     * Отслеживает обращение к несуществующим методам.
     * Ищет метод 'Cалл_' + МетодНаме<бр>
     * Ищет отношение (свиазь) с родителем. Если есть создает его и возвращает объект
     *
     * @param string $method абстрактный метод
     * @param array $params параметры метода
     * @return mixed|Zero_Model
     * @throws Exception
     */
    public function __call($method, $params)
    {
        //  стандартный метод перегрузки
        if ( method_exists($this, $method1 = 'Call_' . $method) )
            return $this->$method1($params);
        //  работа со свиазанным родительским объетом через свойтсво свиази (один ко многим)
        if ( isset($this->Get_Config_Prop()[$method]) )
            return self::Make(zero_relation($method), $this->$method, !empty($params[0]));
        throw new Exception('metod not found: ' . get_class($this) . ' -> ' . $method);
    }
}
