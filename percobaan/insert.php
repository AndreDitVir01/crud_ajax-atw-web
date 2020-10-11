<?php 
include('config.php');
include('function.php');

if(isset($_POST["operation"]))
{
    if($_POST["operation"] == "Add")
    {
        $statement = $connection->prepare("INSERT INTO nama (nama, jmlh_mahasiswa) VALUES (:nama, :jmlh_mahasiswa)");
        $result = $statement->execute(
             array(
                ':nama'   =>  $_POST["nama"],
                ':jmlh_mahasiswa' =>  $_POST["jmlh_mahasiswa"],
             )
        );
    }
    if($_POST["operation"] == "Edit")
    {
        $statement = $connection->prepare("UPDATE nama SET nama = :nama, jmlh_mahasiswa = :jmlh_mahasiswa WHERE id = :id");
        $result = $statement->execute(
             array(
                ':nama'   =>  $_POST["nama"],
                ':jmlh_mahasiswa' =>  $_POST["jmlh_mahasiswa"],
                ':id'       =>  $_POST["nama_id"]
             )
        );
    }
    
}
?>
                           