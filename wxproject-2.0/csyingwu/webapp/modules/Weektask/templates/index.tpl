<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="resource/bootstrap3.3.5/css/bootstrap.min.css"/>
    <script type="text/javascript" src="resource/jquery-2.2.1.min.js"></script>
    <script type="text/javascript" src="resource/bootstrap3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h1>会员周考核</h1>
                <table class="table table-bordered table-hover table-condensed">
                    <thead style="font-weight: bold;"><tr><td colspan="4" style="padding-left: 1em;">大富豪 (共{$Level5Count}人)</td></tr></thead>
                    <tbody>
                        {foreach from=$Level5 item=item name=l5}
                        <tr>
                            <td width="8%">{$item->user_id}</td>
                            <td>{$item->wxname}</td>
                            <td width="20%">{$item->task_day}</td>
                            <td width="20%">{$item->uplevel}</td>
                        </tr>
                        {foreachelse}
                        <tr><td colspan="4">无</td></tr>
                        {/foreach}
                    </tbody>
                    <thead style="font-weight: bold;"><tr><td colspan="4" style="padding-left: 1em; padding-top: 1.5em;">富豪 (共{$Level4Count}人)</td></tr></thead>
                    <tbody>
                        {foreach from=$Level4 item=item name=l4}
                        <tr>
                            <td width="8%">{$item->user_id}</td>
                            <td>{$item->wxname}</td>
                            <td width="20%">{$item->task_day}</td>
                            <td width="20%">{$item->uplevel}</td>
                        </tr>
                        {foreachelse}
                        <tr><td colspan="4">无</td></tr>
                        {/foreach}
                    </tbody>
                    <thead style="font-weight: bold;"><tr><td colspan="4" style="padding-left: 1em; padding-top: 1.5em;">东家 (共{$Level3Count}人)</td></tr></thead>
                    <tbody>
                        {foreach from=$Level3 item=item name=l3}
                        <tr>
                            <td width="8%">{$item->user_id}</td>
                            <td>{$item->wxname}</td>
                            <td width="20%">{$item->task_day}</td>
                            <td width="20%">{$item->uplevel}</td>
                        </tr>
                        {foreachelse}
                        <tr><td colspan="4">无</td></tr>
                        {/foreach}
                    </tbody>
                    <thead style="font-weight: bold;"><tr><td colspan="4" style="padding-left: 1em; padding-top: 1.5em;">掌柜 (共{$Level2Count}人)</td></tr></thead>
                    <tbody>
                        {foreach from=$Level2 item=item name=l2}
                        <tr>
                            <td width="8%">{$item->user_id}</td>
                            <td>{$item->wxname}</td>
                            <td width="20%">{$item->task_day}</td>
                            <td width="20%">{$item->uplevel}</td>
                        </tr>
                        {foreachelse}
                        <tr><td colspan="4">无</td></tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>


