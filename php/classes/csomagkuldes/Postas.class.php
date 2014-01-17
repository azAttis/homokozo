<?php
namespace csomagkuldes;

class Postas
{
    public $nev;
    public $szarmazasi_orszag;

    public function __construct($nev)
    {
        $this->nev = $nev;

        return true;
    }

    public function __destruct()
    {
    }

    public function kuld(Csomag $csomag)
    {
        // csomag kuldese a celba

        return true;
    }

    public function kuldesDijanakKiszamitasa(Csomag $csomag)
    {
        // a célhoz érvényes ráta kikeresése
        $rata = $this->getCsomagkuldesDijaOrszagba($csomag->getCelOrszag());

        // koltsegszamitas
        $koltseg = $rata * $csomag->suly;

        return $koltseg;
    }

    /**
     * A private jelölés miatt egyértelmú, hogy csak ezen osztályon belüli felhasználásra van tervezve a függvény.
     *
     * @param  string $orszag
     * @return float
     */
    private function getCsomagkuldesDijaOrszagba($orszag)
    {
        // itt kéne számolna országspecifikusan

        return 1.2;
    }

    public static function getPostasokOrszagonkent($orszag)
    {
        // postasok listáját adaja vissza származási ország szerint

        // minden postásnak létrehoz egy Postas objektumot

        // visszaadja a válaszobejektumok tömbjét

        return $postasok_listaja;
    }
}