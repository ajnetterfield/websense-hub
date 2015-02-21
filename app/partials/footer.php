<div id='messages' class='messages'>
	<?php echo Application::messages(); ?>
</div>

<?php if (GRUNT_ENV == 'development'): ?>

  <script src="<?php echo Application::assets_dir() . 'js/config.js'; ?>"></script>
  <script src="<?php echo Application::assets_dir() . 'vendor/require/build/require.js'; ?>" data-main="<?php echo Application::assets_dir() . 'js/main.js'; ?>"></script>

<?php elseif (GRUNT_ENV == 'production'): ?>
  <script src="<?php echo Application::assets_dir() . 'js/scripts.min.js'; ?>"></script>
<?php endif; ?>
