<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-02-23 07:31:56
 * @modify date 2022-02-23 07:31:56
 * @license GPLv3
 * @desc [description]
 */

namespace Zein\Pdf;

interface Template
{    
    /**
     * Set PDF instance
     */
    public function setPdf(object $Pdf);

    /**
     * Get template provider
     */
    public function getProvider();

    /**
     * Set template provider
     */
    public function setProvider(string $providerName);

    /**
     * Render pdf based on method which generated
     */
    public function render();
}