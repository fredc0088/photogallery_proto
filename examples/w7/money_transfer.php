<?php
	try{
		$link = mysqli_connect('---','---','---','---');
		
		if(mysqli_connect_errno()){
			exit(mysqli_connect_error());
			}
	
		if(!isset($_GET['page'])) {
			throw new Exception('Invalid Query String');
			}
			
		else{
			$page = $_GET['page'];
			echo 'Page is set';
			}
		
		if ($page == 1){
			$sql = array("DROP TABLE IF EXISTS account", "Create Table account [name varchar[255], balance Decimal[10,2]]",
				"Create Table account [name varchar[255], balance Decimal[10,2] ]", 
				"Insert Into account Values('Bob', 1000)",
				"Insert Into account Values('Bill', 500)"); 
			
			foreach($sql as $cmd){
				$result = mysqli_query($link, $cmd);
				/*check query*/
				if($result === false){
					echo mysqli_error($link);
				}
			}
			echo "Money transferred";
                }
		else {
			throw new Exception ('Invalid page');
			}
			
		$result = mysqli_query($link, $sql);
		if ($result == false) {
			echo mysqli_error($link);
		}
		else {
			while ($row = mysqli_fetch_assoc($result)) {
				echo $row['id'] . ' ' . $row['firstname'] . ' ' . $row['lastname'] . '<br>';
				}
			}
		mysqli_free_result($result);
	}
	catch (mysqli_sql_exception $ex){
		mysqli_rollback($link);
		echo "Mysql exception Raised: " . $ex->getMessage();
	}
	catch (Exception $ex){
		echo "General Exception Raised: " . $ex->getMessage();
	}
	
	