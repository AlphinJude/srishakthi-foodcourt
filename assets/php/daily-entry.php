<!DOCTYPE html>
<?php
    session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daliy Entry</title>
    <link rel="icon" href="../icons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../js/jquery/export/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../js/jquery/export/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        #daily-entry {
            color: var(--hover-color);
            background-color: var(--background-color);
        }

        #daily-entry img{
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
                    <h2>Daily Entry</h2>
                </div>
                <div class="container">
                <form action="insert-stock.php" method="post" autocomplete="off">
                        <table class="entry-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="tr_input">
                                    <td hidden>
                                        <input type="text" id="id_1" class="input-box" name="id[]" placeholder="Enter item name" hidden>
                                    </td>
                                    <td>
                                        <input type="text" id="name_1" class="input-box sugg-item" name="name[]" placeholder="Enter item name">
                                    </td>
                                    <td>
                                        <input type= "text" id="price_1" class="input-box" name="price[]" disabled>
                                    </td>
                                    <td>
                                        <input type="number" id="quantity_1" class="input-box" name="quantity[]" placeholder="Enter quantity">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="buttons-row">
                            <div class="button"> 
                                <button type="button" id="add-item" name="add-item">
                                    <img src="../icons/add.svg" alt="">
                                    <p>Add Item</p>
                                </button>
                            </div>
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
    </div>
    <script type="text/javascript" src="../js/main.js"></script>
    <script type="text/javascript" src="../js/jquery/export/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../js/jquery/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/jquery/dataTables.bootstrap.min.js"></script>
    <link href = "..\js\autocomplete\jquery-ui.css" rel = "stylesheet">
    <script src = "..\js\autocomplete\jquery-1.10.2.js"></script>
    <script src = "..\js\autocomplete\jquery-ui.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('keydown', '.sugg-item', function() {
                var id = this.id;
                var splitid = id.split('_');
                var index = splitid[1];
                $( '#'+id ).autocomplete({
                    source: function( request, response ) {
                        $.ajax({
                            url: "autocomplete-item.php",
                            type: "POST",
                            dataType: "json",  
                            data: {
                                search: request.term
                            },
                            success: function( data ) {
                                response( data );
                            }
                        });
                    },

                    select: function (event, ui) {
                        $(this).val(ui.item.label);
                        var itemid = ui.item.value;
                        document.getElementById('id_'+index).value = itemid;
            
                        return false;
                    },
                });
            }); 
        });     
        $(document).change(function(){
            var lastname_id = $('.tr_input input[type=text]:nth-child(1)').last().attr('id');
            var split_id = lastname_id.split('_');

            var index = split_id[1];
            var temp = 'name_'+ index;
            var x=document.getElementById('id_'+index).value;
            $("#"+temp).blur(function(){
                $.ajax({url: 'get-price.php',
                        type: 'POST',
                        data: 
                        {
                            search: x
                        },})
                .done(function(response){
                    var x=response.toString().split('"')[1];
                    document.getElementById('price_'+index).value=x.split(',')[0];
                })
            });
        });

        $('#add-item').click(function(){
            var lastname_id = $('.tr_input input[type=text]:nth-child(1)').last().attr('id');
            var split_id = lastname_id.split('_');

            var index = Number(split_id[1]);

            var name=document.getElementById('name_'+index).value;
            var price=document.getElementById('quantity_'+index).value;

            if(name!='' && price !=''){
                var newindex=index+1;
                var html = '<tr class="tr_input"><td hidden><input type="text" id="id_'+newindex+'" class="input-box" name="id[]" placeholder="Enter item name" hidden></td><td><input type="text" id="name_'+newindex+'" class="input-box sugg-item" name="name[]" placeholder="Enter item name"></td><td><input type= "text" id="price_'+newindex+'" class="input-box" name="price[]" disabled></td><td><input type="number" id="quantity_'+newindex+'" class="input-box" name="quantity[]" placeholder="Enter quantity"></td></tr>';
            }

            $('tbody').append(html);
        });
    </script>
    <?php
    }
    else
        header("Location:../../");
    ?>
    </body>
</html>