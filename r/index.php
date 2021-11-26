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


    header("Refresh:5; URL=" . $url['long_url']);
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    
    <div class="conainer" style="padding-top: 50px;">
        <div class="row">
        <div class="col-md-8 offset-md-2">
        <div class="pokemon-name"><h1><?= $url['pokemon']; ?>, I choose you!</h1></div>
        <div class="pokemon-redirect"><p>You are being redirected. Please enjoy your randomly assigned Pokemon while you wait!</p></div>
       <div class="pokemon-image"> <img src="<?= $url['image']; ?>" width= 100vw; height= 100vh; class="img-fluid" alt="pokemon image"></div>
    </div>
    </div>
    </div>
</body>
</html>