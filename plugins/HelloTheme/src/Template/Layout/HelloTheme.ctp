<!DOCTYPE html>
<html lang="ja">
 <head>
	<?=$this->Html->charset(); ?>
	<title>
		<?= $this->fetch('title') ?>
	</title>
	<?php
	echo $this->Html->css('HelloTheme');
	echo $this->Html->script('HelloTheme');
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">** Header **</div>
		<div id="content">
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">** this is test. **</div>
	</div>
</body>
</html>
