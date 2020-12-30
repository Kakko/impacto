<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Área Administrativa - Impacto</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/admin.css">
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/products.css">
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/categories.css">
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
	</head>
	<body>
		<div class="topAdmin">
			<div class="topBrand">
				<img src="<?php echo BASE_URL; ?>assets/images/logo-marca-w.svg">
			</div>
			<div class="topRight">
				<a href="<?php echo BASE_URL; ?>admLogin/logout">Sair</a>
			</div>
		</div>
		<div class="leftMenu">
			<img src="<?php echo BASE_URL; ?>assets/icons/user.png"><br/>
			<div class="userInfo">
				<span class="userInfo">Seja bem vindo <?php echo $viewData['userInfo']['name']; ?></span>
				<img src="<?php echo BASE_URL; ?>assets/icons/edit.svg"> <!-- Onclick para abrir o modal e editar o usuario -->
			</div>
			<div class="menuItens">
				<ul>
					<li><a href="<?php echo BASE_URL; ?>products">Produtos</a></li>
					<li><a href="<?php echo BASE_URL; ?>categories">Categorias</a></li>
					<li><a href="<?php echo BASE_URL; ?>author">Autores</a></li>
					<li><a href="<?php echo BASE_URL; ?>reports">Relatórios</a></li>
					<li><a href="<?php echo BASE_URL; ?>metrics">Métricas</a></li>
					<li><a href="<?php echo BASE_URL; ?>approval">Aprovações</a></li>
					<li><a href="<?php echo BASE_URL; ?>users">Usuários</a></li>
				</ul>
			</div>
		</div>
		<div class="viewArea">
			<?php
				$this->loadViewInTemplate($viewName, $viewData);
			?>
		</div>
	</body>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
</html>