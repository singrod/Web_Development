<?php
// Functions for Mark's Web Development

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

?>