

function lowerProductAmount(id) {
    let amount = document.getElementById('actualAmount'+id).value
    document.getElementById('actualAmount'+id).value = amount - 1
    let qtd = document.getElementById('actualAmount'+id).value;

    var formData = new FormData();
    formData.append('id', id)
    formData.append('qtd', qtd)
    formData.append('cart_action', 'lowerProductAmount')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200){
                console.log(xhr.responseText)
            } else {
                console.log('Deu Algum Erro')
            }
        }
    }
    xhr.send(formData)

    changeFinalValue(id, qtd)
    fetchFinalValue()
}

function raiseProductAmount(id) {
    let amount = document.getElementById('actualAmount'+id).value
    document.getElementById('actualAmount'+id).value = parseInt(amount) + parseInt(1)

    let qtd = document.getElementById('actualAmount'+id).value;

    var formData = new FormData();
    formData.append('id', id)
    formData.append('qtd', qtd)
    formData.append('cart_action', 'raiseProductAmount')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200){
                console.log(xhr.responseText)
            } else {
                console.log('Deu Algum Erro')
            }
        }
    }
    xhr.send(formData)

    changeFinalValue(id, qtd)
    fetchFinalValue()
}

function removeProductCart(id) {
    let c = confirm('Deseja remover o produto da sua sacola?')
    if(c == true){
        let userID = document.getElementById('guest_id').value;
        var formData = new FormData();
        formData.append('id', id)
        formData.append('userID', userID)
        formData.append('cart_action', 'removeProductCart')

        const xhr = new XMLHttpRequest();
        xhr.open('POST', window.location.href, true);
        xhr.onreadystatechange = () => {
            if(xhr.readyState == 4) {
                if(xhr.status == 200){
                    document.getElementById('cartModal').innerHTML = xhr.responseText;
                    alert('Produto removido da sua sacola')
                } else {
                    console.log('Deu Algum Erro')
                }
            }
        }
        xhr.send(formData)
    }
}

function calcularFrete(id){
    var formData = new FormData();
    let frete = document.getElementById('freteValue').value
    let price = document.getElementById('totalProductsPrice').value
    let postService = document.querySelector('input[name="postService"]:checked').value

    formData.append('id', id)
        formData.append('cep', frete)
        formData.append('postService', postService)
        formData.append('price', price)
        formData.append('cart_action', 'calcular_frete')

        const xhr = new XMLHttpRequest();
        xhr.open('POST', window.location.href, true);
        xhr.onreadystatechange = ()=> {
            if(xhr.readyState == 4){
                if(xhr.status == 200){
                    document.getElementById('cartDetails').innerHTML = xhr.responseText;
                } else {
                    console.log('errroouuu')
                }
            }
        }
        xhr.send(formData)
}

function changeFinalValue(id, qtd){
    let unitValueText = document.getElementById('productPrice'+id).innerText
    let unitValue = unitValueText.split(' ')[1].replace(',', '.');

    unitValue = parseFloat(unitValue);

    let price = (unitValue * qtd).toFixed(2).replace('.', ',');    
    document.getElementById('finalPrice'+id).innerHTML = 'R$ '+price
}

function fetchFinalValue(){
    var formData = new FormData();
    formData.append('cart_action', 'updateFinalPrice')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4){
            if(xhr.status == 200){
                console.log(xhr.responseText)
                document.getElementById('detailsArea').innerHTML = xhr.responseText
            } else {
                console.log('xiiii')
            }
        }
    }
    xhr.send(formData)
}

function proceedToIdentify($id){
    let finalPrice = document.getElementById('finalPrice').innerText.split(' ')[1].replace(',', '.');
    let frete = document.getElementById('cepDestino').innerText.split(': ')[1];
    var formData = new FormData();

    formData.append('finalPrice', finalPrice)
    formData.append('cep', frete)
    formData.append('cart_action', 'updatePurchase')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4){
            if(xhr.status == 200){
                console.log(xhr.responseText)
            } else {
                console.log('deu ruim')
            }
        }
    }
    xhr.send(formData)

    window.location.href="identification"
}
fetchFinalValue();

function selectAddress() {
    alert(' Selecionado ')
}
