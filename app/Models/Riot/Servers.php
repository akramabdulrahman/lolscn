<?php

namespace App\Models\Riot;

class Servers {

    const BR = 'br';
    const EUNE = 'eune';
    const EUW = 'euw';
    const KR = 'kr';
    const LAN = 'lan';
    const LAS = 'las';
    const NA = 'na';
    const OCE = 'oce';
    const RU = 'ru';
    const TR = 'tr';

    public function platform($region) {
        $platform = '';
        switch ($region) {
            case $this->BR : $platform = 'BR1';
                break;
            case $this->EUNE : $platform = 'EUN1';
                break;
            case $this->EUW : $platform = 'EUW1';
                break;
            case $this->LAN : $platform = 'LA1';
                break;
            case $this->LAS : $platform = 'LA2';
                break;
            case $this->NA : $platform = 'NA1';
                break;
            case $this->OCE :$platform = 'OC1';
                break;
            case $this->RU : $platform = 'RU';
                break;
            case $this->TR : $platform = 'TR1';
                break;

            default:
                $platform = false;
                break;
        }
        return $platform;
    }

}
