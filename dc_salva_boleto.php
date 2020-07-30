<?php
include 'dc_config.php';
ini_set('default_charset','UTF-8');
// Check whether username or password is set from android	
  if(isset($_POST['extrato']) && isset($_POST['data']) && isset($_POST['linha']) && isset($_POST['valor']) && isset($_POST['entregador']) && isset($_POST['username']))
  {
   // Innitialize Variable
   $extrato = $_POST['extrato'];
   $data = $_POST['data'];
   $linha = $_POST['linha'];
   $valor = $_POST['valor'];
   $entregador = $_POST['entregador'];
   $username = $_POST['username'];
   $dataGravacao = date('Y-m-d H:i:s');
   $recebido = 0;
 
   // Query database for row exist or not
   $sql = 'INSERT INTO expressas_boletos (num_extrato, dat_credito, num_linha_boleto, val_boleto, cod_expressa,
   dat_cadastro, nom_usuario, dom_recebido)
   VALUES
   (:num_extrato, :dat_credito, :num_linha_boleto, :val_boleto, :cod_expressa,:dat_cadastro, :nom_usuario, :dom_recebido);';
   
   $stmt = $conn->prepare($sql);
   $stmt->bindParam(':num_extrato', $extrato);
   $stmt->bindParam(':dat_credito', $data);
   $stmt->bindParam(':num_linha_boleto', $linha);
   $stmt->bindParam(':val_boleto', $valor);
   $stmt->bindParam(':cod_expressa', $entregador);
   $stmt->bindParam(':dat_cadastro', $dataGravacao);
   $stmt->bindParam(':nom_usuario', $username);
   $stmt->bindParam(':dom_recebido', $recebido);
   if ($stmt->execute())
   {
     echo 'true';   
   } elseif(!$stmt->rowCount()) {
     echo 'false';
   }
 }	
?>