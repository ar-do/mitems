<?php
/* Meine Applikation hat noch kein PW vergessen oder PW reset feature. Falls bei 
 einem User das Password zurückgesetzt werden muss, muss zuerst mit diesem Helper
 der Hash generiert werden und das neue gehashte Passwort in die Datenbank
 gespeichert werden.
 */
$pw = "PW HIER EINGEBEN";
echo password_hash($pw, PASSWORD_DEFAULT);
?>