<?php
    session_start();
     
    if($_SESSION["role"] == "JuiceAdmin")
            include("config-juice.php");
        else if($_SESSION["role"] == "ChakramAdmin")
            include("config-chakram.php");

    $search = $_POST['search'];

    $query = "select * from item_list where id = $search";
    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_array($result) ){
        $response= $row['price'];
        $response.=",";
        $response.=$row['percentage'];
    }

    echo json_encode($response);
    exit;
?>