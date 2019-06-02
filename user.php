<?php require_once("ViewControllers/userViewController.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="/favicon.png" type="image/png">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
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
            <?php
            if(isset($errorMSG)){
                ?><div class="msg error"><?=$errorMSG?></div><?php
            }elseif(isset($successMSG)){
                ?><div class="msg success"><?=$successMSG?></div><?php
            }
            ?>
            <div>
                <?=showIdField()?>
                <?=showRegisterDateField()?>
                <?=showUpdateDateField()?>
            </div>
        </div>   
        <?php showAccountDataForm() ?>
        <?php showPasswordForm() ?>
        <?php showPersonalInfoForm() ?>
        <?php showUserStateForm() ?>
        <?php showRoleForm()?>
    </div>
        <?php
    }elseif($register){
        ?>
    <div class="form-container new-user">
        <form method="post" action="user.php?newUser=">
            <div id="header">
                <h1><?=$title?></h1>
                <?php
                if(isset($errorMSG)){
                    ?><div class="msg error"><?=$errorMSG?></div><?php
                }elseif(isset($successMSG)){
                    ?><div class="msg success"><?=$successMSG?></div><?php
                }
                ?>
            </div>   
            <?php showAccountDataForm() ?>
            <?php showPasswordForm() ?>
            <?php showPersonalInfoForm() ?>
            <?php showUserStateForm() ?>
            <?php showRoleForm()?>  
            <div class="form-buttons">
                <input type="submit" value="Registrar Usuario" class="input-submit-button" name="registerUser">
            </div>
        </form>
    </div>    
        <?php
    }
    ?>
</body>
</html>