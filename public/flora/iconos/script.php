<?php
// Ruta a la carpeta de los SVGs
$iconFolder = __DIR__ . '/data/';

$icons = [];
if (is_dir($iconFolder)) {
    foreach (scandir($iconFolder) as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'svg') {
            $name = pathinfo($file, PATHINFO_FILENAME);
            $content = file_get_contents($iconFolder . $file);
            $icons[] = [
                'name' => $name,
                'svg' => $content
            ];
        }
    }
}

// Encabezados para permitir llamadas desde JS
header('Content-Type: application/json');
echo json_encode($icons);
