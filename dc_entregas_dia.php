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
                  crm_clientes.nom_fantasia as nom_cliente, 
                  tbentregas.dat_baixa as dat_baixa, count(tbentregas.num_nossonumero) as qtd_entregas, 
                  tbentregas.des_tipo_peso as des_tipo, 
                  sum(tbentregas.val_verba_entregador) as val_verba  
                  from tbentregas
                  inner join crm_clientes
                  on crm_clientes.cod_cliente = tbentregas.cod_cliente_empresa
                  where tbentregas.cod_entregador in (' . $entregador . ') and tbentregas.dat_baixa between "' . $dataini . '" and 
                  "' . $datafim . '" group by tbentregas.cod_cliente_empresa, 
                  tbentregas.dat_baixa, tbentregas.des_tipo_peso order by tbentregas.dat_baixa;';
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