<?php
/**
 * @author Drajat Hasan
 * @email drajathasan20@gmail.com
 * @create date 2022-02-22 14:01:56
 * @modify date 2022-06-09 07:48:49
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

    
    public function __construct($template = '')
    {
        if (is_object($template))
        {
            // set template
            $this->setTemplate($template);
            // set provider
            $this->setProvider($this->Template->getProvider());
        }
    }

    /**
     * Method to set template instance
     *
     * @param object $template
     * @return void
     */
    public function setTemplate(object $template)
    {
        if (!$template instanceof TemplateContract) 
        {
            throw new Exception("Provider {$providerNameOrClass} not fullable template contract!", 1);
        }

        // Set template instance
        $this->Template = $template;
    }

    /**
     * Set Provider Instance
     *
     * @param string $providerName
     * @return void
     */
    public function setProvider(string $providerNameOrClass)
    {            
        if (class_exists($Class = $this->PrefixNamespace . $providerNameOrClass))
        {
            $this->Provider = new $Class;    
        }
        else if (class_exists($providerNameOrClass))
        {
            $this->Provider = new $providerNameOrClass;
        }
        else
        {
            throw new Exception("Provider {$providerNameOrClass} not found!", 1);
        }

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