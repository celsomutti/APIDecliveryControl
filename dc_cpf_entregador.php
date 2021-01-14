<?php

    include 'dc_config.php';

    // Check whether username or password is set from android	
    if(isset($_POST['cpf']))
    {
        // Innitialize Variable
        $cpf = $_POST['cpf'];

        // Query database for row exist or not
        $sql = 'SELECT COD_CADASTRO, COD_ENTREGADOR, NOM_FANTASIA, COD_AGENTE, DAT_CODIGO, DES_CHAVE, COD_GRUPO, 
        VAL_VERBA, NOM_EXECUTANTE, DOM_ATIVO, DAT_MANUTENCAO from tbcodigosentregadores 
        where DES_CHAVE = :cpf and COD_CADASTRO <> 0;';

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