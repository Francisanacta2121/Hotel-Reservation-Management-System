<?php
require_once __DIR__ . "/config.php";


function find_rooms($conn) {
    $sql = "SELECT * FROM rooms"; 
    $result = $conn->query($sql);
    $rooms = [];
    while ($row = $result->fetch_assoc()) {
        $rooms[] = $row;
    }
    return $rooms;
}


function create_reservation($conn, $data){
  $stmt = $conn->prepare("INSERT INTO reservations (user_id, room_id, check_in, check_out, guests, notes, status, created_at) VALUES (?,?,?,?,?,?, 'pending', NOW())");
  $stmt->bind_param("iissis", $data['user_id'], $data['room_id'], $data['check_in'], $data['check_out'], $data['guests'], $data['notes']);
  return $stmt->execute();
}

function approve_reservation($conn, $id){
  $stmt = $conn->prepare("UPDATE reservations SET status='approved', approved_at=NOW() WHERE id=?");
  $stmt->bind_param("i", $id);
  return $stmt->execute();
}
?>