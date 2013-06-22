<?php Asset::add_asset('bootstrap', 'assets/css/bootstrap.min.css'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Debug</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php Asset::url('bootstrap') ?>">
    <style>
      body { padding-top: 80px; }
      h1 { margin-bottom: 20px;}
      strong{ font-size: medium; }
      ul { list-style: none; }
      ul li { margin-bottom: 10px; }
      .debug-list { margin-left: 0;}
      .value{ color: #777; font-size: medium;}

    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="span12">

                <h1>Debug</h1>

                <ul class="debug-list">
                <?php foreach($debug as $name => $value): ?>

                    <li>
                        <strong><?php echo $name ?>:</strong>

                        <?php if(is_array($value)): ?>

                            <ul class="debug-list-nest">

                            <?php foreach($value as $key => $subvalue): ?>
                                <li>

                                    <strong><?php echo $key ?>:</strong>

                                    <span class="value"><?php echo $subvalue ?></span>

                                </li>
                            <?php endforeach ?>

                            </ul>

                        <?php else: ?>

                            <span class="value"><?php echo $value ?></span>

                        <?php endif ?>

                    </li>

                <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>