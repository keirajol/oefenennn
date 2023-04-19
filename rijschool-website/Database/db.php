<?php

class Database
{
    public $host;
    public $db;
    public $user;
    public $pass;
    public $charset;
    public $pdo;

    public function __construct()
    {

        $this->host = "127.0.0.1";
        $this->db = "autorijschool_vierkante_wielen";
        $this->user = "root";
        $this->pass = "";
        $this->charset = "utf8mb4";

        try {

            $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false,];
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
    }

    
   public function delete($sql,$placeholders) {
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($placeholders);
}
// public function wijzigLes($les_id, $datum, $lestijd_start, $lestijd_eind, $doel_van_les, $ophaal_locatie) {
    
//     // Update de lesgegevens in de database
//     $stmt = $this->pdo->prepare("UPDATE lessen SET datum = :datum, lestijd_start = :lestijd_start, lestijd_eind = :lestijd_eind, doel_van_les = :doel_van_les, ophaal_locatie = :ophaal_locatie WHERE les_id = :les_id");
//     $stmt->bindParam(':les_id', $les_id);
//     $stmt->bindParam(':datum', $datum);
//     $stmt->bindParam(':lestijd_start', $lestijd_start);
//     $stmt->bindParam(':lestijd_eind', $lestijd_eind);
//     $stmt->bindParam(':doel_van_les', $doel_van_les);
//     $stmt->bindParam(':ophaal_locatie', $ophaal_locatie);
//     $stmt->execute();
    
//     // Sluit de databaseverbinding
//     $this->pdo = null;
// }

}

