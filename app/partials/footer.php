<div id='messages' class='messages'>
	<?php echo Application::messages(); ?>
</div>

<?php if (GRUNT_ENV == 'development'): ?>
  <script src="<?php echo Application::assets_dir() . 'js/scripts.js'; ?>"></script>
<?php elseif (GRUNT_ENV == 'production'): ?>
  <script src="<?php echo Application::assets_dir() . 'js/scripts.min.js'; ?>"></script>
<?php endif; ?>
