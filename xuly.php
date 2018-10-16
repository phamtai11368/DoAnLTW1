<?php
if(isset($_FILES['fileUpload']) && isset($_POST['name']) && isset($_POST['type_id']) && isset($_POST['manu_id']) && isset($_POST['price'])){
	if($_POST['name'] != '' && $_POST['type_id'] != '' && $_POST['manu_id'] != '' && $_POST['price'] != '' && is_uploaded_file($_FILES['fileUpload']['tmp_name'])){
		$check = getimagesize($_FILES['fileUpload']['tmp_name']);
		if($check == true){
			$tagetDir = "public/image/";
			$tagetFile = $tagetDir . basename($_FILES['fileUpload']['name']);
			move_uploaded_file($_FILES['fileUpload']['tmp_name'], $tagetFile);
			include "config.php";
			include "db.php";
			$db = new db;
			$db->addProducts($_POST['name'], $_POST['price'], basename($_FILES['fileUpload']['name']), $_POST['description'], $_POST['manu_id'], $_POST['type_id']);
			header("location:index.php");
		}
		else
			echo "Hinh Khong Anh Hop Le!";
	}
}
?>