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

           <div class="span4 offset3">

              <h3>Users</h3>

              <a href="#" class="btn btn-small btn-primary">Create user</a>

              <?php if ( ! empty($users)): ?>

              <ul class="user-list">

                <?php foreach ($users as $user): ?>

                  <li class="user">
                    <span class="username"><?php echo $user->username ?></span>
                    <span class="timestamp"><?php echo $user->created ?></span>
                    <span class="actions"><a href="#"><i class="icon icon-pencil"></i></a> <a href="#"><i class="icon icon-remove"></i></a></span>
                  </li>

                <?php endforeach ?>

              </ul>

              <?php else: ?>

              <p><em>No users found.</em></p>

              <?php endif ?>

           </div>

       </div>

    </div>

    <script src="<?php Asset::url('app') ?>"></script>

</body>
</html>