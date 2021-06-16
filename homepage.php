<?php include('./templates/header.php');

session_start();
// if not loggedin redirecting to index
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
}

$name = $_SESSION['name'];

?>
<style>
    .container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 80vh;
        width: 100vw;
        flex-direction: column;
    }

    .main {
        margin-top: 10px;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
    }

    .item {
        height: 100px;
        width: 10vw;
        border: 1px solid;
        margin: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #F08080;
        color: white;
        cursor: pointer;
        transition: all 1s ease;
    }

    .item:hover {
        background-color: #800000;
    }
</style>
<?php include('./templates/navbar.php') ?>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Home</li>
    </ol>
</nav>


<div class="container">
    <div class="display-4">Take-A-Way Restaurant</div>
    <div class="lead">Welcome,<span class="h5"><?php echo $name ?></span></div>

    <div class="main">
        <!-- Add Order -->
        <form method="POST" action="addOrder.php" class="item">
            <button class="h5 btn" style="background-color: transparent;" type="submit">Add Order</button>
        </form>
        <!-- All Records -->
        <form method="POST" action="records.php" class="item">
            <button class="h5 btn" style="background-color: transparent;" type="submit">Records</button>
        </form>
        <!-- Logout -->
        <form method="POST" action="logout.php" class="item">
            <button class="h5 btn" style="background-color: transparent;" type="submit">Logout</button>
        </form>
    </div>
</div>


</body>

</html>