function addProductModal() {
    $('#addProduct').modal('show')
}

function addCategory() {
    $("[name='categoryName']").val('')
    $('#newCategory').modal('show')
}

function addNewCategory() {
    let name = $("[name='categoryName']").val()
    if(name != ''){
        $.post('', {
            acao_produtos: 'addNewCategory',
            name,
        }, function(data){
            $('#newCat').html(data)
        })
        $('#newCategory').modal('hide')
    } else {
        alert('A Categoria Precisa ter um nome')
        
    }
}

function showAmazonLink() {
    if(document.getElementById('linkAmazon').hasAttribute('hidden')){
        document.getElementById('linkAmazon').removeAttribute('hidden');
    } else {
        document.getElementById('linkAmazon').setAttribute('hidden', true);
    }
    
}

function showGoogleLink() {
    if(document.getElementById('linkGoogle').hasAttribute('hidden')){
        document.getElementById('linkGoogle').removeAttribute('hidden')
    } else {
        document.getElementById('linkGoogle').setAttribute('hidden', true)
    }
}

function showDiscount() {
    let nome = document.getElementById('hasDiscount')
    let hasDiscount = nome.options[nome.selectedIndex].value

    if(hasDiscount == 'Sim') {
        document.getElementById('discountField').removeAttribute('hidden')
    } else if(hasDiscount == 'Não'){
        document.getElementById('discountField').setAttribute('hidden', true);
    }
}

function saveProduct() {
    let form = document.getElementById('newProduct')

    $.ajax({
        type: 'POST',
        url: '',
        data: new FormData(form),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data){
            console.log(data)
        }
    })
    $('#addProduct').modal('hide');
}

function seeProduct(id) {
    $.post('', {
        acao_produtos: 'see_produto',
        id
    }, function(data) {
        $('.seeProduct').html(data)
    })
    $('#seeProduct').modal('show');
}

function editProduct(id){
    $.post('', {
        acao_produtos: 'edit_produto',
        id
    }, function(data){
        $('#editProduct').html(data)
    })
    $('#updProduct').modal('show')
}