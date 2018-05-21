<div class="container">
    <form method="post" action="update.php?action=insertSave&amp;<?=$queryString?>" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?=$user['id']?>">

        <div class="form-group">
            <label for="username">Username</label>
            <div class="input-group mb-2 mb-sm-0">
                <div class="input-group-addon"><i class="fa fa-user fa-fw" aria-hidden="true"></i></div>
                <input type="text" class="form-control" pattern="[a-zA-Z\s]{1,64}" id="username" placeholder="Username" name="username" required>
            </div>
        </div>

        <div class="form-group">
            <label for="age">Età</label>
            <div class="input-group mb-2 mb-sm-0">
                <div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                <input type="text" class="form-control" pattern="[0-9]{1,3}" id="age" placeholder="Età" name="age"  required>
            </div>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <div class="input-group mb-2 mb-sm-0">
                <div class="input-group-addon"><i class="fa fa-envelope fa-fw" aria-hidden="true"></i></div>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email"  required>
            </div>
        </div>
        
             <div class="form-group">
            <label for="fiscalcode">Codice Fiscale</label>
            <div class="input-group mb-2 mb-sm-0">
                <div class="input-group-addon"><i class="fa fa-credit-card" aria-hidden="true"></i></div>
                <input type="text" class="form-control" pattern="[A-Za-z0-9]{16}" id="fiscalcode" placeholder="Codice Fiscale" name="fiscalcode"  required>
            </div>
        </div>

<!----------   CARICAMENTO IMMAGINE   ---------->
      <div class="form-group">
       <img id="thumbnail" width="<?=MAX_FILE_WIDTH?>" height="<?=MAX_FILE_HEIGHT?>" src="<?=empty($user['image'])?AVATAR_DIR.'0.jpg':AVATAR_DIR.$user['image']?>"  alt="immagine di profilo">
    </div>
        
        <input type="hidden" name="MAX_FILE_SIZE" value="<?=MAX_FILE_SIZE?>" />
        
<div class="form-group">
    <label for="avatar">Avatar</label>
    <div class="input-group mb-2 mb-sm-0">
        <div class="input-group-addon"><i class="fa fa-picture-o" aria-hidden="true"></i></div>
        <input type="file" onchange="previewFile(this)" width="MAX_FILE_WIDTH" height="MAX_FILE_HEIGHT" class="form-control" id="avatar" placeholder="Avatar" name="avatar">
    </div>
</div>

       
        <button type="submit" class="btn btn-primary">AGGIUNGI</button>

    </form>
</div>






