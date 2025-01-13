<?php
$cities  = [
    'London' => '48 Store Street, WC1E 7BS',
    'Sydney' => '151 Oxford Street, 2021',
    'NYC'    => '1242 7th Street, 10492',
    'Tokio'  => '1234 Shibuya Street, 150-0002', // Nueva clave y dirección
];
$city = $_GET['city'] ?? '';
if ($city && isset($cities[$city])) { // Validación para evitar errores si la clave no existe
    $address = $cities[$city];
} else {
    $address = 'Please select a city';
}
?>
<?php include 'includes/header.php' ?>

<?php foreach ($cities as $key => $value) { ?>
  <a href="get-2.php?city=<?= $key ?>"><?= $key ?></a>
<?php } ?>

<h1><?= htmlspecialchars($city) ?></h1>
<p><?= htmlspecialchars($address) ?></p>

<?php include 'includes/footer.php' ?>
