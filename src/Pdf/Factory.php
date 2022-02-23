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

    /**
     * Error property
     *
     * @var string
     */
    private $Error;

    /**
     * Provider instance
     *
     * @var object
     */
    private $Provider;

    /**
     * Default prefix namespace for call provider
     * 
     * @var string
     */
    private $PrefixNamespace = '\Zein\Pdf\Provider\\';

    /**
     * Template instance
     * 
     * @var object
     */
    private $Template;

    
    public function __construct(object $template)
    {
        if (!empty($template)) 
        {
            // Set template instance
            $this->Template = $template;

            // set provider
            $Class = $this->PrefixNamespace . $template->getProvider();
            $this->Provider = new $Class;
        }
    }

    /**
     * Set Provider Instance
     *
     * @param string $providerName
     * @return void
     */
    public function setProvider(string $providerName)
    {
        $Class = $this->PrefixNamespace . $providerName;

        if (!class_exists($Class)) 
            throw new Exception("Provider {$providerName} not found!", 1);

        $this->Provider = new $Class;

        return $this;
    }

    /**
     * Get PDF provider
     */
    public function getProvider()
    {
        return $this->Provider;
    }

    /**
     * Get PDF provider instance
     *
     * @return void
     */
    public function getPdf()
    {
        if (func_num_args() === 0)
        {
            $Provider = $this->Provider->getInstance();
        }
        else
        {
            $Provider = call_user_func_array([$this->Provider, 'getInstance'], func_get_args());
        }
        
        // Load template
        $Provider->loadTemplate($this->Template);
        
        return  $Provider;
    }
}