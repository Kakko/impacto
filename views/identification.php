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
            <!-- INÍCIO DA ÁREA DE PAGAMENTO / CADASTRAMENTO DOS CARTÕES -->
            <div class="paymentDeets" id="paymentDeets">
                <div class="paymentMethods" id="paymentMethods">
                    <div class="paymentType" style="margin-right: 10px;" onclick="showCardOptions()">
                        <img src="../assets/icons/creditcard-icon.svg">
                        <div>Cartão de Crédito</div>
                    </div>
                    <div class="paymentType">
                        <img src="../assets/icons/bankslip-icon.svg">
                        <div>Transferência Bancária</div>
                    </div>
                </div>
                <div class="creditCardSelected" id="creditCardSelected">
                    <div class="title">Cartões Salvos</div><img src="../assets/icons/Plus.svg" onclick="addNewCard()" style="cursor: pointer">
                    <!-- AQUI VAI ENTRAR UM FOREACH PARA EXIBIR OS CARTÕES JÁ SALVOS -->
                    <?php if(!empty($cards)): ?>
                        <?php foreach($cards as $c): ?>
                            <div class="registeredCards">
                                <div class="radioCardSelect">
                                    <input type="radio" name="selectCard" class="selectCardRadio" onchange="cardSelected(<?php echo $c['id']; ?>)">
                                </div>
                                <div class="cardInfo">
                                    <div class="cardTitle">Crédito</div>
                                    <div class="cardData">Final <?php echo substr($c['n_card'], -4); ?></div>
                                </div>
                                <div class="cardIcon"><img src="../assets/icons/creditcard-icon.svg"></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        Sem Cartões Cadastrados ainda
                    <?php endif; ?>
                </div>
                <div class="transferSelected">
                    <div class="title">Dados Bancários</div><img src="../assets/icons/Plus.svg">
                    <!-- AQUI VAI ENTRAR UM FOREACH PARA EXIBIR OS DADOS PARA TRANSFERÊNCIA -->
                </div>
                <div class="addNewCard" id="addNewCard">
                    <div class="title">Dados do Cartão</div><div class="titleVoltar">Voltar</div>
                    <div class="inputCard">
                        <input type="number" class="cardInput" id="cardInputNumber" placeholder="Número do Cartão" onkeyup="showOnCard()"><br/>
                        <input type="text" class="cardInput" id="cardInputName" placeholder="Nome impresso no cartão" onkeyup="showOnCard()"><br/>
                        <select class="selectExpirationMonth" id="selectExpirationMonth" name="selectExpirationMonth" onchange="changeCardSide()">
                            <option value="">Mês de Vencimento</option>
                            <option></option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                        </select>
                        <select class="selectExpirationMonth" id="selectExpirationYear" name="selectExpirationYear" onchange="changeCardSide()">
                            <option value="">Ano de Vencimento</option>
                            <option></option>
                            <option>2021</option>
                            <option>2022</option>
                            <option>2023</option>
                            <option>2024</option>
                            <option>2025</option>
                            <option>2026</option>
                            <option>2027</option>
                            <option>2028</option>
                            <option>2029</option>
                            <option>2030</option>
                            <option>2031</option>
                            <option>2032</option>
                        </select>
                        <input type="number" class="cardInput" id="cardInputCvv" placeholder="CVV" onkeyup="showCvvOnCard()">
                    </div>
                    <div class="cardImage" id="cardImage">
                        <div id="frontCardInputs">
                            <input type="text" class="cardInputNumber" id="showInputNumber" readonly><br/>
                            <input type="text" class="cardInputName" id="showInputName" readonly><br/>
                        </div>
                        <div class="backCardInputs">
                            <div class="valid">
                                <label>Valid Thru</label>
                                <input type="text" id="showInputValid">
                            </div>
                            <div class="cvv">
                                <label>CVV</label><br/>
                                <input type="text" id="showInputCvv">
                            </div>
                        </div>
                    </div>
                    <button class="saveCard" onclick="saveCard()">Salvar Cartão</button>
                </div>
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