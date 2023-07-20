<?php
session_start();

header('Content-Type: application/json');

if (isset($_SESSION['name'])) {
    echo json_encode(['success' => true, 'name' => $_SESSION['name']]);
} else {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
}

