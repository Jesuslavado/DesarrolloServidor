<?php
// Declaración de variables
$username = "Susername";
$user_array = [
    'name' => 'Ivy',
    'age' => 24,
    'active' => true
];

// Definición de la clase User
class User {
    public $name;
    public $age;
    public $active;

    // Constructor de la clase
    public function __construct($name, $age, $active) {
        $this->name = $name;
        $this->age = $age;
        $this->active = $active;
    }
}

// Creación de un objeto de la clase User
$user_object = new User('Ivy', 24, true);

// Mostrar valores con formato visual
echo "<h2>Scalar:</h2>";
echo "<pre>" . htmlspecialchars(print_r($username, true)) . "</pre>";

echo "<h2>Array:</h2>";
echo "<pre>" . htmlspecialchars(print_r($user_array, true)) . "</pre>";

echo "<h2>Object:</h2>";
echo "<pre>" . htmlspecialchars(print_r($user_object, true)) . "</pre>";
?>
