<?php

	 include 'dc_config.php';
	 ini_set('default_charset','UTF-8');
	 // Check whether username or password is set from android	
     if(isset($_POST['entregador']))
     {
		  // Innitialize Variable
         $entregador = $_POST['entregador'];
		  
		  // Query database for row exist or not
          $sql = 'SELECT dat_credito FROM expressas_planilha_credito WHERE 
          cod_expressa in (:entregador) and cod_tipo_expressa = 2 and dom_boleto = 0 group by dat_credito';
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':entregador', $entregador, PDO::PARAM_STR);
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