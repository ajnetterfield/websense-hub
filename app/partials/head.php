<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<link rel="icon" href="/favicon.png" sizes="32x32" />
<link rel="apple-touch-icon-precomposed" href="/favicon_lg.png">
<meta name="msapplication-TileImage" content="/favicon_lg.png"/>

<?php if (GRUNT_ENV == 'development'): ?>
  <link href="<?php echo Application::assets_dir() . 'css/main.css'; ?>" rel="stylesheet">
<?php elseif (GRUNT_ENV == 'production'): ?>
  <link href="<?php echo Application::assets_dir() . 'css/main.min.css'; ?>" rel="stylesheet">
<?php endif; ?>

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<title><?php Application::print_title(); ?></title>
