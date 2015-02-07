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

        <h1 class="title">Sensors</h1>

        <div class="actions">
          <button class="btn btn-success" data-toggle="modal" data-target="#sensor_modal"><i class="fa fa-plus"></i> <span class="hidden-xs">New Sensor</span></button>
        </div>

      </div>
    </div>

    <div class="container main">

      <div class="table-responsive">

        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>ID</th>
              <th>Location</th>
              <th width="1%" colspan="2">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Bedroom 1 in-wall sensor</td>
              <td>HOBO-12343544</td>
              <td>Kalgoorlie</td>
              <td><button class="btn btn-sm btn-default pull-right" data-toggle="modal" data-target="#sensor_modal"><i class="fa fa-pencil fa-fw"></i></button></td>
              <td><button class="btn btn-sm btn-default btn-become-danger pull-right js-confirm"><i class="fa fa-trash-o fa-fw"></i></button></td>
            </tr>
            <tr>
              <td>2</td>
              <td>Bedroom 2 stick sensor</td>
              <td>HOBO-83645829</td>
              <td>Kalgoorlie</td>
              <td><button class="btn btn-sm btn-default pull-right" data-toggle="modal" data-target="#sensor_modal"><i class="fa fa-pencil fa-fw"></i></button></td>
              <td><button class="btn btn-sm btn-default btn-become-danger pull-right js-confirm"><i class="fa fa-trash-o fa-fw"></i></button></td>
            </tr>
            <tr>
              <td>3</td>
              <td>Kitchen hanging sensor</td>
              <td>HOBO-64738564</td>
              <td>Kalgoorlie</td>
              <td><button class="btn btn-sm btn-default pull-right" data-toggle="modal" data-target="#sensor_modal"><i class="fa fa-pencil fa-fw"></i></button></td>
              <td><button class="btn btn-sm btn-default btn-become-danger pull-right js-confirm"><i class="fa fa-trash-o fa-fw"></i></button></td>
            </tr>
            <tr>
              <td>4</td>
              <td>Living room hangning sensor</td>
              <td>HOBO-19384937</td>
              <td>Kalgoorlie</td>
              <td><button class="btn btn-sm btn-default pull-right" data-toggle="modal" data-target="#sensor_modal"><i class="fa fa-pencil fa-fw"></i></button></td>
              <td><button class="btn btn-sm btn-default btn-become-danger pull-right js-confirm"><i class="fa fa-trash-o fa-fw"></i></button></td>
            </tr>
          </tbody>
        </table>

      </div>

    </div>

    <?php Application::include_form('sensor'); ?>

  </body>

	<?php Application::include_footer(); ?>

  <script>
    $(document).ready(function() {
      $('.js-confirm').click(function() {
        return confirm('Are you sure?');
      });
    });
  </script>

</html>
