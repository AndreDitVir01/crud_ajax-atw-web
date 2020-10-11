<?php 
include('config.php');
include('function.php');

if(isset($_POST["kursus_id"]))
{
    $output = array();
    $statement = $connection->prepare("SELECT * FROM kursus WHERE id = '".$_POST["kursus_id"]."' LIMIT 1");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
        $output["id"] = $row["id"];
        $output["nama"] = $row["nama"];
        $output["jmlh_mahasiswa"] = $row["jmlh_mahasiswa"];
    }
    echo json_encode($output);
}
?>
                           