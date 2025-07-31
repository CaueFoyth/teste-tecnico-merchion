<?php

// Classe abstrata representando um carro genérico
abstract class Carro {
    // Atributos principais (visíveis)
    protected $marca;
    protected $modelo;
    protected $ano;
    protected $cor;

    // Construtor
    public function __construct($marca, $modelo, $ano, $cor) {
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->ano = $ano;
        $this->cor = $cor;
    }

    // Métodos abstratos: o "que" o carro faz (não o "como")
    abstract public function ligar();
    abstract public function acelerar();
    abstract public function frear();

    // Método para mostrar informações básicas
    public function mostrarInformacoes() {
        echo "Marca: {$this->marca}\n";
        echo "Modelo: {$this->modelo}\n";
        echo "Ano: {$this->ano}\n";
        echo "Cor: {$this->cor}\n";
    }
}

// Uma implementação concreta da classe Carro
class CarroEsportivo extends Carro {

    public function ligar() {
        echo "O carro esportivo foi ligado com botão Start/Stop.\n";
    }

    public function acelerar() {
        echo "O carro está acelerando rapidamente!\n";
    }

    public function frear() {
        echo "O carro está freando com freios ABS.\n";
    }
}

// Utilização
$meuCarro = new CarroEsportivo("Ferrari", "488 GTB", 2020, "Vermelho");

$meuCarro->mostrarInformacoes();
$meuCarro->ligar();
$meuCarro->acelerar();
$meuCarro->frear();
// 