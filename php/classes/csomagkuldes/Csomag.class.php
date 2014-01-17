<?php
/**
 * Az osztály névtérben van
 * Az osztály metódusai fluent interface-t valósítanak meg
 * Az osztály kezeli a clone-ozást
 * Az osztály get-set függvényeket használ
 */
namespace csomagkuldes;

class Csomag
{
    protected $suly;
    protected $celOrszag;
    protected $debug = false;

    public function __construct($debug = false)
    {
        $this->debug = $debug;
    }

    public function setSuly($suly)
    {
        if ($this->getDebug()) {
            \Util::debug('A súly értéke: ' . $suly);
        }

        $this->suly = $suly;

        return $this; // fluent interface
    }

    public function setCelOrszag($celOrszag)
    {
        if ($this->getDebug()) {
            \Util::debug('A célország értéke: ' . $celOrszag);
        }

        $this->celOrszag = $celOrszag;

        return $this; // fluent interface
    }

    public function getCelOrszag()
    {
        return $this->celOrszag;
    }

    public function __clone()
    {
        // shallow object copies
        //
        // másolat készítésekor ha a változók értéke objektum akkor azokról nem készül másolat marad referencia.
        // ezt lehet itt kezelni.
    }

    /**
     * Gets the value of suly.
     *
     * @return mixed
     */
    public function getSuly()
    {
        return $this->suly;
    }

    /**
     * Gets the value of debug.
     *
     * @return mixed
     */
    public function getDebug()
    {
        return $this->debug;
    }

    /**
     * Sets the value of debug.
     *
     * @param mixed $debug the debug
     *
     * @return self
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;

        return $this;
    }
}