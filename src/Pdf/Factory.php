<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-02-22 14:01:56
 * @modify date 2022-02-22 14:01:56
 * @license GPLv3
 * @desc [description]
 */

namespace Zein\Pdf;

use Exception;

class Factory
{

    use Error;

    private $Error;
    private $Provider;

    public function setProvider(string $providerName)
    {
        $Class = '\Zein\Pdf\Provider\\' . $providerName;

        if (!class_exists($Class)) 
            throw new Exception("Provider {$providerName} not found!", 1);

        try {
            $this->Provider = new $Class;
        } catch (Exception $e) {
            $this->Error = $e->getMessage();
        }

        return $this;
    }

    public function getPdf()
    {
        if (func_num_args() === 0)
            return $this->Provider->getInstance();

        return call_user_func_array([$this->Provider, 'getInstance'], func_get_args());
    }
}