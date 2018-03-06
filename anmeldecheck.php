<?php
if(!empty($_REQUEST["a_name"]) && !empty($_REQUEST["email"])){
    $datei = fopen("captcha.txt","r");
    $satz = fgets($datei);
    fclose($datei);
    if($satz == $_REQUEST["captcha"]){
       // print "Erfolg!<br>";
        $name = $_REQUEST["a_name"];
        $email = $_REQUEST["email"];
        $datei = fopen("kunde.txt","w");
        fwrite($datei, "Name: $name\r\n");
        fwrite($datei,"Email: $email\r\n");
        fclose($datei);
        $bild = imagecreatetruecolor(400,400);
        $farbe = imagecolorallocate($bild,255,0,0);
        $textfarbe = imagecolorallocate($bild,255,255,255);
        imagefilledrectangle($bild,0,0,400,400,$farbe);
        imagestring($bild,5,50,150,$name,$textfarbe);
        $pfad = "neukunde.png";
       // imagepng($bild,$pfad);
       // print "<img src='neukunde.png'>";
       header("content-type:image/png");
       imagepng($bild);
    }
    else{
        print "Versuch es nochmal!";
        require("anmeldeformular.php");
    }
}
else{
    print "Bitte Name und Adresse volständig angeben!";
    require("anmeldeformular.php");
}
?>