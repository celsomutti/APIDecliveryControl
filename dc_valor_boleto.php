<?php

	 include 'dc_config.php';
	 ini_set('default_charset','UTF-8');
	 // Check whether username or password is set from android	
     if(isset($_POST['entregador']) && isset($_POST['data']))
     {
		  // Innitialize Variable
         $entregador = $_POST['entregador'];
         $data = $_POST['data'];
		  
		  // Query database for row exist or not
          $sql = 'SELECT num_extrato, val_total FROM expressas_planilha_credito WHERE 
          cod_expressa in (' . $entregador .') and dat_credito = "' . $data .'" and cod_tipo_expressa = 2 and dom_boleto = 0';
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