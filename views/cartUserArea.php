<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu Carrinho - Loja Impacto</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/cartUser.css">
</head>
<body>
    <div class="container">
        <div class="returnLink">Voltar para a loja</div><div style="padding-top: 15px"><img src="<?php echo BASE_URL; ?>assets/icons/arrowleft-icon.svg"></div>
        <div class="purchaseSteps">
            <div class="roundIcon">1</div>
            <div class="stepDescription">Revise sua sacola</div>
            <div class="roundIcon" style="color: #CCC">2</div>
            <div class="stepDescription">Identificação</div>
            <div class="roundIcon" style="color: #CCC">3</div>
            <div class="stepDescription">Pagamento</div>
        </div>
        <div class="cartItens">
            <div class="itensTitle">
                <div class="title">Itens na Sacola</div>
                <div class="title">Valor Unitário</div>
                <div class="title">Valor Total</div>
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
                                <div class="amount">Quantidade</div>
                                <div class="changeAmount">
                                    <div class="lowerAmount" onclick="lowerProductAmount(<?php echo $prod['id']; ?>)"><img src="../assets/icons/less-icon1.svg"></div>
                                    <input type="number" class="actualAmount" id="actualAmount<?php echo $prod['id']; ?>" value="<?php echo $prod['qtd']; ?>">
                                    <div class="raiseAmount" onclick="raiseProductAmount(<?php echo $prod['id']; ?>)"><img src="../assets/icons/plus-icon1.svg"></div>
                                </div>
                            </div>
                            <div class="cartProductAction" onclick="removeProductCart()">
                            <img src="../assets/icons/trash-bag-item.svg">
                            </div>
                        </div>
                        <div class="productPrice"> 
                            <?php if($prod['has_discount'] == 'Sim'): ?>
                                <div class="hasDiscount">R$ <?php echo number_format($prod['price'], 2, ',', '.'); ?></div>
                                <div class="priceText" id="productPrice<?php echo $prod['id']; ?>">R$ <?php echo number_format($prod['price'] - ($prod['price'] / 100 * $prod['discount']), 2, ',', '.'); ?></div>
                            <?php else: ?>
                                <div class="priceText" id="productPrice<?php echo $prod['id']; ?>" style="margin-top: 20px">R$ <?php echo number_format($prod['price'], 2, ',', '.'); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="finalPrice" id="finalPrice<?php echo $prod['id']; ?>">
                            <?php if($prod['has_discount'] == 'Sim'): ?>
                                R$ <?php echo number_format(($prod['price'] - ($prod['price'] / 100 * $prod['discount'])) * $prod['qtd'], 2, ',', '.'); ?>
                            <?php else: ?>
                                R$ <?php echo number_format($prod['price'] * $prod['qtd'], 2, ',', '.'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="cartDetails" id="cartDetails">
            <div class="detailsArea">
                <!-- <label>Calcular Frete (Somente números)</label><br/>
                <input type="number" class="calcShipment" id="freteValue" placeholder="CEP" onkeyup="calcularFrete(<?php echo $_SESSION['cUser']; ?>)">
                <button style="margin-left: 10px" onclick="calcularFrete(<?php echo $_SESSION['cUser']; ?>)">Calcular</button><br/>
                <div><a href="http://www.buscacep.correios.com.br/sistemas/buscacep/default.cfm" target="popup">Não sei meu CEP</a></div><br/>
                <input type="radio" id="postServiceSedex" name="postService" value="sedex"><label for="postServiceSedex" style="margin-left: 10px">SEDEX</label><br/>
                <input type="radio" id="postServicePac" name="postService" value="pac"><label for="postServicePac" style="margin-left: 10px">PAC</label><br/>
                <div id="responseFrete"></div> -->
            </div>
            <div class="detailsArea">

            </div>
            <div class="detailsArea" id="detailsArea">

            </div>
        </div>
    </div>
</body>
</html>
<script>
    function fetchFinalValue(){
    var formData = new FormData();
    formData.append('cart_action', 'updateFinalPrice')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4){
            if(xhr.status == 200){
                document.getElementById('detailsArea').innerHTML = xhr.responseText
            } else {
                console.log('xiiii')
            }
        }
    }
    xhr.send(formData)
    }
    fetchFinalValue();
</script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/cart.js"></script>
