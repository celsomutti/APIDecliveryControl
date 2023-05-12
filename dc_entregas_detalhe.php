<?php

	 include 'dc_config.php';
	 ini_set('default_charset','UTF-8');
	 // Check whether username or password is set from android	
     if(isset($_POST['entregador']))
     {
		  // Innitialize Variable
         $entregador = $_POST['entregador'];
         $cliente = $_POST['cliente'];
         $data = $_POST['data'];
         		  
		  // Query database for row exist or not
          $sql = 'select tbentregas.num_nossonumero as num_remessa, 
                  tbentregas.qtd_peso_real as qtd_peso, tbentregas.des_tipo_peso as des_tipo, tbentregas.cod_cliente_empresa   
                  from tbentregas
                  where tbentregas.cod_entregador in (' . $entregador . ') and tbentregas.dat_baixa = "' . $data . '" and 
                  tbentregas.cod_cliente_empresa = ' . $cliente . ' order by tbentregas.num_nossonumero;';
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