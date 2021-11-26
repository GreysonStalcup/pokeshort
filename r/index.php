<?php
    include "../db.php";

    $db = new Database("db", "64594", "root", "root", "url_short");
 
    $db = $db->connect();

    $pokemon = $_GET['p'];
    $id = $_GET['c'];

    $query = "SELECT * FROM urls WHERE ID = :ID AND pokemon = :pokemon LIMIT 1";
    $stmt = $db->prepare($query);

    $params = array(
        "ID" => $id,
        "pokemon" => $pokemon
    );

    $stmt->execute($params);
    $url = $stmt->fetch();

    header("location: " . $url['long_url']);
    
    
?>