<div class="topPage">
    <div class="topTitle">
        <h1>Autores</h1>
    </div>
    <div class="addProduct">
        <button class="btn btn-success" onclick="addNewAuthor()">Adicionar</button>
    </div>
</div>
<div class="categoriesArea">
    <?php foreach($authors as $author): ?>
        <div class="showCategories">
            <div class="catName">
                <span><?php echo $author['name']; ?></span>
            </div>
            <div class="catAction">
                <button class="btn btn-warning btn-sm" onclick="editAuthor(<?php echo $author['id']; ?>)"><i class="fas fa-pen"></i></button>
                <button class="btn btn-danger btn-sm" onclick="deleteAuthor(<?php echo $author['id']; ?>)"><i class="fas fa-trash"></i></button>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Modal AddNewAuthor -->
<div class="modal fade info" id="newAuthor">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Adicionar Novo Autor</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
            <!-- Modal body -->
            <div class="modal-body" id="addAuthor">
                <div class="row">
                    <div class="col-sm">
                        <label>Nome do Autor:</label>
                        <input type="text" class="form-control form-control-sm" name="authorName" id="authorName" required>
                    </div>
                </div>
            </div>
			<!-- Modal footer -->
			<div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="insertNewAuthor()">Salvar</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal editAuthor -->
<div class="modal fade info" id="modalEditAuthor">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Editar Autor</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
            <!-- Modal body -->
            <div class="modal-body" id="editAuthor">
                
            </div>
			<!-- Modal footer -->
			<div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="updAuthor()">Salvar</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/author.js"></script>