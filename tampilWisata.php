<?php
function curl($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

// Ambil JSON dari file PHP lokal
$send = curl("http://localhost/rekayasaweb/pertemuan2/getWisata.php");
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
            margin: 30px auto;
            font-family: Arial, sans-serif;
        }
        th, td {
            border: 1px solid black;
            padding: 10px 15px;
            text-align: left;
        }
        th {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>KOTA</th>
                <th>LANDMARK</th>
                <th>TARIF</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($data)) {
                foreach ($data as $row) {
                    echo "<tr>";
                    echo "<td>".strtoupper($row["kota"])."</td>";
                    echo "<td>".strtoupper($row["landmark"])."</td>";
                    echo "<td>".(is_numeric($row["tarif"]) ? number_format($row["tarif"], 0, ',', '.') : strtoupper($row["tarif"]))."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Data tidak tersedia.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>