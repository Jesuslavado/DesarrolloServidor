<?php
$text = 'Home sweet home';
?>
<?php include 'includes/header.php'; ?>

<p>
  <b>Lowercase:</b> 
  <?= strtolower($text) ?><br>
  <b>Uppercase:</b> 
  <?= strtoupper($text) ?><br>
  <b>Uppercase first letter:</b> 
  <?= ucwords($text) ?><br>
  <b>Character count:</b> 
  <?= strlen($text) ?><br>
  <b>Word count:</b> 
  <?= str_word_count($text) ?><br>
  <b>Contador de Caracteres (Sin espacios):</b> 
  <?= strlen(str_replace(' ', '', $text)) ?><br>
</p>

<h2>Análisis Adicional:</h2>
<p>
  <?php
  // Análisis de frecuencia de palabras
  $word_frequency = array_count_values(str_word_count(strtolower($text), 1));
  ?>
  <b>Frecuencia de Palabras:</b>
  <ul>
    <?php foreach ($word_frequency as $word => $count): ?>
      <li><?= htmlspecialchars($word) ?>: <?= $count ?></li>
    <?php endforeach; ?>
  </ul>
</p>

<p>
  <b>Resumen (Primeros 50 caracteres):</b> <?= substr($text, 0, 50) ?>
</p>

<?php include 'includes/footer.php'; ?>

