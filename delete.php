<?php

include('db.php');
include("function.php");

if(isset($_POST["jajanan_id"]))
{
	$image = get_image_name($_POST["jajanan_id"]);
	if($image != '')
	{
		unlink("upload/" . $image);
	}
	$statement = $connection->prepare(
		"DELETE FROM jajanan WHERE id = :jajanan_id"
	);
	$result = $statement->execute(
		array(
			':jajanan_id'	=>	$_POST["jajanan_id"]
		)
	);
	
	if(!empty($result))
	{
		echo 'Data Deleted';
	}
}



?>