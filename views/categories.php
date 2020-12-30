<div class="topPage">
    <div class="topTitle">
        <h1>Categorias</h1>
    </div>
    <div class="addProduct">
        <button class="btn btn-success" onclick="addNewCategory()">Adicionar</button>
    </div>
</div>
<div class="categoriesArea">
    <?php foreach($categories as $cat): ?>
        <div class="showCategories">
            <div class="catName">
                <span><?php echo $cat['category_name']; ?></span>
            </div>
            <div class="catAction">
                <button class="btn btn-warning btn-sm" onclick="editCategory(<?php echo $cat['id']; ?>)"><i class="fas fa-pen"></i></button>
                <button class="btn btn-danger btn-sm" onclick="deleteCategory(<?php echo $cat['id']; ?>)"><i class="fas fa-trash"></i></button>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Modal AddNewCategory -->
<div class="modal fade info" id="newCategory">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Adicionar Nova Categoria</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
            <!-- Modal body -->
            <div class="modal-body" id="addCategory">
                <div class="row">
                    <div class="col-sm">
                        <label>Nome da Categoria:</label>
                        <input type="text" class="form-control form-control-sm" name="categoryName" id="categoryName" required>
                    </div>
                </div>
            </div>
			<!-- Modal footer -->
			<div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="insertNewCategory()">Salvar</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal editCategory -->
<div class="modal fade info" id="modalEditCategory">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Editar Categoria</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
            <!-- Modal body -->
            <div class="modal-body" id="editCategory">
                
            </div>
			<!-- Modal footer -->
			<div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="updCategory()">Salvar</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/categories.js"></script>