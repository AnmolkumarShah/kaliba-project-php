<?php include('./templates/header.php');

session_start();

// if not loggedin redirecting to index
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
}


$name = $_SESSION['name'];
$user_id = $_SESSION['user_id'];


include('./db_common.php');
// write query for all menu items

$sql = "select o.order_id as id, m.item_name as item_name, o.quantity, o.total_amount, o.order_date, o.created_at, o.received_by from orders_table o inner join menu_items m on o.item_id = m.item_id where o.received_by = '$user_id' order by o.created_at ";

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

<?php include('./templates/navbar.php') ?>

<!-- breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="homepage.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Records</li>
    </ol>
</nav>


<div class="container">
    <div class="display-4 text-center">All Records</div>
    <div class="lead text-center">Welcome, <span class="h5"><?php echo $name ?></span></div>
    <div class="mt-3">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Sr.No.</th>
                    <th scope="col">Order id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Amount</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $key => $item) {  ?>
                    <tr>
                        <th scope="row"><?php echo $key + 1 ?></th>
                        <td scope="row"><?php echo $item['id'] ?></td>
                        <td><?php echo $item['item_name'] ?></td>
                        <td><?php echo $item['quantity'] ?></td>
                        <td><?php echo $item['total_amount'] ?></td>
                        <td><?php echo $item['order_date'] ?></td>
                        <td><?php echo $item['created_at'] ?></td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
</div>


</body>

</html>