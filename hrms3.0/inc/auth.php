<?php
require_once __DIR__ . "/config.php";

function current_user(){
  return $_SESSION['user'] ?? null;
}
function is_admin(){
  return (current_user()['role'] ?? null) === 'admin';
}
function require_admin(){
  if(!is_admin()){ header("Location: /hrms3.0/admin/login.php?e=auth"); exit; }
}
function require_guest_login(){
  if(!current_user()){ header("Location: /hrms3.0/inc/login-modal.php?e=login"); exit; }
}
?>