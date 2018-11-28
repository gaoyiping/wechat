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
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <h1>福利充值</h1>
                <form class="form-horizontal" method="post" action="index.php?module=Benefit&action=Putin">
                    <div class="form-group">
                        <label>用户ID</label>
                        <input type="text" name="userid" class="form-control" placeholder="wrj1">
                    </div>
                    <div class="form-group">
                        <label>用户积分</label>
                        <input type="text" name="uservalue" class="form-control" placeholder="0.0">
                    </div>
                    <button type="submit" class="btn btn-success" onclick="return confirm('您确定要充值吗?');">确定充值</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>