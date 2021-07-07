<?php

require 'backend/koneksi.php';
require_once("dompdf/autoload.inc.php");

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$sql = "select * from item";
$query = mysqli_query($conn, $sql);
$html = '<center>
        <h1>Daftar Item</h1>
    </center>
    <hr><br>
    <table>
        <tr>
            <th>ID_ITEM</th>
            <th>ID_METODE</th>
            <th>ID_GAME</th>
            <th>NAMA_ITEM</th>
            <th>VALUE_ITEM</th>
            <th>HARGA_ITEM</th>
        </tr>
            ';
while ($row = mysqli_fetch_array($query)) {
    $html .= "<tr>
        <td>" . $row['ID_ITEM'] . "</td>
        <td>" . $row['ID_METODE'] . "</td>
        <td>" . $row['ID_GAME'] . "</td>
        <td>" . $row['NAMA_ITEM'] . "</td>
        <td>" . $row['VALUE_ITEM'] . "</td>
        <td>" . $row['HARGA_ITEM'] . "</td>
    </tr>
    ";
}
$html .= "</table>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'portrait');
// Rendering dari HTML ke PDF
$dompdf->render();
// Melakukan output file PDF
$dompdf->stream('laporan_item.pdf');
