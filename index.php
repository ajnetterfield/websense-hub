<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/app/init.php"); ?>

<!doctype HTML>

<html lang="en">

  <head>

    <?php Application::include_head(); ?>

  </head>

  <body class="home">

		<?php Application::include_header(); ?>

    <div class="container main" style="text-align: center;">
      <i class="fa fa-wifi" style="font-size: 300px; color: #fff;"></i>
      <div style="color: #fff;">
        <h1 style="font-size: 32px; margin: 0 0 20px 0;">WebSense Hub</h1>
        <p style="font-size: 18px;">Simple consolidation of sensor data.</p>
      </div>
    </div>

  </body>

	<?php Application::include_footer(); ?>

</html>
