<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-02-22 14:03:16
 * @modify date 2022-02-22 14:03:16
 * @license GPLv3
 * @desc [description]
 */

namespace Zein\Pdf;

interface FactoryInterface
{
    public function loadTemplate(object $Template);
    public function generate(string $subTemplae);
}