<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Tambah")
	{
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		$statement = $connection->prepare("
			INSERT INTO jajanan (nama, harga_beli, harga_jual, asal_stock, image) 
			VALUES (:nama, :harga_beli, :harga_jual, :asal_stock, :image)
		");
		$result = $statement->execute(
			array(
				':nama'	=>	$_POST["nama"],
				':harga_beli'	=>	$_POST["harga_beli"],
				':harga_jual'	=>	$_POST["harga_jual"],
				':asal_stock'	=>	$_POST["asal_stock"],
				':image'		=>	$image
			)
		);
		if(!empty($result))
		{
			echo 'Data Inserted';
		}
	}
	if($_POST["operation"] == "Edit")
	{
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		else
		{
			$image = $_POST["hidden_user_image"];
		}
		$statement = $connection->prepare(
			"UPDATE jajanan
			SET nama = :nama, harga_beli = :harga_beli, harga_jual = :harga_jual
						, asal_stock = :asal_stock, image = :image  
			WHERE id = :jajanan_id"
		);
		$result = $statement->execute(
			array(
				':nama'	=>	$_POST["nama"],
				':harga_beli'	=>	$_POST["harga_beli"],
				':harga_jual'	=>	$_POST["harga_jual"],
				':asal_stock'	=>	$_POST["asal_stock"],
				':image'		=>	$image,
				':jajanan_id'	=>	$_POST["jajanan_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}

?>