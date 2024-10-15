<?php
if(isset($_POST['client_biodata']))
    header('location:client_biodata.php');

if(isset($_POST['client_balance'])){
        header('location:client_balance.php');
}
if(isset($_POST['create'])){
    header('Location: create.php');
}
if(isset($_POST['update_admin'])){
    header('Location: update_admin.php');
}
if(isset($_POST['delete'])){
    header('location: delete.php');
}

if(isset($_POST['query_sol'])){
    header('location: table.php');
}

?>
