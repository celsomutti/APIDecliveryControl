<?php

    include 'dc_config.php';
	ini_set('default_charset','UTF-8');
	// Check whether username or password is set from android	
    if(isset($_POST['entregador']) && isset($_POST['data1']) && isset($_POST['data2']))
    {
        // Innitialize Variable
        $entregador = $_POST['entregador'];
        $data1 = $_POST['data1'];
        $data2 = $_POST['data2'];
                
        // Query database for row exist or not
        $sql = 'select tblancamentos.des_lancamento, tblancamentos.dat_lancamento, tblancamentos.des_tipo,  
        tblancamentos.val_lancamento 
        from tblancamentos
        where tblancamentos.cod_entregador = :entregador and tblancamentos.dat_lancamento between :data1 and 
        :data2 and tblancamentos.dom_desconto = "N";';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':entregador', $entregador, PDO::PARAM_INT);
        $stmt->bindParam(':data1', $data1, PDO::PARAM_STR);
        $stmt->bindParam(':data2', $data2, PDO::PARAM_STR);
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