<?php
namespace Platform;

class MyGames extends Data {
    function getUserId($id){
        $stmt = $this->connection->prepare("SELECT name FROM my_games INNER JOIN games ON my_games.game_id = games.id WHERE user_id = :user_id");
       
        $stmt->execute([
            'user_id' => $id]
        ); 
        
        $myGames = $stmt->fetchAll();
        return $myGames;
    }
}