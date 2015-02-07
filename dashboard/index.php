<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/app/init.php"); ?>

<!doctype HTML>

<html lang="en">

  <head>

    <?php Application::include_head(); ?>

  </head>

  <body>

		<?php Application::include_header(); ?>

    <div class="header">
      <div class="container">

        <h1 class="title">Dashboard</h1>

        <div class="actions">
          <button class="btn btn-default">Configure</button>
        </div>

      </div>
    </div>

    <div class="container main">
      <div id="highstocks-container" class="highstocks-wrapper" style="height: 500px; min-width: 310px"></div>
    </div>

  </body>

	<?php Application::include_footer(); ?>

  <script>

    $(function () {
      $.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=aapl-c.json&callback=?', function (data) {
        $('#highstocks-container').highcharts('StockChart', {
          rangeSelector : {
            selected : 1
          },
          title : {
            text : 'BOM Temperature'
          },
          series : [{
            name : 'BOM',
            data : data,
            tooltip: {
              valueDecimals: 2
            }
          }]
        });
      });
    });
  </script>

</html>
