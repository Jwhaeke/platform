<?php
namespace Platform;

class Userinfo extends Data{

    public function getUserId($id){
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE id = :sid");
        $stmt->execute([
            'sid' => $id]
        ); 
        
        $user = $stmt->fetchAll();
        return $user;
    }
}

?>