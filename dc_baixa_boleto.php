<?php
	 include 'dc_config.php';
	 ini_set('default_charset','UTF-8');
	 // Check whether username or password is set from android	
     if(isset($_POST['linha']) && isset($_POST['username']))
     {
		  // Innitialize Variable
      $linha = $_POST['linha'];
      $username = $_POST['username'];
	  
		  // Query database for row exist or not
      $sql = 'UPDATE expressas_boletos SET dom_recebido = 1, nom_usuario = :username WHERE 
      num_linha_boleto = :linha and dom_recebido = 0';
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':linha', $linha, PDO::PARAM_STR);
      $stmt->bindParam(':username', $username, PDO::PARAM_STR);
      if ($stmt->execute())
      {
        echo 'true';   
      } elseif(!$stmt->rowCount()) {
        echo 'false';
      }
  	}	
?>