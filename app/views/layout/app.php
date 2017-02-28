<?php
  $router = Config::get('router');
?>
<!DOCTYPE html>
<html lang="pl" class="no-js">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="noodp" name="robots">
    <meta content="noydir" name="robots">
    <title>Magazyn</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/public/assets/css/normalize.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="/public/assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/public/assets/css/fonts.css">
    <link rel="stylesheet" type="text/css" href="/public/assets/css/application.css">
    <link rel="stylesheet" type="text/css" href="/public/assets/css/font-awesome/css/font-awesome.min.css">

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <?php # include 'app/views/shared/_stylesheet.php'; ?>
    <?php # include 'app/views/shared/_javascript.php'; ?>
  </head>
  <body data-env="<?= Config::get('env') ?>">
    <?php
      include 'app/views/shared/_header.php';
    ?>
    <div id="content">
      <?php
        if($path) {
          include $path;
        } else {
          include 'app/views/shared/404.php';
        }
      ?>
    </div>
    <?php
      include 'app/views/shared/_footer.php';
    ?>
  </body>
</html>
