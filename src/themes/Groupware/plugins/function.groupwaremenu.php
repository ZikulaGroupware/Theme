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
function smarty_function_groupwaremenu($params, &$smarty)
{

    $dom = ZLanguage::getThemeDomain('Groupware');
    
    $output  = '<div id="theme_menu_container">';
        
    $output .= '<div class="groupware_mainmenu">'.
               '<a href="'.System::getHomepageUrl().'">'.__('Home', $dom).'</a>'.
               '</div>';   
        
    $modules['Tasks']  = __('Tasks', $dom); 
    $modules['Dizkus'] = __('Forum', $dom); 
    $modules['Wikula'] = __('Wiki', $dom);
    $modules['PostCalendar'] = __('Calendar', $dom);
    $modules['AddressBook'] = __('Adressbook', $dom); 
    $modules['Users'] = __('Settings', $dom); 
    foreach($modules as $modname => $title) {
        if( ModUtil::available($modname) ) {
            $classname = 'groupware_mainmenu';
            if(ModUtil::getName() == $modname) {
                $classname .= '2';
            }
            $output .= '<div class="'.$classname.'">'.
                       '<a href="'.ModUtil::url($modname, 'user', 'main').'">'.$title.'</a>'.
                       '</div>';
        }
    }
    
    
    // Security check
    if (SecurityUtil::checkPermission( '.*', '.*', ACCESS_ADMIN)) {
        $type = FormUtil::getPassedValue('type',   null, "GET");
        $classname = 'groupware_mainmenu';
            if($type == 'admin') {
                $classname .= '2';
            }
        $output .= '<div class="'.$classname.'">'.
                   '<a href="'.ModUtil::url('adminpanel', 'admin', 'adminpanel').'">'.
                   __('Administration', $dom).
                    '</a>'.
                   '</div>';
    }
    
    if(UserUtil::isLoggedIn()) {
        $output .= '<div class="groupware_mainmenu">'.
               '<a href="'.ModUtil::url('Users', 'user', 'logout').'">'.
               __('Log-out', $dom).
               '</a>'.
               '</div>';
    }
    
    
    $output .= '</div>';
    return $output;
    
}
