<?php
	 include 'dc_config.php';
	 ini_set('default_charset','UTF-8');
	 // Check whether username or password is set from android	
     if(isset($_POST['extrato']))
     {
		  // Innitialize Variable
      $extrato = $_POST['extrato'];
	  
		  // Query database for row exist or not
      $sql = 'UPDATE expressas_planilha_credito SET dom_boleto = 1 WHERE 
      num_extrato = :extrato and dom_boleto = 0';
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':extrato', $extrato, PDO::PARAM_STR);
      if ($stmt->execute())
      {
        echo 'true';   
      } elseif(!$stmt->rowCount()) {
        echo 'false';
      }
  	}	
?>