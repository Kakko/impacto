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
        }
    })
    $('#addProduct').modal('hide');
    location.reload();
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
    adjust();
}

function adjust() {
    alert('modal aberto')
}

function deleteImg(id) {
    let c = confirm("Deseja excluir essa imagem?")
    if(c == true){
        $.post('', {
            acao_produtos: 'deleteImg',
            id
        }, function(data){
            $('#showImages').html(data)
        })
    }
}

function insertImg(id){ 
    var file_data = $('#updFile').prop('files')[0];
    var formData = new FormData()
    formData.append('product_id', id)
    formData.append('acao_produtos', 'updImage')
    formData.append('files', file_data)
    
    $.ajax({
        type: 'POST',
        url: '',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function(data1){
            $('#showImages').html(data1)
            $('#updArea').html('<label>Arquivo Enviado com Sucesso!</label><br/>')
        },
    })
    location.reload();

}

function updProduct(){
    let form = document.getElementById('formProduct')

    $.ajax({
        type: 'POST',
        url: '',
        data: new FormData(form),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data){
            
        }
    })
    $('#updProduct').modal('hide');
    location.reload();
}

function deleteProduct(id){
    let c = confirm("Deseja excluir este produto?")
    if(c == true){
        $.post('', {
            acao_produtos: 'deleteProduct',
            id
        }, function(data) {
            alert(data)
        })
        location.reload();
    }
}