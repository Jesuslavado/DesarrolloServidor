<?php
declare(strict_types = 1);
class Library {
public string $libraryName;
public array $books;

public function __construct(string $nombre, array $libros)
{
    $this->libraryName = $nombre;
    $this->books = $libros;
}
// METODOS
public function addBook(string $libro)
{
    $this->books[] = $libro;
}

public function removeBook(string $libro)
{
    $key = array_search($libro, $this->books);
    unset($this->books[$key]);
}
// Getter
public function getBooks(): array
{
    return $this->books;
}
}

class Account {
    public    array  $number;
    public    string $type;
    protected float  $balance;

    public function __construct(array $number, string $type, float $balance = 0.00)
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

    public function getBalance(): float
    {
        return $this->balance;
    }
}

//Create an array to store in the property
$numbers = ['account_number' => 12345678,
            'routing_number' => 987654321,];

//Create an instance of the class and set properties
$account = new Account($numbers, 'Savings', 10.00);
$library = new Library('Mi Libreria', ['PHP', 'JavaScript', 'C++']);

?>
<?php include 'includes/header.php'; ?>
<h2><?= $account->type ?> account</h2>
Account <?= $account->number['account_number'] ?><br>
Routing <?= $account->number['routing_number'] ?>
<?php include 'includes/footer.php'; ?>

<br>
<h2><?= $library->libraryName ?></h2>
<?php 
// Añadimos un libro a la biblioteca
$library->addBook('Python');
// Quitamos un libro de la biblioteca
$library->removeBook('PHP');
?>
    <?php foreach ($library->getBooks() as $book): ?>
        <?= $book ?><br>
    <?php endforeach; ?>



