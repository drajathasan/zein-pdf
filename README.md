## Example

```PHP
<?php
use Zein\Pdf\Factory;

require __DIR__ . '/../vendor/autoload.php';

class Template
{
    public function baspus(object $Pdf)
    {
        $Pdf->AddPage();
        $Pdf->SetFont('Arial','B',16);
        $Pdf->Cell(40,10,'Hello World!');
        $Pdf->Output();
    }
}

$Factory = new Factory;

try {
    $Factory->setProvider('Fpdf\Fpdf');
    $Pdf = $Factory->getPdf();
    $Pdf->loadTemplate(new Template);
    $Pdf->generate('baspus');
} catch (Exception $e) {
    die($e->getMessage());
}
```