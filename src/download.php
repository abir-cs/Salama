<?php
$uploadDir = dirname(__DIR__) . "\uploads\\";
if (!isset($_GET['file'])) {
    exit("No file specified.");
}

$file = basename($_GET['file']);
$filePath = $uploadDir . $file;

if (!file_exists($filePath)) {
    exit("File not found.");
}

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $filePath);
finfo_close($finfo);

header('Content-Description: File Transfer');
header('Content-Type: ' . $mime);
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Content-Length: ' . filesize($filePath));
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: public');

readfile($filePath);
exit;
