<!DOCTYPE html>
<?php
    session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing</title>
    <link rel="icon" href="../icons/favicon.ico" type="image/x-icon">  
    <link rel="stylesheet" href="../js/jquery/export/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../js/jquery/export/bootstrap.css">
    <script src="../js/jquery/2.2.0/jquery.min.js"></script>  
    <link rel="stylesheet" href="../js/jquery/export/bootstrap.min.css" />  
    <script src="../js/jquery/export/jquery.dataTables.min.js"></script>  
    <script src="../js/jquery/dataTables.bootstrap.min.js"></script>            
    <link rel="stylesheet" href="../js/jquery/dataTables.bootstrap.min.css" />
    <script src="..js\jquery\export\jquery-3.5.1.js"></script>
    <script src="..js\jquery\export\jquery.dataTables.min.js"></script>
    <script src="..\js\jquery\export\dataTables.buttons.min.js"></script>
    <script src="..\js\jquery\export\jszip.min.js"></script>
    <script src="..\js\jquery\export\pdfmake.min.js"></script>
    <script src="..\js\jquery\export\vfs_fonts.js"></script>
    <script src="..\js\jquery\export\buttons.html5.min.js"></script>
    <script src="..\js\jquery\export\buttons.print.min.js"></script>
    <link rel="stylesheet" href="..\js\jquery\export\jquery.dataTables.min.css">
    <link rel="stylesheet" href="..\js\jquery\export\buttons.dataTables.min.css">
    <link rel="stylesheet" href="../js/jquery/export/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        #billing {
            color: var(--hover-color);
            background-color: var(--background-color);
        }

        #billing img{
            filter: none;
        }

        html {
            font-size: 16px;
        }

        .page-header {
            margin: 0;
            border: none;
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
                    <h2>Billing</h2>
                </div>
                <div class="container">
                    <form action="insert-usage.php" method="post" autocomplete="off">
                        <table class="entry-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>In Stock</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                    
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
                                        <input type="text" id="price_1" class="input-box" name="price[]" readonly="readonly">
                                    </td>
                                    <td>
                                        <input type= "text" id="stock_1" class="input-box" name="stock[]" disabled>
                                    </td>
                                    <td>
                                        <input type="number" id="quantity_1" class="input-box" name="quantity[]" placeholder="Enter quantity">
                                    </td>
                                    <td>
                                        <input type="text" id="amount_1" class="input-box" name="amount[]" disabled>
                                        <input type="text" id="p_1" class="input-box" name="p[]" hidden>
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
                            <input type="text" id="item-count" class="input-box" value="Items: 0" name="item_count" style="width: 150px; margin: 0; padding: 0; text-align: center; background-color: white;" readonly="readonly">
                            <input type="text" id="total" class="input-box" value="Total: ₹0" style="width: 150px; margin: 0; padding: 0; text-align: center; background-color: white;" readonly="readonly">
                            <div class="button">
                                <button type="submit" name="update" value="">
                                    <img src="../icons/receipt.svg" alt="">
                                    <p>Generate Receipt</p>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div id="report-table" class="container"></div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/main.js"></script>
    <script type="text/javascript" src="../js/jquery/export/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../js/jquery/export/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/jquery/export/dataTables.bootstrap4.min.js"></script>
    <link href = "..\js\autocomplete\jquery-ui.css" rel = "stylesheet">
    <script src = "..\js\autocomplete\jquery-1.10.2.js"></script>
    <script src = "..\js\autocomplete\jquery-ui.js"></script>

    <script>
        var itemCount = 1;
        var flag = 0;
        $(document).ready(function(){
            $(document).on('keydown', '.sugg-item', function() {
                var id = this.id;
                var splitid = id.split('_');
                var index = splitid[1];
                $( '#'+id ).autocomplete({
                    source: function( request, response ) {
                        $.ajax({
                            url: "autocomplete-billing.php",
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
                        $(this).val(ui.item. label);
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
            $("#"+temp).blur(function(){
                var id = document.getElementById('id_' + index).value;
                var name = document.getElementById('name_' + index).value;
                for(var i = 1; i < index; i++){
                    var z = document.getElementById('id_' + i).value;
                    if( z == id){
                        flag=1;
                        if(flag == 1)
                        {
                            alert("Item already added to bill!");
                            document.getElementById('name_'+index).value='';
                            document.getElementById('id_'+index).value='';
                            flag=0;
                            return 0;
                       }
                    }
                    
                }
                
                    var x = document.getElementById('id_'+index).value;
                    if(x!=''){
                    $.ajax({url: 'get-price.php',
                            type: 'POST',
                            data: 
                            {
                                search: x
                            },})
                    .done(function(response){
                        var x=response.toString().split('"')[1];
                        document.getElementById('price_'+index).value=x.split(',')[0];
                        document.getElementById('p_'+index).value=x.split(',')[1];
                    });

                    $.ajax({url: 'get-quantity.php',
                            type: 'POST',
                            data: 
                            {
                                search: x
                            },})
                    .done(function(response){
                        document.getElementById('stock_'+index).value=response.toString().split('"')[1];
                    });}
            });

            qty = 'quantity_'+ index;
            $("#"+qty).blur(function(){
                var stock=parseFloat(document.getElementById('stock_'+index).value);
                var quantity=parseFloat(document.getElementById('quantity_'+index).value);

                if ( quantity > stock){
                    alert("Enter Minimum value than the In-Stock values");
                    document.getElementById('quantity_'+index).value='';
                }
            });

            $('#'+qty).blur(function() {
                document.getElementById('amount_'+index).value = document.getElementById('quantity_'+index).value * document.getElementById('price_'+index).value;
                var x=0;
                for( var m=1;m<=itemCount;m++){
                    x=x+Number(document.getElementById('amount_'+m).value);
                }
                document.getElementById('total').value = "Total: ₹" + x;
            });
            document.getElementById('item-count').value = "Items: " + itemCount;
        });
        
        $('#add-item').click(function(){

            itemCount++;

            var lastname_id = $('.tr_input input[type=text]:nth-child(1)').last().attr('id');
            var split_id = lastname_id.split('_');

            var index = Number(split_id[1]);

            var name=document.getElementById('name_'+index).value;
            var qty=document.getElementById('quantity_'+index).value;

            if(name!='' && qty !=''){
                var newindex=index+1;
                var html = '<tr class="tr_input"><td hidden><input type="text" id="id_'+newindex+'" class="input-box" name="id[]" placeholder="Enter item name" hidden></td><td><input type="text" id="name_'+newindex+'" class="input-box sugg-item" name="name[]" placeholder="Enter item name"></td><td><input type= "text" id="price_'+newindex+'" class="input-box" name="price[]" readonly="readonly"></td><td><input type= "text" id="stock_'+newindex+'" class="input-box" name="stock[]" disabled></td><td><input type="number" id="quantity_'+newindex+'" class="input-box" name="quantity[]" placeholder="Enter quantity"></td><td><input type="text" id="amount_'+newindex+'" class="input-box" name="amount[]" disabled><input type="text" id="p_'+newindex+'" class="input-box" name="p[]" hidden></td></tr>';
            }

            $('tbody').append(html);
        });

        function displayDT(){
            var report = document.getElementById('report').value;

            document.querySelector('title').textContent="Sri Shakthi Canteen Receipt";
            $.ajax({
                url: "receipt-table.php",
                success: function(response){
                    $('#report-table').html(response);
                }
            });
        }

    </script>
    <?php
    }
    else
        header("Location:../../");
    ?>
    </body>
</html>