<?php
// Definir una constante para el nombre de la red social
define('INTERESES', 'INTERESES SOCIALES');

// Lista inicial de intereses de los usuarios
$interests = [
    'Fútbol',
    'Videojuegos',
    'Música',
    'Cine',
    'Fotografía'
];

// Función para mostrar los intereses como una cadena separada por comas
function showInterests($interests) {
    return implode(', ', $interests);
}

// Función para agregar un nuevo interés (simulando la entrada del usuario)
function addInterest(&$interests, $newInterest) {
    // Validamos que el interés no esté repetido
    if (!in_array($newInterest, $interests)) {
        array_push($interests, $newInterest);
        // Redireccionamos después de agregar el nuevo interés
        header("Location: redireccionar.php");
        exit;
    } else {
        echo "<p>¡El interés '$newInterest' ya está en la lista!</p>";
    }
}

// Función para numerar los intereses aleatoriamente
function numberInterests($interests) {
    $numberedInterests = [];
    foreach ($interests as $interest) {
        // Asignar un ID aleatorio a cada interés
        $randomID = rand(1, 1000);
        $numberedInterests[$randomID] = $interest;
    }
    // Ordenar por el identificador aleatorio
    ksort($numberedInterests);
    return $numberedInterests;
}

?>

<?php include 'includes/header.php'; ?>

<h1>Bienvenidos a <?= INTERESES ?></h1>
<p>Aquí puedes compartir tus intereses y hobbies con nosotros.</p>

<h2>Lista de Intereses</h2>
<p><?= showInterests($interests) ?></p>

<h3>Numerar los intereses aleatoriamente</h3>
<ul>
<?php
$numberedInterests = numberInterests($interests);
foreach ($numberedInterests as $id => $interest) {
    echo "<li><b>Id: $id</b> - $interest</li>";
}
?>
</ul>

<h3>Agregar un nuevo interés</h3>
<form method="POST">
    <label for="newInterest">Escribe un nuevo interés:</label><br>
    <input type="text" id="newInterest" name="newInterest" required><br>
    <input type="submit" value="Agregar interés">
</form>

<?php
// Procesar el formulario para agregar un nuevo interés
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newInterest'])) {
    $newInterest = $_POST['newInterest'];
    addInterest($interests, $newInterest);
}

?>

<?php include 'includes/footer.php'; ?>
