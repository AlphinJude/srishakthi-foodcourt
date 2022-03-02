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
            
            #select-store {
                color: var(--hover-color);
                background-color: var(--background-color);
            }

            #select-store img{
                filter: none;
            }

            .container {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }

            .title {
                margin-bottom: 30px;
            }

            .container img {
                height: 100%;
            }

            button {
                width: 250px;
                margin: 30px;
            }

            button img {
                width: 24px;
                height: 24px;
            }

        </style>
    </head>
    <body>
        <?php
            if($_SESSION["username"]) {
                if($_SESSION["role"] == "admin")
                    include("header.php");
                else if($_SESSION["role"] == "ChakramAdmin" or $_SESSION["role"] == "JuiceAdmin")
                    include("header-user.php");
            ?>
            <div class="wrapper">
                <div class="page-container">
                    <div class="container">
                        <div class="container">
                            <div class="title">
                                <h2>Select Store</h2>
                            </div>
                        </div>
                        <form method="POST" action="" autocomplete="off">
                            <div class="container">
                                <select name="store" id="store" class="input-box">
                                    <option value="select">Select Store</option>
                                    <option value="juice">Juice</option>
                                    <option value="chakram">Chakram</option>
                                </select>
                            </div>
                            <button type="submit" name="submit" id="submit">
                                <img src="../icons/done.svg" alt="">
                                <p>Confirm</p>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <script type="text/javascript" src="../js/main.js"></script>
        <?php
           }
            else
                header("Location:../../");
        ?>
        <script>
          
        </script>
    </body>
</html>
<?php
    if( isset($_POST['submit']) ) {
        $_SESSION['store'] = $_POST['store'];
        echo "<script> location.href='select-store.php'; </script>";
    }
?>