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
    <title>Inventory</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../js/jquery/export/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../js/jquery/export/bootstrap.css">
    <style>
        #inventory {
            color: var(--hover-color);
            background-color: var(--background-color);
        }

        #inventory img{
            filter: none;
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
                <div class="title">
                    <h2>Inventory</h2>
                </div>
                <div class="table-responsive"> 
                    <table id="item-list-table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Total Quantity</th>
                                <th>Quantity Used</th>
                                <th>Remaining Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  
                            if($_SESSION["role"] == "JuiceAdmin")
                                include("config-juice.php");
                            else if($_SESSION["role"] == "ChakramAdmin")
                                include("config-chakram.php");
                                else if($_SESSION["role"] == "admin")
                                    if(isset($_SESSION["store"]))
                                        if($_SESSION["store"] == "juice")
                                            include("config-juice.php");
                                        else if($_SESSION["store"] == "chakram")
                                            include("config-chakram.php");

                                    $date = getdate(date("U"));
                                    $mydate = "$date[year]/$date[mon]/$date[mday]";
                                    $query = "SELECT * FROM `inventory`
                                                JOIN item_list
                                                on item_list.id = inventory.id
                                                WHERE date = '$mydate';";
                                    $result = mysqli_query($conn, $query);

                                    while($row = mysqli_fetch_array($result))  
                                    {  
                                        echo '  
                                        <tr>  
                                            <td>'.$row["name"].'</td>  
                                            <td>'.$row["total_qty"].'</td>
                                            <td>'.$row["total_qty"] - $row["rem_qty"].'</td>
                                            <td>'.$row["rem_qty"].'</td>    
                                        </tr>  
                                        ';  
                                    }  
                                
                            ?>  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/main.js"></script>
    <script type="text/javascript" src="../js/jquery/export/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../js/jquery/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/jquery/export/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#item-list-table').DataTable();
        } );
    </script>
    <?php
    }
    else
        header("Location:../../");
    ?>
    </body>
</html>