<?php
require_once '../Config/Config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["start_appointment_date"])) {
    $start_appointment_date = $_POST["start_appointment_date"];
    $end_appointment_date = $_POST["end_appointment_date"];

    echo handleReservation($start_appointment_date, $end_appointment_date);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cancel_id"])) {
    $cancel_id = $_POST["cancel_id"];

    echo cancelReservation($cancel_id);
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    echo json_encode(getAllAppointments());

}
function handleReservation($start_appointment_date, $end_appointment_date) {
    $db = connectDatabase();

    try {
        // Check if the time is already reserved
        if (isTimeReserved($start_appointment_date, $end_appointment_date)) {
            return json_encode(['error' => 'Selected time is already reserved.']);
        }

        $db->beginTransaction();

        $stmt = $db->prepare("INSERT INTO appointments (start_appointment_date, end_appointment_date) VALUES (:start_appointment_date, :end_appointment_date)");
        $stmt->bindParam(':start_appointment_date', $start_appointment_date);
        $stmt->bindParam(':end_appointment_date', $end_appointment_date);
        $stmt->execute();

        $lastInsertId = $db->lastInsertId();

        $db->commit();

        return json_encode(['id' => $lastInsertId]);
    } catch (PDOException $e) {
        $db->rollBack();
        return json_encode(['error' => 'Transaction failed: ' . $e->getMessage()]);
    }
}

// functions.php

function isTimeReserved($start, $end) {
    $db = connectDatabase();

    $stmt = $db->prepare("SELECT COUNT(*) as count FROM appointments WHERE (start_appointment_date < :end) AND (end_appointment_date > :start)");
    $stmt->bindParam(':start', $start);
    $stmt->bindParam(':end', $end);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['count'] > 0;
}




function cancelReservation($cancel_id) {
    $db = connectDatabase();

    try {
        $db->beginTransaction();

        $stmt = $db->prepare("DELETE FROM appointments WHERE id = :id");
        $stmt->bindParam(':id', $cancel_id);
        $stmt->execute();

        // Commit the transaction
        $db->commit();

        return "Reservation canceled!";
    } catch (PDOException $e) {
        // An error occurred, rollback the transaction
        $db->rollBack();
        return "Error canceling reservation: " . $e->getMessage();
    }
}
function getAllAppointments() {
    $db = connectDatabase();
    
    $stmt = $db->query("SELECT * FROM appointments");
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($appointments) {
        return $appointments;
    } else {
        return ['message' => 'No appointments available.'];
    }
}

?>
