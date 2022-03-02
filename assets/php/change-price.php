<!DOCTYPE html>
<?php
    session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Price</title>
    <link rel="icon" href="../icons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../js/jquery/export/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../js/jquery/export/bootstrap.css">
    <style>
        #change-price {
            color: var(--hover-color);
            background-color: var(--background-color);
        }

        #change-price img{
            filter: none;
        }
    </style>
</head>
<body>
    <?php
        if($_SESSION["username"] && $_SESSION["role"] == "admin") {
            include("header.php")
    ?>
    <div class="wrapper">
        <div class="page-container">
        <div class="container">
                    <div class="title"><h2>Change Item Price</h2></div>
                    <form action="update-item.php" method="post" autocomplete="off">
                        <table class="entry-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Percentage</th>
                                </tr>
                            </thead>
                            <tbody id="add-item-table">
                                <?php  
                                    if($_SESSION["role"] == "admin")
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
                                                <td>
                                                    <input type="text" id="id_'.$i.'" class="input-box" name="id[]" value="'.$row["id"].'" readonly = "readonly" hidden>
                                                    <input type="text" id="name" class="input-box" name="name[]" value="'.$row["name"].'" readonly = "readonly">
                                                </td>
                                                <td>
                                                    <input type="number" id="price" class="input-box" name="price[]" value="'.$row["price"].'" required>
                                                </td>
                                                <td>
                                                    <input type="number" id="percentage" class="input-box" name="percentage[]" value="'.$row["percentage"].'" required>
                                                </td>
                                            </tr> 
                                            ';  
                                            $i++;
                                        }
                                    }
                                ?> 
                                
                            </tbody>
                        </table>
                        <div class="buttons-row">
                            <div class="button">
                                <button type="submit" name="update" value="">
                                    <img src="../icons/done.svg" alt="">
                                    <p>Update</p>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/main.js"></script>
    <script type="text/javascript" src="../js/jquery/export/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../js/jquery/export/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/jquery/export/dataTables.bootstrap4.min.js"></script>
    <?php
    }
    else
        header("Location:../../");
    ?>
</body>
</html>