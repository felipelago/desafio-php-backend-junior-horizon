<?php

class NotaEntity {

    public $id;
    public $onda_id;
    public $notaParcial1;
    public $notaParcial2;
    public $notaParcial3;

    public function __construct($id, $onda_id, $notaParcial1, $notaParcial2, $notaParcial3) {
        $this->id = $id;
        $this->onda_id = $onda_id;
        $this->notaParcial1 = $notaParcial1;
        $this->notaParcial2 = $notaParcial2;
        $this->notaParcial3 = $notaParcial3;
    }
    
    public function calcularMedia(){
        return ($this->notaParcial1 + $this->notaParcial2 + $this->notaParcial3) / 3;
    }
}