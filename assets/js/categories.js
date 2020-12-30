function addNewCategory() {
    $('#newCategory').modal('show')
}

function insertNewCategory(){
    let name = $('#categoryName').val();
    if(name != ''){
        $.post('', {
            acao_category: 'addNewCategory',
            name
        }, function(data){
            console.log(data)
        })
        window.location.reload()
        // $('#newCategory').modal('hide');
    } else {
        alert('A Categoria precisa ter um nome')
    }
}

function editCategory(id){
    $('#modalEditCategory').modal('show')

    $.post('', {
        acao_category: 'editCategory',
        id
    }, function(data){
        $('#editCategory').html(data)
    })
}

function updCategory(){
    let name = $('#editCategoryName').val()
    let id = $('#categoryId').val()

    $.post('', {
        acao_category: 'updCategory',
        name,
        id
    }, function(data) {

    })
    window.location.reload()
}

function deleteCategory(id){
    let c = confirm('Deseja excluir essa categoria?')

    if(c == true){
        $.post('', {
            acao_category: 'deleteCategory',
            id
        }, function(data){
            alert(data)
        })
    }
    window.location.reload()
}