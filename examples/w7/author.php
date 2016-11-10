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
			$sql = 'Select * From Author';
			echo "Select * From Author <br><br>";
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
		echo "Mysql exception Raised: " . $ex->getMessage();
	}
	catch (Exception $ex){
		echo "General Exception Raised: " . $ex->getMessage();
	}
	
	