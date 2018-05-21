<?php
$limit = getFromGet('limit', 10, 'int'); 
$lookin = getFromGet('lookin', 'username');
$search = getFromGet('search');
$order = getFromGet('order', 'id');
?>
 
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
  <a class="navbar-brand" href="#"><img src="database-2.svg" width="30" height="30" alt="database"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
   
    <ul class="navbar-nav mr-auto">
        <li class="nav-item <?=empty($_GET['action'])?'active':''?>">
        <a class="nav-link" href="index.php"><i class="fa fa-database" aria-hidden="true"></i>&nbsp;Database<span class="sr-only">(current)</span></a>
      </li>
      
    <li class="nav-item <?=$_GET['action']==='insert'?'active':''?>">
        <a class="nav-link" href="update.php?action=insert"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Add&nbsp;User</a>
    </li>

    </ul>
    
    <form class="form-inline my-2 my-lg-0 text-light">
    <!----------------ORDER------------>
        <div class="form-group">
            <label for="order">Lookin</label>
            <select class="form-control ml-sm-2 mr-4" id="orderId" name="lookin">
                <option <?=$lookin==='id'?'selected':''?> value="id" >id</option>
                <option <?=$lookin==='username'?'selected':''?> value="username" >username</option>
                <option <?=$lookin==='email'?'selected':''?> value="email">email</option>
            </select>
        </div>
<!----------------LIMIT------------>
        <div class="form-group">
            <label for="limit">Limit</label>
            <select class="form-control ml-2 mr-4" id="limitId" name="limit">
                <option <?=$limit===1?'selected' :''?> value=1 >1</option>
                <option <?=$limit===5?'selected' :''?> value=5 >5</option>
                <option <?=$limit===10?'selected':''?> value=10>10</option>
                <option <?=$limit===20?'selected':''?> value=20>20</option>
                <option <?=$limit===30?'selected':''?> value=30>30</option>
            </select>
        </div>
     
     
     <div class="form-group">
 <div class="form-check">
    <label class="form-check-label">Immagini</label>
       <input type="checkbox" class="form-check-input ml-2 mr-4" name="showimg" value=1 <?=isset($_GET['showimg'])?'checked':''?>>
  </div>
    </div>
     
     
<!--      <input class="form-control mr-2" type="search" name="search" placeholder="Search" aria-label="Search">-->
      <input class="form-control mr-2" type="search" placeholder="Search" name="search" value="<?=$search!==""?"$search":''?>" aria-label="search">
      <button class="btn btn-outline-success mr-2 my-2 my-sm-0" type="submit"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Cerca</button>
      <button class="btn btn-outline-danger my-2 my-sm-0" type="reset" onclick="location.href='index.php'"><i class="fa fa-eraser fa-fw"></i>&nbsp;Reset</button>
<!--        <button class="btn btn-outline-danger my-2 my-sm-0" type="reset" href="index.php"><i class="fa fa-eraser fa-fw"></i>Reimposta</button>-->
    </form>
    
  </div>
</nav>