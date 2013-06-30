<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Debug Page</title>
    <style>
        html {
            height: 100%;
            width: 100%;
            background-color: #111;
            color: #2ecc71;
        }
        body { font-family: 'Courier', Tahoma, Helvetica, Arial, sans-serif; }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            color: ;
            margin: 0;
            padding: 0;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h3>Stack trace:</h3>
    <ul>
        <?php foreach($stack as $entry): ?>
            <li><?php echo $entry ?></li>
        <?php endforeach ?>
    </ul>
</body>
</html>