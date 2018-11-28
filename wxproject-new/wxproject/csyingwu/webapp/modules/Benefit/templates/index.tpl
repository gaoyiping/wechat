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
                <h1>福利补贴</h1>
                <form class="form-horizontal" method="post" action="index.php?module=Benefit">
                    <div class="col-sm-12">
                        <p class="form-control-static">补贴总额 ¥{$total}元</p>
                    </div>
                    <button type="submit" class="btn btn-success" onclick="return confirm('您确定要发放吗?');">确定发放</button>
                </form>
                <p>&nbsp;</p>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <table class="table table-bordered table-hover table-condensed">
                    <thead><tr><th>会员ID</th><th>福利补贴</th><th>操作</th></tr></thead>
                    <tbody>
                        {foreach from=$benefitlist item=benefit name=bl}
                        <tr>
                            <td>{$benefit->user_id}</td>
                            <td>¥{$benefit->benefit_once}元</td>
                            <td><a class="btn btn-danger" onclick="return confirm('您确定要删除吗?');" href="index.php?module=Benefit&action=Del&userid={$benefit->user_id}">删除</a></td>
                        </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>