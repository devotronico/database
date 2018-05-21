<!----------PAGINAZIONE---------->
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">

   
<?php for ($i=$pagina-4; $i<=$numeroPagine; $i++) { ?>
    <?php if ( $i > 0 ) { ?>
        <?php  if ($i == $pagina-4) { ?>
            <li class="page-item"><a class="page-link" href="index.php?<?=$paginationParams?>&amp;pagina=<?=$i?>">Previous</a></li>
        <?php } else if ($i < $pagina ) { ?>
            <li class="page-item"><a class="page-link" href="index.php?<?=$paginationParams?>&amp;pagina=<?=$i?>"><?=$i?></a></li>
        <?php } else { break; } ?>
    <?php } ?>
<?php } ?>
   
   

<?php for ($i=$pagina; $i<=$numeroPagine; $i++) { ?>
    <?php if ($i == $pagina) { ?>
        <li class="page-item active"><a class="page-link" href="index.php?<?=$paginationParams?>&amp;pagina=<?=$i?>"><?=$i?></a></li>
    <?php } else if ($i < $pagina+4) { ?>
        <li class="page-item"><a class="page-link" href="index.php?<?=$paginationParams?>&amp;pagina=<?=$i?>"><?=$i?></a></li>
    <?php } else if ($i == $pagina+4) { ?>
        <li class="page-item"><a class="page-link" href="index.php?<?=$paginationParams?>&amp;pagina=<?=$i?>">NEXT</a></li>
    <?php } else { break; } ?>
<?php } ?>
   

  </ul>
</nav>