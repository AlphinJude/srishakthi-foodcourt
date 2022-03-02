<?php
    session_start();

    if($_SESSION["role"] == "JuiceAdmin")
        include("config-juice.php");
    else if($_SESSION["role"] == "ChakramAdmin")
        include("config-chakram.php");
    else if($_SESSION["role"] == "admin")
        if($_SESSION["store"] == "juice")
            include("config-juice.php");
        else if($_SESSION["store"] == "chakram")
            include("config-chakram.php");

    $itemCount = count($_POST["name"]);
    $itemValues=0;
    $query = "INSERT INTO item_list (name, price) VALUES ";

    for($i=0;$i<$itemCount;$i++) {

        if(!empty($_POST["name"][$i])) {
            $trimName=trim($_POST["name"][$i]);
            $trimPrice=trim($_POST["price"][$i]);

            if(($trimName!='')&&($trimPrice!='')){
                $countQuery = "select count(*) from item_list where name = '" . $trimName . "'";
                $countResult = mysqli_query($conn, $countQuery);
                $countRow=mysqli_fetch_row($countResult);
                $count = $countRow[0];
                $queryValue = "";

                if($count == 0){
                    $itemValues++;
                    $queryValue = "('" . $trimName . "','" . $trimPrice . "')";
                    $sql = $query.$queryValue;
                    mysqli_query($conn, $sql);
                }
            }    
        }
    }

    if($itemValues==0) {
        echo "<script>
                    alert('Item already exists, or you are trying insert empty spaces!');
                    window.location = 'items.php';
                </script>";
    }
    
    else{
        echo "<script>
                alert('$itemValues New Item(s) Added!');
                window.location = 'items.php';
            </script>";
    }
        
?>