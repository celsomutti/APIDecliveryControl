<?php

    include 'dc_config.php';
	ini_set('default_charset','UTF-8');
	// Check whether username or password is set from android	
    if(isset($_POST['extratos']))
    {
        // Innitialize Variable
        $extratos = $_POST['extratos'];
                
        // Query database for row exist or not
        $sql = 'select tbextravios.des_extravio, tbextravios.num_nossonumero, tbextravios.cod_entregador,  
        tbextravios.val_total 
        from tbextravios
        where tbextravios.num_extrato in (:extratos);';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':extratos', $extratos, PDO::PARAM_STR);
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