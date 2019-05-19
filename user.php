<?php require_once("ViewControllers/userViewController.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$title?></title>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/main.js"></script>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/single-view.css">
</head>
<body>
    <?php include("./includes/navbar.inc") ?>
    <?php 
    if($edit){
        ?>
    <div class="form-container user">
        <div id="user-info-container">
            <h1><?=$title?></h1>
            <div>
                <?=showIdField()?>
                <?=showRegisterDateField()?>
                <?=showUpdateDateField()?>
            </div>
        </div>   
        <!-- Datos Cuenta -->
        <?php showAccountDataForm() ?>
        <!-- Datos Usuario -->
        <?php showPasswordForm() ?>
        <!-- Datos Personales -->
        <?php showPersonalInfoForm() ?>
        <!-- Estados -->
        <?php showUserStateForm() ?>
        <!-- Estados -->
        <?php showRoleForm()?>
    </div>
        <?php
    }elseif($register){
        ?>
    <div class="form-container new-user">
        <form>
            <div id="user-info-container">
                <h1><?=$title?></h1>
            </div>   
            <!-- Datos Cuenta -->
            <?php showAccountDataForm() ?>
            <!-- Datos Usuario -->
            <?php showPasswordForm() ?>
            <!-- Datos Personales -->
            <?php showPersonalInfoForm() ?>
            <!-- Estados -->
            <?php showUserStateForm() ?>
            <!-- Estados -->
            <?php showRoleForm()?>  
        </form>
    </div>    
        <?php
    }
    ?>
</body>
</html>