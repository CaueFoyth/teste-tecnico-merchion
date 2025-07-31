<?php

class CaixaDeBrinquedos {
    // Atributo privado: ninguém de fora pode acessar diretamente
    private $brinquedos = [];

    // Atributo protegido: só a classe e seus filhos podem acessar
    protected $dono;

    // Atributo público: pode ser acessado de fora
    public $descricao;

    // Construtor
    public function __construct($descricao, $dono) {
        $this->descricao = $descricao;
        $this->dono = $dono;
    }

    // Método público: qualquer um pode usar para adicionar brinquedos
    public function adicionarBrinquedo($brinquedo) {
        $this->brinquedos[] = $brinquedo;
        echo "Brinquedo '$brinquedo' adicionado à caixa.\n";
    }

    // Método público: mostra quantos brinquedos tem na caixa
    public function contarBrinquedos() {
        return count($this->brinquedos);
    }

    // Método privado: usado apenas internamente pela classe
    private function listarBrinquedos() {
        return implode(', ', $this->brinquedos);
    }

    // Método público para mostrar os brinquedos (de forma controlada)
    public function mostrarBrinquedos() {
        echo "Brinquedos na caixa: " . $this->listarBrinquedos() . "\n";
    }
}

// Criando um objeto da classe
$caixa = new CaixaDeBrinquedos("Caixa colorida com tampa", "Maria");

// Usando métodos públicos para interagir com a caixa
$caixa->adicionarBrinquedo("Carrinho");
$caixa->adicionarBrinquedo("Boneca");

echo "Descrição da caixa: {$caixa->descricao}\n";
echo "Total de brinquedos: " . $caixa->contarBrinquedos() . "\n";

$caixa->mostrarBrinquedos();

// Abaixo estão exemplos de tentativas inválidas (gerariam erro)

echo $caixa->brinquedos; // ERRO: $brinquedos é private
echo $caixa->dono;        // ERRO: $dono é protected
$caixa->listarBrinquedos(); // ERRO: método private
