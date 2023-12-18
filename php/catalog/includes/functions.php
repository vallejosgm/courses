<?php 
	function getPageContent()
	{
		$displayPageContent = "";
		$displayPageContent .= '<div class="fontAcme">Welcome to our store!!!</div>';
		
		return $displayPageContent;
	}

	function getForm()
	{
		$displayForm = "";
		$displayForm .= '<form action="index.php" method="post">';
		$displayForm .= '<input type="text" name="un" placeholder="Username">';
		$displayForm .= '<input type="password" name="pw" placeholder="Password">';
		$displayForm .= '<input type="reset" name="reset-button" value="Reset">';
		$displayForm .= '<input type="submit" name="login-button" value="Log In">';
		$displayForm .= '</form>';
		$displayForm .= '<a class="new-account" href="create-account.php">Create New Account</a>';

		return $displayForm;
	}

	function getFormNewAccount($em, $us, $p, $vp)
	{
		$displayForm = "";
		$displayForm .= $em;
		$displayForm .= '<form action="index.php" method="post">';
		$displayForm .= '<input type="text" name="un" value="'.$us.'" placeholder="User Name" onkeyup="releaseKeyUn(this.value)">';
		$displayForm .= '<input type="password" name="pw" value="'.$p.'" placeholder="Password" onfocus="focusPassword(this)" onkeyup="releaseKeyPsw(this.value)">';
		$displayForm .= '<input type="password" name="vpw" value="'.$vp.'" placeholder="Verify Password" onkeyup="releaseKeyVerifyPsw(this.value)">';
		$displayForm .= '<table class="requeriments">';
		$displayForm .= '<tr id="text-pass"><td>Password must contain a number</td><td><span class="req">&#10008;</span></td></tr>';
		$displayForm .= '<tr id="text-pass"><td>Password must be 8 characters long</td><td><span class="req">&#10008;</span></td></tr>';
		$displayForm .= '<tr id="text-pass"><td>Password and "Verify Password" do not match</td><td><span class="req">&#10008;</span></td></tr>';
		$displayForm .= '</table>';
		$displayForm .= '<input disabled type="submit" name="new-account-button" id="sub-ca" value="Create Account">';
		$displayForm .= '<div id="btn-na"><input type="reset" name="reset-button" value="Reset">';
		$displayForm .= '</form>';
		$displayForm .= '<a class="log-in" href="index.php">Log In</a>';

		return $displayForm;
	}

	function isGranted()
	{
		if(isset($_SESSION['granted'])) return true;
		
		return false;
	}

	function getValidateLogin($us, $pw)
	{
		$con = connectToDB();
		$pw = geanVallHash($pw, $us);
		$sql = "SELECT username, password FROM user WHERE username='$us' and password='$pw';";
		$results = mysqli_query($con, $sql);
		if(!mysqli_num_rows($results)) $return = false;
		else $return = true;
		mysqli_close($con);																																																		
		return $return;
	}

	function outputCatalog()
	{
		$products = getCatalogDB();
		$displayPageContent = "";
		$displayPageContent .= buildingTableCatalog($products);

		return $displayPageContent;
	}

	function outputProduct($id)
	{
		$product = getProductDB($id);
		$displayPageContent = "";
		$displayPageContent .= buildingTableProduct($product);

		return $displayPageContent;
	}

	function outputCart($id, $qty)
	{
		if (!isset($_SESSION['product-id'])) {
			$_SESSION['product-id'] = array();
			$_SESSION['qty'] = array();
			$_SESSION['price'] = array();
			$_SESSION['prod-name'] = array();
			$_SESSION['image'] = array();	 
		}

		$displayPageContent = "";		

		if (idDuplicate($id)) {
			for($i = 0 ; $i < count($_SESSION['product-id']) ; $i++) {
				if($_SESSION['product-id'][$i] == $id) {
					$_SESSION['qty'][$i] += $qty;
				}	
			} 
		} else {
			$product = getProductDB($id);
			
			
			foreach($product as $x => $val) {
				$price = $val["price"];
				$prodName = $val["name"];
				$image = $val["image"];
			}

			array_push($_SESSION['product-id'], $id);
			array_push($_SESSION['qty'], $qty);
			array_push($_SESSION['price'], $price);
			array_push($_SESSION['prod-name'], $prodName);
			array_push($_SESSION['image'], $image);	
		}

		$displayPageContent .= buildingTableCart();

		return $displayPageContent;
	}

	function getProductDB($i)
	{
		$con = connectToDB();
		$sql = 'SELECT * FROM product WHERE id='.$i.';';
		$results = mysqli_query($con, $sql);
		if(!mysqli_num_rows($results)) return false;
		while ($record = mysqli_fetch_array($results, MYSQLI_ASSOC))
		{
			$product[] = $record;
		}

		mysqli_close($con);
		return $product;
	}

	function getCatalogDB()
	{
		$con = connectToDB();
		$sql = 'SELECT * FROM product;';
		$results = mysqli_query($con, $sql);
		if(!mysqli_num_rows($results)) return false;
		while ($record = mysqli_fetch_array($results, MYSQLI_ASSOC))
		{
			$catalog[] = $record;
		}

		mysqli_close($con);
		return $catalog;
	}

	function userDuplicate($user) 
	{
		$con = connectToDB();
		$sql = 'SELECT username FROM user WHERE username="'.$user.'";';
		$results = mysqli_query($con, $sql);
		if(!mysqli_num_rows($results)) 
			return false;
		return true;
	}

	function idDuplicate($id) 
	{
		for($i = 0 ; $i < count($_SESSION['product-id']) ; $i++) if($_SESSION['product-id'][$i] == $id) return true;
		return false;
	}

	function buildingTableProduct($data){
		$display = '';
		$display .= '<form action="cart.php" method="post" id="product">';
		#$display .= '<div>';
		#$display .= '<div>Image</div><div>Product Name</div><div>Description</div><div>Price</div>';
		#$display .= '</div>';

		foreach($data as $x => $val) {
			$idProduct = $val["id"];
			$display .= '<div><div><img id="product-detail" src="img/'.$val["image"].'"></div><div id="text-prd">'.$val["name"].'</div><br><span id="st-prd">Description:</span><div id="text-prd">'.$val["description"].'</div><br><span id="st-prd">Price for Unit:</span><div id="text-prd">'.$val["price"].'</div>';
		}
		$display .= '<div>';
		$display .='<br><span id="st-prd">Quantity:</span><br>';
		$display .='<input type="text" id= "qty" name="qty" onblur="blurQty(this.value)" value=1>';
		$display .='</div>';
		$display .='<input type="hidden" name="idProduct" value="'.$idProduct.'">';
		$display .='<div><input type="submit" value="Add to Cart"></div>';
		$display .= '</form>';

		return $display;
	}

	function buildingTableCatalog($data){
		$display = '';
		$display .= '<div id="cover-agents">';
		$display .= '<table id="agents">';
		$display .= '<tr>';
		$display .= '<th>Image</th><th>Product Name</th><th>Price</th><th>Details</th>';
		$display .= '</tr>';

		foreach($data as $x => $val) {
			$display .= '<tr><td><img src="img/'.$val["image"].'"></td><td>'.$val["name"].'</td><td>'.$val["price"].'</td><td><a href="product.php?id='.$val["id"].'">&#128065;</a></td></tr>';
		}
		$display .= '</table>';
		$display .= '</div>';

		return $display;
	}

	function shoppingDone()
	{
		$display = '';
		$display .= '<table id="agents">';
		$display .= '<tr>';
		$display .= '<th>Image</th><th>Product Name</th><th>Price per unit</th><th>Quantity</th><th>Total Price</th>';
		$display .= '</tr>';
		$total = 0;
		$j = 0;
		
		for($i = 0 ; $i < count($_SESSION['prod-name']) ; $i++) {
			$intQty = (int)$_SESSION['qty'][$i];
			$j++;
			$display .= '<tr><td>'.$_SESSION['image'][$i].'</td>';
			$display .= '<td>'.$_SESSION['prod-name'][$i].'</td>';
			$display .= '<td>'.$_SESSION['price'][$i].'</td>';
			$display .= '<td>'.$_SESSION['qty'][$i].'</td>';
			$display .= '<td>'.$_SESSION['product-id'][$i].'</td>';
			$display .= '<td>'.($_SESSION['price'][$i] * $intQty).'</td></tr>';
			$total += ($_SESSION['price'][$i] * $intQty);
     	}

     	$display .= '<tr><td>Grand Total</td><td>'.$total.'</td></tr>';
     	$display .= '</table>';
     	$display .= '<br><br>';
     	$display .= '<div class="fontAcme">Thank you for your order.</div>';

     	unset($_SESSION['qty']);
		unset($_SESSION['product-id']);
		unset($_SESSION['price']);
		unset($_SESSION['prod-name']);
		unset($_SESSION['image']);

		return $display;

    }

	function updateTableCart($aQty, $aId) 
	{
		$i = 0;
		#echo '<br><br><br>';
		foreach($aQty as $var => $val){
		#	if ((int)$val == 0){
		#		unset($_SESSION['qty'][$i]);
		#		unset($_SESSION['product-id'][$i]);
		#		unset($_SESSION['price'][$i]);
		#		unset($_SESSION['prod-name'][$i]);
		#		unset($_SESSION['image'][$i]);
		#		$i++;
		#		var_dump($_SESSION['qty']);
		#	} else {
				$_SESSION['qty'][$i] = $val;
			   	$i++;
		#	}
		}
		#var_dump($_SESSION['qty']);
		#echo '<br><br><br>';
		
		return buildingTableCart();
	}

	function buildingTableCart()
	{
		$display = '';
		
		if (!isset($_SESSION['product-id'])){
			$display .= '<div class="fontAcme">Your Cart is empty!!!</div>';
		} else {
			$display .= '<form action="cart.php" method="post">';
			$display .= '<table id="cart">';
			$display .= '<tr>';
			$display .= '<th>Image</th><th>Product Name</th><th>Price per unit</th><th>Quantity</th><th>Total Price</th>';
			$display .= '</tr>';
			$total = 0;
			$j = 0;
			
			for($i = 0 ; $i < count($_SESSION['prod-name']) ; $i++) {
				$intQty = (int)$_SESSION['qty'][$i];
				$j++;
				$display .= '<tr><td>'.$_SESSION['image'][$i].'</td>';
				$display .= '<td>'.$_SESSION['prod-name'][$i].'</td>';
				$display .= '<td>$'.$_SESSION['price'][$i].'</td>';
				$display .= '<td><input type="text" name="arrayQty[item'.$j.']" value='.$_SESSION['qty'][$i].'></td>';
				$display .= '<td><input type="hidden" name="arrayId[item'.$j.']" value='.$_SESSION['product-id'][$i].'></td>';
				$display .= '<td>$'.($_SESSION['price'][$i] * $intQty).'</td></tr>';
				$total += ($_SESSION['price'][$i] * $intQty);
	     	}

	     	$display .= '<tr><td id="gt">Grand Total</td><td>$'.$total.'</td></tr>';
	     	$display .= '<tr><td><input type="submit" name="update" value="Update Cart"></td></tr>';
	     	$display .= '<tr><td><input type="submit" name="place" value="Place Order"></td></tr>';
	     	$display .= '</table>';
	     	$display .= '</form>';
		}
		return $display;
	}

	function createNewCredentials($u, $p) 
	{
		$u = htmlentities($u);
		$p = htmlentities($p);

		$con = connectToDB();
		$u = mysqli_real_escape_string($con, $u);
		$p = mysqli_real_escape_string($con, $p);
		$p = geanVallHash($p, $u);
		$sql = 'INSERT INTO user (username, password) VALUES ("'.$u.'","'.$p.'");';
		$results = mysqli_query($con, $sql);
		mysqli_close($con);
	}

	function geanVallHash($word, $p)
	{
			$sp1 = 'ksdjbksdjbkac;kajbckajsbdccdc';
			$sp2 = 'pmknotnixqrycwxlsdjfh;kbiweece';

			$p = $sp1.$p.$sp2;
			$pdouble = $sp1.$p.$p.$sp2;

			$salt1 = hash('sha512', $p);
			$salt2 = hash('sha512', $pdouble);

			$word = $salt1.$word.$salt2;
			$word = hash('sha512', $word);

			return $word;
	}
?>