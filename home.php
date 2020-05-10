<?php
    require_once("query.php");
    session_start();
    // only users are allowed if not they go to errorpage
    if(!isset($_SESSION['valid_user']))
    {
        echo "sorry log in";
        header("location: error.html");
    }
    $user = $_SESSION['valid_user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APP</title>
    <link rel="stylesheet" type="text/css" href="stylesheet/home.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    <!-- nav bar -->
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <a href="#" class="navbar-brand">
            <img src="Humor.PNG" height="50" alt="Humor.ly ">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">HOME<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#"><?php echo 'Hello '.$user; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">Cart</a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-item nav-link">Log out</a>
                </li>
            </ul>
        <div>
    </nav>
	
	<!-- Sort button -->
	<form action = "home.php" method="post" enctype="multipart/form-data">
	<div class="form-group">
	<form action = "home.php" method="post" enctype="multipart/form-data">
	<table>
            <h3>Sort By:
            <select id="sortby" class="form-control" name="sort">
				<option value="name">Product Name</option>
                <option value="priceAsc">Price Ascending</option>
                <option value="priceDesc">Price Descending</option>
            </select>
			<button type="submit" name="ok">Ok</button>
            </h3>;
        </div>
	</table>
		
<!----- display profiles -------------------------------------------------------------->
<?php
    
	
	/*-------Sorting algorithm to product display---------------------------*/
	
	if (isset($_POST["ok"])) {
		$answer = $_POST["sort"];
	} else {
		//set default $query
		$query = "SELECT * FROM product ORDER BY name";
	}
		
	if($answer == 'name') {
		$query = "SELECT * FROM product ORDER BY name";
	} else if($answer == 'priceAsc') {
		$query = "SELECT * FROM product ORDER BY price";
	} else if($answer == 'priceDesc') {
		$query = "SELECT * FROM product ORDER BY price DESC";
	}

// connect to db
    $conn = db_connect();
    // get data with default sort
    
    $result = $conn->query($query);
    // just in case something happes
    if(!$result) {
        throw new Exception('product is not found');
        exit;
    }
	/*-------Display products---------------------------------------------------------*/
	
    while($row = $result->fetch_row()) 
    {
        echo '<div class="list-content">'; // fileName 
        echo'<img src="uploads/'.$row[3].'"/ alt="Error on Displaying"></img>'; //picture
        echo'<div class="text">'.$row[1].'</div>'; // name
        echo'<div class="price">'. '$'.$row[2].'</div>'; // price
        echo'<div class="text">'. 'Description: '.$row[4].'</div>'; // description
        echo'<form action="cart.php" method="post" "multipart/form-data">';
        echo'<input class="button" type="submit" name="id" value="ADD TO CART"/>';
        echo'<input type="hidden" name="recordID" value="'.$row[0].'">';
        echo'</form>';
        echo'</div>';

		
        // echo '<a href="product?recordID='.$row[0].'">';
        // echo '<div class="list-content">'; // fileName 
        // echo'<img src="uploads/'.$row[3].'"/ alt="Error on Displaying"></img>'; //picture
        // echo'<div class="text">'.$row[1].'</div>'; // name
        // echo'<div class="price">'. '$'.$row[2].'</div>'; // price
        // echo'<div class="text">'. 'Description: '.$row[4].'</div>'; // description
        // echo'</div>';
        // echo '</a>';
    }


    // close connection
    $result->close();
    $conn->close();

?>
</body>
</html>
