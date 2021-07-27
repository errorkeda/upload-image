<?php

	class Customers
	{
		private $servername = "localhost";
		private $username   = "root";
		private $password   = "";
		private $dbname     = "2k27";
		public  $con;


		
		public function __construct()
		{
		    try {
			$this->con = new mysqli($this->servername, $this->username, $this->password, $this->dbname);	
		    } catch (Exception $e) {
			echo $e->getMessage();
		    }
		}

		// Insert customer data into customer table
		public function insertData($name, $Phone_number,$email,$file)
		{	
			$allow = array('jpg', 'jpeg', 'png');
		   	$exntension = explode('.', $file['name']);
		   	$fileActExt = strtolower(end($exntension));
		   	$fileNew = rand() . "." . $fileActExt;  
		   	$filePath = 'uploads/'.$fileNew; 
			
			if (in_array($fileActExt, $allow)) {
    		          if ($file['size'] > 0 && $file['error'] == 0) {
		            if (move_uploaded_file($file['tmp_name'], $filePath)) {
		   		$query = "INSERT INTO user(Name, Phone_number, Email, image)
					VALUES('$name','$Phone_number','$email','$fileNew')";
				$sql = $this->con->query($query);
				if ($sql==true) {
				   return true;
				}else{
				  return false;
			    }   		    
		        }
		      }
		   }
		}



		public function displayData()
		{
		    $sql = "SELECT * FROM user";
		    $query = $this->con->query($sql);
		    $data = array();
		    if ($query->num_rows > 0) {
			while ($row = $query->fetch_assoc()) {
			    $data[] = $row;
			}
			return $data;
		    }else{
			return false;
		    }
		}

	}
	?>