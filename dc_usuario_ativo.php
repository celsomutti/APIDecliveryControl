<?php
include 'dc_config.php';
ini_set('default_charset','UTF-8');
// Check whether username or password is set from android	
if(isset($_POST['cpf']))
{
    // Innitialize Variable
    $cpf = $_POST['cpf'];
    
    // Query database for row exist or not
    $sql = 'SELECT NUM_CPF_CNPJ, DOM_ATIVO FROM tbusuarios WHERE 
    NUM_CPF_CNPJ = :cpf and DOM_ATIVO = "S"';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
    $stmt->execute();
    if($stmt->rowCount())
    {
    echo "true";          
    } elseif(!$stmt->rowCount()) {
    echo "false";
    }
}
?>