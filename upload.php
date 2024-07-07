<?php
// Установите директорию для загрузки файлов
$uploadDir = 'uploads/';

// Проверьте, был ли отправлен файл
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['image']['tmp_name'];
    $fileName = basename($_FILES['image']['name']);
    $fileSize = $_FILES['image']['size'];
    $fileType = $_FILES['image']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Разрешенные расширения файлов
    $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');

    // Проверьте, соответствует ли загружаемый файл одному из допустимых расширений
    if (in_array($fileExtension, $allowedfileExtensions)) {
        // Проверка существования директории и создание, если ее нет
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Задание уникального имени файла
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        // Полный путь для загружаемого файла
        $dest_path = $uploadDir . $newFileName;

        // Переместите файл в директорию загрузки
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            echo 'Файл успешно загружен.';
            header('Location: albom.php');
        } else {
            echo 'Произошла ошибка при перемещении загружаемого файла.';
        }
    } else {
        echo 'Загружаемый файл имеет недопустимое расширение. Разрешены только: ' . implode(',', $allowedfileExtensions);
    }
} else {
    echo 'Ошибка при загрузке файла. Пожалуйста, попробуйте еще раз.';
}
?>