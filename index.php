<?php 
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
    <div class="form_div">
        <h1>PokéShort</h1>
        <br/><br/>
        <form action="shorten.php" method="post">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="e.g. http://www.yourwebsite.com/" aria-label="Your URL" aria-describedby="button-addon2">
                <button style="background-color:rgb(36, 150, 255); color:white;" class="btn btn-outline-secondary" type="button" id="button-addon2">Throw Pokeball!</button>
            </div>
        </form>
                </div>
        <div class="footer">
            <ul>
        <li><img src="/img/github.png" name="github_img" alt="github image" /></li>
                </ul>
    
    </div>
                </center>
    
</body>
</html>