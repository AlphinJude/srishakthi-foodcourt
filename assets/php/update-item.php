<?php
    session_start();
     
    
    if($_SESSION["role"] == "admin")
        if($_SESSION["store"] == "juice")
                include("config-juice.php");
        else if($_SESSION["store"] == "chakram")
                include("config-chakram.php");

    $itemCount = count($_POST["name"]);
    $itemValues=0;
    $query = "UPDATE item_list SET ";

    for($i=0;$i<$itemCount;$i++) {

        if(!empty($_POST["name"][$i])) {
            $trimName=trim($_POST["name"][$i]);
            $trimPrice=trim($_POST["price"][$i]);
            $trimID = trim($_POST["id"][$i]);
            $trimPercentage = trim($_POST["percentage"][$i]);

            if(($trimName!='')&&($trimPrice!='')){
                $itemValues++;
                $queryValue = "price = '".$trimPrice."', percentage = '".$trimPercentage."' where id = '".$trimID."';";
                $sql = $query.$queryValue;
                mysqli_query($conn, $sql);
            }    
        }
    }

    if($itemValues==0) {
        echo "<script>
                    alert('Item already exists, or you are trying insert empty spaces!');
                    window.location = 'change-price.php';
                </script>";
    }
    
    else {
        echo "<script>
                alert('Item(s) Updated!');
                window.location = 'change-price.php';
            </script>";
    }
        
?>