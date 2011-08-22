<div id="theme_navigation_bar">
    <div style="float:left">
        <ul class="z-clearfix">
            <li><a href="{homepage}">{gt text='Home'}</a></li>
            <li><a href="{modurl modname='Tasks' type='user' func='main'}">To-Do</a></li>
            <li><a href="{modurl modname='Dizkus' type='user' func='main'}">Forum</a></li>
            <li><a href="{modurl modname='Wikula' type='user' func='main'}">Wiki</a></li>
            <li><a href="{modurl modname='PostCalendar' type='user' func='main'}">Kalender</a></li>
            <li><a href="{modurl modname='Addressbook' type='user' func='main'}">Adressbuch</a></li>
            <li><a href="{modurl modname='Users' type='user' func='main'}">Einstellungen</a></li>
            {adminlink}
            <li><a href="{modurl modname='Users' type='user' func=logout}">Log-out</a></li>
        </ul>
    </div>

    <div style="float:right;margin-right:10px">
        <form class="z-form z-linear" method="post" action="{modurl modname="Search" type="user" func="search"}">
            <input type="text" name="q" size="20" maxlength="255" style="border:1px" value="Suchen" onfocus="if(this.value=='{gt text='Suchen'}')this.value=''" />
       </form>
    </div>
</div>