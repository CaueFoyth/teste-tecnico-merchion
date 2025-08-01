<?php

// Abstração + Herança
abstract class Produto {
    protected $nome;
    protected $preco;

    public function __construct($nome, $preco) {
        $this->nome = $nome;
        $this->preco = $preco;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getPreco() {
        return $this->preco;
    }

    // Polimorfismo
    abstract public function calcularPrecoFinal();
}

class ProdutoFisico extends Produto {
    private $peso;

    public function __construct($nome, $preco, $peso) {
        parent::__construct($nome, $preco);
        $this->peso = $peso;
    }

    public function calcularPrecoFinal() {
        return $this->preco + ($this->peso * 2); // frete simples
    }
}

class ProdutoDigital extends Produto {
    private $tamanho;

    public function __construct($nome, $preco, $tamanho) {
        parent::__construct($nome, $preco);
        $this->tamanho = $tamanho;
    }

    public function calcularPrecoFinal() {
        return $this->preco; // sem frete
    }
}

// Pedido usa encapsulamento
class Pedido {
    private $produtos = [];

    public function adicionarProduto(Produto $produto) {
        $this->produtos[] = $produto;
    }

    public function calcularTotal() {
        $total = 0;
        foreach ($this->produtos as $p) {
            $total += $p->calcularPrecoFinal(); // polimorfismo
        }
        return $total;
    }

    public function listarProdutos() {
        foreach ($this->produtos as $p) {
            echo "- {$p->getNome()} (R$ " . number_format($p->calcularPrecoFinal(), 2) . ")\n";
        }
    }
}

// ---------- Teste final ----------
$pedido = new Pedido();

$pedido->adicionarProduto(new ProdutoFisico("Notebook", 3030, 2.5));
$pedido->adicionarProduto(new ProdutoDigital("Curso PHP", 199.90, 1500));

echo "Produtos no pedido:\n";
$pedido->listarProdutos();

echo "\nTotal do pedido: R$ " . number_format($pedido->calcularTotal(), 2) . "\n";
