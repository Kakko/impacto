<?php
if(!isset($_SESSION)){
    session_start(); 
}
?>
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
    <!-- <?php echo session_status(); ?> -->
    <!-- <?php echo $_SESSION['cUser']; ?> -->
    <!-- MODAL DE LOGIN -->
    <div class="loginModal" id="loginModal">
        <div class="formArea">
            <form method="POST" id="loginForm">
                <div class="loginData">
                    <span>Login</span><br/>
                    <input type="text" name="user_action" value="loginAction" hidden>
                    <input type="email" class="loginInput" name="loginEmail" placeholder="E-mail"><br/>
                    <input type="password" class="loginInput" name="loginPassword" placeholder="Senha"><br/><br/>
                    <p>Esqueci a Senha</p><br/>
                    <input type="submit" class="loginButton" value="Entrar"><br/><br/>
                    <p style="font-size: 16px">Ainda não tem uma conta?<br/><p style="color: #000; cursor: pointer" onclick="registerModel()">Registre-se</p></p>
                </div>
            </form>
            <div class="loginFooter">
                <p>Ao fazer login, você concorda com a <br/><a href="#">Política de Privacidade</a> e com os <br/><a href="#">Termos de Uso</a> do site.</p>
            </div>
        </div>
    </div>
    <!-- MODAL DE REGISTRO -->
    <div class="registerModal" id="registerModal">
        <form method="POST" id="registerForm">
            <div class="loginData">
                <span>Registre-se</span><br/>
                <input type="text" name="user_action" value="register" hidden>
                <input type="text" class="loginInput" name="name" placeholder="Nome"><br/>
                <input type="email" class="loginInput" name="email" placeholder="E-mail"><br/>
                <input type="password" class="loginInput" name="password" placeholder="Senha"><br/><br/>
                <input type="submit" class="loginButton" value="Cadastrar"><br/><br/>
            </div>
        </form>
        <p style="padding-left: 30px; font-family: 'Arial', font-size: 16px; cursor: pointer" onclick="returnLogin()">Voltar</p>
        <div class="loginFooter">
            <p>Ao se cadastrar, você concorda com a <br/><a href="#">Política de Privacidade</a> e com os <br/><a href="#">Termos de Uso</a> do site.</p>
        </div>
    </div>
    <!-- MODAL DO CARRINHO -->
    <div class="cartModal" id="cartModal">
        
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
        <input type="text" value="<?php echo session_id(); ?>" id="guest_id" hidden>
        <div class="userHeader">
            <?php if(!empty($_SESSION['cUser'])): ?>
                <span style="cursor: pointer" onclick="userDropDown()">Olá, <strong><?php echo $clients['name']; ?></strong><img src="<?php echo BASE_URL; ?>assets/icons/arrowdown-icon.svg"></span>
            <?php else: ?>
                <span onclick="openLoginModal()" style="cursor: pointer">Conecte ou Registre-se</span>
            <?php endif; ?>
        </div>
        <div class="userCartHeader">
            <img src="<?php echo BASE_URL; ?>assets/icons/bag-icon.svg" id="cart" onclick="cartModal()">
            <div id="cardCircle"></div>
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
                            <img src="<?php echo BASE_URL; ?>assets/images/products/<?php echo $info['url']; ?>" style="height: 100%">
                        </div>
                        <div class="infoProduct">
                            <span class="prodTitle"><?php echo $info['name']; ?></span><br/>
                            <span class="authorName"><?php echo $info['author_name']; ?></span>
                        </div>
                        <div class="priceProduct">
                            <?php if($info['has_discount'] === 'Sim' ): ?>
                                <span class="origPrice">R$<?php echo $info['price']; ?></span><br/>
                                <span class="descPrice">R$<?php echo $info['price'] - ($info['price'] / 100 * $info['discount']); ?></span>
                            <?php else: ?>
                                <span class="descPrice">R$<?php echo $info['price']; ?></span><br/>
                            <?php endif; ?>
                        </div>
                        <button class="sendToCart" onclick="sendToCart(<?php echo $info['id']; ?>)">Adicionar à sacola</button>
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
    <div class="userDropDown" id="userDropDown" hidden>
        <ul>
            <li><a href="#">Meus Pedidos</a></li>
            <li><a href="#">Favoritos</a></li>
            <li><a href="<?php echo BASE_URL; ?>clients/editar?id=<?php echo $_SESSION['cUser']; ?>">Conta</a></li>
            <li><a href="<?php echo BASE_URL; ?>home/logout">Sair</a></li>
        </ul>
    </div>
    <script>
        var modal = document.getElementById('loginModal')
        window.onclick = function(event) {
            if(event.target == modal){
                modal.style.width = "0";
            }
        }

        window.onload = function(){
            let guest = document.getElementById('guest_id').value
            var formData = new FormData();
            formData.append('guest_id', guest)
            formData.append('user_action', 'getCartNumber')

            const xhr = new XMLHttpRequest();
            xhr.open('POST', window.location.href, true);
            xhr.onreadystatechange = () => {
                if(xhr.readyState == 4) {
                    if(xhr.status == 200){
                        document.getElementById('cardCircle').innerHTML = xhr.responseText;
                    } else {
                        console.log('deu algum erro')
                    }
                }
            }
            xhr.send(formData)

        }
    </script>
</body>
</html>