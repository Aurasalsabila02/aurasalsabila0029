<?php
// Inisialisasi default
$strukBelanja = 0; // Total belanja
$member = true; // Ubah ini menjadi false jika bukan member

// Fungsi untuk menghitung total belanja
function jumlahBelanja($strukBelanja, $member) {
    $diskon = 0; // Inisialisasi diskon

    if ($member) {
        if ($strukBelanja >= 500000) {
            $diskon = 0.20; // Diskon 20%
        } else {
            $diskon = 0.10; // Diskon 10%
        }
    } else {
        if ($strukBelanja >= 300000) {
            $diskon = 0.05; // Diskon 5%
        }
    }

    // Hitung total belanja akhir
    $totalDiskon = $strukBelanja * $diskon;
    $totalBelanjaAkhir = $strukBelanja - $totalDiskon;

    return [$totalDiskon, $totalBelanjaAkhir, $diskon > 0];
}

// Sertakan CSS
echo '<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    margin: 20px;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

h1 {
    color: #343a40;
    text-align: center;
}

.input-group {
    margin: 20px 0;
}

.input-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #343a40;
}

.input-group input[type="number"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    font-size: 16px;
}

.input-group input[type="checkbox"] {
    margin-right: 10px;
}

.input-group button {
    padding: 10px 15px;
    background-color: #17a2b8;
    border: none;
    border-radius: 4px;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
}

.input-group button:hover {
    background-color: #138496;
}

.result {
    margin-top: 20px;
    padding: 10px;
    background-color: #d1ecf1;
    border-left: 5px solid #17a2b8;
}
</style>';

// Tampilkan form input
echo '<form method="POST" action="">';
echo '<h1>Hitung Total Belanja</h1>';
echo '<div class="input-group">';
echo '<label for="strukBelanja">Total Belanja:</label>';
echo '<input type="number" id="strukBelanja" name="strukBelanja" value="' . $strukBelanja . '" required />';
echo '</div>';
echo '<div class="input-group">';
echo '<label for="member">Member:</label>';
echo '<input type="checkbox" id="member" name="member" value="1" ' . ($member ? 'checked' : '') . ' />';
echo '<label for="member">Ya</label>';
echo '</div>';
echo '<div class="input-group">';
echo '<button type="submit">Hitung</button>';
echo '</div>';
echo '</form>';

// Proses input jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $strukBelanja = $_POST['strukBelanja'];
    $member = isset($_POST['member']);
    
    list($totalDiskon, $totalBelanjaAkhir, $diskonAda) = jumlahBelanja($strukBelanja, $member);
    
    // Tampilkan hasil
    echo '<div class="result">';
    echo "<h2>HASIL PERHITUNGAN</h2>";
    echo "Total Belanja Sebelum Diskon: Rp. " . number_format($strukBelanja, 2, ',', '.') . "<br>";
    if ($diskonAda) {
        echo "Total Diskon: Rp. " . number_format($totalDiskon, 2, ',', '.') . "<br>";
        echo "Total Belanja Setelah Diskon: Rp. " . number_format($totalBelanjaAkhir, 2, ',', '.') . "<br>";
    } else {
        echo "Tidak ada diskon tersedia.<br>";
        echo "Total Belanja Setelah Diskon: Rp. " . number_format($strukBelanja, 2, ',', '.') . "<br>";
    }
    echo '</div>';
}
?>
