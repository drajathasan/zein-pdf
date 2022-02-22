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
    /**
     * Template instance
     *
     * @var object
     */
    private $template;

    /**
     * Get core PDF provider instance
     *
     * @param string $orientation
     * @param string $unit
     * @param string $size
     * @return object
     */
    public function getInstance(string $orientation = 'P', string $unit = 'mm', string $size = 'letter')
    {
        parent::__construct($orientation, $unit, $size);
        return $this;
    }

    /**
     * Load user template instance
     *
     * @param object $Template
     * @return void
     */
    public function loadTemplate(object $Template)
    {
        $this->template = $Template;
    }

    /**
     * Get template instance
     *
     * @return value
     */
    public function getTemplate($callback = '')
    {
        if (is_callable($callback)) return $callback($this->template);
        
        return $this->template;
    }

    /**
     * Generate user method
     *
     * @param string $subTemplae
     * @return void
     */
    public function generate(string $subTemplae)
    {
        $this->template->{$subTemplae}($this);
    }
}