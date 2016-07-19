<?php
// Functions for Tasha's Kitchen

/* testing functions
_____________________________________________________________________________________*/	

	function redirect_to($new_location){
		header("Location: " . $new_location);
		exit;
	}

	function mysql_prep($string){
		global $connection;		
		$escaped_string = mysqli_real_escape_string($connection, $string);
		return $escaped_string;
	}
	
	function confirm_query($result_set){
		if(!$result_set){
			die("Database query failed.");
		}
	}
	
	function form_errors($errors=array()){
		$output = "";
		if(!empty($errors)){
			$output = "<div class=\"error\">";
			$output .= "Please correct the following items: ";
			$output .= "<ul>";
			foreach($errors as $key => $error){
			$output .= "<li>";
			$output .= htmlentities($error);
			$output .= "</li>";
			}
			$output .= "</ul>";
			$output .= "</div>";
		}
		return $output;
	}

/* order process
_____________________________________________________________________________________*/	

	function find_all_customers(){
		global $connection;		
		$query  = "SELECT * ";
		$query .= "FROM  customers ";
		$result = mysqli_query($connection, $query);
		return $result;
	}
	
	function find_customer_match($customer_name, $email){
		// Set the variables
		$result = find_all_customers();
		$count =mysqli_num_rows($result);
		$customer_id = 0;
		$customer_name = strtolower($customer_name);	
		$customer_name = trim($customer_name);
		$email = trim($email);
		// Check for customer set
		if($count !== 0){						
			// Traverse customer set		
			while($customer = mysqli_fetch_assoc($result)){
				// Set the variables from set
				$row_name = $customer["customer_name"];
				$row_name_lowcase =  strtolower($row_name);
				$row_name_lowcase = trim($row_name_lowcase);
				// Test input against database
				if($row_name_lowcase === $customer_name){
					// Set email variable from set
					$customer_email = trim($customer["email"]);				
					
					if($customer_email === $email){
						$customer_id = $customer["id"];					
						break;
					}
				}			
			}
			// 4. Release returned data
			mysqli_free_result($result);
		}		
		return $customer_id;				
	}

	function create_the_customer($customer_name, $email, $phone){
		global $connection;		
		$query  = "INSERT INTO customers ( ";
		$query .= "customer_name, email, phone ";
		$query .= ") VALUES ( ";
		$query .= " '{$customer_name}', '{$email}', '{$phone}') ";
		$result  = mysqli_query($connection, $query);
		return $result;		
	}
	
	function get_customer_id(){
		global $connection;
		$query  = "SELECT max(id) ";
		$query .= "FROM customers ";
		$result  = mysqli_query($connection, $query);
		confirm_query($result);
		$customer_id = mysqli_fetch_assoc($result);
		$customer_id = $customer_id["max(id)"];		
		return $customer_id;
	}
	
	function create_the_order($customer_id){
		global $connection;		
		$query  = "INSERT INTO orders (";
		$query .= "customer_id";
		$query .= ") VALUES (";
		$query .= "{$customer_id}";
		$query .= ")";
		$result = mysqli_query($connection, $query);
		return $result;		
	}
	
	function get_order_id($customer_id){
		global $connection;		
		$query  = "SELECT max(id) ";
		$query .= "FROM orders ";
		$query .= "WHERE customer_id = {$customer_id}";
		$result  = mysqli_query($connection, $query);
		confirm_query($result);
		$order_id = mysqli_fetch_assoc($result);
		$order_id = $order_id["max(id)"];
		return $order_id;		
	}
	
	function submit_order_details($order_id, $item_id, $quantity_ordered, $price, $comments){
		global $connection;			
		$query  = "INSERT INTO order_details ( ";
		$query .= " order_id, item_id, quantity_ordered, price, comments ";
		$query .= ") VALUES ( ";
		$query .= "{$order_id}, {$item_id}, {$quantity_ordered}, {$price}, '{$comments}') ";
		$result = mysqli_query($connection, $query);		
		return $result;		
	}
	
	function find_current_customer(){
		global $current_customer;		
		if(isset($_GET["customer"])){
			$current_customer = find_customer_by_id($_GET["customer"]);
		} else {
			$current_customer = null;
		}			
	}
	
	function find_customer_by_id($customer_id){
		global $connection;		
		$safe_customer_id = mysqli_real_escape_string($connection, $customer_id);		
		$query  = "SELECT * ";
		$query .= "FROM  customers ";
		$query .= "WHERE id = {$safe_customer_id} ";
		/*		
		if($public){
			$query .= "AND visible = 1 ";
		}
		*/		
		$query .= "LIMIT 1";
		$result = mysqli_query($connection, $query);
		confirm_query($result);		
		if($customer = mysqli_fetch_assoc($result)){
			return $customer;	
		} else {
			return null;
		}
	}
	
	function find_current_order(){
		global $current_order;		
		if(isset($_GET["order"])){
			$current_order = find_order_by_id($_GET["order"]);
		} else {
			$current_order = null;
		}			
	}
	
	function find_order_by_id($order_id){
		global $connection;		
		$safe_order_id = mysqli_real_escape_string($connection, $order_id);		
		$query  = "SELECT * ";
		$query .= "FROM  orders ";
		$query .= "WHERE id = {$safe_order_id} ";
		/*		
		if($public){
			$query .= "AND visible = 1 ";
		}
		*/		
		$query .= "LIMIT 1";
		$result = mysqli_query($connection, $query);
		confirm_query($result);		
		if($order = mysqli_fetch_assoc($result)){
			return $order;	
		} else {
			return null;
		}
	}

/* checkout
_____________________________________________________________________________________*/	

	function collect_items_ordered($order_id){
		global $connection;		
		$safe_order_id = mysqli_real_escape_string($connection, $order_id);		
		$query   = "SELECT ";
		$query  .= "menu_name, comments, quantity_ordered, price ";
		$query  .= "FROM ";
		$query  .= "items, order_details ";
		$query  .= "WHERE ";
		$query  .= "items.id = order_details.item_id ";
		$query  .= "AND ";
		$query  .= "order_details.order_id = {$safe_order_id} ";
		$order_list = mysqli_query($connection, $query);
		confirm_query($order_list);
		return $order_list;
	}

	function display_total_sum($order_id){
		global $connection;
		$total_price = 0;		
		$safe_order_id = mysqli_real_escape_string($connection, $order_id);		
		$query   = "SELECT ";
		$query  .= "price ";
		$query  .= "FROM ";
		$query  .= "items, order_details ";
		$query  .= "WHERE ";
		$query  .= "items.id = order_details.item_id ";
		$query  .= "AND ";
		$query  .= "order_details.order_id = {$safe_order_id} ";
		$prices = mysqli_query($connection, $query);
		confirm_query($prices);
		while($price = mysqli_fetch_assoc($prices)){
			$total_price += $price["price"];
		}
		return $total_price;			
	}	
?>