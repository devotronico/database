<?php 
###### DIR [ ASC, DESC ]
if ( empty($_GET['dir']) ) {  $_GET['dir'] = 'ASC';  }   
$dir = $_GET['dir'];


###### START [ .... ] 
if ( empty($_GET['pagina']) ) {  $_GET['pagina'] = '1';  }  
$pagina =  $_GET['pagina'];
//$start = ($pagina-1) * $limit; // echo "conta da ".$start."<br>";


require_once("functions.php"); 
require_once("fill-database.php"); //insertRandUsers(1000, $GLOBALS['mysqli']); non cancellare [riutilizzabile]
require_once("header.php"); 
require_once("navbar.php"); 
$showimg = isset($_GET['showimg']) ? $_GET['showimg'] : '';

// PARAMETRI DEL NAVBAR DI RICERCA
$arrBuildUrl = array(
    'lookin'=> $lookin,
//    'showimg'=> $showimg,
    'search'=> $search,
    'limit' => $limit
);

$tableParams = http_build_query($arrBuildUrl, '', '&amp;')."&amp;pagina=$pagina"; //echo $allParams; // per la tabella

$paginationParams = http_build_query($arrBuildUrl, '', '&amp;')."&amp;order=$order&amp;dir=$dir"; // per la paginazione

$actionParams =  http_build_query($arrBuildUrl, '', '&amp;')."&amp;order=$order&amp;dir=$dir&amp;pagina=$pagina"; // per la paginazione

$arrayParams = array(
    'lookin'=> $lookin,
    'showimg'=> $showimg,
    'search'=> $search,
    'order' => $order,
    'dir'   => $dir,
    'pagina' => $pagina,
    'limit' => $limit
);


$users = listaUtenti($arrayParams);
 

$totaleRisultati = totaleUtenti(['lookin'=> $lookin, 'search'=> $search]); // echo "totale risultati ".$totaleRisultati."<br>";
$numeroPagine = ceil($totaleRisultati/$limit); // echo "numero pagine ".$numeroPagine."<br>";


 //foreach ($users as $user) {   echo " id = " . $user['id'] . " username = " . $user['username'] .  " email = " . $user['email'] . "<br>";}  



if ( isset($_GET['message']) ) { 
   // $success = intval($_GET['success']);
    $class = $_GET['success'] ? "alert-success" : "alert-danger"; ?>
   <div class="container">
    <div class="alert <?=$class?> text-center my-0 py-sm-1" role="alert" ><?=$_GET['message']?></div>   
    </div>   
<?php } ?>



   
<?php


 if ($users) { 
        require_once("stats.php"); 
        require_once("progress.php"); 
        require_once("table.php"); 
        require_once("pagination.php");  
    }
require_once("footer.php");
?> 


   

