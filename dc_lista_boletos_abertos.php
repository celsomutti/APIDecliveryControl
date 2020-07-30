<?php

	 include 'dc_config.php';
	 ini_set('default_charset','UTF-8');
	 // Check whether username or password is set from android	
     if(isset($_POST['entregador']))
     {
		  // Innitialize Variable
         $entregador = $_POST['entregador'];
	  
		  // Query database for row exist or not
          $sql = 'SELECT id_boleto, num_extrato, dat_credito, num_linha_boleto, val_boleto, cod_expressa, dat_cadastro, 
          nom_usuario, dom_recebido FROM expressas_boletos WHERE cod_expressa in (:entregador) and dom_recebido = 0 
          order by dat_credito';
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':entregador', $entregador);
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