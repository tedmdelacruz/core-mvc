<?php
    Asset::add('bootstrap', 'assets/css/bootstrap.min.css');
    Asset::add('bootstrap-responsive', 'assets/css/bootstrap-responsive.min.css');
    Asset::add('master', 'assets/css/master.css');
    Asset::add('app', 'assets/js/app.js');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="author" content="Ted Mathew dela Cruz">
    <meta name="description" content="">
    <link rel="stylesheet" href="<?php Asset::url('bootstrap') ?>">
    <link rel="stylesheet" href="<?php Asset::url('bootstrap-responsive') ?>">
    <link rel="stylesheet" href="<?php Asset::url('master') ?>">
    <style>
        body { padding-top: 120px; }
        h1 {
            font-size: 120px;
            margin-bottom: 40px;
            color: #9d261d;
            text-align: center;
        }
        p{
            color: #777;
            font-size: medium;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="span12">
                <h1><?php echo ($code == 0 ? 'Error' : $code) ?></h1>
                <p><?php echo $message ?></p>
                <p><a href="<?php echo baseUrl() ?>">Go back</a></p>
            </div>
        </div>
    </div>
</body>
</html>