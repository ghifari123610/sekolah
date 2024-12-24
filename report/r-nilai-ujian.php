<?php


require __DIR__ . '/../asset/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;

// Inisialisasi Html2Pdf
$html2pdf = new Html2Pdf();

// Tulis konten HTML
$htmlContent = '<h1>Hello World</h1><p>This is my first test with Html2Pdf.</p>';
$html2pdf->writeHTML($htmlContent);

// Hasilkan output PDF
$html2pdf->output('example.pdf'); // Nama file hasil output
