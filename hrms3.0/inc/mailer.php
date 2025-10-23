<?php
// File-based "mailer" to avoid SMTP setup during dev.
// Writes emails to /emails/ folder so you can preview.
$EMAIL_DIR = __DIR__ . '/../emails';
if(!is_dir($EMAIL_DIR)) mkdir($EMAIL_DIR, 0777, true);

function queue_mail($to, $subject, $html){
  global $EMAIL_DIR;
  $id = uniqid('mail_', true);
  $payload = "TO: $to
SUBJECT: $subject

$html";
  file_put_contents($EMAIL_DIR . "/$id.eml", $payload);
  return true;
}
?>