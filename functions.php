<?php
require_once("connection.php");  



function getFromGet($param,  $default=null, $type='string'){
    
    if($type === 'int'){
        $param = intval(filter_input(INPUT_GET, $param, FILTER_SANITIZE_NUMBER_INT));
    } else {
        $param = filter_input(INPUT_GET, $param, FILTER_SANITIZE_STRING)  ;
    }
    
    $ret = $param? $param : $default;
    
    return $ret;
}

function listaUtenti(array $parametri ) {
    $mysqli = $GLOBALS['mysqli'];
    
    $lookin = $mysqli->real_escape_string($parametri['lookin']);
    $search = $mysqli->real_escape_string($parametri['search']);
    $order  = $mysqli->real_escape_string($parametri['order']);
    $dir    = $mysqli->real_escape_string($parametri['dir']);   
    $limit  = $mysqli->real_escape_string($parametri['limit']);
    $pagina  = $mysqli->real_escape_string($parametri['pagina']);
    $start = ($pagina-1) * $limit; // echo "conta da ".$start."<br>";
    
    $records = []; 
    
    $sql = "SELECT * FROM users WHERE $lookin LIKE '%{$search}%' ORDER BY $order $dir LIMIT $limit OFFSET $start";

    $result = $mysqli->query($sql);
    
    if ( $result && $result->num_rows )
    {
        while  ($row = $result->fetch_assoc())
        {
            $records[] = $row;
        }
    }
      
  //$result->free(); // free result set 
    //$mysqli->close(); // close connection 
    return $records;
}

function totaleUtenti(array $parametri) {
    $mysqli = $GLOBALS['mysqli'];
    
    $lookin = $mysqli->real_escape_string($parametri['lookin']);
    $search = $mysqli->real_escape_string($parametri['search']);
    
    $totale = '';
    $sql = "SELECT COUNT(*) AS totale FROM users WHERE $lookin LIKE '%{$search}%'"; //echo $sql;
    $result = $mysqli->query($sql);
    if ( $result && $result->num_rows )
    {
        $row = $result->fetch_assoc();
        $totale = $row['totale'];
    }
    return $totale;
} 

function eliminaUtente($id) {
    $mysqli = $GLOBALS['mysqli'];
    
    $user = profiloUtente($id);
    
    $sql = "DELETE FROM users WHERE id = ". ($id);
    
    $result = $mysqli->query($sql);
    
    if ( $result && $user['image'] && file_exists(AVATAR_DIR.$user['image']))
    {
       unlink(AVATAR_DIR.$user['image']); 
    }
    return $result;
}

function profiloUtente($id) {
   // $mysqli = $GLOBALS['mysqli'];
    
    $id = $id; //$mysqli->real_escape_string($id);
    
    $records = []; 
    
    $sql = "SELECT * FROM users WHERE id = $id LIMIT 1";

    $result = $GLOBALS['mysqli']->query($sql);
    
    if ( $result && $result->num_rows )
    {
         $records = $result->fetch_assoc();
    }
    return $records;
}

function aggiornaUtente(array $array) {
    $mysqli = $GLOBALS['mysqli'];
    
    $id = intval($array['id']);
    $username  = $mysqli->real_escape_string($array['username']);
    $username = ucwords(strtolower($username));
    $age = intval($array['age']);
    $email  = $mysqli->real_escape_string($array['email']);
    $fiscalcode = $mysqli->real_escape_string($array['fiscalcode']);  
    $fiscalcode = strtoupper($fiscalcode);
    
    $sql = "UPDATE users SET username='$username', age=$age, email='$email', fiscalcode='$fiscalcode' WHERE id = $id LIMIT 1";

    return $mysqli->query($sql);
/*    if (  $mysqli->query($sql)===true )
    {
        return $mysqli->affected_rows;
    }*/
}

function aggiungiUtente(array $array) {   
        $mysqli = $GLOBALS['mysqli'];
             
        $username = $mysqli->real_escape_string($array['username']);
        $username = ucwords(strtolower($username));
        $age = intval($array['age']);
        $email = $mysqli->real_escape_string($array['email']);
        $fiscalcode = $mysqli->real_escape_string($array['fiscalcode']);   
        $fiscalcode = strtoupper($fiscalcode);
       
        $sql ="INSERT INTO users (username, age, email, fiscalcode) VALUES ('$username', $age, '$email', '$fiscalcode')";
        $result = $mysqli->query($sql);
        return $result;
    }

function copiaImmagine($id) {
        
        
    if ( empty($_FILES) ) {
        $message = 'nessun file caricato';
        //return $message;
         die($message);
    }

    if (!isset($_FILES['avatar']) || !is_uploaded_file($_FILES['avatar']['tmp_name'])) {
      echo 'Non hai inviato nessun file...';
      exit;    
    }
    
    
     if ( $_FILES['avatar']['error'] ) {
        $message = "si è verificato un errore nel caricamento del file";
        //return $message;
          die($message);
    }

    if ( $_FILES['avatar']['size'] > MAX_FILE_SIZE ) {
        $message = "Il file caricato supera i ". MAX_FILE_SIZE ." bytes";
        //return $message;
        die($message);
    }

    // CONTROLLA L ESTENSIONE DEL FILE
    $ext_ok = array('jpg', 'doc', 'docx', 'pdf'); // creiamo un array con i tipi di file
    $temp = explode('.', $_FILES['avatar']['name']); // dividiamo il nome del file dove c'è il punto [ immagine.jpg = 'immagine' e 'jpg' ]  
    $estensione_file = end($temp);      // prendiamo la seconda parte del nome spezzato 'jpg'
    if (!in_array($estensione_file, $ext_ok))  // se non c'è il la parola 'jpg' nell'array ('doc', 'docx', 'pdf') 
    { 
      echo "I file con l' estensione". $_FILES['avatar']['type'] ."non sono ammessi!";
      exit;
    }
    

    
    $filename = $_FILES['avatar']['tmp_name']; // prende il file dal suo percorso temporaneo
    // $img_resource = imagecreatefromjpeg($filename); //  crea una risorsa dell immagine
    
    list($original_width, $original_height, $image_type) = getimagesize($filename); //list ottiene (larghezza, altezza, tipo di file)

    switch ($image_type)
    {
        case 1: $img_resource = imagecreatefromgif($filename); break; // 1 = gif
        case 2: $img_resource = imagecreatefromjpeg($filename);  break; // 2 = jpeg
        case 3: $img_resource = imagecreatefrompng($filename); break;  // 3 = png
        default: return '';  break;
    }
    
// CORREGGE L ANGOLO DI ROTAZIONE DELL 'IMMAGINE********************************
    if (function_exists('exif_read_data')) 
    {
        $exif = @exif_read_data($filename);
        if($exif && isset($exif['Orientation'])) 
        {
            $orientation = $exif['Orientation']; // ottiene il dato sulla rotazione del file
            if($orientation != 1){ // se l'immagine è ruotata
                $deg = 0;
                switch ($orientation) {
                    case 3: $deg = 180; break;
                    case 6: $deg = 270; break;
                    case 8: $deg = 90;  break;  
                }
                if ($deg) // se diverso da zero
                {
                    $img_resource = imagerotate($img_resource, $deg, 0);  // ruota l immagine     
                }
       
            } // if there is some rotation necessary
        } // if have the exif orientation info
    }  // if function exists     

    
  
    // RIDIMENSIONARE L IMMAGINE*****************************************************************
   
    $rapportoOriginale = $original_width/$original_height; // rapporto originale dell immagine
    $rapportoStandard = MAX_FILE_WIDTH/MAX_FILE_HEIGHT; // rapporto standard dell immagine
    $calc_width  = MAX_FILE_WIDTH;
    $calc_height = MAX_FILE_HEIGHT;
    if ( $rapportoStandard > $rapportoOriginale) 
    {
        $calc_width = $calc_width * $rapportoOriginale;
    } 
    else
    {
        $calc_height = $calc_width / $rapportoOriginale; 
    }
    $img_resource = imagescale($img_resource, $calc_width, $calc_height); // ridimensiona la risorsa dell immagine

    
    // RINOMINA IL FILE E CAMBIA IL PERCORSO DELLA CARTELLA
    $filename = $id.'.'.$estensione_file; // rinominiamo il file    
 
    switch ($image_type)  // riscrive l immagine ruotata e ridimensionata sul nuovo percorso del file
    {
        case 1:$result = imagegif($img_resource, AVATAR_DIR.$filename); break; // default quality
        case 2:$result = imagejpeg($img_resource, AVATAR_DIR.$filename, 100 );  break; // best quality
        case 3:$result = imagepng($img_resource, AVATAR_DIR.$filename, 0); break; // no compression
        default: echo ''; break;
    }
   
    

    if ( !$result ) {
        $message = "Impossibile salvare miniatura";
        //return $message; 
         die($message);
    }
    
    $sql = "UPDATE users SET image='$filename' WHERE id = $id";
    return $GLOBALS['mysqli']->query($sql);
}

?>
 

















