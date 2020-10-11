<?php

function get_total_all_records()
{
	include('config.php');
	$statement = $connection->prepare("SELECT * FROM kursus");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

?>