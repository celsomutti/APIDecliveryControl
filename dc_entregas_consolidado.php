<?php

	 include 'dc_config.php';
	 ini_set('default_charset','UTF-8');
	 // Check whether username or password is set from android	
   if(isset($_POST['entregador']) && isset($_POST['dataini']) && isset($_POST['datafim']))
    {

  // Innitialize Variable
      $entregador = $_POST['entregador'];
      $dataini = $_POST['dataini'];
      $datafim = $_POST['datafim'];
          
  // Query database for row exist or not
      $sql = 'SELECT tbentregas.cod_cliente_empresa as cod_cliente, tbentregas.cod_entregador as cod_entregador, tbentregas.val_verba_entregador as val_verba, 
      count(tbentregas.num_nossonumero) as qtd_entregas, tbentregas.num_extrato, tbentregas.des_tipo_peso as des_tipo,
      crm_clientes.nom_fantasia as nom_cliente  
      FROM tbentregas
      INNER JOIN crm_clientes
      ON crm_clientes.cod_cliente = tbentregas.cod_cliente_empresa
      where tbentregas.cod_entregador in (' . $entregador . ') and tbentregas.dat_baixa between "' . $dataini . '" and 
      "' . $datafim . '" and dom_fechado <> "S" group by tbentregas.cod_cliente_empresa, tbentregas.val_verba_entregador;';
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
    } else {
      echo "error params";
    }	

?>