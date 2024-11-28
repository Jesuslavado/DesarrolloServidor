<?php
class Customer
{
    public string $forename;
    public string $surname;
    public string $email;
    public string $password;
    public string $nombre;
    public string $apellidos;
}

class Account
{
    public int    $number;
    public string $type;
    public float  $balance;
}

$customer = new Customer();
$account  = new Account();
$customer->nombre = 'Jesús';
$customer->apellidos  = 'Lavado García';
$customer->email  = 'ivy@eg.link';
$account->balance = 1000.00;
?>
<?php include 'includes/header.php'; ?>
<p>Nombre: <?= $customer->nombre ?></p>
<p>Apelidos: <?= $customer->apellidos ?></p>
  <p>Email: <?= $customer->email ?></p>
  <p>Balance: $<?= $account->balance ?></p>
<?php include 'includes/footer.php'; ?>