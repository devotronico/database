<?php
ob_start();
require_once("functions.php");     
ob_end_clean();



if ( empty($_GET['id']) ) { $_GET['id'] = 0; } 
$id = intval($_GET['id']);  


$arrParams = $_GET;
unset($arrParams['action']); // toglie la var action
unset($arrParams['id']);        // toglie la var id
$queryString = http_build_query($arrParams,'','&amp;'); // costruisce una nuova query senza 'action' e 'id'


if ( isset($_GET['action']) )
{       
    switch ( $_GET['action'] )
    {
        case "delete":       
            $return = eliminaUtente($id); 
            $message = $return?"record cancellato con successo":"record NON cancellato";
            $queryString = str_replace('&amp;', '&', $queryString);
            $url = "index.php?message=".urlencode($message)."&success=".$return."&".$queryString;
            header("Location: $url"); 
        break;
            
        case "update":   
         
            $user = profiloUtente($id);
          
            if ( $user ) {
                require_once("header.php"); 
                require_once("navbar.php"); 
                require_once('formupdate.php');
                require_once("footer.php");
            }
        break;
            
         case "updateRecord":      
            $return = aggiornaUtente($_POST);  
            copiaImmagine($_POST['id']); 

            $message = $return?"record aggiornato con successo":"record NON aggiornato";
            $queryString = str_replace('&amp;', '&', $queryString);
            $url = "index.php?message=".urlencode($message)."&success=".$return."&".$queryString;
            header("Location: $url"); 
            
//            if ( !$return_1 ) { 
//                $message = "record NON aggiornato"; 
//            } else if ( !$return_2 ){
//                $message = $img_error;
//            } else { $message = "record aggiornato con successo"; }
           
            
        break;
            
        case "insert":   
                require_once("header.php"); 
                require_once("navbar.php"); 
                require_once('formadduser.php');
                require_once("footer.php");
        break;
               case "insertSave":   
         
            $return = aggiungiUtente($_POST); 
            if ( $return ) { copiaImmagine($mysqli->insert_id); } 
            $message = $return?"record aggiunto con successo":"record NON aggiunto";
            $queryString = str_replace('&amp;', '&', $queryString);
            $url = "index.php?message=".urlencode($message)."&success=".$return."&".$queryString;
            header("Location: $url"); 
        break;

    }
}


?>