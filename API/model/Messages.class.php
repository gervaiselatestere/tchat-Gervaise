<?php

// model/Messages.class.php

/**
 * Classe permettant de gérer les messages
 */
class Messages extends Model
{

  protected $messageValue = 'messageValue';
  protected $messageDate = 'messageDate';
  protected $userId = 'userId';

  

  public function listAll()
  {
    // On prépare la requête SQL
    $query = "SELECT a.*, userNickName
              FROM messages As a, users As b
              WHERE a.userId= b.userId
              ORDER BY messageDate desc";

    // On charge notre requête SQL dans la couche d'abstraction PDO
    $statement = $this->PDO->prepare($query);

    // On exécute notre requête SQL
    $statement->execute();

    // On retourne nos résultats SQL (liste des personnages)
    // sous la forme d'un tableau à deux dimensions
    //return $statement->fetchAll();
      echo json_encode($statement->fetchAll());
  }


  /**
   * Ajoute un nouveau message dans la BDD
   * 
   * @param  string $messageValue     message
   * @param  string $userId           userId
   * @return void
   */
  public function add($messageValue, $userId)
  {
    // On prépare notre requête SQL
    $query = "INSERT INTO messages (messageValue, userId) VALUES (:messageValue, :userId)";
    
    // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
    // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
    $boundValues = [
      'messageValue' => $messageValue,
      'userId' => $userId
    ];

    // On charge notre requête SQL dans la couche d'abstraction PDO
    $statement = $this->PDO->prepare($query);

    // On exécute notre requête SQL (en liant notre tableau de "binding")
    $statement->execute($boundValues);

  }


}
