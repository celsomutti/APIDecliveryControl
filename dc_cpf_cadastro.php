<?php

    include 'dc_config.php';

    // Check whether username or password is set from android	
    if(isset($_POST['cpf']))
    {
        // Innitialize Variable
        $cpf = $_POST['cpf'];

        // Query database for row exist or not
        $sql = 'SELECT cod_cadastro, des_razao_social from tbentregadores 
        where num_cnpj = :cpf and cod_status in (2,3,4);';

        $conn->exec("set names utf8");
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
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