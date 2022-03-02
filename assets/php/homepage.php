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
        
        .wrapper {
            height: 100vh;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .title {
            width: auto;
            margin: 0;
            text-align: center;
            text-transform: uppercase;
        }

        .container img {
            height: 100%;
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
                            <h1>Welcome <?php echo $_SESSION["username"]; ?> !</h1>
                        </div>
                    </div>
                    <div class="container">
                        <img src="../images/homepage-illustration.svg" alt="">
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="../js/main.js"></script>
    <?php
        }
        else
            header("Location:../../");
    ?>
    </body>
</html>