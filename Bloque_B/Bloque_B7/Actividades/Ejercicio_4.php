<?php
$moved = false;
$message = '';
$error = '';
$upload_path = 'uploads/';
$max_size = 5242880;
$allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
$allowed_exts = ['jpeg', 'jpg', 'png', 'gif'];

function crear_nombre_archivo($filename, $upload_path) {
    $basename = preg_replace('/[^A-z0-9]/', '-', pathinfo($filename, PATHINFO_FILENAME));
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $filename = $basename . '.' . $extension;
    $i = 0;
    while (file_exists($upload_path . $filename)) {
        $i++;
        $filename = $basename . $i . '.' . $extension;
    }
    return $filename;
}

function redimensionar_y_recortar_imagen($orig_path, $new_path, $new_width, $new_height) {
    $image_data = getimagesize($orig_path);
    $orig_width = $image_data[0];
    $orig_height = $image_data[1];
    $media_type = $image_data['mime'];
    $orig_ratio = $orig_width / $orig_height;
    $new_ratio = $new_width / $new_height;

    if ($new_ratio < $orig_ratio) {
        $select_width = $orig_height * $new_ratio;
        $select_height = $orig_height;
        $x_offset = ($orig_width - $select_width) / 2;
        $y_offset = 0;
    } else {
        $select_width = $orig_width;
        $select_height = $orig_width / $new_ratio;
        $x_offset = 0;
        $y_offset = ($orig_height - $select_height) / 2;
    }

    switch ($media_type) {
        case 'image/gif': $orig = imagecreatefromgif($orig_path); break;
        case 'image/jpeg': $orig = imagecreatefromjpeg($orig_path); break;
        case 'image/png': 
            $orig = imagecreatefrompng($orig_path);
            imagealphablending($orig, false);
            imagesavealpha($orig, true);
            break;
    }

    $new = imagecreatetruecolor($new_width, $new_height);
    if ($media_type === 'image/png') {
        imagealphablending($new, false);
        imagesavealpha($new, true);
    }

    imagecopyresampled($new, $orig, 0, 0, $x_offset, $y_offset, $new_width, $new_height, $select_width, $select_height);

    switch ($media_type) {
        case 'image/gif': return imagegif($new, $new_path);
        case 'image/jpeg': return imagejpeg($new, $new_path);
        case 'image/png': return imagepng($new, $new_path);
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error = ($_FILES['image']['error'] === 1) ? 'El archivo es demasiado grande. ' : '';

    if ($_FILES['image']['error'] == 0) {
        $error .= ($_FILES['image']['size'] <= $max_size) ? '' : 'El archivo supera los 5MB. ';
        $type = mime_content_type($_FILES['image']['tmp_name']);
        $error .= in_array($type, $allowed_types) ? '' : 'El tipo de archivo no es permitido. ';
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $error .= in_array($ext, $allowed_exts) ? '' : 'La extensión del archivo no es válida. ';

        if (!$error) {
            $filename = crear_nombre_archivo($_FILES['image']['name'], $upload_path);
            $destination = $upload_path . $filename;
            $thumb_dir = $upload_path . 'thumbs/';
            if (!file_exists($thumb_dir)) mkdir($thumb_dir, 0777, true);
            $thumbpath = $thumb_dir . $filename;

            $moved = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
            $resized = redimensionar_y_recortar_imagen($destination, $thumbpath, 200, 200);
        }
    }

    if ($moved && $resized) {
        $message = '<img src="' . $thumbpath . '">';
    } else {
        $message = '<b>No se pudo subir el archivo:</b> ' . $error;
    }
}
?>
<?php include 'includes/header.php' ?>
<?= $message ?>
<form method="POST" action="Ejercicio_4.php" enctype="multipart/form-data">
    <label for="image"><b>Subir archivo:</b></label>
    <input type="file" name="image" accept="image/*" id="image"><br>
    <input type="submit" value="Subir">
</form>
<?php include 'includes/footer.php' ?>
