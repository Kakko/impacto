<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Marketplace Impacto">
    <title>Impacto MarketPlace - Edição do Usuário</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/editClient.css">
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/editClient.js"></script>
</head>
<body>
    <div class="userDropDown" id="userDropDown" hidden>
        <ul>
            <li><a href="#">Meus Pedidos</a></li>
            <li><a href="#">Favoritos</a></li>
            <li><a href="<?php echo BASE_URL; ?>clients/editar?id=<?php echo $_SESSION['cUser']; ?>">Conta</a></li>
            <li><a href="<?php echo BASE_URL; ?>home/logout">Sair</a></li>
        </ul>
    </div>
    <header class="headerArea">
        <div class="headerBrand">
            <img src="<?php echo BASE_URL; ?>assets/images/logo-marca.svg">
        </div>
        <div class="headerMenu">
            <ul>
                <li>Empresa<img src="<?php echo BASE_URL; ?>assets/icons/arrowdown-icon.svg"></li>
                <li>Produtos<img src="<?php echo BASE_URL; ?>assets/icons/arrowdown-icon.svg"></li>
                <li>Publique Conosco</li>
                <!-- <li>Blog</li> -->
            </ul>
        </div>
        <div class="userHeader">
            <?php if(!empty($_SESSION['cUser'])): ?>
                <span style="cursor: pointer" onclick="userDropDown()">Olá, <strong><?php echo $clients['name']; ?></strong><img src="<?php echo BASE_URL; ?>assets/icons/arrowdown-icon.svg"></span>
            <?php endif; ?>
        </div>
        <div class="userCartHeader">
            <img src="<?php echo BASE_URL; ?>assets/icons/bag-icon.svg" id="cart">
        </div>
    </header>
    <div class="container">
        <div class="menuClient">
            <div class="menuTitle">Configurações</div>
            <div class="menuList">
                <ul>
                    <li onclick="clientInfo(<?php echo $clients['id']; ?>)">Minhas Informações</li>
                    <li onclick="shipment(<?php echo $clients['id']; ?>)">Endereços de Entrega</li>
                    <li onclick="orderHistory(<?php echo $clients['id']; ?>)">Histórico de Pedidos</li>
                    <li onclick="favorites(<?php echo $clients['id']; ?>)">Favoritos</li>
                </ul>
            </div>
            <div class="menuFooter">Sair</div>
        </div>
        <div class="infoClient" id="infoClient">
        
            
        </div>
    </div>
</body>
</html>