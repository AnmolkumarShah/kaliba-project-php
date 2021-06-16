<?php
session_start();
// if not loggedin redirecting to index
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
}


include('./db_common.php');

// on form submission
if (isset($_POST['Add'])) {
    $user_id = $_SESSION['user_id'];
    $item_id = $_POST['item_id'];
    $total = $_POST['total'];
    $qty = $_POST['qty'];

    // check if any item is selected
    if ($item_id == -1) {
        echo "<script>alert('Please select atleast one item!!!')</script>";
    }
    // check if item qty is more than 0
    else if ($qty == 0) {
        echo "<script>alert('Please order atleast one item!!!')</script>";
    } else {

        $sql = "insert into orders_table (item_id, quantity, total_amount, received_by, order_date, created_at) values('$item_id', '$qty', '$total', '$user_id', NOW(), NOW())";
        $result = mysqli_query($conn, $sql);
        header('Location: homepage.php');
    }
}

// write query for all menu items

$sql = 'select * from menu_items';

// execute query

$result = mysqli_query($conn, $sql);

// formatting result

$items = mysqli_fetch_all($result, MYSQLI_ASSOC);

// print_r($items);

// releasing memory

mysqli_free_result($result);

// close connection

mysqli_close($conn);


?>



<?php include('./templates/header.php') ?>

<style>
    .container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 80vh;
        /* width: 100vw; */
        flex-direction: column;
    }

    .container>form {
        width: 25vw;
    }
</style>

<?php include('./templates/navbar.php') ?>


<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="homepage.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Order</li>
    </ol>
</nav>


<div class="container">
    <div class="display-4">Add Order</div>
    <hr />
    <form method="POST" action="addOrder.php">

        <!-- Menu Items -->
        <div class="form-group">
            <div class="row">
                <div class="col-4 d-flex mt-2 align-item-center">
                    <label class="h6" for="exampleFormControlSelect1">Item</label>
                </div>

                <select name="item_id" class="form-control col-8" id="itemselect">
                    <option value=-1>select item</option>

                    <!-- iterating each item -->
                    <!-- value = item id -->
                    <!-- title = price -->
                    <?php foreach ($items as $item) {   ?>
                        <option title="<?php echo $item['price'] ?>" value=" <?php echo $item['item_id'] ?>">
                            <?php echo $item['item_name'] ?>
                        </option>
                    <?php  } ?>
                </select>

            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-4 d-flex mt-2 align-item-center">
                    <label class="h6" for="exampleFormControlSelect1">Quantity</label>
                </div>
                <input name="qty" id="qty" type="number" min="0" max="10" class="form-control col-8">
            </div>
        </div>


        <div class="form-group">
            <div class="row">
                <div class="col-4 d-flex mt-2 align-item-center">
                    <label class="h6" for="exampleFormControlSelect1">Price</label>
                </div>
                <h6 id="price" class="mt-2"></h6>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-4 d-flex mt-2 align-item-center">
                    <label class="h6" for="exampleFormControlSelect1">Total Amount</label>
                </div>
                <input name="total" type="text" id="total_price" class="mt-2 h6 border-0" readonly>
            </div>
        </div>



        <button type="submit" name="Add" value="Add" class="btn btn-primary">Add Order</button>
    </form>
</div>


<script type="text/javascript">
    document.getElementById('itemselect').addEventListener('click', () => {
        let val = Array.from(document.getElementById('itemselect').selectedOptions[0].title);
        val = val.join('');
        const price = parseInt(val);
        document.getElementById('price').innerHTML = price + " " + 'Rs.';
        document.getElementById('total_price').value = 0;
        document.getElementById('qty').value = 0;
    })

    document.getElementById('qty').addEventListener('click', () => {
        let qty = document.getElementById('qty').value;
        const each_price = document.getElementById('price').innerHTML;
        document.getElementById('total_price').value = parseInt(qty) * parseInt(each_price);
    })
</script>
</body>

</html>