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
        // $sensor->init(null, 'AJ Sensor', 'SENSOR-12345', array('metric' => 'celcius'));
        // $sensor->save();

        // // UPDATE
        // $sensor = new Sensor();
        // $sensor->init(null, 'AJ Sensor', 'SENSOR-12345', array('metric' => 'celcius'));
        // $sensor->save();

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

        $query = new Query();

        $query->select(['title', 'sensor_id', 'location.title', 'location.@rid'])
              ->from(['Sensor'])
              ->where([
                '@rid' => '#12:0',
                'title' => 'HOBO Sensor 1', 
                'sensor_id' => '123456789'
              ])
              ->order(['title']);

        echo ($query->to_s());
        // print_r($query->execute()->to_a());

      ?>

    </div>

  </body>

	<?php Application::include_footer(); ?>

</html>
