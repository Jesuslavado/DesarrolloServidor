<?php
$cities  = [
    'London' => '48 Store Street, WC1E 7BS',
    'Sydney' => '151 Oxford Street, 2021',
    'NYC'    => '1242 7th Street, 10492',
];
$city  = $_GET['city'] ?? '';
$valid = array_key_exists($city, $cities);

if (!$valid && $city !== '') {
    // Redirigir al usuario a la página de error si la ciudad no es válida
    header('Location: errorpage.php');
    exit; // Asegurarse de que no se ejecute más código después de la redirección
}

$address = $valid ? $cities[$city] : 'Please select a city';
?>
<?php include 'includes/header.php' ?>

<?php foreach ($cities as $key => $value) { ?>
  <a href="Ejercicio_3.php?city=<?= htmlspecialchars($key) ?>"><?= htmlspecialchars($key) ?></a>
<?php } ?>

<h1><?= htmlspecialchars($city) ?></h1>
<p><?= htmlspecialchars($address) ?></p>

<?php include 'includes/footer.php' ?>
