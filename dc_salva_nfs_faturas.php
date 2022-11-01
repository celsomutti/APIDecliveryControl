<?php
include 'dc_config.php';
ini_set('default_charset','UTF-8');
// Check whether username or password is set from android	
  if(isset($_POST['cadastro']) && isset($_POST['dataVencimento']) && isset($_POST['arquivo']) && isset($_POST['localizacao']))
  {
   // Innitialize Variable
   $cadastro = $_POST['cadastro'];
   $dataVencimento = $_POST['dataVencimento'];
   $arquivo = $_POST['arquivo'];
   $localizacao = $_POST['localizacao'];
   $aceite = 0;
   $credito = 0;
   $dataEnvio = date('Y-m-d H:i:s');
 
   // Query database for row exist or not
   $sql = 'INSERT INTO financeiro_nfs_faturas (cod_cadastro, dat_vencimento, nom_arquivo, des_localizacao_arquivo, dom_aceite, dom_credito, dat_envio)
   VALUES
   (:cod_cadastro, :dat_vencimento, :nom_arquivo, :des_localizacao_arquivo, :dom_aceite, :dom_credito, :dat_envio);';
   
   $stmt = $conn->prepare($sql);
   $stmt->bindParam(':cod_cadastro', $cadastro);
   $stmt->bindParam(':dat_vencimento', $dataVencimento);
   $stmt->bindParam(':nom_arquivo', $arquivo);
   $stmt->bindParam(':des_localizacao_arquivo', $localizacao);
   $stmt->bindParam(':dom_aceite', $aceite);
   $stmt->bindParam(':dom_credito', $credito);
   $stmt->bindParam(':dat_envio', $dataEnvio);
   if ($stmt->execute())
   {
     echo 'true';   
   } elseif(!$stmt->rowCount()) {
     echo 'false';
   }
 }	
?>