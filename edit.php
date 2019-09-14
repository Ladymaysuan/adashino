<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{	
	$id = $_POST['id'];
	
	$productname=$_POST['productname'];
	$productdescription=$_POST['productdescription'];
	$productprice=$_POST['productprice'];	
	$productquantity=$_POST['productquantity'];	
	// checking empty fields
	if(empty($productname) || empty($productdescription) || empty($productprice) || empty($productquantity)) {	
			
		if(empty($productname)) {
			echo "<font color='red'>product Name field is empty.</font><br/>";
		}
		
		if(empty($productdescription)) {
			echo "<font color='red'>product description field is empty.</font><br/>";
		}
		
		if(empty($productprice)) {
			echo "<font color='red'>product price field is empty.</font><br/>";
		}	
		if(empty($productquantity)) {
			echo "<font color='red'>product quantity field is empty.</font><br/>";
		}	
	} else {	
		//updating the table
		$sql = "UPDATE users SET productname=:productname, productdescription=:productdescription, productprice=:productprice, productquantity=:productquantity WHERE id=:id";
		$query = $dbConn->prepare($sql);
				
		$query->bindparam(':id', $id);
		$query->bindparam(':productname', $productname);
		$query->bindparam(':productdescription', $productdescription);
		$query->bindparam(':productprice', $productprice);
		$query->bindparam(':productquantity', $productquantity);
        $query->execute();
		
		// Alternative to above bindparam and execute
		// $query->execute(array(':id' => $id, ':productname' => $productname, ':productdescription' => $productdescription, ':productprice' => $productprice, ':productquantity' => $productquantity));
				
		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$sql = "SELECT * FROM suan1db WHERE id=:id";
$query = $dbConn->prepare($sql);
$query->execute(array(':id' => $id));

while($row = $query->fetch(PDO::FETCH_ASSOC))
{
	$productname = $row['productname'];
	$productdescription = $row['productdescription'];
	$productprice = $row['productprice'];
	$productquantity = $row['productquantity'];
}
?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	<a href="index.php">Home</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>product Name</td>
				<td><input type="text" name="productname" value="<?php echo $productname;?>"></td>
			</tr>
			<tr> 
				<td>product description</td>
				<td><input type="text" name="productdescription" value="<?php echo $productdescription;?>"></td>
			</tr>
			<tr> 
				<td>productprice</td>
				<td><input type="text" name="productprice" value="<?php echo $productprice;?>"></td>
			</tr>
			<tr>
				<td>productquantity</td>
				<td><input type="text" name="productquantity" value="<?php echo $productquantity;?>"></td>
			</tr>
            <tr>			
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>