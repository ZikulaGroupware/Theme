<?php

/**
 * Copyright Groupware Team 2011
 *
 * This work is licensed to You under the following license:
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 * @package Groupware
 * @link https://github.com/phaidon/Groupware
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

/**
 * Smarty function to display a login in the menu
 *
 * Example
 * {adminlink}
 *
 * Two additional defines need adding to a xanthia theme for this plugin
 * _CREATEACCOUNT and _YOURACCOUNT
 *
 * @author       Fabian Wuertz
 * @since        21/10/03
 * @see          function.myuserPageEdit.php::smarty_function_myuserPageEdit()
 * @param        array       $params      All attributes passed to this function from the template
 * @param        object      &$smarty     Reference to the Smarty object
 * @param        string      $start       start delimiter
 * @param        string      $end         end delimiter
 * @param        string      $seperator   seperator
 * @return       string      user links
 */
function smarty_function_adminlink($params, &$smarty)
{

    // Security check
    if (SecurityUtil::checkPermission( '.*', '.*', ACCESS_ADMIN)) {
        $link = '<a href="' . 
        ModUtil::url('adminpanel','admin','adminpanel') .
        '">Administration</a>';
        return '<li>'.$link.'</li>';
    }
        
}
