<?php

	 include 'dc_config.php';
	 ini_set('default_charset','UTF-8');
	 // Check whether username or password is set from android	
     if(isset($_POST['entregador']))
     {
		  // Innitialize Variable
         $entregador = $_POST['entregador'];
         $dataini = $_POST['dataini'];
         $datafim = $_POST['datafim'];
		  
		  // Query database for row exist or not
          $sql = 'SELECT 
		      expressas_extrato.id_extrato,
          expressas_extrato.dat_inicio,
          expressas_extrato.dat_final,
          expressas_extrato.num_ano,
          expressas_extrato.num_mes,
          expressas_extrato.num_quinzena,
          expressas_extrato.cod_base,
          expressas_extrato.cod_entregador,
          expressas_extrato.num_extrato,
          expressas_extrato.val_verba,
          expressas_extrato.qtd_volumes,
          expressas_extrato.qtd_volumes_extra,
          expressas_extrato.val_volumes_extra,
          expressas_extrato.qtd_entregas,
          expressas_extrato.qtd_atraso,
          expressas_extrato.val_performance,
          expressas_extrato.val_producao,
          expressas_extrato.val_creditos,
          expressas_extrato.val_debitos,
          expressas_extrato.val_extravios,
          expressas_extrato.val_total_expressa,
          expressas_extrato.val_total_empresa,
          expressas_extrato.cod_cliente,
          crm_clientes.nom_fantasia as nom_cliente, 
          expressas_extrato.dat_credito,
          expressas_extrato.des_unique_key 
          FROM expressas_extrato
          INNER JOIN crm_clientes
          ON crm_clientes.cod_cliente = expressas_extrato.cod_cliente 
          WHERE expressas_extrato.cod_entregador in (' . $entregador . ') and expressas_extrato.dat_inicio = "' . $dataini . '" and 
          expressas_extrato.dat_final = "' . $datafim . '" order by expressas_extrato.cod_cliente, expressas_extrato.val_verba';
          $stmt = $conn->prepare($sql);
          
          $stmt->execute();
          if($stmt->rowCount())
          {
			      $row_all = $stmt->fetchall(PDO::FETCH_ASSOC);
            header('Content-type: application/json');
            echo json_encode($row_all);	
          } elseif(!$stmt->rowCount()) {
            echo "false";
          }
  	}
	
?>