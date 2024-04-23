<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\DBAL\Connection;

class TrucController extends AbstractController
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function someAction()
    {
        $sql = "SELECT * FROM japonais_francais"; //Remplacez columnName et tableName par le nom de votre colonne et de votre table

        $results = $this->connection->executeQuery($sql)->fetchAll();
        return $results;
        // Utilisez $results pour obtenir les résultats de la requête
    }
}
