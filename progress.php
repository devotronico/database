<!----------BARRA DEL PROGRESSO---------->
<?php
$percent = ceil(($pagina/$numeroPagine )*100); 
$percent = $percent."%"; 
?>

<div class="container">
<div class="progress">
  <div class="progress-bar" role="progressbar"   style="width: <?=$percent?>" aria-valuenow="<?=$pagina?>" aria-valuemin="0" aria-valuemax="100"><?=$percent?></div>
</div>
</div>
