<?php
		if(isset($_POST['username'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$address = $_POST['address'];
			$city = $_POST['city'];
			$state = $_POST['state'];
			$zipcode = $_POST['zipcode'];
			$carMake = $_POST['make'];
			$carModel = $_POST['model'];
			$licensePlate = $_POST['license'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];

			$servername = "localhost";

			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				?> <h2><br><br><br>You are now a registered Driver!<br></h2> <?php
			} else {
				//go back to sign up page
				echo "<h3>$email is an invalid email <br>Please enter valid email</h3>";
				//header("Location: /SPOTS/drivePage.php");
				//exit;
			}

			//here we're going to use the root because it would be easier
			//WILL BE CHANGED EVENUTALLY TO A USER
			$databaseUsername = "spotsuser";
			$databasePassword = "spots123";
			$database = "spots";

			global $conn;
			$conn = mysql_connect($servername, $databaseUsername, $databasePassword);

			// Check connection
			if (!$conn) 
			{
				//if the connection fails then we kill the whole thing
    			die("Connection failed: " . mysql_error());
			} else {
				echo "database successfully connected<br>";
			}

			mysql_select_db($database);

			$insert = "INSERT INTO Driver (username, fname, lname, email, password, street, city, state, zip, phone) VALUES ('$username', '$fname', '$lname', '$email', '$password', '$address', '$city', '$state', $zipcode, '$phone')";

			if (mysql_query($insert) === TRUE) {	
				echo "Driver info entered successfully<br>";
			} else {
				echo "Error: " . $insert . "<br>" . mysql_error();
			}

			$query = mysql_query("SELECT userId FROM Driver where username = '$username'", $conn);
			$row = mysql_fetch_row($query);
			
			$userId = $row[0];
			$insert2 =  "INSERT INTO Vehicle (licensePlate, carMake, carModel, userId) values ('$licensePlate', '$carMake', '$carModel', $userId)";

			if (mysql_query($insert2) === TRUE) {	
				echo "Car added to $username<br>";
			} else {
				echo "Error: " . $insert2 . "<br>" . mysql_error();
			}



			//print up the information of the driver
		// 	echo "<h1> Welcome Driver $name </h1>";
		// 	echo "<h2> Your Username is: $username </h2>";
		// 	echo "<h2> Your email is: $email </h2>";
		// 	echo "<h2> Address: $address, $city, $state, $zipcode</h2>";
		// 	echo "<h2> Your car is a $carModel and your license plate is $licensePlate";
		}
	?>