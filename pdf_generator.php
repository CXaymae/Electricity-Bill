<?php

require_once('tcpdf/tcpdf.php');

function generatePDF($factureData) {
    // Create a new TCPDF instance
    $pdf = new TCPDF();
    
    // Set document properties
    $pdf->SetCreator('Your Application Name');
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Facture Data PDF');

    // Add a page
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('times', '', 12);

    // Loop through facture data and add to the PDF
    foreach ($factureData as $facture) {
        $pdf->Cell(0, 10, 'Facture ID: ' . $facture['id_facture'], 0, 1);
        $pdf->Cell(0, 10, 'Mois: ' . $facture['mois'], 0, 1);
        $pdf->Cell(0, 10, 'Consommation: ' . $facture['consommation'], 0, 1);
        $pdf->Cell(0, 10, 'Status: ' . $facture['status'], 0, 1);
        $pdf->Cell(0, 10, 'Prix: ' . calculatePrice($facture['consommation']) . ' DH', 0, 1);
        $pdf->Ln(10); // Add some space between factures
    }

    // Output the PDF
    $pdf->Output('facture_data.pdf', 'D');
}



?>