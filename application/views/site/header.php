<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- ! -->
	<title><?= $configuration['app_name'] ?: 'Hubii' ?></title>
	<link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>assets/img/favicon.png" />
	<!-- ! -->
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap-responsive.min.css" />
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/matrix-style.css" />
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/matrix-media.css" />
	<link href="<?= base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/fullcalendar.css" />

	<!--Tema-->
	<?php if ($configuration['app_theme'] == 'white') { ?>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/tema.css" />
  <?php } ?>
</head>

<body>
	<div>
		<h1>TESTE</h1>
	</div>
</body>

</html>
