<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-02-22 14:09:15
 * @modify date 2022-02-22 14:09:15
 * @license GPLv3
 * @desc [description]
 */

namespace Zein\Pdf\Provider\Fpdf;

use Fpdf\Fpdf as CorePDF;
use Zein\Pdf\FactoryInterface;

class Fpdf extends CorePDF implements FactoryInterface
{
    private $template;

    public function getInstance(string $orientation = 'P', string $unit = 'mm', string $size = 'letter')
    {
        parent::__construct($orientation, $unit, $size);
        return $this;
    }

    public function loadTemplate(object $Template)
    {
        $this->template = $Template;
    }

    public function generate(string $subTemplae)
    {
        $this->template->{$subTemplae}($this);
    }
}