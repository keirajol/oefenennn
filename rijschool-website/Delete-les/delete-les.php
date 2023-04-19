<?php
    include '../Database/db.php';
    $database = new Database();

    $les_id = $_GET['les_id'];
    if($les_id) {
    try {
        $query = "DELETE FROM lessen where les_id=:les_id";
        $data = [
            'les_id' => $les_id
        ];
        $database->delete($query,$data);
        header("Location: ../leerling-page/leerling.php");
    } catch (\Exception $e) { 
        echo $e->getMessage();
    }
}
   


?>