<?php
if(!isset($_POST['name'])){
	header("location:form.php");
}
include "db.php";
include "config.php";
$db = new Db;
$sp = $db->HTSP($_POST['id']);
$img = "";
if(is_uploaded_file($_FILES['fileUpload']['tmp_name'])){
	$img = $_FILES['fileUpload']['name'];
	$imgName = "public/image/" . $_FILES['fileUpload']['name'];
	$imgCu = "public/image/" .  $sp[0]['image'];
	unlink($imgCu);
	move_uploaded_file($_FILES['fileUpload']['tmp_name'], $imgName);
}
else{
	$img = $sp[0]['image'];
}
$db->CapNhap($_POST['name'], $_POST['price'], $img, $_POST['description'], $_POST['manu_id'], $_POST['type_id'], $_POST['id']);
header("location:index.php");
?>