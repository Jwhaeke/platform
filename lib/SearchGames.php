<?php
namespace Platform;

class SearchGames extends Data {
  
    public function getSearchedGames(){
            $searchedGames = array();  
            $where = array();
            $params = array();
            $sql = "";
             
                //  Check if a search by name has been done
                if (!empty($_POST['name'])) {
                //  Prepare a partial query LIKE string    
                    $where[] = "name LIKE :name";
                //  Set params accordingly  
                    $nameGame = $_POST['name'];
                    $params[':name'] = "%$nameGame%";
                }
              
                if (!empty($_POST['type'])) {
                    $where[] = "type = :type";
                    $params[':type'] = $_POST['type'];
                }
              
                if (!empty($_POST['price'])) {
                    $where[] = "price <= :price";
                    $params[':price'] = $_POST['price'];
                }
            
                if (!empty($_POST['review'])) {
                $where[] = "review >= :review";
                $params[':review'] = $_POST['review'];
                }
        
                $whereFirst = $where[0];
                $paramsFirst = $params[0];
                
                
                //  Search through the games table and use foreign key genre - add all prepared partial queries
                if(count($where) > 0){
                    $sql .= "SELECT games.id, games.name, games.genre, games.price, games.review, genre.type FROM games INNER JOIN genre ON games.genre = genre.id WHERE ". implode(' AND ', $where);      
                }
        
                $stmt = $this->connection->prepare($sql);
                $stmt->execute($params);
                return $stmt->fetchAll(); 
    }
}

 //  Hoping to filter out games already owned 

        // $searchedResult = array_diff($searchedGames['name'], $myGames);
        // print_r($searchResult);
        // echo "<hr>";
        // print_r($searchedGames);
