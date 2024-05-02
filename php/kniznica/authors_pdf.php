<?php
session_start();

// include autoloader
require_once 'vendor/autoload.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

include_once('inc/config.php');

$text = "
<style>
* {font-family: DejaVu Sans;}
td, th {padding: 2px 10px;}
th {background: #ffffaa}
</style>
<h1>Zoznam autorov</h1>

<table>
<thead>
    <tr>
        <th>ID</th>
        <th>Meno</th>
        <th>Priezvisko</th>
    </tr>
</thead>
<tbody>
";
$sql = "SELECT * FROM authors";
$result = $conn->query($sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $text .= "<tr>";
        $text .= "<td>" . $row['id']. "</td>";
        $text .= "<td>" . $row['first_name']. "</td>";
        $text .= "<td>" . $row['last_name']. "</td>";
        $text .= "</tr>";
    }
}
$text .= "</tbody></table>";
$dompdf->loadHtml($text);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait'); // portrait/landscape

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('authors.pdf');