<?php
require('fpdf.php'); // Include your PDF library

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $name = $_POST["name"];
    $age  = $_POST["age"];
    // Retrieve signature data
    $signatureData = $_POST["signature"];

    // Add other input fields

    // Generate PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    // set pdf background image
    $pdf->Image('./assets/img/bg.png', 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());

    $pdf->SetFont('helvetica', '', 13.5);
    // Add content to the PDF
    $pdf->Cell(40, 70, 'Name: ' . $name);
    $pdf->Cell(40, 90, 'Age: ' . $age); // Align to the left by default
    // Add signature as an image
    if (!empty($signatureData)) {
        // Decode the base64-encoded image data
        $signatureImage = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signatureData));

        // Save the signature image as a file
        $signatureImagePath = 'signature.png';
        file_put_contents($signatureImagePath, $signatureImage);

        // Add the signature image to the PDF
        $pdf->Image($signatureImagePath, 100, 120, 100, 40);
        // Adjust the position and size as needed

        // Remove the temporary signature image file
        unlink($signatureImagePath);
    }
    $pdf->Cell(100,120,'signature');
    // Add other content to the PDF

    $outputPath = 'output.pdf';

    // Check if the form was submitted for preview
    if (isset($_POST['preview'])) {
        // Provide the generated PDF for inline viewing
        $pdf->Output('I');
    } else {
        // Save the PDF file for download
        $pdf->Output($outputPath, 'F');
        header('Content-Disposition: attachment; filename="output.pdf"');
        readfile($outputPath);
    }
}
