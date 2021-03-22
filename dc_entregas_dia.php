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
          $sql = 'select tbentregas.cod_cliente_empresa as cod_cliente, 
                  tbentregas.dat_baixa as dat_baixa, count(tbentregas.num_nossonumero) as qtd_entregas, 
                  tbentregas.des_tipo_peso as des_tipo  
                  from tbentregas
                  where tbentregas.cod_entregador in (' . $entregador . ') and tbentregas.dat_baixa between "' . $dataini . '" and 
                  "' . $datafim . '" group by tbentregas.cod_cliente_empresa, 
                  tbentregas.dat_baixa, tbentregas.des_tipo_peso;';
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