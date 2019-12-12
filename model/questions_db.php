<?php

function getUsersQuestion($userId){
    global $db;

    $query ='SELECT * FROM questions WHERE ownerId = :ownerId';

    $statement = $db->prepare($query);
    $statement->bindParam('ownerId',$ownerId);
    $statement->execute();

    $questions =$statement->fetchAll();
    $statement->closeCursor();

    return $questions;
}