<?php
// Called by admin after approval to queue an email (demo-friendly).
require_once __DIR__ . '/../inc/config.php';
require_once __DIR__ . '/../inc/mailer.php';

if(!isset($_GET['id'])){ http_response_code(400); exit('Missing id'); }
$id=intval($_GET['id']);
$q=$conn->query("SELECT r.id, u.username, rm.name room FROM reservations r
LEFT JOIN users u ON u.id=r.user_id
LEFT JOIN rooms rm ON rm.id=r.room_id WHERE r.id=$id");
$row=$q->fetch_assoc();
if(!$row){ exit('Not found'); }

$html = "<h2>Reservation Approved</h2><p>Hi ".esc($row['username']).", your reservation #".$row['id']." for <b>".esc($row['room'])."</b> has been approved.</p>";
queue_mail($row['username']."@example.com", "Reservation Approved #".$row['id'], $html);
echo "Queued";
?>