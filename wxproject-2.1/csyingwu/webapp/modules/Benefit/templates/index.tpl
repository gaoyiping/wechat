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
                <h1>周期分红</h1>
                <form class="form-horizontal" method="post" action="index.php?module=Benefit">
                    <div class="col-sm-12">
                        <p class="form-control-static">本期总额 ¥{$total}元</p>
                    </div>
                    <button type="submit" class="btn btn-success">确定分红</button>
                </form>
                <p>&nbsp;</p>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <table class="table table-bordered table-hover table-condensed">
                    <thead><tr><th>会员ID</th><th>剩余金额</th><th>本期金额</th><th>总金额</th></tr></thead>
                    <tbody>
                        {foreach from=$benefitlist item=benefit name=bl}
                        <tr>
                            <td>{$benefit->user_id}</td>
                            <td>¥{$benefit->benefit_less}元</td>
                            <td>¥{$benefit->benefit_once}元</td>
                            <td>¥{$benefit->benefit_total}元</td>
                        </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>