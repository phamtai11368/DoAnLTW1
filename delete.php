<?php
require "db.php";
require "config.php";
$db = new Db;
$db->deleteProduct($_GET['id'], $_GET['image']);
header("location:index.php");