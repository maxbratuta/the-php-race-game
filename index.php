<?php

use App\Race\Race;

require_once __DIR__ . '/vendor/autoload.php';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>The PHP Race Game</title>

    <style>
        html, body {
            margin: 0;
            padding: 0;
        }

        .container-wrapper {
            display: flex;
            justify-content: center;
        }

        .container {
            max-width: 500px;
            padding: 10px;
        }

        h3 {
            padding-bottom: 14px;
            text-align: center;
        }

        table {
            width: 100%;
            border: 1px solid;
            border-collapse: collapse;
        }

        td {
            border: 1px solid;
            padding: 3px 5px;
        }

    </style>
</head>
<body>
<div class="container-wrapper">
    <div class="container">
        <h3>The PHP Race Game</h3>
        <?php (new Race())->start()->displayRaceResults(); ?>
    </div>
</div>
</body>
</html>
