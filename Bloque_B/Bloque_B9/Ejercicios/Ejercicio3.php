<?php
session_start();

// Lista de productos ficticios
$productos = [
    1 => ['nombre' => 'Producto A', 'precio' => 10],
    2 => ['nombre' => 'Producto B', 'precio' => 15],
    3 => ['nombre' => 'Producto C', 'precio' => 20],
];

// Agregar producto al carrito
if (isset($_GET['agregar'])) {
    $id = (int)$_GET['agregar'];
    if (isset($productos[$id])) {
        $_SESSION['carrito'][$id] = ($_SESSION['carrito'][$id] ?? 0) + 1;
    }
    header('Location: cart.php');
    exit;
}
?>

<?php include 'includes/header.php'; ?>

<h1>Lista de Productos</h1>
<ul>
    <?php foreach ($productos as $id => $producto): ?>
        <li>
            <?= htmlspecialchars($producto['nombre']) ?> - $
            <?= number_format($producto['precio'], 2) ?>
            <a href="products.php?agregar=<?= $id; ?>">Añadir al carrito</a>
        </li>
    <?php endforeach; ?>
</ul>

<?php include 'includes/footer.php'; ?>
