<?php
class Clients extends Model {
    
    public function registerClient($name, $email, $password){
        $sql = $this->db->prepare("INSERT INTO clients SET name = :name, email = :email, password = :password, data_cadastro = now()");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":password", $password);
        $sql->execute();
    }

    public function loginClient($email, $password, $userSessionId){
        $sql = $this->db->prepare("SELECT * FROM clients WHERE email = :email AND password = :password");
        $sql->bindValue(":email", $email);
        $sql->bindValue(":password", md5($password));
        $sql->execute();

        if($sql->rowCount() > 0){
            $row = $sql->fetch();
            $_SESSION['cUser'] = $row['id'];

            $sql = $this->db->prepare("UPDATE guest_user SET registered_user_id = :registered_user_id WHERE guest_user_id = :guest_user_id");
            $sql->bindValue(":registered_user_id", $_SESSION['cUser']);
            $sql->bindValue(":guest_user_id", $userSessionId);
            $sql->execute();

            return true;
        } else {
            return false;
        }
    }

    public function logoutClient() {
        session_unset();
    }

    public function setLoggedClient() {
        if(isset($_SESSION['cUser']) && !empty($_SESSION['cUser'])){
            $id = $_SESSION['cUser'];

            $sql = $this->db->prepare("SELECT * FROM clients WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();

            if($sql->rowCount() > 0){
                $this->clientInfo = $sql->fetch();
            }
        }
    }

    public function fetchClient(){
        if(!empty($_SESSION['cUser'])){
            $sql = $this->db->prepare("SELECT * FROM clients WHERE id = :id");
            $sql->bindValue(":id", $_SESSION['cUser']);
            $sql->execute();

            if($sql->rowCount() > 0){
                $data = $sql->fetch(PDO::FETCH_ASSOC);
            }
            return $data;
        } else {
            return 'Invasor';
        }
    }

    public function editMyInfo($id) {
        $data = '';
        $sql = $this->db->prepare("SELECT * FROM clients WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $info = $sql->fetch(PDO::FETCH_ASSOC);
        }

        $data .='
            <div id="infoTitle">Dados Pessoais</div>
            <div class="infoInputs">
                <form method="POST" id="clientInfo">';
                    if(!empty($info['name'])){
                        $data .='
                        <input type="text" placeholder="Nome" value="'.$info['name'].'" name="name">';
                    } else {
                        $data .='
                        <input type="text" placeholder="Nome" name="name">';
                    }
                    if(!empty($info['surname'])){
                        $data .='
                        <input type="text" placeholder="Sobrenome" value="'.$info['surname'].'" name="surname"><br/>';
                    } else {
                        $data .='
                        <input type="text" placeholder="Sobrenome" name="surname"><br/>';
                    }
                    if(!empty($info['cpf_cnpj'])){
                        $data .='
                        <input type="text" placeholder="CPF / CNPJ" value="'.$info['cpf_cnpj'].'" name="cpf_cnpj">   
                        ';
                    } else {    
                        $data .='
                        <input type="text" placeholder="CPF / CNPJ" name="cpf_cnpj">
                        ';
                    }
                    if(!empty($info['email'])){
                        $data .='
                        <input type="email" placeholder="E-mail" name="email" value="'.$info['email'].'"><br/>
                        ';
                    } else {    
                        $data .='
                        <input type="email" placeholder="E-mail" name="email"><br/>
                        ';
                    }
                    if(!empty($info['phone'])){
                        $data .='
                        <input type="text" placeholder="Telefone" name="phone" value="'.$info['phone'].'"><br/>
                        ';
                    } else {    
                        $data .='<input type="text" placeholder="Telefone" name="phone"><br/>';
                    }
                    $data .='
                    <div class="infoText">Todos os campos devem estar preenchidos</div>
                </form>
            </div>
            <button class="saveInfoClient" onclick="saveInfoClient('.$info['id'].')">Salvar</button>
        ';
        return $data;
    }

    public function updMyInfo($id, $name, $surname, $cpf_cnpj, $email, $phone) {
        $data = '';
        $sql = $this->db->prepare("UPDATE clients SET name = :name, surname = :surname, cpf_cnpj = :cpf_cnpj, email = :email, phone = :phone WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":name", $name);
        $sql->bindValue(":surname", $surname);
        $sql->bindValue(":cpf_cnpj", $cpf_cnpj);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":phone", $phone);
        
        if($sql->execute()){
            $sql = $this->db->prepare("SELECT * FROM clients WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();

            if($sql->rowCount() > 0){
                $info = $sql->fetch(PDO::FETCH_ASSOC);
            }
            $data .='
            <div id="infoTitle">Dados Pessoais</div>
            <div class="infoInputs">
                <form method="POST" id="clientInfo">';
                    if(!empty($info['name'])){
                        $data .='<input type="text" placeholder="Nome" value="'.$info['name'].'" name="name">';
                    } else {
                        $data .='<input type="text" placeholder="Nome" name="name">';
                    }
                    if(!empty($info['surname'])){
                        $data .='<input type="text" placeholder="Sobrenome" value="'.$info['surname'].'" name="surname"><br/>';
                    } else {
                        $data .='<input type="text" placeholder="Sobrenome" name="surname"><br/>';
                    }
                    if(!empty($info['cpf_cnpj'])){
                        $data .='<input type="text" placeholder="CPF / CNPJ" value="'.$info['cpf_cnpj'].'" name="cpf_cnpj">';
                    } else {    
                        $data .='<input type="text" placeholder="CPF / CNPJ" name="cpf_cnpj">';
                    }
                    if(!empty($info['email'])){
                        $data .='<input type="email" placeholder="E-mail" name="email" value="'.$info['email'].'"><br/>';
                    } else {    
                        $data .='<input type="email" placeholder="E-mail" name="email"><br/>';
                    }
                    if(!empty($info['phone'])){
                        $data .='<input type="text" placeholder="Telefone" name="phone" value="'.$info['phone'].'"><br/>';
                    } else {    
                        $data .='<input type="text" placeholder="Telefone" name="phone"><br/>';
                    }
                    $data .='
                    <div class="infoText">Todos os campos devem estar preenchidos</div>
                </form>
            </div>
            <button class="saveInfoClient" onclick="saveInfoClient('.$info['id'].')">Salvar</button>';
            
            return $data;
        } else {
            return 'Ocorreu um erro na hora de salvar os dados';
        }
    }

    public function shipmentAddress($id) {
        $sql2 = $this->db->prepare("SELECT * FROM estados ORDER BY estado ASC");
        $sql2->execute();

        if($sql2->rowCount() > 0) {
            $state = $sql2->fetchAll(PDO::FETCH_ASSOC);
        }
        
        $data = '';
        $sql = $this->db->prepare("SELECT cidades.cidade AS city, estados.estado AS state, client_address.* FROM client_address
                                LEFT JOIN cidades ON (client_address.city_id = cidades.id)
                                LEFT JOIN estados ON (client_address.state_id = estados.id)
                                WHERE client_id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $info = $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach($info as $i){
                $data .= '
                <div class="cardArea">
                    <div class="address1">'.$i['street'].', '.$i['address_number'].', '.$i['complement'].'</div>
                    <div class="address1">'.$i['neighborhood'].' - '.$i['city'].' - '.$i['state'].'</div>
                    <div class="address1">CEP: '.$i['cep'].'</div>
                </div>';
            }
            $data .='
            <br/>
            <div class="buttonArea">
                <button class="newClientAddress" onclick="anotherClientAddress('.$id.')">Adicionar Novo</button>    
            </div>
            ';

            return $data;
        } else {
            $data .='
            <div id="infoTitle">Adicionar Novo Endereço</div>
            <div class="infoInputs">
                <form method="POST" id="newClientAddress">
                    <input type="text" placeholder="CEP" name="cep">
                    <span class="infoCEP">Não sei meu CEP</span>
                    <input type="text" placeholder="Rua / Avenida" name="street">
                    <input type="text" placeholder="Número" name="number"><br/>
                    <input type="text" placeholder="Complemento" name="complement">
                    <input type="text" placeholder="Bairro" name="neighborhood"><br/>
                    <select class="addressSelect" id="states" name="uf" onchange="fetchCities()">
                        <option value="" readonly>Selecione o Estado...</option>';
                        foreach($state as $st) {
                            $data .='<option value="'.$st['id'].'">'.$st['estado'].'</option>';
                        }
                        $data .='
                    </select>
                    <select class="addressSelect" name="city" id="fetch_cities">
                        <option>Selecione primeiro o estado...</option>
                    </select>
                    <div class="infoText">Todos os campos devem estar preenchidos</div>
                </form>
            </div>
            <button class="addClientAddress" onclick="addNewClientAddress('.$id.')">Salvar</button>';
            
            return $data;
        }
    }

    public function addNewAddress($client_id, $cep, $street, $number, $complement, $neighborhood, $uf, $city) {
        $sql = $this->db->prepare("INSERT INTO client_address SET client_id = :client_id, cep = :cep, street = :street, address_number = :address_number, complement = :complement, neighborhood = :neighborhood, state_id = :uf, city_id = :city, data_cadastro = now()");
        $sql->bindValue(":client_id", $client_id);
        $sql->bindValue(":cep", $cep);
        $sql->bindValue(":street", $street);
        $sql->bindValue(":address_number", $number);
        $sql->bindValue(":complement", $complement);
        $sql->bindValue(":neighborhood", $neighborhood);
        $sql->bindValue(":uf", $uf);
        $sql->bindValue(":city", $city);

        if($sql->execute()) {
            $data = '';
            $sql = $this->db->prepare("SELECT cidades.cidade AS city, estados.estado AS state, client_address.* FROM client_address
                                    LEFT JOIN cidades ON (client_address.city_id = cidades.id)
                                    LEFT JOIN estados ON (client_address.state_id = estados.id)
                                    WHERE client_id = :id");
            $sql->bindValue(":id", $client_id);
            $sql->execute();

            if($sql->rowCount() > 0){
                $info = $sql->fetchAll(PDO::FETCH_ASSOC);

                foreach($info as $i){
                    $data .= '
                    <div class="cardArea">
                        <div class="address1">'.$i['street'].', '.$i['address_number'].', '.$i['complement'].'</div>
                        <div class="address1">'.$i['neighborhood'].' - '.$i['city'].' - '.$i['state'].'</div>
                    <div class="address1">CEP: '.$i['cep'].'</div>
                </div>';
                }
                $data .='
                <br/>
                <div class="buttonArea">
                    <button class="newClientAddress" onclick="anotherClientAddress('.$client_id.')">Adicionar Novo</button>
                </div>  
                ';

                return $data;
            }
        }
    }

    public function newFormAddress($id) {
        $data = '';
        $sql = $this->db->prepare("SELECT * FROM estados ORDER BY estado ASC");
        $sql->execute();

        if($sql->rowCount() > 0) {
            $state = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        $data .= '
        <div id="infoTitle">Adicionar Novo Endereço</div>
        <div class="infoInputs">
            <form method="POST" id="newClientAddress">
                <input type="text" placeholder="CEP" name="cep">
                <span class="infoCEP">Não sei meu CEP</span>
                <input type="text" placeholder="Rua / Avenida" name="street">
                <input type="text" placeholder="Número" name="number"><br/>
                <input type="text" placeholder="Complemento" name="complement">
                <input type="text" placeholder="Bairro" name="neighborhood"><br/>
                <select class="addressSelect" id="states" name="uf" onchange="fetchCities()">
                    <option value="" readonly>Selecione o Estado...</option>';
                    foreach($state as $st) {
                        $data .='<option value="'.$st['id'].'">'.$st['estado'].'</option>';
                    }
                    $data .='
                </select>
                <select class="addressSelect" name="city" id="fetch_cities">
                    <option>Selecione primeiro o estado...</option>
                </select>
                <div class="infoText">Todos os campos devem estar preenchidos</div>
            </form>
        </div>
        <button class="addClientAddress" onclick="addNewClientAddress('.$id.')">Salvar</button>';
        
        return $data;
    }

    public function fetchClientAddress($id){
        $sql = $this->db->prepare("SELECT client_address.id AS address_id, client_address.*, estados.*, cidades.* FROM client_address
                                    LEFT JOIN estados ON (estados.id = client_address.state_id)
                                    LEFT JOIN cidades ON (cidades.id = client_address.city_id)
                                    WHERE client_address.client_id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $info = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $info;
    }

    public function updatePurchase($id, $cep, $finalPrice){

        $sql = $this->db->prepare("SELECT * FROM user_purchase WHERE user_id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $sql = $this->db->prepare("UPDATE user_purchase SET user_id = :id, user_cep = :cep, purchase_value = :finalPrice, approved = 'N', data_cadastro = now()");
            $sql->bindValue(":id", $id);
            $sql->bindValue(":cep", $cep);
            $sql->bindValue(":finalPrice", $finalPrice);
            $sql->execute();
        } else {
            $sql = $this->db->prepare("INSERT INTO user_purchase SET user_id = :id, user_cep = :cep, purchase_value = :finalPrice, approved = 'N', data_cadastro = now()");
            $sql->bindValue(":id", $id);
            $sql->bindValue(":cep", $cep);
            $sql->bindValue(":finalPrice", $finalPrice);
            $sql->execute();
        }
    }

    public function purchaseDeets($id) {
        $data = '';
        $sql = $this->db->prepare("SELECT * FROM user_purchase WHERE user_id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetch(PDO::FETCH_ASSOC);
        }

        return $data;
    }

    public function proceedToPayment($receiverName, $receiverDocs, $receiverEmail, $receiverPhone, $finalPrice, $cep, $client_id){
        $sql = $this->db->prepare("SELECT * FROM deliver_deets WHERE client_id = :client_id AND sent != 'S'");
        $sql->bindValue(":client_id", $client_id);
        $sql->execute();

        if($sql->rowCount() == 0){
            $sql = $this->db->prepare("INSERT INTO deliver_deets SET client_id = :client_id, receiverName = :receiverName, receiverDocs = :receiverDocs, receiverEmail = :receiverEmail, receiverPhone = :receiverPhone, destinyCep = :destinyCep, finalPrice = :finalPrice, sent = 'N', data_cadastro = now()");
            $sql->bindValue(":client_id", $client_id);
            $sql->bindValue(":receiverName", $receiverName);
            $sql->bindValue(":receiverDocs", $receiverDocs);
            $sql->bindValue(":receiverEmail", $receiverEmail);
            $sql->bindValue(":receiverPhone", $receiverPhone);
            $sql->bindValue(":destinyCep", $cep);
            $sql->bindValue(":finalPrice", $finalPrice);
            $sql->execute();
        }
    }
}
