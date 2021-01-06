function addNewAuthor() {
    $('#newAuthor').modal('show')
}

function insertNewAuthor(){
    let name = $('#authorName').val();
    if(name != ''){
        $.post('', {
            acao_author: 'addNewAuthor',
            name
        }, function(data){

        })
        window.location.reload()
        // $('#newCategory').modal('hide');
    } else {
        alert('O autor precisa ter um nome')
    }
}

function editAuthor(id){
    $('#modalEditAuthor').modal('show')

    $.post('', {
        acao_author: 'editAuthor',
        id
    }, function(data){
        $('#editAuthor').html(data)
    })
}

function updAuthor(){
    let name = $('#editAuthorName').val()
    let id = $('#authorId').val()

    $.post('', {
        acao_author: 'updAuthor',
        name,
        id
    }, function(data) {

    })
    window.location.reload()
}

function deleteAuthor(id){
    let c = confirm('Deseja excluir esse autor?')

    if(c == true){
        $.post('', {
            acao_author: 'deleteAuthor',
            id
        }, function(data){
            alert(data)
        })
    }
    window.location.reload()
}