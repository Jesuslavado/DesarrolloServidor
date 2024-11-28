<?php
declare(strict_types=1);

// Clase Book
class Book {
    public string $title;
    public string $author;
    public int $pages;

    public function __construct(string $title, string $author, int $pages) {
        $this->title = $title;
        $this->author = $author;
        $this->pages = $pages;
    }

    public function getDetails(): string {
        return "<br>Title: {$this->title},<br> Author: {$this->author},<br> Pages: {$this->pages} <br>";
    }
}

// Clase Library
class Library {
    private array $books = [];

    // Agregar un libro a la biblioteca
    public function addBook(Book $book): void {
        $this->books[] = $book;
    }

    // Eliminar un libro por título
    public function removeBook(string $title): bool {
        foreach ($this->books as $index => $book) {
            if ($book->title === $title) {
                unset($this->books[$index]);
                // Reindexar el array después de eliminar
                $this->books = array_values($this->books);
                return true;
            }
        }
        return false;
    }

    // Listar todos los libros
    public function listBooks(): string {
        if (empty($this->books)) {
            return "No hay libros em la biblioteca.";
        }

        $bookDetails = array_map(function(Book $book) {
            return $book->getDetails();
        }, $this->books);

        return implode( $bookDetails);
    }
}

// Clase AccountNumber
class AccountNumber {
    public int $accountNumber;
    public int $routingNumber;

    public function __construct(int $accountNumber, int $routingNumber) {
        $this->accountNumber = $accountNumber;
        $this->routingNumber = $routingNumber;
    }
}

// Clase Account
class Account {
    public AccountNumber $number;
    public string $type;
    protected float $balance;

    public function __construct(AccountNumber $number, string $type, float $balance = 0.00) {
        $this->number = $number;
        $this->type = $type;
        $this->balance = $balance;
    }

    public function deposit(float $amount): float {
        $this->balance += $amount;
        return $this->balance;
    }

    public function withdraw(float $amount): float {
        if ($amount > $this->balance) {
            throw new Exception("Insufficient funds.");
        }
        $this->balance -= $amount;
        return $this->balance;
    }

    public function getBalance(): float {
        return $this->balance;
    }
}

// Crear una biblioteca
$library = new Library();

// Crear libros
$book1 = new Book("1984", "Jesús Lavado", 328);
$book2 = new Book("Libro a Secas", "Paco Barba", 281);

// Agregar libros a la biblioteca
$library->addBook($book1); 

$library->addBook($book2);

// Listar libros en la biblioteca
echo "Books in the Library:";
echo $library->listBooks();

// Eliminar un libro
if ($library->removeBook("Libro a Secas")) {
    echo " <br>Book 'Libro a Secas' eliminado.  <br>";
} else {
    echo "Book 'Libro a Secas' no encontrado";
}

// Listar libros después de la eliminación
echo "<br>Libros en la libreria tras eliminar: ";
echo $library->listBooks();

// Crear una cuenta bancaria
$accountNumber = new AccountNumber(12345678, 987654321);
$account = new Account($accountNumber, 'Savings', 10.00);

// Mostrar detalles de la cuenta bancaria
?>
<?php include 'includes/header.php'; ?>
<h2><?= $account->type ?> Account</h2>
<p>Account: <?= $account->number->accountNumber ?></p>
<p>Routing: <?= $account->number->routingNumber ?></p>
<p>Balance: $<?= number_format($account->getBalance(), 2) ?></p>
<?php include 'includes/footer.php'; ?>
