<?php
 if(!isset($_SESSION)) 
 { 
     session_start(); 
 }

if (!isset($_SESSION['log_detail'])) {
    $_SESSION['log_detail'] = null;

}
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] =[];
}
// session_unset();