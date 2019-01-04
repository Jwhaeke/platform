<?php include 'data.php'; ?>

<?php


//On submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $game = $_POST['name'];
    $genre = $_POST['genre'];
    $price = $_POST['price'];
    $review = $_POST['review'];
    $searchedGames = [];

    

    function filterGame(){
        global $listGames;
        global $searchedGames;
        global $game;
        $tempArr = [];
        if ($game != '') {              //  If game is not empty
            $gameName = strtolower($game);

            if (empty($searchedGames)) {                                                         
                
                // If genre is anything other than no preference:
                // Loop through $listgames and check if $genre is same as "genre"
                for ($i=0; $i < count($listGames); $i++) { 
                    if ($listGames[$i]["game"] == $game) {
                        array_push($searchedGames, $listGames[$i]); 
                    } 
                }
            } else {
                for ($i=0; $i < count($searchedGames); $i++) { 
                    if ($listGames[$i]["game"] == $game) {
                        array_push($tempArr, $listGames[$i]);
                    }                    
                }
                $searchedGames = $tempArr;    
            }    
        }
    }

    function filterGenre(){
        global $listGames;
        global $searchedGames;
        global $genre;
        $tempArr = [];
        if ($genre != '') {   
            echo "yay";                                  // If genre is anything other than no preference:
            if (empty($searchedGames)) {              
            for ($i=0; $i < count($listGames); $i++) {          // Loop through $listgames and check if $genre is same as "genre"
                if ($listGames[$i]["genre"] == $genre) {
                    array_push($searchedGames, $listGames[$i]); 
                } 
            }
        } else {
            for ($i=0; $i < count($searchedGames); $i++) { 
                if ($listGames[$i]["genre"] == $genre) {
                    array_push($tempArr, $listGames[$i]);
                }                    
            }
            $searchedGames = $tempArr; 
        }
    }

    
    function filterPrice(){
        global $listGames;
        global $searchedGames;
        global $price;
        if ($price != '') {            
            //If price is not empty    
            // Loop through $listgames and check if $price is lower than "price"
            for ($i=0; $i < count($listGames); $i++) { 
                if ($listGames[$i]["price"] <= $price) {
                    array_push($searchedGames, $listGames[$i]);
                } 
            }    
        }
    }

    function filterReview(){
        global $listGames;
        global $searchedGames;
        global $review;
        if ($review != '') {
            //If price is not empty
                
            // Loop through $listgames and check if $review is higher than "review"
            for ($i=0; $i < count($listGames); $i++) { 
                if ($listGames[$i]["review"] >= $review) {
                    array_push($searchedGames, $listGames[$i]);
                } 
            }
        }
    }
    
    filterGenre();
    filterGame();
    filterPrice();
    filterReview();
    print_r($searchedGames);
        
}
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title>Platform</title>
</head>
<body>


<div class="container">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="text" name="name" id="" placeholder="Search Game" value="<?php if(isset($_POST['name'])) echo $_POST['name'] ?>">
        <select name="genre" id="">
            <option value="">Select Genre</option>
            <option value="rpg">RPG</option>
            <option value="fps">FPS</option>
            <option value="arcade">Arcade</option>
        </select>
        <input type="number" name="price" id="" placeholder="Max Price" value="<?php if(isset($_POST['price'])) echo $_POST['price'] ?>">
        <input type="number" name="review" id="" placeholder="Min Review Value" value="<?php if(isset($_POST['review'])) echo $_POST['review'] ?>">
        <button type="submit">Search</button>
    </form>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>