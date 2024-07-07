<a href="index.php">Do you want to upload more photos to the photo album?
</a>
<br>
<?php
    $uploadDir = 'uploads/';
    if (is_dir($uploadDir)) {
        $files = scandir($uploadDir);

        foreach ($files as $file) {
            $filePath = $uploadDir . $file;

    // Проверить, является ли файл изображением
    if (is_file($filePath) && getimagesize($filePath)) {
        echo '<div>';
        echo '<img src="' . $filePath . '" alt="' . htmlspecialchars($file) . '" width="200">';
        // echo '<p>' . htmlspecialchars($file) . '</p>';
        echo '<p>' . 'Next photo:' . '</p>';
        echo '</div>';
        }
    }
}
?>