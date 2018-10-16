<?php
class Db{
	//Tao bien $conn ket noi
	public static $conn;
	//Tao ket noi trong ham construct
	public function __construct(){
		self::$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		self::$conn->set_charset('utf8');
	}
	public function __destruct(){
		self::$conn->close();
	}
	public function getData($obj){
		$arr = array();
		while($row = $obj->fetch_assoc()){
			$arr[]=$row;
		}
		return $arr;
	}
	//Xem Danh Sach Sam Pham
	public function product1(){
		//Viet cau SQL
		$sql = "SELECT *
		FROM `protypes`,product,manufactures
		WHERE product.type_ID = protypes.type_ID
		AND product.manu_ID = manufactures.manu_ID"; 
		
		//Thuc thi cau truy van
		$result = self::$conn->query($sql);
		return $this->getData($result);
	}
	//Tim kiem San Pham
	public function timKiem($Search)
	{
		$sql = "SELECT *
		FROM `protypes`,product,manufactures
		WHERE product.manu_ID = manufactures.manu_ID
		AND product.type_ID = protypes.type_ID
		AND (`name` LIKE '%$Search%' OR `description` LIKE '%$Search%')";
		$result = self::$conn->query($sql);
		return $this->getData($result);
	}
	public function manufactur(){
		$sql = "SELECT * FROM `manufactures`";
		$result = self::$conn->query($sql);
		return $this->getData($result);
	}
	public function getUserByUSName($username){
		$sql = "SELECT *
		FROM `user`
		WHERE Username = '$username'";
		$result = self::$conn->query($sql);
		return $this->getData($result);
	}
	//Phan Trang
	public function getAllProducts($page, $per_page)
     {
 
       // Tính số thứ tự trang bắt đầu  
   
        $first_link = ($page - 1) * $per_page; 
  
        $sql = "SELECT * 
        FROM `protypes`,`Product`,`manufactures`
        WHERE product.type_ID = protypes.type_ID
        AND product.manu_ID = manufactures.manu_ID 
       	ORDER BY ID DESC
        LIMIT $first_link, $per_page"; 
      	$result = self::$conn->query($sql);
		return $this->getData($result);   
     } 

      public function paginate($url, $total, $page, $per_page, $offset)
        {
        	if($total <=0)
        		return "";

             $total_links = ceil($total/$per_page);
             if($total_links <=1)
             return "";
             $from =$page -$offset;
             $to =$page + $offset;

             if($from <=0)
             {
             	$from =1;
             	$to = $offset *2;
             }
             if($to > $total_links)
             {
             	$to = $total_links;
             }
             $prev = $page - 1; 
             $Next = $page +1;
             $link = "<a href='$url?page=1'> << </a>";
             $link = $link . "<a href='$url?page=$prev'> < </a>";

             for($j=$from; $j <= $to ; $j++) 
             {
                 $link = $link."<a href='$url?page=$j'> $j </a>";
             } 
             $link = $link."<a href='$url?page=$Next'> > </a>";
             $link = $link."<a href='$url?page=$total_links'> >> </a>";
              return $link; 
         } 
        	public function getAllProTypes(){
		$sql = "SELECT * FROM `protypes`";
		$result = self::$conn->query($sql);
		return $this->getData($result);
	}

	public function getAllManufacture(){
		$sql = "SELECT * FROM `manufactures`";
		$result = self::$conn->query($sql);
		return $this->getData($result);
	}
	public function addProducts($name, $price, $image, $desc, $manu_ID, $type_ID){
		$sql = "INSERT INTO `product`(`name`, `price`, `image`, `description`, `manu_ID`, `type_ID`)
		VALUES ('$name',$price,'$image','$desc',$manu_ID,$type_ID)";
		self::$conn->query($sql);
	}
	public function getTongSanPham(){
		$sql = "SELECT * FROM `products`";
		$result = self::$conn->query($sql);
		return $result->num_rows;
	}

	public function deleteProduct($ID, $image){
		$sql = "DELETE FROM `product` 
		WHERE `ID` = $ID";
		self::$conn->query($sql);
		unlink("public/image/$image");
	}
	public function HTSP($ID){
		$sql = "SELECT * FROM `product`
		WHERE `ID` = $ID";
		$result = self::$conn->query($sql);
		return $this->getData($result);
	}
	public function CapNhap($name, $price, $image, $desc, $manu_ID, $type_ID, $id){
		$sql = "UPDATE `product`
		SET `name`='$name',`price`=$price,`image`='$image',`description`='$desc',`manu_ID`=$manu_ID,`type_ID`=$type_ID
		WHERE `ID` = $id";
		//var_dump($sql);
		self::$conn->query($sql);
	}
}