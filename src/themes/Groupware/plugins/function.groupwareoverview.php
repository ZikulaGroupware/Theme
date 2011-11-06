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
function smarty_function_groupwareoverview($params, &$smarty)
{

    
   // tasks
        //-------------------------
        $tasks = ModUtil::apiFunc('Tasks','user','getTasks', array(
           'mode'  => 'undone',
           'limit' => 4,
           'onlyMyTasks' => true
        ) );
        $smarty->assign('tasks', $tasks);
        $finished_tasks = ModUtil::apiFunc('Tasks','user','getTasks', array(
           'mode'  => 'done',
           'limit' => 4,
           'orderBy' => 'done_date desc'
        ) );
        $smarty->assign('finished_tasks', $finished_tasks);
        
        
        
        //wiki
        //-------------------------
        $wiki_pages = ModUtil::apiFunc('Wikula', 'user', 'LoadRecentlyChanged', array(
            'numitems' => 3,
            'formated' => true
        ) );
        $smarty->assign('wiki_pages', $wiki_pages);
        
        
        //events
        //-------------------------
        $start = date('m/d/Y');
        $oneweeklater = mktime(0, 0, 0, date("m"), date("d")+14, date("y"));
        $end = date("m/d/Y", $oneweeklater);
        $events0 = ModUtil::apiFunc('PostCalendar', 'event', 'getEvents', array(
            'start' => $start,
            'end' => $end,
        ) );
        $events = array();
        foreach($events0 as $events1) {
             foreach($events1 as $event) {
                 $events[] = $event;
             }
        }
        $smarty->assign('events', $events);
        
        //forum
        //-------------------------        

        list($last_visit, $last_visit_unix) = ModUtil::apiFunc('Dizkus', 'user', 'setcookies');
        list($posts, $m2fposts, $rssposts, $text) = ModUtil::apiFunc('Dizkus', 'user', 'get_latest_posts', array('selorder'   => 7,
           'nohours'    => 336,
           'amount'     => 100,
           'unanswered' => 0,
           'last_visit' => $last_visit,
           'last_visit_unix' => $last_visit_unix
        ));
        $smarty->assign('forum_posts', $posts );
        
        //birthdays
        $birthdays = ModUtil::apiFunc('AddressBook','user','getBirthdays');
        $smarty->assign('birthdays',  $birthdays );
        
        // comments
        //------------------------- 
        $options = array(
            'status' => 0,
            'numitems' => 3,
        );
        $items = ModUtil::apiFunc('EZComments', 'user', 'getall', $options);
        $comments = ModUtil::apiFunc('EZComments', 'user', 'prepareCommentsForDisplay', $items);
        $smarty->assign('comments', $comments);
        
        return $smarty->fetch('view.tpl');
    
}
