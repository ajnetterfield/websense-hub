<div id='messages' class='messages'>
	<?php echo Application::messages(); ?>
</div>

<?php if (GRUNT_ENV == 'development'): ?>

  <script src="/app/assets/vendor/jquery/dist/jquery.js"></script>
  <script src="/app/assets/vendor/underscore/underscore.js"></script>
  <script src="/app/assets/vendor/bootstrap/dist/js/bootstrap.js"></script>
  <script src="/app/assets/vendor/moment/moment.js"></script>
  <script src="/app/assets/vendor/moment-timezone/moment-timezone.js"></script>
  <script src="/app/assets/vendor/highstock/highstock.js"></script>

<?php elseif (GRUNT_ENV == 'production'): ?>
  <script src="<?php echo Application::assets_dir() . 'js/scripts.min.js'; ?>"></script>
<?php endif; ?>
