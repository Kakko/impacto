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
                <th>Imagem</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td> - </td>
                <td>Teste</td>
                <td>200</td>
                <td><button>Excluir</button></td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Modal AddProductModal -->
<div class="modal fade info" id="addProduct">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Adicionar Novo Produto</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body" id="notes">
				
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/products.js"></script>