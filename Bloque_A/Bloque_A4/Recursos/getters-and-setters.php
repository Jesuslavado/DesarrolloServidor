<?php
declare(strict_types = 1);

class Account {
    public    int    $number;
    public    string $type;
    protected float  $balance;
    private string $owner; // CREACION DE OWNER

    
    public function __construct(int $number, string $type, float $balance = 0.00, string $propietario="")
    {
        $this->number  = $number;
        $this->type    = $type;
        $this->balance = $balance;
        $this->owner = $propietario;

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

    public function getBalance(): float
    {
        return $this->balance;
    }
// GETTERS Y SETTERS
    public function getOwner(){
        return $this->owner;

    }

    public function setOwner(string $propietario){
        $this->owner = $propietario;
    }

}

$account = new Account(20148896, 'Savings', 80.00);
$account ->setOwner('Jesús');
?>
<?php include 'includes/header.php'; ?>
<h2><?= $account->type ?> Account</h2>
<p>Owner: <?= $account->getOwner() ?></p>
<p>Previous balance: $<?= $account->getBalance() ?></p>
<p>New balance: $<?= $account->deposit(35.00) ?></p>
<?php include 'includes/footer.php'; ?>