<?php

include('database connection.php');
include('function.php');

if(isset($_POST["kursus_id"]))
{
	$statement = $connection->prepare(
		"DELETE FROM kursus WHERE id = :id"
	);
	$result = $statement->execute(

		array(':id'	=>	$_POST["kursus_id"])
		
	    );
}

?>