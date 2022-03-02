<link rel="icon" href="../icons/favicon.ico" type="image/x-icon">

<?php
	session_start();
     
	if($_SESSION["role"] == "JuiceAdmin")
            include("config-juice.php");
        else if($_SESSION["role"] == "ChakramAdmin")
            include("config-chakram.php");
	$itemCount = count($_POST["name"]);
	$itemValues=0;
	$date = getdate(date("U"));
	$mydate = "$date[year]/$date[mon]/$date[mday]";
	
	$query = "INSERT INTO stock_update (id, qty, date) VALUES ";
	$chemStock = "INSERT INTO inventory (id, total_qty, rem_qty, date) VALUES ";
	$queryValue = "";
	for($i=0;$i<$itemCount;$i++) {
		if(!empty($_POST["quantity"][$i]) || !empty($_POST["price"][$i])) {
			$countQuery = "select count(*) from inventory where id = '" . $_POST["id"][$i] . "' and date = '$mydate'";
            $countResult = mysqli_query($conn, $countQuery);
            $countRow=mysqli_fetch_row($countResult);
            $count = $countRow[0];

			if($count == 0){
				$insert="INSERT into inventory values('" . $_POST["id"][$i] . "','" . $_POST["quantity"][$i] . "','" . $_POST["quantity"][$i] . "', '$mydate')";			
				mysqli_query($conn, $insert);
				$itemValues++;
				if($queryValue!="") {
					$queryValue .= ",";
				}
				$queryValue .= "('" . $_POST["id"][$i] . "', '" . $_POST["quantity"][$i] . "', '$mydate')";
				
			}
		}   
	}
	$sql = $query.$queryValue;
	if($itemValues!=0) {
		$result = mysqli_query($conn, $sql);
		if(!empty($result)){
			echo "<script>
						alert('Stock Updated!');
						window.location = 'daily-entry.php';
					</script>";
		}
		else{
			echo "<script>
						alert('Error while updating stock! Please try again.');
						window.location = 'daily-entry.php';
					</script>";
		}
	}

	else {
		echo "<script>
						alert('Item\'s stock already updated!');
						window.location = 'daily-entry.php';
					</script>";
	}
?>