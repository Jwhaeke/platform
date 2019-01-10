

<?php
session_start();

function connect(){
    $conn = new PDO("mysql:host=127.0.0.1;dbname=platform", "root", "pannenkoek");
}
$conn = new PDO("mysql:host=127.0.0.1;dbname=platform", "root", "pannenkoek");

$stmt = $conn->query("SELECT * FROM games INNER JOIN genre ON games.genre = genre.id");

while ($row = $stmt->fetch()) {
    $listGames[] = array(
        'id' => $row['id'],
        'game' => $row['name'],
        'genre' => $row['type'],
        'price' => $row['price'],
        'review' => $row['review']
   );
}


$conn = NULL;

//On submit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST["search"] == "searched"){
    $game = $_POST['name'];
    $genre = $_POST['genre'];
    $price = $_POST['price'];
    $review = $_POST['review'];
    $searchedGames = [];
    
    if ($game = "" && $genre = "" && $price = "" && $review = ""){
    } else {
        function filterGame(){
            global $listGames;
            global $searchedGames;
            global $game;
            $tempArr = [];
            if ($game != '') {                                             //   If game is not empty
                $gameName = strtolower($game);                             //   Convert search query to lower case
                if (empty($searchedGames)) {                               //   Check if a search has been done already                                          
                    for ($i=0; $i < count($listGames); $i++) {             //   If not use original database 
                        if ($listGames[$i]["game"] == $game) {             //   Check is there is a match
                            array_push($searchedGames, $listGames[$i]);    //   If so add array to searchedgames array
                        } 
                    }
                } else {                                                   //   If a search has already been done
                    for ($i=0; $i < count($searchedGames); $i++) {         //   Loop through $searchedGames
                        if ($searchedGames[$i]["game"] == $game) {         //   Check if there is a match
                            array_push($tempArr, $searchedGames[$i]);      //   If so add to temparray
                        }                    
                    }
                    $searchedGames = $tempArr;                             //   and set $searchedGames equal to temparray
                }    
            }
        }

        function filterGenre(){
            global $listGames;
            global $searchedGames;
            global $genre;
            $tempArr = [];
            if ($genre != '') {   
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
        }
        
        function filterPrice(){
            global $listGames;
            global $searchedGames;
            global $price;
            $tempArr = [];
            if ($price != '') {                                                //If price is not empty    
                if (empty($searchedGames)) {    
                    for ($i=0; $i < count($listGames); $i++) {                 // Loop through $listgames and check if $price is lower than "price"
                        if ($listGames[$i]["price"] <= $price) {
                            array_push($searchedGames, $listGames[$i]);
                        } 
                    }    
                } else { 
                    for ($i=0; $i < count($searchedGames); $i++) { 
                        if ($searchedGames[$i]["price"] <= $price) {
                            array_push($tempArr, $searchedGames[$i]);
                        }                    
                    }
                    $searchedGames = $tempArr;  
                }   
            }
        }

        function filterReview(){
            global $listGames;
            global $searchedGames;
            global $review;
            $tempArr = [];
            if ($review != '') {
                if (empty($searchedGames)) {    
                    for ($i=0; $i < count($listGames); $i++) { 
                        if ($listGames[$i]["review"] >= $review) {
                            array_push($searchedGames, $listGames[$i]);
                        } 
                    }
                } else { 
                    for ($i=0; $i < count($searchedGames); $i++) { 
                        if ($searchedGames[$i]["review"] >= $review) {
                            array_push($tempArr, $searchedGames[$i]);
                        }                    
                    }
                    $searchedGames = $tempArr;  
                }   
            }
        }
        // Temp search query as a test. Is working but needs 
        function getReview() {
            global $review;
            global $searchedGames;
            $conn = new PDO("mysql:host=127.0.0.1;dbname=platform", "root", "pannenkoek"); // May be ok to put this at top of function
            $sql = "SELECT * FROM games INNER JOIN genre ON games.genre = genre.id WHERE games.review >= $review";
            foreach ($conn->query($sql) as $row) {
                $searchedGames[] = $row;
            }
            print_r($searchedGames);
        }

    filterGenre();
    filterGame();
    filterPrice();
    getReview($conn);    
    }   
}


//  Add the game name to the list
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST["buy"] == "Buy"){
    $buyGame = $_POST['id'];
    $_SESSION["myGames"][] = $buyGame;
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
        <input type="hidden" name="search" value="searched">
        <!-- Maybe find a way to auto complete typing -->
        <input type="text" name="name" id="" placeholder="Search Game" value="<?php if(isset($_POST['name'])) echo $_POST['name'] ?>">
        <select name="genre" id="">
            <option value="">Select Genre</option>
            <option value="rpg">RPG</option>
            <option value="fps">FPS</option>
            <option value="race">Race</option>
            <option value="sport">Sport</option>
            <option value="puzzle">Puzzle</option>

        </select>
        <input type="number" name="price" id="" placeholder="Max Price" value="<?php if(isset($_POST['price'])) echo $_POST['price'] ?>">
        <input type="number" name="review" id="" placeholder="Min Review Value" value="<?php if(isset($_POST['review'])) echo $_POST['review'] ?>">
        <button type="submit">Search</button>
    </form>
    <div class="dropdown float-right">
        <button class="btn btn-secondary dropdown-toggle"
                type="button" id="dropdownMenu1" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            My games
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
        <?php foreach ($_SESSION["myGames"] as $game): ?>         
            <a class="dropdown-item" href="#!"><?php echo $game; ?></a>
        <?php endforeach; ?>
        </div>
    </div>
</div>

<p class="text-center"><?php echo "You have found ".count($searchedGames)." games from a total of ".count($listGames)."."; ?> </p>

<?php

if (isset($searchedGames)  && !empty($searchedGames)): ?>
    <div class="container">
            <?php foreach ($searchedGames as $value): ?> 
            <div class="card d-inline-block">
                <div class="card-body">
                    <h4 class="card-title"><?php echo $value["name"]; ?></h4>
                    <h4 class="card-subtitle mb-2 text-muted"><?php echo $value["type"]; ?></h4>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $value["review"]; ?> out of 5 stars.</h6>
                    <p class="card-text">This game costs <?php echo $value["price"].".<br>"; ?>
                    <b>Description:</b> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rem asperiores deleniti necessitatibus! Pariatur, maiores suscipit? Pariatur alias fugit expedita quae?
                    </p>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <input class="btn btn-primary" type="submit" name="buy" value="Buy" />
                        <input type="hidden" name="id" value="<?php echo $value["game"]; ?>"/>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
    </div>
<?php endif; ?>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>