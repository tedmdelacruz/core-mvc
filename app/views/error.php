<?php
    Asset::add_asset('bootstrap', 'assets/css/bootstrap.min.css');
    Asset::add_asset('bootstrap-responsive', 'assets/css/bootstrap-responsive.min.css');
    Asset::add_asset('master', 'assets/css/master.css');
    Asset::add_asset('app', 'assets/js/app.js');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="author" content="<?php echo $author ?>">
    <meta name="description" content="<?php echo $description ?>">
    <link rel="stylesheet" href="<?php Asset::url('bootstrap') ?>">
    <link rel="stylesheet" href="<?php Asset::url('bootstrap-responsive') ?>">
    <link rel="stylesheet" href="<?php Asset::url('master') ?>">
    <style>
      body { padding-top: 120px; }
      h1 { font-size: 65px; margin-bottom: 20px; color: #9d261d; }
      p{ color: #777; font-size: medium;}
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="span12">
                <h1><?php echo ($code == 0 ? 'Error' : $code) ?></h1>
                <p><?php echo $message ?></p>
            </div>
        </div>
    </div>
</body>
</html>