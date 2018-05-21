<!----------TABELLA---------->
 <table class="table table-responsive-sm table-hover table-bordered table-dark">
    <thead>
        <tr>
            <th scope="col">
        <a <?=$order==='id'?"class=\"$dir\"":''?> href="index.php?<?=$tableParams?>&amp;order=id&amp;dir=<?=$dir==='ASC'?'DESC':'ASC'?>">id</a>    
            </th>
            <th scope="col">
    <a <?=$showimg!=1?"class=\"test\"":''?> href="index.php?<?=$actionParams?>&amp;showimg=<?=$showimg==1?'':1?>">immagine</a> 
            </th>
            <th scope="col">
                <a <?=$order==='username'?"class=\"$dir\"":""?> href="index.php?<?=$tableParams?>&amp;order=username&amp;dir=<?=$dir==='ASC'?'DESC':'ASC'?>">username</a> 
            </th>
            <th scope="col">
                  <a <?=$order==='age'?"class=\"$dir\"":""?> href="index.php?<?=$tableParams?>&amp;order=age&amp;dir=<?=$dir==='ASC'?'DESC':'ASC'?>">age</a> 
            </th>
            <th scope="col">
                  <a <?=$order==='email'?"class=\"$dir\"":""?> href="index.php?<?=$tableParams?>&amp;order=email&amp;dir=<?=$dir==='ASC'?'DESC':'ASC'?>">email</a> 
            </th>
            <th scope="col">
                  <a <?=$order==='fiscalcode'?"class=\"$dir\"":""?> href="index.php?<?=$tableParams?>&amp;order=fiscalcode&amp;dir=<?=$dir==='ASC'?'DESC':'ASC'?>">fiscalcode</a> 
            </th>
            <th scope="col-2" colspan="2" class="text-center">
            AZIONE
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user) : ?>
        <tr>
            <th scope="row"><?=$user['id']?></th>
            <td>
           
            <?php if ( $showimg ) { if ( $user['image'] && file_exists(AVATAR_DIR.$user['image']) ) { ?> <img src="<?=AVATAR_DIR.$user['image']?>" alt="<?=$user['image']?>"><?php } else { ?>
            <img src="<?=AVATAR_DIR.'0.jpg'?>" alt="default image"><?php } }?>
            </td>
            <td><?=$user['username']?></td>
            <td><?=$user['age']?></td>
            <td><?=$user['email']?></td>
            <td><?=$user['fiscalcode']?></td>
            <td><a class="btn btn-success" href="update.php?<?=$actionParams?>&amp;action=update&amp;id=<?=$user['id']?>"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;MOD</a></td>   
            <td><a class="btn btn-danger" onclick="return confirm('vuoi eliminare il record?')" href="update.php?<?=$actionParams?>&amp;action=delete&amp;id=<?=$user['id']?>"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;CANC</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

















