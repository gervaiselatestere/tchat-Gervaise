<?php

// model/Users.class.php

/**
 * Classe permettant de gérer les utilisateurs
 */
class Users extends Model
{
  protected $userNickName = 'userNickName';

  public function listAll()
  {
    // On prépare la requête SQL
    $query = "SELECT *
              FROM users
              ORDER BY userNickName asc";

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
     * Ajoute un utilisateur dans la BDD
     * @param  string $userNickName    Nom de l'utilisateur
     * @return void
     */
    public function add($userNickName)
    {
               // On prépare notre requête SQL
        $query = "INSERT INTO users (userNickName) VALUES (:userNickName)";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'userNickName' => $userNickName,
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL (en liant notre tableau de "binding")
        $statement->execute($boundValues);
        $lastId=$this->PDO->lastInsertId();
        return ($lastId);

    }


    /**
     * Contrôle si l'utilisateur existe à partir de son identifiant
     *
     * @param  int   $userNickName    Identifiant de l'utilisateur
     * @return bool             Renvoie FALSE s'il existe,  TRUE sinon
     */
    public function exists($userNickName)
    {
        // On prépare notre requête SQL
        $query = "SELECT * FROM users WHERE userNickName = :userNickName";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)

        $boundValues = [
            'userNickName' => $userNickName
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL (en liant notre tableau de "binding")
        $statement->execute($boundValues);

        // S'il n'y a aucun enregistrement dans la BDD
        if ($statement->rowCount() === 0)
        {
            // On retourne la valeur FALSE
            //echo("false : User n'existe pas");
            return false;
        }

        // Sinon (s'il y a enregistrement)
        else
        {
            //echo("true : User existe");
            return true;
        }
    }


    public function existeId($userNickName)
    {
        // On prépare la requête SQL
        $query = "SELECT userId
              FROM users
              WHERE userNickName = :userNickName";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)

        $boundValues = [
            'userNickName' => $userNickName
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->PDO->prepare($query);

        // On exécute notre requête SQL (en liant notre tableau de "binding")
        $statement->execute($boundValues);

       $result=$statement->fetch();
        $id=$result['userId'];
        return($id);


    }
}
