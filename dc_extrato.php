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
          $sql = 'SELECT id_extrato,
          dat_inicio,
          dat_final,
          num_ano,
          num_mes,
          num_quinzena,
          cod_base,
          cod_entregador,
          num_extrato,
          val_verba,
          qtd_volumes,
          qtd_volumes_extra,
          val_volumes_extra,
          qtd_entregas,
          qtd_atraso,
          val_performance,
          val_producao,
          val_creditos,
          val_debitos,
          val_extravios,
          val_total_expressa,
          val_total_empresa,
          cod_cliente,
          dat_credito,
          des_unique_key FROM expressas_extrato WHERE cod_entregador in (' . $entregador . ') and dat_inicio = "' . $dataini . '" and 
          dat_final = "' . $datafim . '" order by cod_cliente, val_verba';
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