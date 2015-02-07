<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
      <a class="navbar-brand" href="/"><i class="fa fa-wifi"></i> WebSense Hub</a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
        <li class="<?php Application::print_active_page('dashboard') ?>"><a href="/dashboard">Dashboard</a></li>
        <li class="<?php Application::print_active_page('sensors') ?>"><a href="/sensors">Sensors</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			  <li class="dropdown <?php Application::print_active_dropdown('settings') ?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cogs"></i> Settings <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
            <li class="<?php Application::print_active_page('locations') ?>"><a href="/settings/locations">Locations</a></li>
            <li class="<?php Application::print_active_page('database') ?>"><a href="/settings/database">Database</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
