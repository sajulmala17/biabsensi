<?php
// Load Google API client library
require_once __DIR__ . '/gapi/vendor/autoload.php';

// Define access credentials
$client = new Google_Client();
$client->setApplicationName('SheetPHP');
$client->setScopes(Google_Service_Sheets::SPREADSHEETS);
$client->setAuthConfig(__DIR__ . '/credentials.json');
$client->setAccessType('offline');
$client->setPrompt('select_account consent');

// Connect to Google Sheets API
$service = new Google_Service_Sheets($client);

// Define spreadsheet ID and sheet name
$spreadsheetId = '1-XUDmJDNKMxTXyRGmXN_uo_sEcUBtKGHYtpm3jUqjqA';
$sheetName = 'Sheet1';

// Get submitted data
$nis = $_POST['nis'];
$nama_siswa = $_POST['nm_siswa'];
$nama_kelas = $_POST['nm_kelas'];
$keterangan = $_POST['ket'];

// Get current date and olehg from session
$timestamp = time();
$currenttime = date('Y-m-d H:i:s', $timestamp);
$tanggal = date('d/m/Y');

// Get nama_mapel from hidden input
$olehg = $_POST['nm_guru'];
$nama_mapel = $_POST['nm_mapel'];

// Build data array for Google Sheets API
$data = [];
foreach ($nis as $key => $value) {
    $row = [
        $currenttime,
		$value,
        $nama_siswa[$key],
        $nama_kelas,
        $keterangan[$value],
        $tanggal,
        $nama_mapel,
        $olehg
    ];
    $data[] = $row;
}

// Define range to write data to
$range = $sheetName . '!A2:H2' . (count($data) + 1);

// Build value range object for Google Sheets API
$valueRange = new Google_Service_Sheets_ValueRange();
$valueRange->setValues(['values' => $data]);

// Write data to Google Sheets
$result = $service->spreadsheets_values->append($spreadsheetId, $range, $valueRange, ['valueInputOption' => 'USER_ENTERED']);

// Check for errors
if ($result->getUpdates()->getUpdatedCells() > 0) {
    echo "Data absensi berhasil disimpan ke Google Sheets.";
} else {
    echo "Terjadi kesalahan saat menyimpan data absensi ke Google Sheets.";
}
?>