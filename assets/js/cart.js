

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
    let finalPrice = document.getElementById('finalPrice').innerText.split(' ')[1].replace(',', '.');
    var formData = new FormData()
    formData.append('finalPrice', finalPrice)
    formData.append('cart_action', 'proceedToIdentify')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4){
            if(xhr.status == 200){
                console.log(xhr.responseText)
            } else {
                console.log('erro')
            }
        }
    }
    xhr.send(formData)

    window.location.href="identification"
}

function proceedToPayment() {
    let receiverName = document.getElementById('receiverName').value
    let receiverDocs = document.getElementById('receiverDocs').value
    let receiverEmail = document.getElementById('receiverEmail').value
    let receiverPhone = document.getElementById('receiverPhone').value
    let finalPrice = document.getElementById('finalPrice').innerText.split(' ')[1].replace(',', '.');
    let cep = document.querySelector('input[name="address"]:checked').value

    var formData = new FormData();

    formData.append('receiverName', receiverName)
    formData.append('receiverDocs', receiverDocs)
    formData.append('receiverEmail', receiverEmail)
    formData.append('receiverPhone', receiverPhone)
    formData.append('finalPrice', finalPrice)
    formData.append('cep', cep)
    formData.append('cart_action', 'proceedToPayment')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4){
            if(xhr.status == 200){
                console.log(xhr.responseText)
                document.getElementById('purchaseSteps').style.backgroundImage = "url('../assets/images/Flags-3.svg')"
                document.getElementById('paymentDeets').style.display = "block"
            } else {
                console.log('culpa do pira')
            }
        }
    }
    xhr.send(formData)
    
}
function addNewCard(){
    document.getElementById('paymentMethods').style.display = "none"
    document.getElementById('creditCardSelected').style.display = "none"
    document.getElementById('addNewCard').style.display = "block"
}

function saveCard() {
    let cardNumber = document.getElementById('cardInputNumber').value
    let cardName = document.getElementById('cardInputName').value
    let expMonth = document.getElementById('selectExpirationMonth').value
    let expYear = document.getElementById('selectExpirationYear').value
    let cardCvv = document.getElementById('cardInputCvv').value

    var formData = new FormData();

    formData.append('cardNumber', cardNumber)
    formData.append('cardName', cardName)
    formData.append('expMonth', expMonth)
    formData.append('expYear', expYear)
    formData.append('cardCvv', cardCvv)
    formData.append('cart_action', 'addCardDeets')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4){
            if(xhr.status == 200){
                console.log(xhr.responseText)
            } else {
                console.log('erro')
            }
        }
    }
    xhr.send(formData)
}

function showCardOptions() {
    document.getElementById('creditCardSelected').style.display = "block"
}

function showTransferInfo() {
    
}

function showOnCard() {
    document.getElementById('frontCardInputs').style.display = "block"
    document.getElementById('cardImage').style.backgroundImage = "url('../assets/images/frontCard.svg')"
    let number = document.getElementById('cardInputNumber').value
    let name = document.getElementById('cardInputName').value
    
    let res = [...number].map((d, i) => (i) % 4==0 ? ' '+d : d).join('').trim()

    console.log(res)

    document.getElementById('showInputNumber').value = res
    document.getElementById('showInputName').value = name
}

function changeCardSide(){
    document.getElementById('frontCardInputs').style.display = "none"
    document.getElementById('cardImage').style.backgroundImage = "url('../assets/images/backCard.svg')"

    let month = document.getElementById('selectExpirationMonth').value
    let year = document.getElementById('selectExpirationYear').value

    document.getElementById('showInputValid').value = month+' / '+year
}

function showCvvOnCard() {
    let cvv = document.getElementById('cardInputCvv').value

    document.getElementById('showInputCvv').value = cvv
}

function cardSelected(id){
    let cep = document.getElementById('cepDestino').innerText.split(': ')[1]
    var formData = new FormData();

    formData.append('cardId', id);
    formData.append('cep', cep)
    formData.append('cart_action', 'finishInsertData')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4){
            if(xhr.status == 200){
                console.log(xhr.responseText)
            } else {
                console.log('erro')
            }
        }
    }
    xhr.send(formData)

    document.getElementById('buyout').innerText = 'Finalizar'
    document.getElementById('buyout').setAttribute('onclick', 'finish()');
}

function finish() {
    window.location.href = "finishPurchaseCard"
}