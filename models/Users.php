<?php
class Users extends Model {

    private $userInfo;

    public function isLogged() {
        if(isset($_SESSION['lgUser']) && !empty($_SESSION['lgUser'])) {
            return true;
        } else {
            return false;
        }
    }
 
    public function doLogin($email, $password) {
        $sql = $this->db->prepare("SELECT * FROM adm_users WHERE email = :email AND password = :password");
        $sql->bindValue(":email", $email);
        $sql->bindValue(":password", $password);
        $sql->execute();

        if($sql->rowCount() > 0){
            $row = $sql->fetch();
            $_SESSION['lgUser'] = $row['id'];
            return true;
        } else {
            return false;
        }
    }

    public function logout() {
        session_unset();
    }

    public function setLoggedUser() {
        if(isset($_SESSION['lgUser']) && !empty($_SESSION['lgUser'])) {
            $id = $_SESSION['lgUser'];

            $sql = $this->db->prepare("SELECT * FROM adm_users WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();

            if($sql->rowCount() > 0) {
                $this->userInfo = $sql->fetch();
            }
        }
    }
    
    public function getUser() {
        if(!empty($_SESSION['lgUser'])) {
            $sql = $this->db->prepare("SELECT * FROM adm_users WHERE id = :id");
            $sql->bindValue(":id", $_SESSION['lgUser']);
            $sql->execute();

            if($sql->rowCount() > 0) {
                $data = $sql->fetch(PDO::FETCH_ASSOC);
            }
            return $data;
        } else {
            return 'Invasor';
        }
    }
}