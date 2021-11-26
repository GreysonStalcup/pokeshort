<?php
    include "../db.php";

    $db = new Database("db", "64594", "root", "root", "url_short");

    $db = $db->connect();

    $long_url = $_POST['long_url'];
    $pokemon = $_POST['pokemon'];
    $pokemon_id = $_POST['pokemon_id'];
    $image = $_POST['image'];

    $query = "INSERT INTO urls (long_url, pokemon, pokemon_id, image) VALUES (:long_url, :pokemon, :pokemon_id, :image)";
    $stmt = $db->prepare($query);
    $params = Array(
        "long_url" => $long_url,
        "pokemon" => $pokemon, 
        "pokemon_id" => $pokemon_id,
        "image" => $image
    );
    $result = $stmt->execute($params);

    header("location: /?i=" . $db->lastInsertId());
?>