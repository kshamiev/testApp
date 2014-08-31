<?php

/**
 * Controller. Content Page.
 *
 * usage for plugin: {controller "Www_Content_Page" block="footer"}
 *
 * @package Zero.Content.Controller
 * @author Konstantin Shamiev aka ilosa <konstantin@phpzero.com>
 * @version $Id$
 * @link http://www.phpzero.com/
 * @copyright <PHP_ZERO_COPYRIGHT>
 * @license http://www.phpzero.com/license/
 */
class Www_Content_Page extends Zero_Controller
{
    /**
     * Create views.
     *
     * @return boolean flag stop execute of the next chunk
     */
    public function Action_Default()
    {
        $this->View = new Zero_View('Content_Page');
        $this->View->Assign('Name', 'Тест выборки данных о пользователях');
        $this->View->Assign('Content', 'По умолчанию выводятся все пользователи.</br>Воспользуйтесь фильтрами для получения выборочной информации.');
        return $this->View;
    }
}
