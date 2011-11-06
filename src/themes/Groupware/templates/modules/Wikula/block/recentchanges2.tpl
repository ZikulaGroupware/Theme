<p style="float:right;margin-top:-25px">
    <a href="{modurl modname='Wikula' type='user' func='recentchangesxml' theme='rss'}" title="RSS">
        {img modname='wikula' src='rss.png' __title='RSS' __alt='RSS'}
    </a>
</p>

{if $pagelist}
  {assign var='currentdate' value=''}
  {foreach from=$pagelist key='date' item='pages'}
    {foreach from=$pages item='page'}
      <a href="{modurl modname='Wikula' type='user' func='main' tag=$page.tag|urlencode}" title="{$page.tag}">{$page.tag}</a>
      <span class="z-sub">{gt text='by' comment="e.g. written by Drak"}</span> {$page.user} <span class="z-sub">({$page.time|date_format:'%d.%m'})</span>
      {if $page.note neq ''}<br /><span class="pagenote">[ {$page.note} ]</span>{/if}
      <br />
    {/foreach}
  {foreachelse}
    {gt text='There are no recent changes'}
  {/foreach}
{/if}
