<?php
include('db.php');
include('function.php');
if(isset($_POST["jajanan_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM jajanan 
		WHERE id = '".$_POST["jajanan_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["nama"] = $row["nama"];
		$output["harga_beli"] = $row["harga_beli"];
		$output["harga_jual"] = $row["harga_jual"];
		$output["asal_stock"] = $row["asal_stock"];
		if($row["image"] != '')
		{
			$output['user_image'] = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="100" height="100" /><input type="hidden" name="hidden_user_image" value="'.$row["image"].'" />';
		}
		else
		{
			$output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
		}
	}
	echo json_encode($output);
}
?>