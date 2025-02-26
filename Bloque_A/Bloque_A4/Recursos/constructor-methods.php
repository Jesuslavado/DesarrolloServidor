<?php

declare(strict_types = 1);
include "Product.php";


class Account
{
    public int    $number;
    public string $type;
    public float  $balance;

    public function __construct(int $number, string $type, float $balance = 0.00)
    {
        $this->number  = $number;
        $this->type    = $type;
        $this->balance = $balance;
    }

    public function deposit(float $amount): float
    {
        $this->balance += $amount;
        return $this->balance;
    }

    public function withdraw(float $amount): float
    {
        $this->balance -= $amount;
        return $this->balance;
    }
}

$product = new Product(2.00, 100, 1, 'manzanas'); // LLAMANDO AL CONSTRUCTOR
$checking = new Account(43161176, 'Checking', 32.00);
$savings  = new Account(20148896, 'Savings', 756.00);
?>

<?php include 'includes/header.php'; ?>
<h2>Account Balances</h2>
<table>
  <tr>
    <th>Date</th>
    <th><?= $checking->type ?></th>
    <th><?= $savings->type  ?></th>
  </tr>
  <tr>
    <td>23 June</td>
    <td>$<?= $checking->balance ?></td>
    <td>$<?= $savings->balance  ?></td>
  </tr>
  <tr>
    <td>24 June</td>
    <td>$<?= $checking->deposit(12.00)  ?></td>
    <td>$<?= $savings->withdraw(100.00) ?></td>
  </tr>
  <tr>
    <td>25 June</td>
    <td>$<?= $checking->withdraw(5.00) ?></td>
    <td>$<?= $savings->deposit(300.00) ?></td>
  </tr>
</table>
<br>
<!-- NUEVA TABLA -->
<h2>Tabla de Productos</h2>
<table>
  <th>ID</th>
  <th>Nombre</th>
  <th>Precio</th>
  <th>Stock</th>
    
  <tr>
    <td><?= $product->id ?></td>
    <td><?= $product->name ?></td>
    <td><?= $product->price ?>€</td>
    <td><?= $product->stock ?></td>
    
  </tr>

</table>


<?php include 'includes/footer.php'; ?>

