<?php
// Configuração do servidor

$serve = mysqli_connect('localhost', 'root', '', 'estacione');



// Incluir veículo
if($_GET['acao'] == 'inclusao'){
    $placa= $_GET['placa'];
    $veiculo= $_GET['veiculo'];
    $email= $_GET['email'];
    $telefone= $_GET['telefone'];
    $data_entrada= $_GET['data_entrada'];
    $data_saida= $_GET['data_saida'];
    $hora_entrada= $_GET['hora_entrada'];
    $hora_saida= $_GET['hora_saida'];
    $valor_pagar= $_GET['valor_pagar'];
    $sql = "INSERT INTO `controle`(`idControle`, `veiculo`, `placa`, `email`, `telefone`, `valor_pagar`, `data_entrada`, `hora_entrada`, `data_saida`, `hora_saida` ) VALUES (null, '$veiculo','$placa','$email','$telefone',0,'$data_entrada',  '$hora_entrada', '$data_saida', '$hora_saida')"; 
    if ($re=mysqli_query($serve,$sql)) {    }   $re->close();    
    lista();
}

// Atualiza veículo
if($_GET['acao'] == 'atualiza'){
    $idcontrole= $_GET['idcontrole'];
    $placa= $_GET['placa'];
    $veiculo= $_GET['veiculo'];
    $email= $_GET['email'];
    $telefone= $_GET['telefone'];
    $data_entrada= $_GET['data_entrada'];
    $hora_entrada= $_GET['hora_entrada'];
    $data_saida= $_GET['data_saida'];
    $hora_saida= $_GET['hora_saida'];
    $valor_pagar= $_GET['valor_pagar'];
    
    $sql = "UPDATE `controle` SET `placa`='$placa', `email`='$email', `veiculo`='$veiculo', `telefone`='$telefone' , `data_entrada`= 
    '$data_entrada', `hora_entrada`= '$hora_entrada', `data_saida`= '$data_saida', `hora_saida`= '$hora_saida', `valor_pagar`='$valor_pagar' where idcontrole = '$idcontrole'";
    if ($re=mysqli_query($serve,$sql))
    {
        
        echo "Ok";
        
    } 
    $re->close();
    
    lista();
}


// Deletar veículo
if($_GET['acao'] == 'delete'){
    $idcontrole= $_GET['idcontrole'];
    $sql = "Delete from controle where idControle = '$idcontrole'"; 
    if ($re=mysqli_query($serve,$sql)) {}  $re->close();   
    }
    
    
    
    // Listar veículos
    if($_GET['acao'] == 'atualizar_veiculo'){
        
        $idcontrole= $_GET['idcontrole'];
        $calc = $_GET['calc'];
        
        if($calc == 1) {
            $sql = "UPDATE `controle` SET `data_saida`= date_format(now(),'%Y-%m-%d'), `hora_saida`= date_format(now(),'%r') where idcontrole = '$idcontrole' and valor_pagar = 0";            
            $result=mysqli_query($serve,$sql);             
            $sql = "SELECT `idControle`, `veiculo`, `placa`, `email`, `telefone`, ((DATE_FORMAT(TIMEDIFF(`hora_saida`, `hora_entrada`),'%H') * 60) + (DATE_FORMAT(TIMEDIFF(`hora_saida`, `hora_entrada`),'%i'))) * 0.16 `valor_pagar`, `data_entrada`, `hora_entrada`, `data_saida`, `hora_saida` FROM controle where idControle = '$idcontrole' ";
        }else{
            $sql = "SELECT `idControle`, `veiculo`, `placa`, `email`, `telefone`, `valor_pagar`, `data_entrada`, `hora_entrada`, `data_saida`, `hora_saida` FROM controle where idControle = '$idcontrole' ";
        }
        
        if ($result=mysqli_query($serve,$sql))
        {
            echo "<table id='details-table' class='table table-bordered' border=0 border CELLPADDING=2 COLLPADDING=2";
            $res = array();
            while ($row = $result->fetch_assoc()) {
                
                echo "<tr>"; 
                echo "<td><label  style='font-size: 30px'>Placa</label> </td> ";
                echo " <td> <input style='font-size: 30px; text-align:center' size='22'  id='placa_atu' type='text' name='placa_atu' value=",$row["placa"]," /> </td> "; 
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><label  style='font-size: 30px'>Veículo</label> </td> ";
                echo "<td> <input style='font-size: 30px; text-align:center' size='22' id='veiculo_atu' type='text' name='veiculo_atu' value=",$row["veiculo"]," /> </td> ";  
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><label  style='font-size: 30px'>Email</label> </td> ";
                echo " <td> <input style='font-size: 30px' size='22' id='email_atu' type='text' name='email_atu' value=",$row["email"]," /> </td> ";   
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><label  style='font-size: 30px'>Telefone:</label> </td> ";
                echo "<td>  <input style='font-size: 30px; text-align:center' size='22' type='text' id='telefone_atu' value=",$row["telefone"]," /> </td> "; 
                echo "</tr>";
                
                echo "<tr>";
                echo " <td><label  style='font-size: 30px'>Entrada</label></td>";
                echo " <td><input style='font-size: 30px; text-align:center' size='22'  type='date' data-clear-btn='true name='data_entrada_atu' id='data_entrada_atu' value=",$row["data_entrada"]," /></td>"; 
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><label  style='font-size: 30px'>Hora</label> </td> ";
                echo " <td> <input style='font-size: 30px; text-align:center' size='22'  type='time' data-clear-btn='false' id='hora_entrada_atu'  value=",$row["hora_entrada"]," /> </td> "; 
                echo "</tr>";
                
                
                echo "<tr>";
                echo " <td><label  style='font-size: 30px'>Saída</label></td>";
                echo " <td><input style='font-size: 30px; text-align:center' size='22'  type='date' data-clear-btn='true name='data_saida_atu' id='data_saida_atu' value=",$row["data_saida"]," /></td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td><label  style='font-size: 30px'>Hora</label> </td> ";
                echo " <td> <input  style='font-size: 30px; text-align:center' size='22'  type='time' data-clear-btn='false' id='hora_saida_atu'  value=",$row["hora_saida"]," /> </td> "; 
                echo "</tr>";
                
                echo "<tr>";          
                echo "<td><label  style='font-size: 30px'>Valor R$</label></td> ";
                echo "<td> <input style='font-size: 30px; text-align:center' size='22' id='valor_pagar_atu' type='text' name='valor_pagar_atu'  value=",$row["valor_pagar"]," /></td>  "; 
                echo "</tr>";  
                echo "</table>";
                echo "<button style='font-size: 30px; text-align:center' value=",$row["idControle"]," type='button' onclick='atualiza(this)' class='ui-btn ui-shadow ui-corner-all ui-btn-icon-center ui-icon-shop'>Salvar</button>";
                
            }
            echo "</table>";
            
            /* free result set */
            
            $result->close();
            
        }
    }
    
    
    
    
    
    
    // Listar veículos
    if($_GET['acao'] == 'listar_veiculo'){
        
        $sql = "INSERT INTO `controle`(`IdControle`,`veiculo`, `placa`, `email`, `telefone`, `valor_pagar`) VALUES (null, 'tttdsaaaasa','a','a',0,0)"; 
        $sql = "SELECT * FROM controle";
        
        
        if ($result=mysqli_query($serve,$sql))
        {
            echo "<table id='details-table' class='table table-bordered' border=0 border rules=rows>";
            
            
            while ($row = $result->fetch_assoc()) {
                
                echo "<tr >";	   
                echo "<td width=60%><label style='font-size: 25px'>Placa: ",$row["placa"]," &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </label></td>";
                
                echo "<td width=16%><button value=",$row["idControle"]," type='button' onclick='alterar(this)' class='ui-btn ui-shadow ui-corner-all ui-btn-icon-left ui-icon-edit'>&nbsp</button></td>";
                echo "<td width=16%><button value=",$row["idControle"]," type='button' onclick='remove(this)' class='ui-btn ui-shadow ui-corner-all ui-btn-icon-left ui-icon-delete'>&nbsp</button></td>";
                echo "<td width=16%><button value=",$row["idControle"]," type='button' onclick='totaliza(this)' class='ui-btn ui-shadow ui-corner-all ui-btn-icon-left ui-icon-shop'>&nbsp</button></td>";
                echo "</tr>";
            }
            echo "</table>";            
            
            /* free result set */
            $result->close();                  
        }
    }
    ?>