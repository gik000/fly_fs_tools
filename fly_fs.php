<?php
  define('CURRENT_PATH',__DIR__);
  $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  define('CURRENT_URL',$protocol.$_SERVER['HTTP_HOST']);
  define('CURRENT_URL_FULL',$protocol.$_SERVER['HTTP_HOST'].'/'.basename(__FILE__));
  require_once(CURRENT_PATH.'/fly_fs/fly_fs_loader.php');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Fly FS - a filesystem swissknife</title>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <div class="container">
    <header class="row">
      <div class="col-md-3">
        <h1>Fly FS</h1>
        <h2>a filesystem swissknife</h2>
      </div>
      <div class="col-md-9">
        <?php print $side_header; ?>
      </div>
    </header>
  </div>
  <div class="container">
    <aside class="sidebar col-md-3">
      <?php print $menu; ?>
      <?php print $sidebar; ?>
    </aside>
    <div id="content" class="col-md-9">
      <?php print $content; ?>
    </div>
  </div>
  <div class="container">
    <footer class="col-md-12">
      ...
    </footer>
  </div>
  <div class="closure"></div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Bootstrap -->
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <?php
    print $scripts;
    print $styles;
  ?>
</body>
</html>