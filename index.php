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

    public array $kotelezo_targyak = array("magyar nyelv és irodalom", "történelem", "matematika");

    public int $alappontszam;
    public int $tobbletpontszam;
    public int $osszpontszam;

    function vanMindenKitelezo($kotelezo_targyak, $exampleData) {

        // 1) kigyűjtjük a letett érettségiket
        $erettsegik = array();
        foreach($exampleData['erettsegi-eredmenyek'] as $erettsegi) {
            $erettsegik[] = $erettsegi['nev'];
        }

        // 2) megnézzük, hogy minden kötelező köztük van e
        foreach ($kotelezo_targyak as $kotelezo_targy) {
            if(!in_array($kotelezo_targy, $erettsegik)) {
                return false; // ha bármelyik is hiányzik, akkor return false
            } else {
                return true;
            }
        }

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

        // ha nincs meg minden kötelező tárgy
        if(!$this->vanMindenKitelezo($this->kotelezo_targyak, $exampleData)) {
            return "output: hiba, nem lehetséges a pontszámítás a kötelező érettségi tárgyak hiánya miatt";
        } else {
            return "megvan minden kötelező tárgy";
        }

    }

}

$calculator = new Calculator();
echo $calculator->pontszamito($exampleData0)."<br>";
echo $calculator->pontszamito($exampleData1)."<br>";
echo $calculator->pontszamito($exampleData2)."<br>";
echo $calculator->pontszamito($exampleData3)."<br>";
