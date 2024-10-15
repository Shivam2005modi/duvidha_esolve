<?php
if(isset($_POST['bank_balance']))
    header('location:bank_balance.php');

if(isset($_POST['faq'])){
        header('location:faq.php');
}
if(isset($_POST['ask_user'])){
    header('Location: ask_user.php');
}
if(isset($_POST['profile'])){
    header('Location: profile.php');
}
