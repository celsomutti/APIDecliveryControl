<?php

    include 'dc_config.php';
    ini_set('default_charset','UTF-8');
    // Check whether username or password is set from android	
    if(isset($_POST['linha']))
    {
        // Innitialize Variable
        $linha = $_POST['linha'];
        
        // Query database for row exist or not
        $sql = 'SELECT num_linha_boleto FROM expressas_boletos WHERE 
        num_linha_boleto = :linha';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':linha', $linha, PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount())
        {
        echo "true";          
        } elseif(!$stmt->rowCount()) {
        echo "false";
        }
    }

?>