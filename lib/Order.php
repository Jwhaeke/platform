<?php
namespace Platform;

class Order extends Data{

    public function addToBasket($game_id, $user_id){
        $stmt = $this->connection->prepare("INSERT INTO orders (game_id, user_id) VALUES (:game, :user)");
        $stmt->execute([
            'game' =>$game_id,
            'user' => $user_id
        ]);
        
    }

}
?>