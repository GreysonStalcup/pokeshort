<?php 
    include "db.php";

    $db = new Database("db", "64594", "root", "root", "url_short");

    $db = $db->connect();

    $stmt = $db->query("SELECT * FROM urls");
    $urls = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    function GrabPokemon(){
        $min = 0;
        $max = 300; 
        /* use PokePHP\PokeApi;
        $api = new PokeAPI();

        echo $api->pokemon('1'); */
        $url = "https://pokeapi.co/api/v2/pokemon/";
        $id = rand($min, $max);
        $data = file_get_contents($url.$id.'/');
        $pokemon = json_decode($data);
        $image = $pokemon->sprites->front_default;
        
        
        $final[0] = $pokemon->name;
        $final[1] = $image;
        $final[2] = $id;

        
        return $final;
    }
    $pokemon = GrabPokemon();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon URL Shortener</title>
    <link rel="stylesheet" href="style.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    <center>
    <section class="form">
    <div class="form_div">
        <h1>PokéShort</h1>
        <br/><br/>
        <form action="/add/index.php" method="post">
            <div class="input-group mb-3">
                <input type="text" name="long_url" class="form-control" placeholder="e.g. http://www.yourwebsite.com/" aria-label="Your URL" aria-describedby="button-addon2">
                <input type="hidden" name="pokemon" value=<?php echo $pokemon[0] ?> />
                <input type="hidden" name="image" value=<?php echo $pokemon[1] ?> />
                <input type="hidden" name="pokemon_id" value=<?php echo $pokemon[2] ?> />
                <button style="background-color:rgb(36, 150, 255); color:white;" class="btn btn-outline-secondary" type="submit" id="button-addon2">Throw Pokeball!</button>
            </div>
            
        </form>
        <hr>
        <?php if(isset($_GET['i'])){
                $id = $_GET['i'];
                $query = "SELECT * FROM urls WHERE ID = :ID LIMIT 1";
                $stmt = $db->prepare($query);
                $params = array(
                    "ID" => $id
                );
                $stmt->execute($params);
                $alerturl = $stmt->fetch();
                $html = '<div class="alert alert-success" role="alert">Your shortened URL is: <a class="alert-link" href=/r?p=' .  $alerturl['pokemon'] . '&c=' . $alerturl['ID'] . '>'. 'localhost/r?p=' .  $alerturl['pokemon'] . '&c=' . $alerturl['ID'] . '</div>';
                echo $html;
            } ?>
                </div>
        
        
    </div>
                </center>
            </section>
            <!-- Footer -->
<footer class="page-footer font-small cyan darken-3">

<!-- Footer Elements -->




<div class="footer-copyright text-center py-3">
<a href="https://github.com/GreysonStalcup/pokeshort"> <img src="/img/github.png" width=36 height=36></a><br>
    © 2020 Pokeshort
  
</div>


</footer>

</body>
</html>