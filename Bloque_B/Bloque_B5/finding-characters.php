<?php
$text = 'Home sweet home';
?>
<?php include 'includes/header.php'; ?>

<h2>Comprobación de Caracteres en una Cadena</h2>
<p>
  <b>First match (case-sensitive):</b> 
  <?= strpos($text, 'ho') !== false ? strpos($text, 'ho') : 'Not found' ?><br>
  <b>First match (not case-sensitive):</b> 
  <?= stripos($text, 'me', 5) !== false ? stripos($text, 'me', 5) : 'Not found' ?><br>
  <b>Last match (case-sensitive):</b> 
  <?= strrpos($text, 'Ho') !== false ? strrpos($text, 'Ho') : 'Not found' ?><br>
  <b>Last match (not case-sensitive):</b> 
  <?= strripos($text, 'Ho') !== false ? strripos($text, 'Ho') : 'Not found' ?><br>
  <b>Text after first match (case-sensitive):</b> 
  <?= strstr($text, 'ho') !== false ? strstr($text, 'ho') : 'Not found' ?><br>
  <b>Text after first match (not case-sensitive):</b> 
  <?= stristr($text, 'ho') !== false ? stristr($text, 'ho') : 'Not found' ?><br>
  <b>Text between two positions:</b> 
  <?= substr($text, 5, 5) ?><br>
  <b>Comienza con "Home":</b> 
  <?= str_starts_with($text, 'Home') ? 'Sí' : 'No' ?><br>
  <b>Termina con "home":</b>
  <?= str_ends_with($text, 'home') ? 'Sí' : 'No' ?><br>
</p>

<?php include 'includes/footer.php'; ?>
