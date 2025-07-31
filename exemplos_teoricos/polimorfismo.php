<?php

// Classe base
abstract class Animal {
    protected $nome;

    public function __construct($nome) {
        $this->nome = $nome;
    }

    // Método abstrato (obrigatório nas subclasses)
    abstract public function fazerSom();
}

// Subclasse: Cachorro
class Cachorro extends Animal {
    public function fazerSom() {
        echo "{$this->nome} diz: Au au!\n";
    }
}

// Subclasse: Gato
class Gato extends Animal {
    public function fazerSom() {
        echo "{$this->nome} diz: Miau!\n";
    }
}

// Função que aceita qualquer Animal
function emitirSomDoAnimal(Animal $animal) {
    $animal->fazerSom();
}

// ----- Testando o polimorfismo -----

$animais = [
    new Cachorro("Rex"),
    new Gato("Mingau"),
];

foreach ($animais as $animal) {
    emitirSomDoAnimal($animal); // Cada animal reage com seu som específico
}
