<?php
require_once 'connection.php';    

    
    
    
function getRandName() {

    $names = ['ROBERTO', 'GIOVANNI', 'GIULIA', 'TED', 'JOHN'];
    $lastnames = ['SMITH', 'RE', 'ROSSI', 'ARIAS', 'MENDOZA', 'CRUZ', 'WILDE'];
    return $names[mt_rand(0, count($names) - 1)] . ' ' . $lastnames[mt_rand(0, count($names) - 1)];
}

function getRandEmail( $name) {
     $domains = ['google.com', 'yahoo.com', 'hotmail.it','libero.it'];
  

    $str = strtolower(str_replace(' ','.',$name)).'.'.mt_rand(11, 99).'@'.$domains[mt_rand(0, count($domains) - 1)] ;
    return $str;
}
function getRandFiscalcode() {
    $i = 16;
    $res = '';
    while ($i > 0) {
        $res .=chr(mt_rand(97, 122));
        $i--;
    }
    return strtoupper($res);
}
function insertRandUsers($tot, mysqli $mysqli) {
    $fiscalcodeArray = [];
     $emails = [];
     $fiscalcode = $email = '';
    for ($i = 0; $i < $tot; $i++) {
        
        do{
            $fiscalcode = getRandFiscalcode(); // crea un nuovo fiscalcode
        } while (in_array($fiscalcode, $fiscalcodes)); // finche nell array $fiscalcodeArray è presente lo stesso fiscalcode
        
        $fiscalcodeArray[] = $fiscalcode; // inserisci il nuovo fiscalcode nell array
        
        $name = getRandName();
        
        $age = mt_rand(18, 99);
        
        do{
            $email = getRandEmail( $name);
        } while (in_array($email, $emails));
       
        $emails[] = $email;
        $query = "INSERT INTO users (id, username,age,fiscalcode,email) VALUES (NULL, '$name', $age,'" . $fiscalcode . "','$email')";
        $res = $mysqli->query($query);
        if (!$res) {
            echo('<br>Error' . $mysqli->error);
        } else {
            echo $mysqli->affected_rows . ' created';
        }
    }
}


?>