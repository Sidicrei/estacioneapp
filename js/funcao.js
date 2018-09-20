$(document).ready(function(){    
    $vlr = "";  
    var $server= 'http://localhost:4343/xampp/estacioneapp/www';
    $('#inclusao').on('click', function(){
        $placa = $('#placa').val();
        $veiculo = $('#veiculo').val();
        $email = $('#email').val();
        $telefone = $('#telefone').val();
        $data_entrada = $('#data_entrada').val();
        $hora_entrada = $('#hora_entrada').val();
        $data_saida = $('#data_saida').val();
        $hora_saida = $('#hora_saida').val();
        $valor_pagar = $('#valor_pagar').val();        
        
        $.ajax({
            type: "get",
            url: $server+"/conecta.php",
            data: "placa="+ $placa+ "&veiculo=" + $veiculo+  "&email=" + $email+  "&telefone=" + $telefone+  "&valor_pagar="+ $valor_pagar + "&data_entrada=" + $data_entrada + "&hora_entrada=" + $hora_entrada +"&data_saida=" + $data_saida + "&hora_saida" + $hora_saida +  "&acao=inclusao",
            
            
            success: function(data) {
                lista();
                alert('Placa cadastrada com sucesso!', 'Aviso!', 'OK');
                limpa_campos();
            }
        });
        
    });
    
    function limpa_campos(){
        document.getElementById('placa').value = '';
        document.getElementById('veiculo').value = '';
        document.getElementById('email').value = '';
        document.getElementById('telefone').value = '';
        document.getElementById('data_entrada').value = '';
        document.getElementById('hora_entrada').value = '';
        document.getElementById('data_saida').value = '';
        document.getElementById('hora_saida').value = '';
        document.getElementById('valor_pagar').value = '';
    }
    
    (function($) {	  remove = function(item) {
        var apagar = confirm('Deseja realmente excluir este registro?');
        if (apagar){
            var tr = $(item).closest('tr');
            $idcontrole = $(item).val();
            $.ajax({
                type: "get",
                url: $server+"/conecta.php",
                data: "idcontrole="+ $idcontrole+ "&acao=delete",                
                success: function(data) {
                    alert('Registro excluído com sucesso!', 'Aviso!', 'OK');
                    lista();
                    window.location.replace("#pag_listar");
                }
            });
            
        }else{
            event.preventDefault();
        }	   
    }	})(jQuery);
    
    
    (function($) {	  alterar = function(item) {
        var tr = $(item).closest('tr');	
        $vlr =  $(item).val();  
        window.location.replace("#pag_atualizar");          
        atualizar_veiculo(0);   
        return false;	 
    }	})(jQuery);
    
    (function($) {	  totaliza = function(item) {
        var tr = $(item).closest('tr');	
        $vlr =  $(item).val();  
        window.location.replace("#pag_atualizar"); 
        atualizar_veiculo(1);
        return false;	 
    }	})(jQuery);
    
    (function($) {	  atualiza = function(item) {
        if($(item).val() > 0){
        $idcontrole = $(item).val();
        $placa = $('#placa_atu').val();
        $veiculo = $('#veiculo_atu').val();
        $email = $('#email_atu').val();
        $telefone = $('#telefone_atu').val();
        $data_entrada = $('#data_entrada_atu').val();
        $hora_entrada = $('#hora_entrada_atu').val();
        $data_saida =$('#data_saida_atu').val();
        $hora_saida = $('#hora_saida_atu').val();
        $valor_pagar = $('#valor_pagar_atu').val();
        $.ajax({
            type: "get",
            url: $server+"/conecta.php",
            data: "placa="+ $placa+ "&idcontrole="+ $idcontrole + "&veiculo="+ $veiculo + "&email="+ $email + "&telefone="+ $telefone + "&data_entrada="+ $data_entrada + "&hora_entrada="+ $hora_entrada + "&data_saida="+ $data_saida + "&hora_saida="+ $hora_saida + "&valor_pagar="+ $valor_pagar + "&acao=atualiza",
            
            
            success: function(data) {
                lista();                             
                alert('Alteração realizada com sucesso!', 'Aviso!', 'OK');
                window.location.replace("#pag_listar");                
            }
        });
    }
        
    }	})(jQuery);
    
    function lista(){
        
        $.ajax({
            type: "get",
            dataType : 'html',
            url: $server+"/conecta.php",
            data: "acao=listar_veiculo",
            success: function(data){
                $('#listar_veiculo').html(data);
            }
            
        });
    }
    lista();      
    function atualizar_veiculo($calc){           
        
        $.ajax({
            type: "get",
            dataType : 'html',
            url: $server+"/conecta.php",
            data: "idcontrole="+ $vlr+  "&calc="+ $calc + "&acao=atualizar_veiculo",
            success: function(data){
                $('#atualizar_veiculo').html(data);
            }
            
        });
    }
    
});

