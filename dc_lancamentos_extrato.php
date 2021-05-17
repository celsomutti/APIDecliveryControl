<?php

    include 'dc_config.php';
	
	// Check whether username or password is set from android	
    if(isset($_POST['extratos']))
    {
        // Innitialize Variable
        $extratos = $_POST['extratos'];
                
        // Query database for row exist or not
        $sql = 'SELECT tblancamentos.des_lancamento, tblancamentos.dat_lancamento, tblancamentos.des_tipo,  
        tblancamentos.val_lancamento 
        from tblancamentos 
        where tblancamentos.num_extrato = :extratos';

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