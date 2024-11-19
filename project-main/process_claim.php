<?php
require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = $_POST['patient_id'];
    
    // Calculate total
    $total_biaya = 
        $_POST['biaya_pendaftaran'] +
        $_POST['biaya_akomodasi'] +
        $_POST['biaya_pemeriksaan'] +
        $_POST['biaya_tindakan'] +
        $_POST['biaya_ibu_bayi'] +
        $_POST['biaya_obat'];
    
    // Get patient's batas_klaim
    $stmt = $pdo->prepare("SELECT batas_klaim FROM patients WHERE id = ?");
    $stmt->execute([$patient_id]);
    $patient = $stmt->fetch();
    
    // Check if claim exceeds limit
    $status_klaim = $total_biaya > $patient['batas_klaim'] ? 'exceeded' : 'normal';
    
    // Insert claim
    $stmt = $pdo->prepare("INSERT INTO claims (
        patient_id, biaya_pendaftaran, biaya_akomodasi,
        biaya_pemeriksaan, biaya_tindakan, biaya_ibu_bayi,
        biaya_obat, total_biaya, status_klaim
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->execute([
        $patient_id,
        $_POST['biaya_pendaftaran'],
        $_POST['biaya_akomodasi'],
        $_POST['biaya_pemeriksaan'],
        $_POST['biaya_tindakan'],
        $_POST['biaya_ibu_bayi'],
        $_POST['biaya_obat'],
        $total_biaya,
        $status_klaim
    ]);
    
    if ($status_klaim === 'exceeded') {
        $_SESSION['message'] = "Peringatan: Biaya melebihi Batas Klaim BPJS!";
    } else {
        $_SESSION['message'] = "Klaim berhasil disimpan";
    }
    
    header('Location: dashboard.php');
    exit;
}
