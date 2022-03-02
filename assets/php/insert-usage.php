<?php
		session_start();
     
       	if($_SESSION["role"] == "JuiceAdmin")
			include("config-juice.php");
		else if($_SESSION["role"] == "ChakramAdmin")
			include("config-chakram.php");
		$noOfItems = count($_POST["name"]);
		$itemCount = count($_POST["name"]);
		$itemValues=0;
		$date = getdate(date("U"));
		$mydate = "$date[year]/$date[mon]/$date[mday]";
		 
		$query = "INSERT INTO billing (id, price, qty, date,per) VALUES ";
		$queryValue = "";
		for($i=0;$i<$itemCount;$i++) {
			if(!empty($_POST["name"][$i])) {
				if($_POST["quantity"][$i] != 0){
					$itemValues++;
					if($queryValue!="") {
						$queryValue .= ",";
					}
					$queryValue .= "(" . $_POST["id"][$i] . ", " . $_POST["price"][$i] . ", " . $_POST["quantity"][$i] . ", '$mydate', " . $_POST["p"][$i] . ")";
					$updaterem = "UPDATE inventory set rem_qty=(Select rem_qty from inventory where id='" . $_POST["id"][$i] . "' and date = '$mydate')-'" . $_POST["quantity"][$i] . "' where id='" . $_POST["id"][$i] . "' and date = '$mydate'";
					mysqli_query($conn, $updaterem);
				}
				else
					$noOfItems--;
			}   
		}
        $sql = $query.$queryValue;
		if($itemValues!=0) {
		    $result = mysqli_query($conn, $sql);
			if(!empty($result)) {}
			else
				echo "<script>
						alert('Error while recording usage! Please try again.');
						
					</script>";
		}
		else
        echo "<script>
                    alert('Cannot generate bill for 0 items!');
                    
                </script>";
	
?>

<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			Sri Shakthi Food Court

			<br>

			<?php
				if($_SESSION["role"] == "JuiceAdmin")
					echo " Sri Maheshwari Fruit Stall";
				else if($_SESSION["role"] == "ChakramAdmin")
					echo " Chakaram Cafe";
			?>

			<br>

			Receipt
		</title>

		<link rel="stylesheet" href="../js/jquery/export/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="../js/jquery/export/bootstrap.css">
		<script src="../js/jquery/2.2.0/jquery.min.js"></script>  
		<link rel="stylesheet" href="../js/jquery/export/bootstrap.min.css" />  
		<script src="../js/jquery/export/jquery.dataTables.min.js"></script>  
		<script src="../js/jquery/dataTables.bootstrap.min.js"></script>            
		<link rel="stylesheet" href="../js/jquery/dataTables.bootstrap.min.css" />
		<script src="..js/jquery/export/jquery-3.5.1.js"></script>
		<script src="..js/jquery/export/jquery.dataTables.min.js"></script>
		<script src="../js/jquery/export/dataTables.buttons.min.js"></script>
		<script src="../js/jquery/export/jszip.min.js"></script>
		<script src="../js/jquery/export/pdfmake.min.js"></script>
		<script src="../js/jquery/export/vfs_fonts.js"></script>
		<script src="../js/jquery/export/buttons.html5.min.js"></script>
		<script src="../js/jquery/export/buttons.print.min.js"></script>
		<link rel="stylesheet" href="../js/jquery/export/jquery.dataTables.min.css">
		<link rel="stylesheet" href="../js/jquery/export/buttons.dataTables.min.css">
		<link rel="stylesheet" href="../js/jquery/export/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="../js/jquery/export/bootstrap.css">
		<link rel="stylesheet" href="../css/style.css">

		<style>
			html {
				font-size: 16px;
			}

			body {
				display: block;
				overflow-x: hidden;
				text-align: center;
			}

			h1 {
				padding: 50px 0;
			}

			.wrapper {
				display: flex;
				width: calc(100vw - 200px);
				min-height: 100vh;
				align-items: center;
				margin-left: 200px;
				justify-content: center;
				background-color: var(--background-color);
				overflow-y: scroll;
			}

			.page-header {
				position: fixed;
				left: 0;
				top: 0;
				width: 200px;
				min-height: 100%;
				background-color: var(--primary-color);
			}

			#billing {
				color: var(--hover-color);
				background-color: var(--background-color);
			}

			#billing img {
				filter: none;
			}

			.page-header {
				margin: 0;
			}

			.title {
				margin: 50px 0 10px 0;
			}

			.page-container {
				width: 100%
			}

			.container {
				max-width: 100%;
			}

			.buttons-row {
				padding: 3% 3% 3% 3%;
			}

			button {
				transition: all 0.3s ease;
			}

			button p {
				margin-left: 15px;
			}

			table {
				width: 100%;
				font-size: 40px;
			}

		</style>
	</head>
	<body>
		<?php
			if($_SESSION["username"]) {
				if($_SESSION["role"] == "admin")
					include("header.php");
				else if($_SESSION["role"] == "JuiceAdmin" or $_SESSION["role"] == "ChakramAdmin")
					include("header-user.php");
		?>
		<div class="wrapper">
			<div class="page-container">
				<div class="container">
					<div class="container">
						<div class="title" style="margin: 0 0 30px 0">
							<h2>Report</h2>
						</div>
					</div>
					<div id="receipt-table-container" class="container">
						<div class="container">
							<div class="table-responsive">  
								<table id="receipt-table" class="table table-striped table-bordered">
									<thead>
										<tr>
											<td>Name</td>  
											<td>Price</td>  
											<td>Quantity</td>
											<td>Amount</td>
										</tr>  
										
									</thead>  
									<?php
										$query = "SELECT * FROM billing
													JOIN item_list
													on billing.id = item_list.id
													ORDER BY receipt_no DESC LIMIT ".$noOfItems." ;";
										$result = mysqli_query($conn, $query);
										while($row = mysqli_fetch_array($result))  
										{  
											echo '  
											<tr>
												<td>'.$row["name"].'</td>
												<td>₹ '.$row["price"].'</td>  
												<td>'.$row["qty"].'</td> 
												<td>₹ '.$row["qty"] * $row["price"].'</td>      
											</tr>  
											';  
											
										}  
										$query = "select sum(price*qty) as total from billing where receipt_no> (select ((SELECT max(receipt_no) from billing) - (select ".$noOfItems.")));";
										$result = mysqli_query($conn, $query);
										$row = mysqli_fetch_array($result);
										echo '
											<tr>
												<td>₹</td>
												<td></td>  
												<td><b>Grand Total</b></td>
												<td><b>₹ '.$row["total"].'</b></td> 
												</tr>
											';
									?>  
								</table>  
							</div>  
						</div>
					</div>
					<div class="buttons-row">
					<button id="back">
						<img src="../icons/back.svg" alt="">
						<p>Back</p>
					</button>
				</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="../js/main.js"></script>
		<script type="text/javascript" src="../js/jquery/export/dataTables.bootstrap4.min.js"></script>
		<script>

			$(document).ready(function() {
				$('#receipt-table').DataTable({
					dom: 'Bfrtip',
					buttons: [
						{
							extend: 'print',
							attr:  {
								title: 'Print',
								id: 'print-button'
							},
							text: 'Print Receipt',
							autoPrint: true
						}
					]
				});

				var printButton = document.getElementById('print-button');
				printButton.click();

				setTimeout(()=> {document.location.href = 'billing.php';}, 
					1000
				);
			});

			$('#back').click(function(){
				history.back();
			});
		</script>
		<?php
			}
			else
				header("Location:../../");
		?>
	</body>
</html>