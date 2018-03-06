<?php
$zeichen = array("a","b","c","d","e","f","g","h","i","j","A","B","C","D","E","F","G","H","I","J",0,1,2,3,4,5,6,7,8,9);
$max = count($zeichen)-1;
$satz = "";
for($i = 0; $i < 5; $i++){
    $satz .= $zeichen[random_int(0,$max)];
}
$datei = fopen("captcha.txt","w");
fwrite($datei,$satz);
fclose($datei);

$bild = imagecreatetruecolor(100,100);
imagecolorallocate($bild, 200,200,200);

$bg = imagecolorallocate($bild,80,80,80);
$textfarbe = imagecolorallocate($bild,0,255,0);

imagefilledrectangle($bild,10,10,90,90,$bg);
//imagestring($bild,4,20,40,$satz,$textfarbe);
imagettftext($bild, 25, 45,25,85,$textfarbe,"../../../../Windows/fonts/arial.ttf",$satz);
//imagettftext($bild, 25, 45,30,80,$textfarbe,"../../../../Windows/fonts/segoe_slboot.ttf",$satz[1]);

$target = "bild.png";
imagepng($bild,$target);
?>
<form action="anmeldecheck.php" method="post">
    Anmeldename:<br>
    <input type="text" name="a_name"><br>
    Email Adresse:<br>
    <input type="text" name="email"><br>
    Bitte geben Sie folgende Zeichenkette ein:<br>
    <img src="bild.png" alt="captcha"><br>    
    <input type="text" name="captcha"><br>
    <input type="submit" value="anmelden">
</form>