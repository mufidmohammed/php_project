<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Transactions</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../templates/w3.css">
        <link rel="stylesheet" href="../static/style.css">
        <script src="../scripts/script.js"></script>
    </head>
    <body>
        <div class="w3-container">
            <h1 class="w3-green w3-center">Daily Sales tracker</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Amount</th>
                        <th>Purchases</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($transactions as $transaction): ?>
                    <?php $id = $transaction['id']; ?>
                        <tr>
                            <td><?= $id; ?></td>
                            <td><?= $transaction['product_name'] ?></td>
                            <td>
                                <span class="prices" style="color: green">
                                    <?= formatDollarAmount($transaction['price']); ?>
                                </span>
                            </td>
                            <td>
                                <span class="purchases" id=<?= $id; ?> >0</span>
                                <div class="modifier">
                                    <span class="increment-btn" onclick=increment(<?= $id; ?>)>+</span>
                                    <span class="decrement-btn" onclick=decrement(<?= $id; ?>)>-</span>
                                </div>
                            </td>
                            <td><?= $transaction['date']; ?></td>
                        </tr>
                    <?php endforeach ?>
                    <tr>
                        <td>Total Sales</td>
                        <td id="totalSales" colspan="4">0</td>
                    </tr>
                </tbody>
            </table>
            <button class="w3-button w3-teal" onclick="document.getElementById('add').style.display='inline-block'">Add</button>
            <div id="add" class="w3-modal">
                <div class="w3-modal-content">
                    <header class="w3container w3-teal">
                        <span onclick="document.getElementById('add').style.display='none'" class="w3-button w3-display-topright">&times</span>
                        <h2 class="w3-teal w3-padding">Add Product</h2>
                    </header>
                    <div class="w3-container">
                        <form action="../app/add.php" method="POST">
                            <div class="w3-padding-small">
                                <label>Product Name</label>
                                <input type="text" name="product_name" value="" required />
                            </div>
                            <div class="w3-padding-small">
                                <label style="margin-right:70px">Price</label>
                                <input type="number" name="price" step=".01" value="" required />
                            </div>
                            <div class="w3-margin">
                                <input type="submit" name="Add" value="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <button class="w3-button w3-red" onclick="document.getElementById('delete').style.display='inline-block'">Delete</button>
            <div id="delete" class="w3-modal">
                <div class="w3-modal-content">
                    <header class="w3container w3-teal">
                        <span onclick="document.getElementById('delete').style.display='none'" class="w3-button w3-display-topright">&times</span>
                        <h2 class="w3-red w3-padding">Delete</h2>
                    </header>
                    <div class="w3-container">
                        <form action="../app/delete.php" method="POST">
                            <div class="w3-padding-small">
                                <label style="margin-right:70px">Enter product ID: </label>
                                <input type="number" name="id" value="" required />
                            </div>
                            <div class="w3-button">
                                <input type="submit" name="delete" value="delete">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
