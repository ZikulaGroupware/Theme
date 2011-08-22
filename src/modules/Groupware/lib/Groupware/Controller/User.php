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

class Groupware_Controller_User extends Zikula_AbstractController
{

    //-----------------------------------------------------------//
    //-- Main ---------------------------------------------------//
    //-----------------------------------------------------------//

    
    public function main()
    {
        return $this->view();
    }

  
    public function view()
    {
        // Security check
        if (!SecurityUtil::checkPermission('Groupware::', '::', ACCESS_READ)) {
            return LogUtil::registerPermissionError();
        }
        
        // tasks
        //-------------------------
        $tasks = ModUtil::apiFunc('Tasks','user','getTasks', array(
           'mode'  => 'undone',
           'limit' => 4,
           'onlyMyTasks' => 'on'
        ) );
        $this->view->assign('tasks', $tasks);
        $finished_tasks = ModUtil::apiFunc('Tasks','user','getTasks', array(
           'mode'  => 'done',
           'limit' => 4,
           'orderBy' => 'done_date desc'
        ) );
        $this->view->assign('finished_tasks', $finished_tasks);
        
        //wiki
        //-------------------------
        $wiki_pages = ModUtil::apiFunc('Wikula', 'user', 'LoadRecentlyChanged', array(
            'numitems' => 3,
            'formated' => true
        ) );
        $this->view->assign('wiki_pages', $wiki_pages);
        
        
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
        $this->view->assign('events', $events);
        
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
        $this->view->assign('forum_posts', $posts );
        
        //birthdays
        $birthdays = ModUtil::apiFunc('AddressBook','user','getBirthdays');
        $this->view->assign('birthdays',  $birthdays );
        
        // comments
        //------------------------- 
        $options = array(
            'status' => 0,
            'numitems' => 3,
        );
        $items = ModUtil::apiFunc('EZComments', 'user', 'getall', $options);
        $comments = ModUtil::apiFunc('EZComments', 'user', 'prepareCommentsForDisplay', $items);
        $this->view->assign('comments', $comments);
        
        
        return $this->view->fetch('user/view.tpl');
    }

}