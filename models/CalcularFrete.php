<?php
class CalcularFrete extends Model {
    
    public function calculaFrete($id, $cep_destino, $cod_servico, $price
        // $cod_servico, /* codigo do servico desejado */
        // $cep_origem,  /* cep de origem, apenas numeros */
        // $cep_destino, /* cep de destino, apenas numeros */
        // $peso,        /* valor dado em Kg incluindo a embalagem. 0.1, 0.3, 1, 2 ,3 , 4 */
        // $altura,      /* altura do produto em cm incluindo a embalagem */
        // $largura,     /* altura do produto em cm incluindo a embalagem */
        // $comprimento, /* comprimento do produto incluindo embalagem em cm */
        // $valor_declarado='0' /* indicar 0 caso nao queira o valor declarado */
     ){

        $peso = 0;
        $sql = $this->db->prepare("SELECT user_cart.*, products.*, product_details.* FROM user_cart 
                                    LEFT JOIN products ON (user_cart.product_id = products.id)
                                    LEFT JOIN product_details ON (products.id = product_details.product_id)
                                    WHERE user_id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $info = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($info as $i){
               $peso += $i['weight'];
            }
        }
        
        $cep_origem = 88306773;
        $altura = 15;
        $largura = 30;
        $comprimento = 50;
        $valor_declarado = '0';

        $cod_servico = strtoupper( $cod_servico );
        if( $cod_servico == 'SEDEX10' ) $cod_servico = 40215 ; 
        if( $cod_servico == 'SEDEXACOBRAR' ) $cod_servico = 40045 ; 
        if( $cod_servico == 'SEDEX' ) $cod_servico = 40010 ; 
        if( $cod_servico == 'PAC' ) $cod_servico = 41106 ;
  
        # ###########################################
        # C�digo dos Principais Servi�os dos Correios
        # 41106 PAC sem contrato
        # 40010 SEDEX sem contrato
        # 40045 SEDEX a Cobrar, sem contrato
        # 40215 SEDEX 10, sem contrato
        # ###########################################
  
        $correios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=".$cep_origem."&sCepDestino=".$cep_destino."&nVlPeso=".$peso."&nCdFormato=1&nVlComprimento=".$comprimento."&nVlAltura=".$altura."&nVlLargura=".$largura."&sCdMaoPropria=n&nVlValorDeclarado=".$valor_declarado."&sCdAvisoRecebimento=n&nCdServico=".$cod_servico."&nVlDiametro=0&StrRetorno=xml";
  
        $xml = simplexml_load_file($correios);

        $data = '';
        $_arr_ = array();
        if($xml->cServico->Erro == '0'):
           $_arr_['codigo'] = $xml -> cServico -> Codigo ;
           $_arr_['valor'] = $xml -> cServico -> Valor ;
           $_arr_['prazo'] = $xml -> cServico -> PrazoEntrega .' Dias' ;
           // return $xml->cServico->Valor;
           $valor = (array) $_arr_['valor'];
           $valor = $valor[0];
           $valor = str_replace(',', '.', $valor);

           $total = ($price + $valor);

           $data .='
            <div class="detailsArea">
               
            </div>
            <div class="detailsArea">
               <div style="font-size: 18px;" id="cepDestino">Frete para o CEP: '.$cep_destino.'</div><br/><br/>

               <div id="responseFrete">';
                  if($cod_servico == 40010){
                     $data .='SEDEX';
                  } else {
                     $data .='PAC';
                  }
                  $data .='
                  <div>Valor do Frete: R$'.$valor.'</div>
                  <div>Prazo de Entrega: '.$_arr_['prazo'].'</div>
               </div>
            </div>
            <div class="detailsArea" id="detailsArea">
            <label>Total a pagar</label><br/>
               <input type="text" value="'.$price.'" id="totalProductsPrice" hidden>
               <div class="finalPrice" id="finalPrice">R$ '.number_format($total, 2, ',', '.').'</div>
               <button class="buyout" onclick="proceedToPayment()">Continuar</button>
            </div>
           ';

           return $data ; 
        else:
            $data .='
            <div class="detailsArea">
               <label>Calcular Frete (Somente números)</label><br/>
               <input type="number" class="calcShipment" id="freteValue" placeholder="CEP"><button style="margin-left: 10px" onclick="calcularFrete('.$id.')">Calcular</button><br/><br/>
               <input type="radio" id="postServiceSedex" name="postService" value="sedex" selected><label for="postServiceSedex" style="margin-left: 10px">SEDEX</label><br/>
               <input type="radio" id="postServicePac" name="postService" value="pac"><label for="postServicePac" style="margin-left: 10px">PAC</label><br/>
               <div style="color: red">Erro ao Encontrar CEP. Tente novamente (somente números)</div>
            </div>
            <div class="detailsArea">

            </div>
            <div class="detailsArea" id="detailsArea">
            <label>Total a pagar</label><br/>
               <div class="finalPrice" id="finalPrice">R$ '.number_format($price, 2, ',', '.').'</div>
               <button class="buyout" onclick="proceedToIdentify('.$id.')" disabled>Continuar</button>
            </div>
           ';
           return $data;
        endif;
    }

    public function insereFrete(){

    }
}