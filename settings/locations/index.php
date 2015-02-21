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

        <h1 class="title">Locations</h1>

        <div class="actions"></div>

      </div>
    </div>

    <div class="container main">

      <?php //print_r($db->get_cluster_id('sensor')); ?>

      <?php

        // print_r(Database::parse_rid("#12:12")[0]);

        // // CREATE
        // $sensor = new Sensor();
        // $sensor->init(null, 'AJ Sensor', 'SENSOR-12345', array('metric' => 'celcius'))->save();

        // // UPDATE
        // $sensor = new Sensor();
        // $sensor->init(1, 'AJ Sensor', 'SENSOR-12345', array('metric' => 'celcius'))->save();

        // //DELETE
        // $sensor = new Sensor();
        // $sensor->load(8);
        // $sensor->destroy();

        // LOAD
        // $sensor = new Sensor();
        // $sensor->set_position(1);
        // $sensor->load();
        // $attributes = $sensor->get_attributes();
        // $attributes['title'] = "New Title";
        // $attributes['metric'] = "Celcius";
        // $sensor->set_attributes($attributes);
        // $sensor->save();

        // SAVE
        // $attributes = array(
        //   'title' => 'Sensor A',
        //   'sensor_id' => 'SENSOR-A',
        //   'metric' => 'celcius'
        // );
        // $sensor = new Sensor();
        // $sensor->set_attributes($attributes);
        // $sensor->save();

        // $locations = Location::all();
        // $locations = Location::where(array("title" => "Kalgoorlie"));

        // print_r($locations[0]['parent']);

        // foreach ($sensors as $rid => $sensor) {
        //   $name = $sensor["title"];
        //   $sensor_id = $sensor["sensor_id"];

        //   echo "<h2>$rid : $name : $sensor_id</h2>";
        // }

        // $sensor = new Sensor();
        // $query = $sensor->query()->
        //   ->select(['title', 'sensor_id', 'location.title', 'location.@rid'])
        //   ->where([
        //     '@rid' => '#12:0',
        //     'title' => 'HOBO Sensor 1', 
        //     'sensor_id' => '123456789'
        //   ])
        //   ->order(['title']);
        // echo($query->get_statement());
        // print_r($query->execute()->get_results());

        // $query = new Query();
        // $query->select(['title', 'sensor_id', 'location.title', 'location.@rid'])
        //   ->from(['Sensor'])
        //   ->where([
        //     '@rid' => '#12:0',
        //     'title' => 'HOBO Sensor 1', 
        //     'sensor_id' => '123456789'
        //   ])
        //   ->order(['title']);

        // echo ($query->get_statement());
        // print_r($query->execute()->get_results());

        $attributes = ['@rid', 'title', 'location.title', 'metric'];
        $results = Sensor::query()->select($attributes)->execute()->get_results();
        $sensors = Sensor::parse_results($results);
        foreach ($sensors as $sensor) {
          $rows[] = Format::tr($sensor->get_rid(), $attributes, $sensor->get_attributes());
        }
      ?>

      <select class="form-control" name="test-select">
        <?php echo $sensor->get_options(['location.@rid' => '#14:2']); ?>
      </select>

      <table class="table table-striped">
        <?php echo Format::thead($attributes); ?>
        <tbody>
          <?php echo implode('', $rows); ?>
        </tbody>
      </table>

    </div>

  </body>

	<?php Application::include_footer(); ?>

</html>
