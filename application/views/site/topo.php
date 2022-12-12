<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title><?= $configuration['app_name'] ?: 'Hubii' ?></title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>assets/img/favicon.png" />
	<!-- Google Web Fonts -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;500;700&display=swap' rel='stylesheet' type='text/css'>
	<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

	<!-- Libraries Stylesheet -->
	<link href="lib/animate/animate.min.css" rel="stylesheet">

	<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

	<!-- Customized Bootstrap Stylesheet -->
	<link href="css/style.css" rel="stylesheet">

	<?php if ($configuration['app_theme'] == 'white') { ?>
	<?php } ?>

</head>

<body>
	<!-- Topbar Start -->
	<div class="container-fluid">
		<div class="row bg-secondary py-1 px-xl-5">
			<div class="col-lg-6 d-none d-lg-block">
				<div class="d-inline-flex align-items-center h-100">
					<a class="text-body mr-3" id="desconto" name="desconto" href="<?= site_url('site/desconto') ?>">Descontos</a>
					<a class="text-body mr-3" id="lojas" name="lojas" href="<?= site_url('site/lojas') ?>">Lojas</a>
					<a class="text-body mr-3" id="contato" name="contato" href="<?= site_url('site/contato') ?>">Contato</a>
					<a class="text-body mr-3" id="ajuda" name="ajuda" href="<?= site_url('site/ajuda') ?>">Ajuda</a>
				</div>
			</div>
			<div class="col-lg-6 text-center text-lg-right">
				<div class="d-inline-flex align-items-center">
					<div class="btn-group">
						<button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Area do cliente</button>
						<div class="dropdown-menu dropdown-menu-right">
							<button class="dropdown-item" type="button">Login</button>
							<button class="dropdown-item" type="button">Cadastro</button>
						</div>
					</div>
				</div>
				<div class="d-inline-flex align-items-center d-block d-lg-none">
					<a href="" class="btn px-0 ml-2">
						<i class="fas fa-heart text-dark"></i>
						<span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
					</a>
					<a href="" class="btn px-0 ml-2">
						<i class="fas fa-shopping-cart text-dark"></i>
						<span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
					</a>
				</div>
			</div>
		</div>
		<div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
			<div class="col-lg-4">
				<?= $configuration['app_theme'] == 'white' ? '<img src="' . base_url() . 'assets/img/logo.svg">' : '<img src="' . base_url() . 'assets/img/logo-branco.svg">'; ?>
			</div>
			<div class="col-lg-4 col-6 text-left">
				<form action="">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Pesquisar descontos">
						<div class="input-group-append">
							<span class="input-group-text bg-transparent text-primary">
								<i class="fa fa-search"></i>
							</span>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Topbar End -->
</body>
