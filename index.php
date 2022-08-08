

<?php

include "./controllers/PlantController.php";


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_POST['save'])){
        $hasErrors = PlantController::store();
        if(!$hasErrors){
            header("Location:".$_SERVER['REQUEST_URI']);
        }
    }
    
    if(isset($_POST['edit'])){
        $plant = PlantController::show();
    }
    
    if(isset($_POST['update'])){
        PlantController::update();
        header("Location:".$_SERVER['REQUEST_URI']);

    }
    
    if(isset($_POST['destroy'])){
        PlantController::destroy();
        header("Location:".$_SERVER['REQUEST_URI']);
    }
}

$plants = PlantController::index();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<link rel="stylesheet" href="./css/main.css">
<!-- <script type="text/javascript" src="javascript.js"></script> -->
    <title>Document</title>
    </head>
<body>
    <div class="container">
        <?php 
        if(isset($_SESSION) && isset($_SESSION['errors'])){
            foreach ($_SESSION['errors'] as $error) { ?>
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
            <?php }
          unset($_SESSION['errors']); 
        } ?>
        <div>
            <form action="" method="post" class="inputs">
                <div id="firsT">
                    <div class="row">
                <div id=rogs>
                <div class="form-group col-md-7">
                    <label >Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Name" 
                        <?= isset($_POST['edit']) ? 'value="' . $plant->name.'"' : "" ?>
                    >
                </div>
                <div class="form-group col-md-7">
                    <label >nameL</label>
                    <input type="text" class="form-control" name="nameL" placeholder="In latin"
                        <?= isset($_POST['edit']) ? 'value="' . $plant->nameL.'"' : "" ?> 
                    >
                </div>
                
                
                <div class="row">
                    <div class="form-group col-md-7">
                        <label >perennial</label>
                        <input type="radio" name="perennial" class="radiobtn" value="1" checked <?= isset($_POST['edit']) ? 'value="' . $plant->perennial . '"' : "" ?>><label for="perennial" class="radiotxt">YES</label>
                        <input type="radio" name="perennial" class="radiobtn" value="0" <?= isset($_POST['edit']) ? 'value="' . $plant->perennial . '"' : "" ?>><label for="perennial" class="radiotxt">NO</label>
                    </div>
                </div>
                    <div class="form-group col-md-7">
                        <label >age</label>
                    <input type="text" class="form-control" name="age" placeholder="age"
                        <?= isset($_POST['edit']) ? 'value="' . $plant->age.'"' : "" ?> 
                    >
                </div>
                <div class="form-group col-md-7">
                    <label >height</label>
                    <input type="text" class="form-control" name="height" placeholder="height"
                        <?= isset($_POST['edit']) ? 'value="' . $plant->height.'"' : "" ?> 
                    >
                </div>
                
            </div>
            </div>
             <div id="buttonP">
            <br>
            
                <?= isset($_POST['edit']) ? '<input type="hidden" name="id" value="'.$plant->id.'">' : "" ?> 
                <button type="submit"  class="btn btn-primary" name= 
                    <?= isset($_POST['edit']) ? '"update" >Atnaujinti' :'"save" >Išsaugoti'?>
                </button>
                </div>
        </form>

        <div id="tbwraper">
        <table class="table table-striped">
            <tr>
                <th>Name</th>
                <th>NameL</th>
                <th>Perennial</th>
                <th>Age-Months</th>
                <th>Height-cm</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
      

        <?php foreach ($plants as $plant) {?>
            <tr>
                <td><?=$plant->name?></td>
                <td><?=$plant->nameL?></td>
                <td><?= ($plant->perennial) ? "YES" : "NO" ?></td>
                <td><?=$plant->age?></td>
                <td><?=$plant->height?></td>
         
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?=$plant->id?>">
                        <button type="submit" class="btn btn-success" name="edit" value=" <?=$plant->id?> " > edit</button>
                    </form>
                </td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?=$plant->id?>">
                        <button type="submit" class="btn btn-danger" name="destroy" >delete</button>
                    </form>
                </td>
            </tr>
                
        <?php }?>
    </div>
    </div>
</table>

</div>

</body>
</html>