<div class="topPage">
    <div class="topTitle">
        <h1>Produtos</h1>
    </div>
    <div class="addProduct">
        <button class="btn btn-success" onclick="addProductModal()">Adicionar</button>
    </div>
</div>
<div class="productTable">
    <table class="table table-striped table-hover table-sm">
        <thead class="thead-dark">
            <tr>
                <th>Capa</th>
                <th>Nome</th>
                <th>Autor</th>
                <th>Idioma</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
        <?php if(!empty($getProducts)): ?>
            <?php foreach($getProducts as $prod): ?>
            <tr>
                <td><img style="height: 80px" src="<?php echo BASE_URL; ?>assets/images/products/<?php echo $prod['url']; ?>"></td>
                <td><?php echo $prod['name']; ?></td>
                <td><?php echo $prod['author']; ?></td>
                <td><?php echo $prod['language']; ?></td>
                <td><?php echo $prod['amount']; ?></td>
                <td>R$ <?php echo str_replace('.', ',', $prod['price']); ?></td>
                <td>
                    <button class="btn btn-primary btn-sm" onclick="seeProduct(<?php echo $prod['prodID']; ?>)"><i class="fas fa-eye"></i></button>
                    <button class="btn btn-warning btn-sm" onclick="editProduct(<?php echo $prod['prodID']; ?>)"><i class="fas fa-pen"></i></button>
                    <button class="btn btn-danger btn-sm" onclick="deleteProduct(<?php echo $prod['prodID']; ?>)"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Modal AddProductModal -->
<div class="modal fade info" id="addProduct">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header" style="background: linear-gradient(0deg, #c3e6f8, #7FCAF5)">
				<h4 class="modal-title">Adicionar Novo Produto</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<!-- Modal body -->
            <div class="modal-body" id="cadProduct" style="background-color: #c3e6f8">
                <form method="POST" enctype="multipart/form-data" id="newProduct">
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Nome:</label>
                            <input type="text" name="acao_produtos" value="cadProduto" hidden>
                            <input type="text" class="form-control form-control-sm" name="name">
                        </div>
                        <div class="col-sm-3">
                            <label>Categoria:</label>
                            <div class="input-group">
                                <select class="custom-select custom-select-sm" name="category" id="newCat">
                                    <option value="" readonly>Selecione...</option>
                                    <?php foreach($categoryProduct as $cat): ?>
                                        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['category_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success btn-sm" type="button" onclick="addCategory()"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label>Autor:</label>
                            <div class="input-group">
                                <select class="custom-select custom-select-sm" name="author" id="newAuthor">
                                    <option value="" readonly>Selecione...</option>
                                    <?php foreach($authors as $author): ?>
                                        <option value="<?php echo $author['id']; ?>"><?php echo $author['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success btn-sm" type="button" onclick="addAuthor()"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <label>Preço:</label>
                            <input type="text" class="form-control form-control-sm" name="price" placeholder="R$">
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-sm-2">
                            <label>Tipo:</label>
                            <select class="form-control form-control-sm" name="type">
                                <option value="">Selecione...</option>
                                <option>Livro</option>
                                <option>Audiobook</option>
                                <option>E-Book</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label>Disponibilidade:</label><br/>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" name="amazonCheck" onchange="showAmazonLink()">
                                <label class="form-check-label">Amazon</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" name="googleCheck" onchange="showGoogleLink()">
                                <label class="form-check-label">Google Livros</label>
                            </div>
                        </div>
                        <div class="col-sm" id="linkAmazon" hidden>
                            <label>Link Amazon</label>
                            <input type="text" class="form-control form-control-sm" name="amazonLink">
                        </div>
                        <div class="col-sm" id="linkGoogle" hidden>
                            <label>Link Google Livros</label>
                            <input type="text" class="form-control form-control-sm" name="googleLink">
                        </div>
                        <div class="col-sm">
                            <label>Edição:</label>
                            <input type="text" class="form-control form-control-sm" name="edition_number">
                        </div>
                        <div class="col-sm">
                            <label>Ano da Edição:</label>
                            <input type="text" class="form-control form-control-sm" name="edition_year">
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-sm-2">
                            <label>Idioma:</label>
                            <select class="form-control form-control-sm" name="language">
                                <option value="" readonly>Selecione...</option>
                                <option>Português</option>
                                <option>Inglês</option>
                                <option>Espanhol</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label>Largura:</label>
                            <input type="number" step=".01" class="form-control form-control-sm" name="width">
                        </div>
                        <div class="col-sm-2">
                            <label>Altura:</label>
                            <input type="number" step=".01" class="form-control form-control-sm" name="height">
                        </div>
                        <div class="col-sm-2">
                            <label>Tem Desconto:</label>
                            <select class="form-control form-control-sm" name="hasDiscount" id="hasDiscount" onchange="showDiscount()">
                                <option value="Não">Não</option>
                                <option value="Sim">Sim</option>
                            </select>
                        </div>
                        <div class="col-sm-1" id="discountField" hidden>
                            <label>Porcentagem:</label>
                            <input type="number" step="0.1" class="form-control form-control-sm" name="discount">
                        </div>
                        <div class="col-sm">
                            <label>Quantidade:</label>
                            <input type="number" class="form-control form-control-sm" name="amount">
                        </div>
                        <div class="col-sm">
                            <label>Número de Páginas</label>
                            <input type="number" class="form-control form-control-sm" name="number_pages">
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-sm">
                            <label>Descrição: (Máx 500 caractéres)</label>
                            <textarea class="form-control form-control-sm" style="resize: none; height: 200px" name="desc"></textarea>
                        </div>
                        <div class="col-sm">
                            <label>Selecione a Capa do Livro: </label><br/>
                            <input type="file" name="upload_arquivos">
                        </div>
                    </div>
                </form>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer" style="background-color: #c3e6f8">
				<button type="button" class="btn btn-success" onclick="saveProduct()">Salvar</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Visualizar Produto -->
<div class="modal fade info" id="seeProduct">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header" style="background: linear-gradient(0deg, #c3e6f8, #7FCAF5)">
				<h4 class="modal-title">Ver Produto</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body" id="cadProduct" style="background-color: #c3e6f8">
				<div class="seeProduct">
                    
                </div>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer" style="background-color: #c3e6f8">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Update Product -->
<div class="modal fade info" id="updProduct">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header" style="background: linear-gradient(0deg, #c3e6f8, #7FCAF5)">
				<h4 class="modal-title">Edição de Produto</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<!-- Modal body -->
            <div class="modal-body" id="editProduct" style="background-color: #c3e6f8">
                
			</div>
			<!-- Modal footer -->
			<div class="modal-footer" style="background-color: #c3e6f8">
				<button type="button" class="btn btn-success" onclick="updProduct()">Salvar</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal AddNewCategory -->
<div class="modal fade info" id="newCategory" style="background-color:rgba(0,0,0,0.5)">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Adicionar Nova Categoria</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body" id="cadProduct">
				<div class="row">
                    <div class="col-sm">
                        <label>Nome da Categoria:</label>
                        <input type="text" class="form-control form-control-sm" name="categoryName" required>
                    </div>
                </div>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="addNewCategory()">Salvar</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal AddNewAuthor -->
<div class="modal fade info" id="newAuthorModal" style="background-color:rgba(0,0,0,0.5)">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Adicionar Novo Autor</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body" id="cadProduct">
				<div class="row">
                    <div class="col-sm">
                        <label>Nome do Autor:</label>
                        <input type="text" class="form-control form-control-sm" name="authorName" required>
                    </div>
                </div>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="addNewAuthor()">Salvar</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/products.js"></script>