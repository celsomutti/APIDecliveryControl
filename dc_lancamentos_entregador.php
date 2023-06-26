<?php

    include 'dc_config.php';
	ini_set('default_charset','UTF-8');
	// Check whether username or password is set from android	
    if(isset($_POST['entregador']) && isset($_POST['datini']) && isset($_POST['datfim']))
    {
        // Innitialize Variable
        $entregador = $_POST['entregador'];
        $datini = $_POST['datini'];
        $datfim = $_POST['datfim'];
                
        // Query database for row exist or not
        $sql = 'SELECT tblancamentos.des_lancamento, tblancamentos.dat_lancamento, tblancamentos.des_tipo,  
        tblancamentos.val_lancamento 
        FROM tblancamentos
        WHERE tblancamentos.cod_entregador IN (' . $entregador . ') AND tblancamentos.dat_lancamento BETWEEN "' . $datini . '" AND 
        "' . $datfim .'" AND tblancamentos.dom_desconto = "N";';
        $stmt = $conn->prepare($sql);
        // $stmt->bindParam(':entregador', $entregador, PDO::PARAM_INT);
        // $stmt->bindParam(':datini', $datini, PDO::PARAM_STR);
        // $stmt->bindParam(':datfim', $datfim, PDO::PARAM_STR);
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