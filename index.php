<?php

// ÖSSZPONTSZÁM = 400 + 100 (alappont + többletpont)

// alappontok: érettségi eredmények

// érettségi: 0-100% (0-100 pont), 20% (0-20 pont) alatt nincs output!

// kötelezők:
// magyar nyelv és irodalom
// történelem
// matematika

// közép vagy emelt szint

// egy választható mindenképp kell

// ALAPPONTSZÁM = (kötelezők + legjobb választható) * 2

// többletpontok (0-100 pont):
// B2-es 28 pont
// C1-es 40 pont

// emelt 50 pont

// angol B2 + angol C1 = 40 pont

require_once 'homework_input.php';

class Calculator {

    public array $erettsegik;
    public int $kotval_vizsgak = 0;
    public array $kotelezo_targyak = array("magyar nyelv és irodalom", "történelem", "matematika");

    public string $egyetem;
    public string $kar;
    public string $szak;

    public array $kotelezo_targy;
    public array $kotval_targyak;

    public int $alappontszam;
    public int $tobbletpontszam;
    public int $osszpontszam;

    // melyik szakra
     function szakValaszto($valasztott_szak) {

        $this->egyetem = $valasztott_szak['egyetem'];
        $this->kar = $valasztott_szak['kar'];
        $this->szak = $valasztott_szak['szak'];

        if($this->egyetem === "ELTE" && $this->kar === "IK" && $this->szak === "Programtervező informatikus") {
            $this->kotelezo_targy = array("nev"=>"matematika");
            $this->kotval_targyak = array("biológia", "fizika", "informatika", "kémia");
        }
        if($this->egyetem === "PPKE" && $this->kar === "BTK" && $this->szak === "Anglisztika") {
            $this->kotelezo_targy = array("nev"=>"angol", "tipus"=>"emelt");
            $this->kotval_targyak = array("francia", "német", "olasz", "orosz", "spanyol", "történelem");
        }

    }

    function erettsegik($erettsegi_eredmenyek) {
        foreach($erettsegi_eredmenyek as $erettsegi) {
            $this->erettsegik[] = $erettsegi['nev'];
        }
    }

    // kötelező tárgyakból kötelező érettségit tenni
    function megvanMindenKotelezo($kotelezo_targyak) {

        // minden kötelező tárgy szerepel a letett érettségik közt?
        foreach ($kotelezo_targyak as $kotelezo_targy) {
            if(!in_array($kotelezo_targy, $this->erettsegik)) {
                return false; // ha bármelyik is hiányzik, akkor return false
            } else {
                return true;
            }
        }

    }

    // kötvál vizsgáka száma
    function legalabbEgyKotvalVizsga($kotval_tarygak) {
        foreach ($kotval_tarygak as $kotval_targy) {
            if(in_array($kotval_targy, $this->erettsegik)) {
                $this->kotval_vizsgak++;
            }
        }

        return $this->kotval_vizsgak >= 1 ? true : false;

    }

    function calcAlap() {
        $this->alappontszam = ($kotelezo_targyak + $legjobb_valaszthato) * 2;
    }

    function calcTobblet() {
        $this->többletpontszam =  $tmp;
    }

    function calcOssz() {
        $this->osszpontszam = $this->alappontszam + $this->tobbletpontszam;
    }

    function pontszamito($exampleData) {

        $this->szakValaszto($exampleData['valasztott-szak']);
        $this->erettsegik($exampleData['erettsegi-eredmenyek']);

        // ha megvan minden kötelező tárgy
        if($this->megvanMindenKotelezo($this->kotelezo_targyak)) {

            // ha van legalább egy kötvál vizsga
            if($this->legalabbEgyKotvalVizsga($this->kotval_targyak)) {

                // TODO

            } else {
                return "output: hiba, nem lehetséges a pontszámítás a legalább egy kötelezően választható érettségi tárgy hiánya miatt";
            }

        } else {
            return "output: hiba, nem lehetséges a pontszámítás a kötelező érettségi tárgyak hiánya miatt";
        }

        unset($this->erettsegik);

    }

}

$calculator = new Calculator();
echo "1. vizsga összpontszám: ".$calculator->pontszamito($exampleData0)."<br>";
echo "2. vizsga összpontszám: ".$calculator->pontszamito($exampleData1)."<br>";
echo "3. vizsga összpontszám: ".$calculator->pontszamito($exampleData2)."<br>";
echo "4. vizsga összpontszám: ".$calculator->pontszamito($exampleData3)."<br>";
