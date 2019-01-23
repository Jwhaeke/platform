<?php
namespace Platform;
require 'vendor/autoload.php';
// Start a session and check if there is a user session active - if not redirect to login.php
session_start();

if(empty($_SESSION['user_id']))
{
    header("Location: login.php");
}

// Pull all owned games by the user and put them in an array
# Refactured to OOP - This is now being done in MyGames.php
$userGames = new MyGames;
$myGames = $userGames->getMyGames($_SESSION['user_id']); 
foreach ($myGames as $item => $value){
    $listGames[] = $value['name'];
}

//On search check if the form is the search form
# Refactured to OOP - This is now being done in SearchGames.php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST["search"] == "searched"){
    $search = new SearchGames;
    $searchedGames = $search->getSearchedGames($_POST['name'], $_POST['type'],$_POST['price'],$_POST['review']);       
}

//  Needs to be rewritten to add to db - but first a step to order / basket is required
# Refactured to OOP - This is now being done in SearchGames.php
# Understand the declaring vars is a bit redundant but is for the sake of readability
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST["purchase"] == "Buy"){
    $buyGame = $_POST['id'];
    $user = $_SESSION['user_id'];
    $order = new Order;
    $order->addToBasket($buyGame,$user);    
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
    <script type="text/javascript" src="javascript/main.js"></script>
</head>
<body onload="startTime()">

<!-- Collapsed part of the navbar -->
<div class="pos-f-t">
  <div class="collapse" id="navbarToggleExternalContent">
    <div class="bg-dark p-4 d-flex justify-content-between">
        <div>
            <h3 class="text-white">Welcome <?php echo ucfirst($_SESSION['user']) ?></h3>
            <a href="logout.php"><img src="https://img.icons8.com/nolan/64/000000/exit.png" data-toggle="tooltip"
        data-placement="top" title="Logout"></a>
        </div>
        <div>
            <h3 class="text-white">Profile</h3>
            <a href="profile.php"><img src="https://img.icons8.com/nolan/64/000000/xbox-menu.png" data-toggle="tooltip"
        data-placement="top" title="Profile"></a>
        </div>
        <div>
            <h3 class="text-white">My Basket</h3>
            <a href="basket.php"><img src="https://img.icons8.com/nolan/64/000000/shopping-cart.png" data-toggle="tooltip"
        data-placement="top" title="My Basket"></a>
        </div>
    </div>
  </div>

  <!-- Visible part of navbar -->
  <nav class="navbar navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      <span><?php echo ucfirst($_SESSION['user']) ?></span>
    </button>
    <div>
        <span class="text-muted">The time is</span>
        <span class="text-info" id="txt"></span> 
    </div>

    <!-- Search form for games -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="input-group">
            <input class="form-control" type="hidden" name="search" value="searched">
            <input class="form-control" type="text" name="name" id="" placeholder="Search Game" value="<?php if(isset($_POST['name'])) echo $_POST['name'] ?>">
            <select class="custom-select" name="type" id="">
                <option selected value="">Select Genre</option>
                <!-- This really should be automated - gathering type names from db server -->
                <option value="rpg">RPG</option>
                <option value="fps">FPS</option>
                <option value="race">Race</option>
                <option value="sport">Sport</option>
                <option value="puzzle">Puzzle</option>
            </select>
            <input class="form-control" type="number" name="price" id="" placeholder="Max Price" value="<?php if(isset($_POST['price'])) echo $_POST['price'] ?>" min=0 max=999>
            <input class="form-control" type="number" name="review" id="" placeholder="Min Review" value="<?php if(isset($_POST['review'])) echo $_POST['review'] ?>" min=0 max=5>
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>    
    
    <!-- Dropdown menu displaying owned games -->
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle"
                type="button" id="dropdownMenu1" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            My games
        </button>     
            <div class="dropdown-menu" aria-labelledby="dropdownMenu1">     
            <?php foreach ($listGames as $game): ?>                    
                <a class="dropdown-item" href="#!"><?php echo $game; ?></a>
            <?php endforeach; ?>
        </div>
    </div>
    </nav>
</div>

<?php

// Once a search has been done it will be displayed as individual cards with info and a buy button
if (!empty($searchedGames)): ?>
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
                    <input class="btn btn-primary" type="submit" name="purchase" value="Buy" />
                    <input type="hidden" name="id" value="<?php echo $value["id"]; ?>"/>
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