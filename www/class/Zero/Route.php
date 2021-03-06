<?php

/**
 * Component. RRouting or analysis of the incoming request.
 *
 * Definition and initialization of the input parameters of the request
 *
 * @package Zero.Component
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 */
class Zero_Route
{
    /**
     * Routing iazy`ka
     *
     * @var string
     */
    public $Lang = '';

    /**
     * Identifikator iazy`ka
     *
     * @var integer
     */
    public $LangId = 0;

    /**
     * Routing razdela s parametrami dlia navigatcii
     *
     * @var string
     */
    public $Url = '';

    /**
     * Routing iazy`ka
     *
     * @var array
     */
    public $Param = [];

    /**
     * Routing iazy`ka
     *
     * @var array
     */
    public $ApiUrlSegment = [];

    /**
     * Роутинг
     *
     * @var array
     */
    public $Route = [
        '/' => 'Www_Content_Page',
        '/test' => 'Www_Content_PageTest',
        '/api/users/data' => 'Www_Users_Api',
        '/api/users/directory/citys' => 'Www_Users_Api',
        '/api/users/directory/education' => 'Www_Users_Api',
    ];

    /**
     * Analiz request url
     */
    public function __construct()
    {
        $this->Lang = Zero_App::$Config->Site_Language;
        $this->LangId = Zero_App::$Config->Language[$this->Lang]['ID'];
        $this->Url = '/';

        // если запрос консольный
        if ( !isset($_SERVER['REQUEST_URI']) || $_SERVER['REQUEST_URI'] == '/' )
            return;

        if ( substr($_SERVER['REQUEST_URI'], -1) == '/' )
        {
            Zero_App::ResponseRedirect(substr($_SERVER['REQUEST_URI'], 0, -1));
        }

        $row = explode('/', strtolower(rtrim(ltrim(explode('?', $_SERVER['REQUEST_URI'])[0], '/'), '/')));

        // язык
        if ( $this->Lang != $row[0] && isset(Zero_App::$Config->Language[$row[0]]) )
        {
            $this->Lang = array_shift($row);
            $this->LangId = Zero_App::$Config->Language[$this->Lang]['ID'];
            $this->Url .= $this->Lang;
        }

        // api
        if ( 'api' == $row[0] )
        {
            Zero_App::$Mode = 'api';
            $this->ApiUrlSegment = $row;
            if ( $_SERVER['REQUEST_METHOD'] === "PUT" )
            {
                $data = file_get_contents('php://input', false, null, -1, $_SERVER['CONTENT_LENGTH']);
                $_POST = json_decode($data, true);
            }
            else if ( $_SERVER['REQUEST_METHOD'] === "POST" && isset($GLOBALS["HTTP_RAW_POST_DATA"]) )
            {
                $_POST = json_decode($GLOBALS["HTTP_RAW_POST_DATA"], true);
            }
        }

        // парамтеры
        if ( 0 < count($row) && $row[0] )
        {
            $param = array_pop($row);
            if ( preg_match("~.+?-([^/]+)$~", $param, $arr) )
            {
                $row[] = str_replace('-' . $arr[1], '', $param);
                foreach (explode('-', explode('.', $arr[1])[0]) as $segment)
                {
                    $arr = explode(':', $segment);
                    if ( 1 < count($arr) )
                        $this->Param[$arr[0]] = $arr[1];
                }
            }
            else
                $row[] = $param;
            $this->Url .= implode('/', $row);
        }
    }
}
