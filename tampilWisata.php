<?php
function curl($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

// Ambil data JSON dari endpoint lokal
$send = curl("http://localhost/rekayasaweb/pertemuan2/getWisata.php");

// Decode JSON ke array
$data = json_decode($send, TRUE);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Wisata</title>
    <style>
        table {
            border-collapse: collapse;
            width: 60%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #999;
            padding: 8px;
            text-align: left;
        }
        th {
            background: #f0f0f0;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Daftar Tempat Wisata</h2>
    <table>
        <thead>
            <tr>
                <th>ID Wisata</th>
                <th>Kota</th>
                <th>Landmark</th>
                <th>Tarif</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($data)) {
                foreach($data as $row){
                    echo "<tr>";
                    echo "<td>".$row["id_wisata"]."</td>";
                    echo "<td>".$row["kota"]."</td>";
                    echo "<td>".$row["landmark"]."</td>";
                    echo "<td>".$row["tarif"]."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Tidak ada data tersedia</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>