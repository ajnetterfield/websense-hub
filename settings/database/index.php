<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/app/init.php"); ?>

<?php $database = new Database(); ?>

<!doctype HTML>

<html lang="en">

  <head>

    <?php Application::include_head(); ?>

  </head>

  <body>

		<?php Application::include_header(); ?>

    <div class="header">
      <div class="container">

        <h1 class="title">Database</h1>

      </div>
    </div>

    <div class="container main">

      <div class="row">

        <div class="col-sm-6">
          <h2>Query</h2>
          <div>
            <?php
              $type = (isset($_POST['type'])) ? $_POST['type'] : "";
              $query = (isset($_POST['query'])) ? $_POST['query'] : "";
            ?>
          </div>
          <form action="." method="POST">
            <label for="type">Query Type</label>
            <select name="type" class="form-control">
              <option value="query" <?php echo ($type == 'query') ? "selected" : ''; ?>>Query (SELECT)</option>
              <option value="command" <?php echo ($type == 'command') ? "selected" : ''; ?>>Command (INSERT, UPDATE, DELETE)</option>
            </select>
            <label for="query">Query</label>
            <textarea name="query" class="form-control" rows="4"><?php echo Application::sanitize_html($query); ?></textarea>
            <input type="submit" class="btn btn-primary" />
          </form>
        </div>

        <div class="col-sm-6">
          <h2>Result</h2>
          <div class="well">
            <?php
              if ($query != "") {
                switch ($type) {
                  case "query":
                    print_r($db->query($query));
                    break;

                  case "command":
                    print_r($db->command($query));
                    break;

                  default:
                    break;
                }
              } else {
                // print_r($db->create(11, array("name" => "Qwerty")));
              }
            ?>
          </div>
        </div>

      </div>

    </div>

  </body>

	<?php Application::include_footer(); ?>

</html>
