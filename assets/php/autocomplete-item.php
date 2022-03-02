<?php
    session_start();
     
    if($_SESSION["role"] == "JuiceAdmin")
        include("config-juice.php");
    else if($_SESSION["role"] == "ChakramAdmin")
        include("config-chakram.php");

    $search =$_POST['search'];

    $query = "SELECT * FROM item_list WHERE name like '%".$search."%'";
    $result = mysqli_query($conn, $query);
    
    while($row = mysqli_fetch_array($result) ){
        $response[] = array("value"=>$row['id'], "label"=>$row['name']);
    }

    echo json_encode($response);
    exit;
?>