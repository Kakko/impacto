<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Marketplace Impacto">
    <title>Impacto MarketPlace</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/home.css">
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/home.js"></script>
</head>
<body>
    <div class="loginModal">
            
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
            <!-- <span>Olá <strong>Estranho</strong></span><img src="<?php echo BASE_URL; ?>assets/icons/arrowdown-icon.svg"> -->
            <span onclick="openLoginModal()" style="cursor: pointer">Login</span>
        </div>
        <div class="userCartHeader">
            <img src="<?php echo BASE_URL; ?>assets/icons/bag-icon.svg" id="cart">
        </div>
        <div class="titleBrand">
            <h1>CLUBE IMPACTO</h1>
            <h5>Assine o clube e receba livros todo mês</h5>
            <button id="headerButton">Ver Pacotes</button>
        </div>
    </header>
    <aside class="frontFilter">
        <div class="filterContent">
            <h5>Filtros</h5>
            <table class="filterTable">
                <tr>
                    <th>Preço</th>
                    <th>+</th>
                </tr><tr>
                    <th>Gêneros</th>
                    <th>+</th>
                </tr><tr>
                    <th>Disciplina</th>
                    <th>+</th>
                </tr><tr>
                    <th>Faixa Etária</th>
                    <th>+</th>
                </tr>
            </table>
            <h5>Organizar Por:</h5>
            <select class="filterSelect">
                <option>Recentes</option>
                <option>Menor Preço</option>
                <option>Maior Preço</option>
            </select>
        </div>
    </aside>
    <section class="showProducts">
        <div class="productContent">
            <div class="lancamentosProducts">
                <h1>Últimos Lançamentos</h1>
                <?php foreach ($products as $info): ?>
                    <div class="products">
                        <div class="imgProduct">
                            <img src="<?php echo BASE_URL; ?>assets/images/book-preview.png">
                        </div>
                        <div class="infoProduct">
                            <span class="prodTitle"><?php echo $info['name']; ?></span><br/>
                            <span class="authorName"><?php echo $info['author']; ?></span>
                        </div>
                        <div class="priceProduct">
                            <?php if($info['has_discount'] === 'Sim' ): ?>
                                <span class="origPrice">R$<?php echo $info['price']; ?></span><br/>
                                <span class="descPrice">R$<?php echo $info['price'] - ($info['price'] / 100 * $info['discount']); ?></span>
                            <?php else: ?>
                                <span class="descPrice">R$<?php echo $info['price']; ?></span><br/>
                            <?php endif; ?>
                        </div>
                        <button class="sendToCart">Adicionar à sacola</button>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="allProducts">
                <h1>Infanto Juvenil</h1>
                <div class="products">
                    <div class="imgProduct">
                        <img src="<?php echo BASE_URL; ?>assets/images/book-preview.png">
                    </div>
                    <div class="infoProduct">
                        <span class="prodTitle">Vírus: Guia de Informações</span><br/>
                        <span class="authorName">Nome da Escritora</span>
                    </div>
                    <div class="priceProduct">
                        <span class="origPrice">R$100,00</span><br/>
                        <span class="descPrice">R$50,00</span>
                    </div>
                    <button class="sendToCart">Adicionar à sacola</button>
                </div>
                <div class="products">
                    <div class="imgProduct">
                        <img src="<?php echo BASE_URL; ?>assets/images/book-preview.png">
                    </div>
                    <div class="infoProduct">
                        <span class="prodTitle">Vírus: Guia de Informações</span><br/>
                        <span class="authorName">Nome da Escritora</span>
                    </div>
                    <div class="priceProduct">
                        <span class="origPrice">R$100,00</span><br/>
                        <span class="descPrice">R$50,00</span>
                    </div>
                    <button class="sendToCart">Adicionar à sacola</button>
                </div>
                <div class="products">
                    <div class="imgProduct">
                        <img src="<?php echo BASE_URL; ?>assets/images/book-preview.png">
                    </div>
                    <div class="infoProduct">
                        <span class="prodTitle">Vírus: Guia de Informações</span><br/>
                        <span class="authorName">Nome da Escritora</span>
                    </div>
                    <div class="priceProduct">
                        <span class="origPrice">R$100,00</span><br/>
                        <span class="descPrice">R$50,00</span>
                    </div>
                    <button class="sendToCart">Adicionar à sacola</button>
                </div>
                <div class="products">
                    <div class="imgProduct">
                        <img src="<?php echo BASE_URL; ?>assets/images/book-preview.png">
                    </div>
                    <div class="infoProduct">
                        <span class="prodTitle">Vírus: Guia de Informações</span><br/>
                        <span class="authorName">Nome da Escritora</span>
                    </div>
                    <div class="priceProduct">
                        <span class="origPrice">R$100,00</span><br/>
                        <span class="descPrice">R$50,00</span>
                    </div>
                    <button class="sendToCart">Adicionar à sacola</button>
                </div>
                <div class="products">
                    <div class="imgProduct">
                        <img src="<?php echo BASE_URL; ?>assets/images/book-preview.png">
                    </div>
                    <div class="infoProduct">
                        <span class="prodTitle">Vírus: Guia de Informações</span><br/>
                        <span class="authorName">Nome da Escritora</span>
                    </div>
                    <div class="priceProduct">
                        <span class="origPrice">R$100,00</span><br/>
                        <span class="descPrice">R$50,00</span>
                    </div>
                    <button class="sendToCart">Adicionar à sacola</button>
                </div>
                <div class="products">
                    <div class="imgProduct">
                        <img src="<?php echo BASE_URL; ?>assets/images/book-preview.png">
                    </div>
                    <div class="infoProduct">
                        <span class="prodTitle">Vírus: Guia de Informações</span><br/>
                        <span class="authorName">Nome da Escritora</span>
                    </div>
                    <div class="priceProduct">
                        <span class="origPrice">R$100,00</span><br/>
                        <span class="descPrice">R$50,00</span>
                    </div>
                    <button class="sendToCart">Adicionar à sacola</button>
                </div>
                <div class="products">
                    <div class="imgProduct">
                        <img src="<?php echo BASE_URL; ?>assets/images/book-preview.png">
                    </div>
                    <div class="infoProduct">
                        <span class="prodTitle">Vírus: Guia de Informações</span><br/>
                        <span class="authorName">Nome da Escritora</span>
                    </div>
                    <div class="priceProduct">
                        <span class="origPrice">R$100,00</span><br/>
                        <span class="descPrice">R$50,00</span>
                    </div>
                    <button class="sendToCart">Adicionar à sacola</button>
                </div>
                <div class="products">
                    <div class="imgProduct">
                        <img src="<?php echo BASE_URL; ?>assets/images/book-preview.png">
                    </div>
                    <div class="infoProduct">
                        <span class="prodTitle">Vírus: Guia de Informações</span><br/>
                        <span class="authorName">Nome da Escritora</span>
                    </div>
                    <div class="priceProduct">
                        <span class="origPrice">R$100,00</span><br/>
                        <span class="descPrice">R$50,00</span>
                    </div>
                    <button class="sendToCart">Adicionar à sacola</button>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer">
        <div class="footerSection">
            <ul>
                <li>Empresa</li>
                <li>Sobre Nós</li>
                <li>Publique Conosco</li>
                <li>Contato</li>
                <li>Termos de Serviço</li>
            </ul>
        </div>
        <div class="footerSection">
            <ul>
                <li>Produtos</li>
                <li>Loja Virtual</li>
                <li>Clube Impacto</li>
                <li>Portal</li>
                <li>FAQs</li>
            </ul>
        </div>
        <div class="footerSection">
            <ul>
                <li>Recursos</li>
                <li>Blog</li>
                <li>Newsletter</li>
            </ul>
        </div>
        <div class="footerSection">
            <span>
                Av. Osvaldo Reis, 3281, 2001<br/>
                Ed. Riviera Business & Mall<br/>
                Praia Brava - Itajaí / SC<br/>
                CEP: 88306-772<br/>
                (47) 9 9720-1385
            </span>
        </div>
        <div class="footerMedia">
            <div class="footerBrand">
                <img src="<?php echo BASE_URL; ?>assets/images/logo-impacto.svg">
            </div>
            <div class="footerSocial">
                <img src="<?php echo BASE_URL; ?>assets/icons/linkedin-icon.svg">
                <img src="<?php echo BASE_URL; ?>assets/icons/instagram-icon.svg">
                <img src="<?php echo BASE_URL; ?>assets/icons/facebook-icon.svg">
            </div>
        </div>
    </footer>
</body>
</html>