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
    <style>
      body { padding-top: 120px; }
    </style>
</head>
<body>

    <div class="container">

       <div class="row">

           <div class="span12">

                <h1>Welcome to Core</h1>
                <p>Core is a micro MVC framework by Ted Mathew dela Cruz</p>
                <p>This is a personal case study of Ted Mathew dela Cruz for OOP concepts and MVC framework construction from scratch.</p>
                <a href="https://github.com/tedmdelacruz/core-mvc">GitHub</a> | <a href="http://tedmdelacruz.com">Author</a>

           </div>

       </div>

    </div>

    <script src="<?php Asset::url('app') ?>"></script>

</body>
</html>