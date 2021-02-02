<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/finishPurchase.css">
    <title>Obrigado!</title>
</head>
<body>
    <div class="container">
    <div class="returnLink"><a href="<?php echo BASE_URL; ?>"><div style="width: 10%; float: left;"><img src="<?php echo BASE_URL; ?>assets/icons/arrowleft-icon.svg"></div>Voltar para a loja</a></div>
        <div class="productList">
            <?php foreach($cartProducts as $prod): ?>
                <div class="productUnit">
                    <div class="showRegisteredCartProducts">
                        <div class="cartProductImage"><img src="<?php echo BASE_URL; ?>assets/images/products/<?php echo $prod['url']; ?>"></div>
                        <div class="cartProductInfo">
                            <div class="cartProductTitle"><?php echo $prod['name']; ?></div>
                            <div class="cartProductAuthor"><?php echo $prod['author_name']; ?></div>
                            <div class="amount">Quantidade: <?php echo $prod['qtd']; ?></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="info">
            <div class="infoTitle">
            Parabéns!<br/>
            O pedido número <?php echo $purchaseInfo['id']; ?> foi finalizado com sucesso!
            </div>
            <div class="infoDesc">
                Aguarde enquanto seu pedido está sendo processado.<br/>
                Você receberá um e-mail com as instruções e detalhes da entrega.
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="footerPurchasePrice">
            <div class="purchasePriceTitle">Valor Total</div>
            <div class="purchasePriceValue">R$ <?php echo number_format($purchaseInfo['purchase_value'],2, ',', '.'); ?></div>
        </div>
        <div class="purchaseAddress">
            <div class="purchaseAddressTitle">Endereço de Entrega</div>
            <div class="purchaseAddressInfo">
                <?php echo $deliverDeets['street']; ?>, 
                <?php echo $deliverDeets['address_number']; ?>, 
                <?php echo $deliverDeets['complement']; ?>,
                <?php echo $deliverDeets['neighborhood']; ?><br/>
                <?php echo $deliverDeets['cidade']; ?> / 
                <?php echo $deliverDeets['uf']; ?>

            </div>
        </div>
    </div>
</body>
</html>