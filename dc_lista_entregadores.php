<?php

    include 'dc_config.php';

    // Check whether username or password is set from android	
    if(isset($_POST['cadastro']))
    {
        // Innitialize Variable
        $cadastro = $_POST['cadastro'];

        // Query database for row exist or not
        $sql = 'SELECT COD_ENTREGADOR from tbcodigosentregadores 
        where COD_CADASTRO = :cadastro and dom_ativo = 1;';

        $conn->exec("set names utf8");
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cadastro', $cadastro, PDO::PARAM_STR);
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