## Example

```PHP
<?php
use Zein\Pdf\{Factory,Template,TemplateContract};

require __DIR__ . '/../vendor/autoload.php';

class IttpTemplate extends TemplateContract implements Template
{
    protected $Pdf;
    protected $Provider = 'Fpdf\Fpdf';
    
    public function setPdf(object $Pdf)
    {
        $this->Pdf = $Pdf;
        return $this;
    }

    public function getProvider()
    {
        return $this->Provider;
    }

    public function setProvider(string $providerName)
    {
        $this->Provider = $providerName;
    }

    public function baspus()
    {
        $this->Pdf->AddPage();
        $this->Pdf->SetFont('Arial','B',16);
        $this->Pdf->Cell(40,10,'Hello World!');
    }

    public function render()
    {
        $this->Pdf->Output();
    }
}

$Factory = new Factory;
$Template = new IttpTemplate;

try {
    $Factory->setProvider($Template->getProvider());
    $Pdf = $Factory->getPdf();
    $Pdf->loadTemplate($Template);
    $Pdf->generate('baspus')->render();
} catch (Exception $e) {
    die($e->getMessage());
}
```