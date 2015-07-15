<?php
function remotefilesize() {
$ch = curl_init('http://www.google.co.in/images/srpr/logo4w.png');

 curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
 curl_setopt($ch, CURLOPT_HEADER, TRUE);
 curl_setopt($ch, CURLOPT_NOBODY, TRUE);

 $data = curl_exec($ch);
 $size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

 curl_close($ch);
 return $size;
}

$file_path = "https://github.com/base205/rep/blob/master/bi3.exe?raw=true";
ob_start();
header("Content-Type: application/x-msdos-executable");
header('Content-Length: '.remotefilesize($file_path) );
header("Content-disposition: attachment; filename=prueba.exe");
$chunksize = 128 * 1024; // how many bytes per chunk (128 KB)
$size = filesize($file_path);
if ($size > $chunksize){
    $handle = fopen($file_path, 'rb');
    $buffer = '';
    while (!feof($handle)) {
      $buffer = fread($handle, $chunksize);
      echo $buffer;
      flush();
      sleep(1);
    }
    fclose($handle);
 }else{
    readfile($file_path);
 }

?>