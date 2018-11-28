<!-- 追盘 -->
<div style="font-family:Tahoma,Verdana;">
<table align='center' border=0 cellpadding=0 cellspacing=0 width=80%>
  {foreach from=$nodes item=item name=for1}
  {if $smarty.foreach.for1.iteration%5==1} <tr> {/if}
  {assign var='color' value='red'}
  {if $item.b==1} {assign var='color' value='blue'} {/if}
  <td><div class="in">
    <div class="{$color}{if $item.n==$userid} self{/if}{if $item.n==null} gray{/if}">
      <div class="top" title=" {$item.p}" 
        {if $color=='blue'&&$item.n!=null}style="border-bottom:1px solid black;"{/if}
        {if $color=='red'&&$item.n!=null}style="border-bottom:1px solid red;"{/if}>
        <a style="font-size:14px;" href="index.php?module=BoardStatus&userid={$item.n}" target=_blank>{$item.n}</a>
        <span style="font-size: 10px;color: blue;"><sup>{$node.leader}</sup></span>
      </div>
      <div style="font-size:14px;">{$item.l}<font color=blue>{$item.lr}</font></div>
      <div style="font-size:14px;">{$item.r}<font color=blue>{$item.rr}</font></div>
    </div>
  </div></td>
  {if $smarty.foreach.for1.iteration%5==0} </tr> {/if}
  {/foreach}
</table>
</div>
