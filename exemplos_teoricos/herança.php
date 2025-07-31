<?php

// Classe base (genérica)
class Veiculo {
    protected $marca;
    protected $modelo;

    public function __construct($marca, $modelo) {
        $this->marca = $marca;
        $this->modelo = $modelo;
    }

    public function ligar() {
        echo "O veículo {$this->marca} {$this->modelo} está ligado.\n";
    }

    public function desligar() {
        echo "O veículo {$this->marca} {$this->modelo} está desligado.\n";
    }

    public function mostrarInformacoes() {
        echo "Marca: {$this->marca}\n";
        echo "Modelo: {$this->modelo}\n";
    }
}

// Classe Carro que herda de Veiculo
class Carro extends Veiculo {
    private $portas;

    public function __construct($marca, $modelo, $portas) {
        parent::__construct($marca, $modelo); // chama o construtor da classe pai
        $this->portas = $portas;
    }

    public function mostrarInformacoes() {
        parent::mostrarInformacoes(); // reutiliza o método da classe pai
        echo "Portas: {$this->portas}\n";
    }

    public function buzinar() {
        echo "Carro buzinando: Bibi!\n";
    }
}

// Classe Moto que herda de Veiculo
class Moto extends Veiculo {
    private $cilindradas;

    public function __construct($marca, $modelo, $cilindradas) {
        parent::__construct($marca, $modelo);
        $this->cilindradas = $cilindradas;
    }

    public function mostrarInformacoes() {
        parent::mostrarInformacoes();
        echo "Cilindradas: {$this->cilindradas}cc\n";
    }

    public function empinar() {
        echo "A moto está empinando!\n";
    }
}

// ----- Testando as classes -----

$carro = new Carro("Toyota", "Corolla", 4);
$moto = new Moto("Honda", "CB500", 500);

echo "--- Carro ---\n";
$carro->ligar();
$carro->mostrarInformacoes();
$carro->buzinar();
$carro->desligar();

echo "\n--- Moto ---\n";
$moto->ligar();
$moto->mostrarInformacoes();
$moto->empinar();
$moto->desligar();
