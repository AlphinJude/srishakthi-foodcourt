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
    <title>Item List</title>
    <link rel="stylesheet" href="../js/jquery/export/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../js/jquery/export/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        #items {
            color: var(--hover-color);
            background-color: var(--background-color);
        }

        #items img{
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
                <div class="add-items-container" id="add-items">
                    <div class="container">
                        <button type="button" class="close-button" onclick="closeAddItems()">
                            <img src="../icons/close.svg" alt="close" id="close-icon">
                        </button>
                        <div class="title"><h2>Add New Items</h2></div>
                        <form action="insert-item.php" method="post" autocomplete="off">
                            <table class="entry-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody id="add-item-table">
                                    <tr>
                                        <td>
                                            <input type="text" id="name" class="input-box" name="name[]" placeholder="Enter item name" required>
                                        </td>
                                        <td>
                                            <input type="number" id="price" class="input-box" name="price[]" placeholder="Enter price" required>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="buttons-row">
                                <div class="button"> 
                                    <button type="button" id="add-item" name="add-item" onclick="addItemRow()">
                                        <img src="../icons/add.svg" alt="">
                                        <p>Add Item</p>
                                    </button>
                                </div>
                                <div class="button">
                                    <button type="submit" name="update" value="">
                                        <img src="../icons/done.svg" alt="">
                                        <p>Insert</p>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="container">
                    <div class="title">
                        <h2>Items</h2>
                        <button onclick="addNewItems()">
                            <img src="../icons/add.svg" alt="">
                            <p>Create New Item</p>
                        </button>
                    </div>
                    <div class="table-responsive"> 
                        <table id="item-list-table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <?php
                                    if($_SESSION["role"] == "admin"){
                                        echo '<th>S.No</th>
                                                <th>Item Name</th>
                                                <th>Price</th>
                                                <th>Percentage</th>';
                                    }
                                    else
                                        echo '<th>S.No</th>
                                                <th>Item Name</th>
                                                <th>Price</th>';
                                ?>
                            </thead>
                            <tbody>
                                <?php 
                                    if($_SESSION["role"] == "JuiceAdmin"){
                                        include("config-juice.php");

                                        $query = "SELECT * FROM item_list ORDER BY name ASC";
                                        $result = mysqli_query($conn, $query);

                                        $i = 0;

                                        while($row = mysqli_fetch_array($result))  
                                        {  
                                            echo '  
                                            <tr>  
                                                <td>'.++$i.'</td>  
                                                <td>'.$row["name"].'</td>
                                                <td> ₹ '.$row["price"].'</td>    
                                            </tr>  
                                            ';  
                                        }
                                    }
                                    else if($_SESSION["role"] == "ChakramAdmin"){
                                        include("config-chakram.php");

                                        $query = "SELECT * FROM item_list ORDER BY name ASC";
                                        $result = mysqli_query($conn, $query);

                                        $i = 0;

                                        while($row = mysqli_fetch_array($result))  
                                        {  
                                            echo '  
                                            <tr>  
                                                <td>'.++$i.'</td>  
                                                <td>'.$row["name"].'</td>
                                                <td> ₹ '.$row["price"].'</td>    
                                            </tr>  
                                            ';  
                                        }
                                    }
                                    else if($_SESSION["role"] == "admin"){
                                        if(isset($_SESSION["store"])){
                                            if($_SESSION["store"] == "juice")
                                                include("config-juice.php");
                                            else if($_SESSION["store"] == "chakram")
                                                include("config-chakram.php");
                                        
                                            $query = "SELECT * FROM item_list ORDER BY name ASC";
                                            $result = mysqli_query($conn, $query);

                                            $i = 0;

                                            while($row = mysqli_fetch_array($result))  
                                            {  
                                                echo '  
                                                <tr>  
                                                    <td>'.++$i.'</td>  
                                                    <td>'.$row["name"].'</td>
                                                    <td> ₹ '.$row["price"].'</td>
                                                    <td>'.$row["percentage"].' %</td>    
                                                </tr>  
                                                ';  
                                            }
                                        }
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