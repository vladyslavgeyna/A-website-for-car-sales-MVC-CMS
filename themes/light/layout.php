<?php
/** @var string $title */
/** @var string $content */
/** @var string $siteName */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $siteName ?> — <?= $title ?></title>
    <link rel="stylesheet" href="/themes/light/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/themes/light/css/style.css">


</head>
<body>


    <?=$content?>




    <script src="/themes/light/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>