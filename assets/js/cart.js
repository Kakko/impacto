

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

function setDeliverTax(id){
    let cep = document.querySelector('input[name="address"]:checked').value
    let finalPrice = document.getElementById('finalPrice').innerText.split(' ')[1].replace(',', '.');
    let postService = document.querySelector('input[name="postService"]:checked').value
    var formData = new FormData();

    formData.append('finalPrice', finalPrice)
    formData.append('cep', cep)
    formData.append('postService', postService)
    formData.append('cart_action', 'updatePurchase')
    

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4){
            if(xhr.status == 200){
                console.log(xhr.responseText)
                document.getElementById('cartDetails').innerHTML = xhr.responseText;
            } else {
                console.log('deu ruim')
            }
        }
    }
    xhr.send(formData)
}

function proceedToIdentify(){

    window.location.href="identification"
}

function proceedToPayment() {
    // let receiverName = document.getElementById('receiverName').value
    // let receiverDocs = document.getElementById('receiverDocs').value
    // let receiverEmail = document.getElementById('receiverEmail').value
    // let receiverPhone = document.getElementById('receiverPhone').value
    // let finalPrice = document.getElementById('finalPrice').innerText.split(' ')[1].replace(',', '.');
    // let cep = document.querySelector('input[name="address"]:checked').value

    // var formData = new FormData();

    // formData.append('receiverName', receiverName)
    // formData.append('receiverDocs', receiverDocs)
    // formData.append('receiverEmail', receiverEmail)
    // formData.append('receiverPhone', receiverPhone)
    // formData.append('finalPrice', finalPrice)
    // formData.append('cep', cep)
    // formData.append('cart_action', 'proceedToPayment')

    // const xhr = new XMLHttpRequest();
    // xhr.open('POST', window.location.href, true);
    // xhr.onreadystatechange = () => {
    //     if(xhr.readyState == 4){
    //         if(xhr.status == 200){
    //             console.log(xhr.responseText)
    //             document.getElementById('purchaseSteps').style.backgroundImage = "url('../assets/images/Flags-3.svg')"
    //             document.getElementById('paymentDeets').style.display = "block"
    //         } else {
    //             console.log('culpa do pira')
    //         }
    //     }
    // }
    // xhr.send(formData)

    document.getElementById('purchaseSteps').style.backgroundImage = "url('../assets/images/Flags-3.svg')"
                document.getElementById('paymentDeets').style.display = "block"
    
}

// function selectAddress(id) {
    
// }
