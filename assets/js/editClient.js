function userDropDown() {
    if(document.getElementById('userDropDown').hasAttribute('hidden')){
        document.getElementById('userDropDown').removeAttribute('hidden')
    } else {
        document.getElementById('userDropDown').setAttribute('hidden', true)
    }
}

function clientInfo(id) {
    var formData = new FormData()
    formData.append('id', id)
    formData.append('acao_clientes', 'edit_myInfo')

    const xhr = new XMLHttpRequest();

    xhr.open('POST', window.location.href, true);

    xhr.onreadystatechange = () => {

        if (xhr.readyState == 4) {

            if (xhr.status == 200) {
                document.getElementById('infoClient').innerHTML = xhr.responseText;
            } else {
                console.log('requisição fail');
            }
        }
    }

    xhr.send(formData);
}

function saveInfoClient(id){
    var form = document.getElementById('clientInfo')
    var formData = new FormData(form)

    formData.append('id', id)
    formData.append('acao_clientes', 'updInfo')

    const xhr = new XMLHttpRequest();

    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4){
            if(xhr.status == 200){
                document.getElementById('infoClient').innerHTML = xhr.responseText;
                // console.log(xhr.responseText)
            } else {
                console.log('requisição fail')
            }
        }
    }
    xhr.send(formData);
}

function shipment(id) {
    var formData = new FormData()
    formData.append('id', id)
    formData.append('acao_clientes', 'shipmentAddress')

    const xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true)
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4){
            if(xhr.status == 200){
                document.getElementById('infoClient').innerHTML = xhr.responseText;
            } else {
                console.log('requisition fail')
            }
        }
    }
    xhr.send(formData)
}

function fetchCities() {
    let state = document.getElementById('states').value;

    var formData = new FormData()
    formData.append('state', state)
    formData.append('acao_clientes', 'fetch_cities')

    const xhr = new XMLHttpRequest()
    xhr.open('POST', window.location.href, true)
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                document.getElementById('fetch_cities').innerHTML = xhr.responseText;
            } else {
                console.log('error - sem resposta')
            }
        }
    }
    xhr.send(formData)
}

function addNewClientAddress(id) {
    let form = document.getElementById('newClientAddress')
    var formData = new FormData(form)
    formData.append('id', id)
    formData.append('acao_clientes', 'addNewAddress')

    const xhr = new XMLHttpRequest()
    xhr.open('POST', window.location.href, true)
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4) {
            if(xhr.status == 200) {
                document.getElementById('infoClient').innerHTML = xhr.responseText;
            } else {
                console.log('deu errado')
            }
        }
    }
    xhr.send(formData)
}

function anotherClientAddress(id) {
    var formData = new FormData();
    formData.append('id', id)
    formData.append('acao_clientes', 'another_address')

    const xhr = new XMLHttpRequest()
    xhr.open('POST', window.location.href, true)
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4){
            if(xhr.status == 200){
                document.getElementById('infoClient').innerHTML = xhr.responseText;
            } else {
                console.log('Algo deu errado')
            }
        }
    }
    xhr.send(formData)
}