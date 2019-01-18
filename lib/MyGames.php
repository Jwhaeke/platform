<?php
namespace Platform;

class MyGames extends Data {
  
    public function getMyGames($id){
  
        $stmt = $this->connection->prepare("SELECT name FROM my_games INNER JOIN games ON my_games.game_id = games.id WHERE user_id = :user_id");
       
        $stmt->execute([
            'user_id' => $id]
        ); 
        
       return $stmt->fetchAll();
    }
}