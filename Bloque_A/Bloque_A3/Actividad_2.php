<?php
function create_logo()
{
echo '<img src="img/logo.png" alt="Logo">';

}
function write_copyright_notice()
 
{
$year = date('Y');
// AÑADO EL NOMBRE DE LA EMPRESA
$message= '&copy; ' . $year . ' The Cany Store';
return $message;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Basic Functions</title>
<link rel="stylesheet" href="css/styles.css">
</head>
<body>
<header>
<h1><?php create_logo() ?> The Candy Store</h1>
</header>
<article>
<h2>Welcome to the Candy Store</h2>
</article>
<footer>
<?= create_logo() ?>
<?= write_copyright_notice() ?>
</footer>
</body>
</html>
