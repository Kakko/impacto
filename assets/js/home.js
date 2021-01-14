function openLoginModal(){
    document.getElementById('loginModal').style.width = '100vw';
}

function registerModel(){
    document.getElementById('registerModal').style.width = '475px';
}

function cartModal(){
    document.getElementById('cartModal').style.width = '475px';
    fetchGuestCart();
}

function closeCartModal() {
    document.getElementById('cartModal').style.width = '0px';
}

function returnLogin() {
    document.getElementById('registerModal').style.width = "0"
}

function proceedToLog(){
    document.getElementById('cartModal').style.width = '0px';
    document.getElementById('loginModal').style.width = '100vw';
}

function userDropDown() {
    if(document.getElementById('userDropDown').hasAttribute('hidden')){
        document.getElementById('userDropDown').removeAttribute('hidden')
    } else {
        document.getElementById('userDropDown').setAttribute('hidden', true)
    }
}

function sendToCart(id) {
    var formData = new FormData();
    formData.append('id', id)
    formData.append('user_action', 'sendToCartGU')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200){
                alert('Produto Adicionado ao seu Carrinho')
                document.getElementById('cardCircle').innerHTML = xhr.responseText;
            } else {
                console.log('deu algum erro')
            }
        }
    }
    xhr.send(formData)
}

function fetchGuestCart() {
    let id = document.getElementById('guest_id').value;
    var formData = new FormData();
    formData.append('guest_id', id)
    formData.append('user_action', 'fetchGuestCart')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200){
                document.getElementById('cartModal').innerHTML = xhr.responseText;
                // console.log(xhr.responseText)
            } else {
                console.log('deu algum erro')
            }
        }
    }
    xhr.send(formData)
}

function lowerProductAmount(id) {
    let amount = document.getElementById('actualAmount'+id).value
    document.getElementById('actualAmount'+id).value = amount - 1
}

function raiseProductAmount(id) {
    let amount = document.getElementById('actualAmount'+id).value
    document.getElementById('actualAmount'+id).value = parseInt(amount) + parseInt(1)
}

function removeProductCart(id) {
    let c = confirm('Deseja remover o produto da sua sacola?')
    if(c == true){
        let userID = document.getElementById('guest_id').value;
        var formData = new FormData();
        formData.append('id', id)
        formData.append('userID', userID)
        formData.append('user_action', 'removeProductCart')

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

 function proceedToFinish(id) {
    window.location.href = "home/cart"
 }



