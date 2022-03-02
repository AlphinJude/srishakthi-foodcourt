<?php
    session_start();
     
    if($_SESSION["role"] == "JuiceAdmin")
    include("config-juice.php");
else if($_SESSION["role"] == "ChakramAdmin")
    include("config-chakram.php");

    $search = $_POST['search'];
    $date = getdate(date("U"));
    $mydate = "$date[year]/$date[mon]/$date[mday]";

    $query = "SELECT i.id, i.name FROM `item_list` i
    join stock_update s
    on s.id=i.id
    where i.name like'%".$_POST['search']."%' and s.date = '$mydate';";
    $result = mysqli_query($conn,$query);

    while($row = mysqli_fetch_array($result) ){
        $response[] = array("value"=>$row['id'],"label"=>$row['name']);
    }
    
    echo json_encode($response);
    exit;
?>