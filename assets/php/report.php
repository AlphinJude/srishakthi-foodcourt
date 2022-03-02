<!DOCTYPE html>
<?php
    session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../icons/favicon.ico" type="image/x-icon">
    <title>Sri Shakthi Canteen Receipt</title>
    <script src="../js/jquery/2.2.0/jquery.min.js"></script>  
    <link rel="stylesheet" href="../js/jquery/export/bootstrap.min.css" />  
    <script src="../js/jquery/jquery.dataTables.min.js"></script>  
    <script src="../js/jquery/dataTables.bootstrap.min.js"></script>            
    <link rel="stylesheet" href="../js/jquery/dataTables.bootstrap.min.css" />
    <script src="..js\jquery\export\jquery-3.5.1.js"></script>
    <script src="..js\jquery\export\jquery.dataTables.min.js"></script>
    <script src="..\js\jquery\export\dataTables.buttons.min.js"></script>
    <script src="..\js\jquery\export\jszip.min.js"></script>
    <script src="..\js\jquery\export\pdfmake.min.js"></script>
    <script src="..\js\jquery\export\vfs_fonts.js"></script>
    <script src="..\js\jquery\export\buttons.html5.min.js"></script>
    <script src="..\js\jquery\export\buttons.print.min.js"></script>
    <link rel="stylesheet" href="..\js\jquery\export\jquery.dataTables.min.css">
    <link rel="stylesheet" href="..\js\jquery\export\buttons.dataTables.min.css">
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

        #report {
            color: var(--hover-color);
            background-color: var(--background-color);
        }

        #report img {
            filter: none;
        }

        .page-header {
            margin: 0;
            border: none;
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

        button {
            transition: all 0.3s ease;
        }

    </style>
</head>
<body>
    <div class="wrapper">
    <?php
    if($_SESSION["username"]) {
        if($_SESSION["role"] == "admin")
            include("header.php");
        else if($_SESSION["role"] == "JuiceAdmin" or $_SESSION["role"] == "ChakramAdmin")
            include("header-user.php");
?>
        <div class="page-container">
            <div class="container">
                <div class="container">
                    <div class="title" style="margin-top: 0">
                        <h2>Report</h2>
                    </div>
                    <div class="title">
                        <h4>Select date range based on which the report should be generated.</h4>
                    </div>
                    <div class="row">
                        <form method="POST" autocomplete="off">
                            <div class='col-sm-4'>
                                <input type="date" name="from" class="form-control">
                            </div>
                            <div class='col-sm-4'>
                                <input type="date" name="to" class="form-control">
                            </div>
                            <div class='col-sm-4'>
                                <input type="submit" value="Get Data" name="submit" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
               <?php
                    if($_SESSION["role"] == "JuiceAdmin")
                        include("config-juice.php");
                    else if($_SESSION["role"] == "ChakramAdmin")
                        include("config-chakram.php");
                    else if($_SESSION["role"] == "admin"){
                            if($_SESSION["store"] == "juice")
                                include("config-juice.php");
                            else if($_SESSION["store"] == "chakram")
                                include("config-chakram.php");
            } 

                    if (isset($_POST['submit']))
                        {
                        $date1=date('Y-m-d',strtotime($_POST['from']));
                        $date2=date('Y-m-d',strtotime($_POST['to']));
                        $query1="Select b.Per,B.date, i.name, b.price, sum(B.qty) as total_qty, 
                                (B.price * sum(B.qty)) as unitTotal,((B.price * sum(B.qty))*b.per)/100 as college from item_list i 
                                join billing B on B.id = i.id where date between '$date1' and '$date2' 
                                group by B.date, B.id,b.per,b.price"; 
                        $result1 = mysqli_query($conn, $query1);  
                        $query2="select date,sum(grandTotal) as Total ,sum(college) as percentage from (Select b.per, b.date, sum(b.price*b.qty) as grandTotal, 
                        ((sum(b.price*b.qty))*b.per)/100 as college from billing as b 
                        where date between '$date1' and '$date2' 
                        group by b.id,date,price,per) as s group by date;"; 
                        $result2 = mysqli_query($conn, $query2);  
                    }

                ?> 
                <div class="container">
                    <div class="title">
                        <h3>Day Wise Item Based Report</h3>
                    </div>
                    <div class="table-responsive">  
                            <table id="T1" class="table table-striped table-bordered">  
                                <thead>  
                                    <tr>  
                                        <td>Date</td>  
                                        <td>Item Name</td>  
                                        <td>Price</td>  
                                        <td>Total Quantity</td>  
                                        <td>Unit Total</td> 
                                        <td>Percentage</td>
                                        <td>ItemWise Percentage</td>   
                                    </tr>  
                                </thead>  
                                <?php  
                                if (isset($_POST['submit'])){
                                while($row1 = mysqli_fetch_array($result1))  
                                {
                                    echo '  
                                    <tr>
                                        <td>'.$row1["date"].'</td>  
                                        <td>'.$row1["name"].'</td>  
                                        <td>₹ '.$row1["price"].'</td>  
                                        <td>'.$row1["total_qty"].'</td>  
                                        <td>₹ '.$row1["unitTotal"].'</td>
                                        <td>'.$row1["Per"].' %</td>
                                        <td>'.$row1["college"].' %</td>  
                                    </tr>  
                                    ';  
                                }  
                            }
                            
                                ?>  
                        </table>  
                    </div>
                </div>
                <div class="container">
                    <div class="title">
                        <h3>Day Wise Grand Report</h3>
                    </div>  
                    <div class="table-responsive">  
                        <table id="T2" class="table table-striped table-bordered">  
                            <thead>  
                                <tr>  
                                        <td>Date</td>  
                                        <td>Total</td>  
                                        <td>Percentage</td>  
                                </tr>  
                            </thead>  
                            <?php  
                                $total = 0;
                                $grandTotal = 0;
                            if (isset($_POST['submit'])){
                                while($row2 = mysqli_fetch_array($result2))  
                                {   
                                    $total += $row2["Total"];
                                    $grandTotal += $row2["percentage"];
                                    echo '  
                                    <tr>
                                            <td>'.$row2["date"].'</td>  
                                            <td>₹ '.$row2["Total"].'</td>  
                                            <td>₹ '.$row2["percentage"].'</td>  
                                    </tr>  
                                    ';  
                                } 
                                echo '  
                                <tr>
                                        <td><b>Grand Total</b></td>  
                                        <td>₹ '.$total.'</td>  
                                        <td>₹ '.$grandTotal.'</td>  
                                </tr>  
                                ';  
                            }
                            ?>  
                        </table>  
                    </div>  
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/main.js"></script>
    <script type="text/javascript" src="../js/jquery/export/dataTables.bootstrap4.min.js"></script>
    <script>    
        $(document).ready(function() {
            $('#T1').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        });

        $(document).ready(function() {
            $('#T2').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        });

        $('.buttons-print').click(function() {
            document.querySelector('title').textContent='Test';
        });
    </script>
<?php
    }
    else
        header("Location:../../");
?>
    </body>
</html>