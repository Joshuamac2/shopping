<?php

session_start();
$connect = mysqli_connect("localhost", "root", "", "cart");

if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping"]))
	{
		$item_array_id = array_column($_SESSION["shopping"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
		$count = count($_SESSION["shopping"]);
		$item_array = array(
		'item_id'		=>	$_GET["id"],
		'item_name'		=>	$_POST["hidden_name"],
		'item_price'		=>	$_POST["hidden_price"],
		'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping"][$count] = $item_array;
		}
		else
		{
		echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
		'item_id'		=>	$_GET["id"],
		'item_name'		=>	$_POST["hidden_name"],
		'item_price'		=>	$_POST["hidden_price"],
		'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping"][0] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping"] as $keys => $values)
		{
		if($values["item_id"] == $_GET["id"])
		{
		unset($_SESSION["shopping"][$keys]);
		echo '<script>alert("Item Removed")</script>';
		echo '<script>window.location="index.php"</script>';
		}
		}
	}
}

?>
<!DOCTYPE html>
<html>
	<body>
		<?php
		$query = "SELECT * FROM tools ORDER BY id ASC";
		$result = mysqli_query($connect, $query);
		if(mysqli_num_rows($result) > 0)
		{
		while($row = mysqli_fetch_array($result))
		{
		?>
		<form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>">
		<h4><?php echo $row["name"]; ?></h4>
		<h4>$<?php echo $row["price"]; ?></h4>
		<input type="text" name="quantity" value="1" />
		<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
		<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
		<input type="submit" name="add_to_cart" value="Add to Cart" />
		</form>
		<?php
		}
		}
		?>
		<h3>Order Details</h3>
		<table>
		<tr>
		<th>Item Name</th>
		<th>Quantity</th>
		<th>Price</th>
		<th>Total</th>
		<th>Action</th>
		</tr>
		<?php
		if(!empty($_SESSION["shopping"]))
		{
		$total = 0;
		foreach($_SESSION["shopping"] as $keys => $values)
		{
		?>
		<tr>
		<td><?php echo $values["item_name"]; ?></td>
		<td><?php echo $values["item_quantity"]; ?></td>
		<td>$ <?php echo $values["item_price"]; ?></td>
		<td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
		<td><a href="index.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
		</tr>
		<?php
		$total = $total + ($values["item_quantity"] * $values["item_price"]);
		}
		?>
		<tr>
		<td>Total</td>
		<td>$ <?php echo number_format($total, 2); ?></td>
		</tr>
		<?php
		}
		?>
		</table>
	</body>
</html>
