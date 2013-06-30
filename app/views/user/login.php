<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="author" content="<?php echo $author ?>">
    <meta name="description" content="<?php echo $description ?>">
    <link rel="stylesheet" href="<?php Asset::url('bootstrap') ?>">
    <link rel="stylesheet" href="<?php Asset::url('bootstrap-responsive') ?>">
    <link rel="stylesheet" href="<?php Asset::url('master') ?>">
</head>
<body>

    <?php View::render('default/header') ?>

    <div class="container">
        <div class="row">
            <div class="span12">
                <h2>Login</h2>
                <form action="<?php echo baseUrl('user/login') ?>" class="login-form form-horizontal" method="post" autocomplete="off">
                    <div class="control-group">
                        <label for="username" class="control-label">Username</label>
                        <div class="controls">
                            <input type="text" name="username" id="username"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="password" class="control-label">Password</label>
                        <div class="controls">
                            <input type="password" name="password" id="password"/>
                        </div>
                    </div>
                    <hr/>
                    <div class="control-group">
                        <input type="submit" class="btn btn-primary" value="Login">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>