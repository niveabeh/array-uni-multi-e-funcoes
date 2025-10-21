<?php
session_start();

// Inicializa array de nomes na sessão, se ainda não existir
if (!isset($_SESSION['nomes'])) {
    $_SESSION['nomes'] = [];
}

// Recebendo os dados
$valor_nome = $_POST['nome'] ?? '';

//Recebendo a ação
$acao = $_POST['acao'] ?? '';

$valor_acao = validar($acao);
$valor_nome = validar($valor_nome);

// Referência ao array de nomes da sessão
//O & é uma referência
//Estou referenciando o array de nomes da sessão
//ambos os arrays apontam para o mesmo lugar
$nomes = &$_SESSION['nomes'];

//Função para validar os dados
function validar($valor)
{
    //se tiver espaços em branco, tirar os espaços em branco
    $valor = trim($valor);
    //tirar os caracteres especiais
    $valor = htmlspecialchars($valor);
    return $valor;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container-resp">
        <h1>Resultado da Ação: <?php echo $valor_acao; ?></h1>
        <div class="container-mensagem">
            <?php

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                switch ($valor_acao) {
                    // Caso a ação seja armazenar
                    case 'armazenar':
                        // Verifica se o nome foi digitado
                        if (!empty($valor_nome)) {
                            // Armazena o nome no array
                            $nomes[] = $valor_nome;
                            // Exibe uma mensagem
                            echo "Nome <strong>$valor_nome</strong> foi armazenado com sucesso!";
                        } else {
                            echo "Nenhum nome informado.";
                        }
                        break;
                                    
                    case 'buscar':
                        if (in_array($valor_nome, $nomes)) {
                            // Busca o nome no array
                            $posicao = array_search($valor_nome, $nomes);
                            echo "O nome <strong>$valor_nome</strong> está na posição <strong>$posicao</strong> do array.";
                        } else {
                            echo "O nome <strong>$valor_nome</strong> não foi encontrado.";
                        }
                        break;

                    case 'ordenar':
                        // Ordena o array
                        sort($nomes);
                        echo "<h3>Nomes Ordenados:</h3><ul>";
                        // Exibe o array
                        foreach ($nomes as $nome) {
                            echo "<li>$nome</li>";
                        }
                        echo "</ul>";
                        break;

                    case 'inverter':

                        // Inverte o array
                        $invertido = array_reverse($nomes);
                        echo "<h3>Nomes na Ordem Invertida:</h3><ul>";
                        foreach ($invertido as $nome) {
                            echo "<li>$nome</li>";
                        }
                        echo "</ul>";
                        break;

                    case 'contar':
                        // Conta o array
                        echo "Há <strong>" . count($nomes) . "</strong> nomes armazenados.";
                        break;

                    case 'mostrar':
                        echo "<h3>Todos os Nomes Armazenados:</h3><ul>";
                        //Exibe o conteudo do array
                        foreach ($nomes as $nome) {
                            echo "<li>$nome</li>";
                        }
                        echo "</ul>";
                        break;

                    case 'limpar':
                        // Limpa o array
                        session_destroy();
                        echo "A lista de nomes foi <strong>limpa</strong> com sucesso.";
                        break;

                    default:
                        echo "Ação inválida.";
                        break;
                }
            }
            ?>
        </div>
        <br><br>
        <a class="voltar" href="index.html">Voltar</a>
    </div>
</body>

</html>


