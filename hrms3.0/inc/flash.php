<?php
function flash($key){
  if(!isset($_SESSION[$key])) return "";
  $m = $_SESSION[$key]; unset($_SESSION[$key]);
  return '<div class="alert">'.esc($m).'</div>';
}
?>