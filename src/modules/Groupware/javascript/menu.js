document.observe('dom:loaded', groupware_menu_init);

function groupware_menu_init()
{
    //$('menu_todo_link').observe('clicked', groupware_menu_clicked);

    //$('menu_todo_container').hide();
}

function groupware_menu_clicked()
{
    $('menu_todo_container').toggle();
}

