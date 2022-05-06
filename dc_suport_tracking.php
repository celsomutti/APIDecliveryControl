<?php

    include 'dc_config.php';
	ini_set('default_charset','UTF-8');
	// Check whether username or password is set from android	
    if(isset($_POST['remessa']) && isset($_POST['awb']))
    {
        // Innitialize Variable
        $remessa = $_POST['remessa'];
        $awb = $_POST['awb'];
                
        // Query database for row exist or not
        $sql = 'select id_tracking, dat_tracking, num_remessa, cod_awb, des_logradouro, num_logradouro, 
                nom_bairro, nom_cidade_uf, num_cep, num_telefone_1, num_telefone_2, num_telefone_3, des_complemento
        from expressas_tracking
        where expressas_tracking.cod_awb = :awb or expressas_tracking.num_remessa = :remessa;';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':awb', $awb, PDO::PARAM_STR);
        $stmt->bindParam(':remessa', $remessa, PDO::PARAM_STR);
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