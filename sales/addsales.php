<?php

include('../config.php');
include('../templates/header.php');


$sqlInventory = "SELECT * FROM inventory";
$resultInventory = $conn->query($sqlInventory);


$sqlCustomer = "SELECT * FROM customers";
$resultCustomer = $conn->query($sqlCustomer);

?>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<style>
    legend{
        width:35%;
        font-size:14px;
        background:white;
        font-weight:bold;
        padding:5px 5px 5px 10px;
        margin-bottom:0;
        border: 1px solid #ddd; 
border-radius:4px;
    }
    fieldset{
        background:#f5f5f5;
        border: 1px solid #ddd;  
        padding-left:10px !important;
border-radius:4px;
position:relative;
margin:0;
min-width:0;
padding:10px;
margin-top:5px;

  
    }

    label{
        font-size:13px;
    }
</style>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">


<fieldset>
            <legend>Sales</legend>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                     
    <label style="color:black;font-weight:600">Customer</label>
                <select class="form-control" name="CustomerID" style = "height:30px !important;width:200px;font-size:10px; " id="CustomerID" required>
                    <?php
                    while ($row = $resultCustomer->fetch_assoc()) {
                        echo "<option class='khalid' value='" . $row["CustomerID"] . "'> " . $row["CustomerName"] . "</option>";
                    }
                    ?>
                </select>
                    </div>
                </div>
        </div>


        </fieldset>

   

            <fieldset>
        <legend>Product</legend>

        <div class="container">
        <div class="row">
            <div class="col-md-3">
            <label for="">Product Name:</label>
    <select style = "height:30px !important;width:200px;font-size:10px; " class="form-control" name="ProductID" id="productSelect" required>
        <option>Select</option>
        <?php
        while ($row = $resultInventory->fetch_assoc()) {
            echo "<option value='" . $row["ProductID"] . "'>" . $row["ProductName"] . "</option>";
        }
        ?>
    </select>
            </div>
     
            <div class="col-md-3">
            <label for="">Price:</label>
    <input style = "height:30px !important;width:200px;font-size:10px; " type="text" class="form-control" id="priceInput" placeholder="price"/>

            </div>
            
            <div class="col-md-3">
            <label for="">Quantity:</label>
    <input style = "height:30px !important;width:200px;font-size:10px; " type="number" class="form-control" id="quantityInput" placeholder="Quantity"/>

            </div>

            <div class="col-md-3">

    <input type="button" style = "height:30px !important;width:200px;font-size:10px; " class="btn btn-sm btn-primary mt-4" value="Add" id="addButton"/>
            </div>
        </div>
        </div>
        </fieldset>

    
    
   


        <fieldset>
        <legend>Items</legend>

        <div class="container">
        <div class="row">
       

    <table id="productTable" class="table ">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">Total Price:</td>
                <td colspan="2" id="totalPrice">0.00</td>
                <td></td>
            </tr>
        </tfoot>
    </table>
    </div>
    </div>
    </fieldset>

    <input type="button" value="Sale" class="btn btn-success mt-4"  id="saleBTN"/>

</form>



    <script>
        let sale_id  = ""

        $(document).ready(function () {
           
            function updateTotalPrice() {
                let total = 0;
                $('#productTable tbody tr').each(function () {
                    let price = parseFloat($(this).find('td:eq(3)').text());
                    total += price;
                });

                // Update the total price in the footer
                $('#totalPrice').text(total.toFixed(2));
            }

            $('#addButton').on('click', function () {
                let productId = $('#productSelect').val();
                let productName = $('#productSelect option:selected').text();

                let price =  parseFloat($('#priceInput').val());
                let quantity = parseFloat($('#quantityInput').val());


                if (quantity <= 0) {
                    alert('Please enter a valid quantity.');
                    return;
                }

                let totalPrice = price * quantity;
                console.log(price)
                console.log(quantity)
                console.log(totalPrice)
                
                let newRow = "<tr>" +
    "<td data-id='" + productId + "'>" + productName + "</td>" +
    "<td data-quantity>" + quantity + "</td>" +
    "<td data-price>" + price + "</td>" +
    "<td data-total-price>" + totalPrice + "</td>" +
    "<td> <button class='removeButton'>Remove</button></td>" +
    "</tr>";
                $('#productTable tbody').append(newRow);

                updateTotalPrice();

                $('#productTable').on('click', '.removeButton', function () {
                $(this).closest('tr').remove();
                updateTotalPrice();
                console.log("Updated")
            });

            })


     
        });
    

        $("#saleBTN").on('click', function () {
                let totalPrice  = $("#totalPrice").text()
                let CustomerID  = $("#CustomerID").val()

                $.ajax({
                        type: 'POST',
                        url: 'saleMaster.php',
                        data: {
                            totalPrice: totalPrice,
                            CustomerID: CustomerID
                        },
                        success: function(response) {
                            $('#result').html('Data successfully submitted. ID: ' + response);
                            sale_id = response;

                            $('#productTable tbody tr').each(function() {
                                let subtotal = parseFloat($(this).find('td:eq(3)').text());
                                let id = parseFloat($(this).find('td:eq(0)').text());
                                let dataId = $(this).find('td:eq(0)').attr('data-id');

                                let price = parseFloat($(this).find('td:eq(2)').text());
                                let qty = parseFloat($(this).find('td:eq(1)').text());


                                console.log(subtotal)
                                console.log(dataId)
                                console.log(price)
                                console.log(qty)

                                $.ajax({
                                    type: 'POST',
                                    url: 'handleSales.php',
                                    data:{
                                        qty: qty,
                                        price: price,
                                        dataId: dataId,
                                        subtotal: subtotal,
                                        sale_id: sale_id
                                    },
                                    success: function(response) {
                                        console.log(dataId)
                                    }


                                })


                            })
                        
                            window.location.href = "/inventory_management/sales/bill.php?p_id=" + sale_id;

                        }
    });

            });

    </script>
