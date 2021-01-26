<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu Carrinho - Loja Impacto</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/identifyUser.css">
</head>
<body>
    <div class="container">
        <div class="returnLink">Voltar para a loja</div><div style="padding-top: 15px"><img src="<?php echo BASE_URL; ?>assets/icons/arrowleft-icon.svg"></div>
        <div class="purchaseSteps" id="purchaseSteps">
            <div class="roundIcon">1</div>
            <div class="stepDescription">Revise sua sacola</div>
            <div class="roundIcon">2</div>
            <div class="stepDescription">Identificação</div>
            <div class="roundIcon" style="color: #CCC">3</div>
            <div class="stepDescription">Pagamento</div>
        </div>
        <div class="cartItens">
            <div class="itensTitle">
                <div class="title">Itens na Sacola</div>
                <div class="title">Dados do Destinatário</div>
                <div class="title">Formas de Pagamento</div>
            </div>
            <div class="cartProductsArea">
                <?php foreach($cartProducts as $prod): ?>
                    <div class="productUnit">
                        <div class="showRegisteredCartProducts">
                            <!-- <input type="text" id="product_id" value="<?php echo $prod['id']; ?>" hidden> -->
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
            <div class="shipmentDeets">
                <div class="receiverData">
                    <form method="POST">
                        <input type="text" class="receiverInput" name ="receiverName" id="receiverName" placeholder="Nome do Destinatário">
                        <input type="text" class="receiverInput" name ="receiverDocs" id="receiverDocs" placeholder="CPF / CNPJ">
                        <input type="mail" class="receiverInput" name ="receiverEmail" id="receiverEmail" placeholder="E-mail">
                        <input type="text" class="receiverInput" name ="receiverPhone" id="receiverPhone" placeholder="Telefone">
                    </form>
                </div>
                <div class="addressCardArea">
                    <div class="title">Endereço de Entrega</div>
                    <?php foreach($clientAddress as $info): ?>
                        <div class="addressCard">
                            <div class="addressInfo">
                                <div class="selectAddress">
                                    <input type="radio" class="checkAddress" name="address" value="<?php echo $info['cep']; ?>">
                                </div>
                                <?php echo $info['street']; ?>, <?php echo $info['address_number']; ?>, 
                                <?php echo $info['complement']; ?> - <?php echo $info['neighborhood']; ?>, 
                                <?php echo $info['cidade']; ?> / <?php echo $info['uf']; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="paymentDeets" id="paymentDeets">
                <img src="../assets/icons/linkedin-icon.svg">
            </div>
        </div>
        <div class="cartDetails" id="cartDetails">
            <div class="detailsArea">
                <label>Selecione o serviço de entrega:</label><br/><br/>
                <input type="radio" id="postServiceSedex" name="postService" value="sedex" onchange="setDeliverTax(<?php echo $info['address_id']; ?>)"><label for="postServiceSedex" style="margin-left: 10px">SEDEX</label>
                <input type="radio" id="postServicePac" name="postService" value="pac" style="margin-left: 40px" onchange="setDeliverTax(<?php echo $info['address_id']; ?>)"><label for="postServicePac" style="margin-left: 10px">PAC</label><br/>
                <div id="responseFrete"></div>
            </div>
            <div class="detailsArea">

            </div>
            <div class="detailsArea">
            <label>Total a pagar</label><br/>
                <div class="finalPrice" id="finalPrice">R$ <?php echo number_format($purchaseDeets['purchase_value'],2,',', '.'); ?></div>
                <button class="buyout" onclick="proceedToPayment()">Continuar</button>
            </div>
        </div>
    </div>
</body>
</html>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/cart.js"></script>