<?php

namespace App\Enhancers;

class Asset
{
    protected $AUTHORS           = ["iLyas Farawe", "Kamsi Kodi"];
    protected $APP_NAME          = "M&A - Federal Competition and Consumer Protection Commission";
    protected $SHORT_APP_NAME    = "M&A - FCCPC";
    protected $AGENCY            = "FCCPC";
    protected $AGENCY_LINK       = "http://fccpc.gov.ng";
    protected $COMPANY           = "techbarn";
    protected $COMPANY_LINK      = "https://techbarn.ng";

    protected $DS                = "/";
    protected $ASSETS            =  $this->DS."assets".$this->DS;

    protected $CSS               =  $this->ASSETS."css".$this->DS;
    protected $IMAGE             =  $this->ASSETS."images".$this->DS;
    protected $JS                =  $this->ASSETS."javascript".$this->DS;

    protected $FE_ASSETS         =  $this->ASSETS."frontend".$this->DS;
    protected $FE_CSS            =  $this->FE_ASSETS."css".$this->DS;
    protected $FE_IMAGE          =  $this->FE_ASSETS."images".$this->DS;
    protected $FE_JS             =  $this->FE_ASSETS."javascript".$this->DS;

    protected $BE_ASSETS         =  $this->ASSETS."backend".$this->DS;
    protected $BE_CSS            =  $this->BE_ASSETS."css".$this->DS;
    protected $BE_IMAGE          =  $this->BE_ASSETS."images".$this->DS;
    protected $BE_JS             =  $this->BE_ASSETS."javascript".$this->DS;
    protected $BE_PLUGIN         =  $this->BE_ASSETS."plugins".$this->DS;
    protected $BE_MEDIA          =  $this->BE_ASSETS."media".$this->DS;

    function __get($property)
    {
        if (property_exists($this, $property)) {
            return asset($this->$property);
        }

        return NULL;
    }
}
