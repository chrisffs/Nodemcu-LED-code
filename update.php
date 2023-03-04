<?php     
  require 'conn.php';
  
  if (!empty($_POST)) {
    $Stat = $_POST['status'];
      
    // insert data
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE led_stat SET status = ? WHERE id = 1";
    $q = $pdo->prepare($sql);
    $q->execute(array($Stat));
    Database::disconnect();
    header("Location: index.php");
  }
?>