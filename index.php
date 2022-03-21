<?php

require_once 'homework_input.php';

class Jelentkezes {

    private array $kotelezo_targyak = array("magyar nyelv és irodalom", "történelem", "matematika");
    private int $minimum_pont = 20;

    private int $kotval_vizsgak = 0;

    private int $kotelezo_targy_ponterteke = 0;
    private int $legjobb_kotval_ponterteke = 0;

    private int $alappontszam = 0;

    // TODO constructor
    private array $dataset = array();

    private string $egyetem = "";
    private string $kar = "";
    private string $szak = "";

    private string $kotelezo_targy = "";
    private array $kotval_targyak = array();

    private array $erettsegik = array();
    private array $erettsegik_kotvalok = array();

    private array $erettsegi_nevek = array();
    private array $erettsegi_pontok = array();

    /***** SETTERS *****/

    private function set_dataset($exampleData) {
        $this->dataset = $exampleData;
    }
    private function set_egyetem_kar_szak() {
        $this->egyetem = $this->dataset['valasztott-szak']['egyetem'];
        $this->kar = $this->dataset['valasztott-szak']['kar'];
        $this->szak = $this->dataset['valasztott-szak']['szak'];
    }
    private function set_kotelezo_targy_kotval_targyak() {
        if($this->egyetem === "ELTE" && $this->kar === "IK" && $this->szak === "Programtervező informatikus") {
            $this->kotelezo_targy = "matematika";
            $this->kotval_targyak = array("biológia", "fizika", "informatika", "kémia");
        }
        if($this->egyetem === "PPKE" && $this->kar === "BTK" && $this->szak === "Anglisztika") {
            $this->kotelezo_targy = "angol";
            $this->kotval_targyak = array("francia", "német", "olasz", "orosz", "spanyol", "történelem");
        }
    }
    private function set_erettsegik() {
        $this->erettsegik = $this->dataset['erettsegi-eredmenyek'];
    }
    private function set_erettsegik_kotvalok() {
        foreach($this->erettsegik as $erettsegi) {
            if(in_array($erettsegi['nev'], $this->kotval_targyak)) {
                $this->erettsegik_kotvalok[] = $erettsegi;
            }
        }
    }
    private function set_erettsegi_nevek() {
        foreach($this->erettsegik as $erettsegi) {
            $this->erettsegi_nevek[] = $erettsegi['nev'];
        }
    }
    private function set_erettsegi_pontok() {
        foreach($this->erettsegik as $erettsegi) {
            // https://stackoverflow.com/questions/2389182/convert-percent-value-to-decimal-value-in-php
            $pct = $erettsegi['eredmeny']; // '15%'
            $int = str_replace('%', '', $pct); // 15
            $this->erettsegi_pontok[] = $int;
        }
    }

    /***** CONDITIONS *****/

    // 1) minden kotelezo targy ott szerepel a letett erettsegik kozt?
    private function megvanMindenKotelezo() {
        foreach ($this->kotelezo_targyak as $kotelezo_targy) {
            if(!in_array($kotelezo_targy, $this->erettsegi_nevek)) {
                return false; // ha csak egyetlen is hianyzik, akkor return false
            } else {
                return true;
            }
        }
    }

    // 2) minden vizsganal megvan a minimum 20%?
    private function megvanAminimumPontszam() {
         foreach($this->erettsegi_pontok as $erettsegi_pont) {
             if($erettsegi_pont < $this->minimum_pont) {
                 return false; // ha barhol kisebb mint 20, akkor return false
             } else {
                 return true;
             }
         }
    }

    // 3) megvan a vizsga a szakhoz kapcsolodo kotelezo targybol?
    private function megvanAkotelezo() {
        return in_array($this->kotelezo_targy, $this->erettsegi_nevek) ? true : false;
    }

    // 4) megvan a legalabb egy kotval?
    private function legalabbEgyKotval() {
        foreach ($this->kotval_targyak as $kotval_targy) {
            if(in_array($kotval_targy, $this->erettsegi_nevek)) {
                $this->kotval_vizsgak++;
            }
        }
        return $this->kotval_vizsgak >= 1 ? true : false;
    }

    /***** ALAPPONTSZAM *****/

    // 1) kotelezo targy ponterteke (alappontszamhoz)
    private function set_kotelezo_targy_ponterteke() {
        foreach($this->erettsegik as $erettsegi) {
            if($erettsegi['nev'] === $this->kotelezo_targy) {
                $pct = $erettsegi['eredmeny']; // '15%'
                $int = str_replace('%', '', $pct); // 15
                $this->kotelezo_targy_ponterteke += $int;
            }
        }
    }

    // 2) legjobban sikerult kotelezoen valaszthato targy ponterteke (alappontszamhoz)
    private function set_legjobb_kotval_ponterteke() {
        $tmp = array();
        foreach($this->erettsegik_kotvalok as $erettsegi_kotval) {
            $pct = $erettsegi_kotval['eredmeny']; // '15%'
            $int = str_replace('%', '', $pct); // 15
            $tmp[] = $int;
        }
        $this->legjobb_kotval_ponterteke = max($tmp);
    }

    // 3) alappontszam = (kotelezoTargyakPonterteke + legjobbKotvalPonterteke) * 2
    private function set_alappontszam() {
        $this->alappontszam = ($this->kotelezo_targy_ponterteke + $this->legjobb_kotval_ponterteke) * 2;
    }

    public function pontszamitas($exampleData) {

        // TODO constructor
        $this->set_dataset($exampleData);

        $this->set_egyetem_kar_szak();
        $this->set_kotelezo_targy_kotval_targyak();

        $this->set_erettsegik();
        $this->set_erettsegik_kotvalok();

        $this->set_erettsegi_nevek();
        $this->set_erettsegi_pontok();

        $this->set_kotelezo_targy_ponterteke();
        $this->set_legjobb_kotval_ponterteke();
        $this->set_alappontszam();

        if($this->megvanMindenKotelezo()) {
            if($this->megvanAminimumPontszam()) {
                if($this->megvanAkotelezo()) {
                    if($this->legalabbEgyKotval()) {

                        return $this->alappontszam;

                    } else {
                        return "nincs meg legalább egy kötvál";
                    }
                } else {
                    return "nincs meg a szakhoz tartozó kötelező tárgy";
                }
            } else {
                return "valahol nincs meg a minimum pontszám (20%)";
            }
        } else {
            return "nincs meg minden kötelező tárgy";
        }

    }

}

$jelentkezes1 = new Jelentkezes();
echo "1. érettségi összpontszám: ".$jelentkezes1->pontszamitas($exampleData1)."<br>";

$jelentkezes2 = new Jelentkezes();
echo "2. érettségi összpontszám: ".$jelentkezes2->pontszamitas($exampleData2)."<br>";

$jelentkezes3 = new Jelentkezes();
echo "3. érettségi összpontszám: ".$jelentkezes3->pontszamitas($exampleData3)."<br>";

$jelentkezes4 = new Jelentkezes();
echo "4. érettségi összpontszám: ".$jelentkezes4->pontszamitas($exampleData4)."<br>";