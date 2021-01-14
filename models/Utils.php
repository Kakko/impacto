<?php
class Utils extends Model {

    public function fetchCities($state_id) {
        $data = '';
        $sql = $this->db->prepare("SELECT * FROM cidades WHERE estado_id = :state_id ORDER BY cidade ASC");
        $sql->bindValue(":state_id", $state_id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $info = $sql->fetchAll(PDO::FETCH_ASSOC);

            $data .='
            <select class="addressSelect" name="city" id="fetch_cities">
                <option>Selecione a Cidade...</option>';
                foreach($info as $i) {
                    $data .='
                    <option value="'.$i['id'].'">'.$i['cidade'].'</option>
                    ';
                }
                $data .='
            </select>
            ';
        } else {
            $data .='
            <select class="addressSelect" name="city"  id="fetch_cities">
                <option>Sem resultados encontrados...</option>
            </select>
            ';
        }

        return $data;
    }
}