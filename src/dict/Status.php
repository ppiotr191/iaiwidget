<?php

namespace AppWidget\dict;

class Status implements IDict{
    
    private $values;

    public function __construct(){
        $this->values = [
            'finished_ext' => 'Realizowane w programie F/K',
            'finished' => 'Wykonane',
            'new' => 'Nieobsłużone',
            'payment_waiting' => 'Oczekuje na wpłatę',
            'delivery_waiting' => 'Oczekuje na dostawę',
            'on_order' => 'Realizowane',
            'packed' => 'Pakowane',
            'packed_ready' => 'Spakowane',
            'ready' => 'Gotowe',
            'wait_for_dispatch' => 'Oczekuje na termin wysłania',
            'suspended' => 'Wstrzymane',
            'missing' => 'Zgubione',
            'lost' => 'Stracone',
            'false' => 'Fałszywe',
            'canceled' => 'Klient anulował',
        ];
    }

    public function getValues(){
        return $this->values;
    }
}