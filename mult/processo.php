
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style.css" />
    <title>Supermecado Tchê</title>
</head>

<body>
    <section>
        <form method="POST" class="formulario">
            <h1>Cadastro de Estoque</h1>
            <label for="nome">Nome do Produto:</label>
            <input type="text" name="nome" id="nome" />

            <label for="preco">Preço (R$):</label>
            <input type="number" name="preco" id="preco"/>

            <label for="estoque">Quantidade em Estoque:</label>
            <input type="number" name="estoque" id="estoque" />

            <button type="submit">Cadastrar</button>
        </form>

        <?php

        session_start();

        // Inicializando nossa Session na primeira vez

        // Inicializa o array produtos na sessão
        if (!isset($_SESSION['produtos'])) {
            $_SESSION['produtos'] = [
                "nomes" => [],
                "precos" => [],
                "estoques" => []
            ];

            // dentro de produtos há mais 3 arrays, como nomes , precos e estoques
        }

        // Função para excluir produto pelo índice

        function excluirProduto($indice)
        {   
            // verifica se existe um array de produtos com uma array de nomes e o seu indice
            if (isset($_SESSION['produtos']['nomes'][$indice])) {

                // remover / cortar , um elemento a partir do indice, o 1 se refere ao corte , ou seja, apenas o valor do indice que queremos.
                array_splice($_SESSION['produtos']['nomes'], $indice, 1);
                array_splice($_SESSION['produtos']['precos'], $indice, 1);
                array_splice($_SESSION['produtos']['estoques'], $indice, 1);
                return true;
            }

            // se ele não conseguir remover / achar o item para remover ele irá retornar falso
            return false;
        }

        // Verifica se é POST para tratar dados

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // puxa o valor do nosso botão ao clicar 
            $botao = $_POST['excluir'] ?? "";

            if ($botao >= 0) {
                // Excluir produto
                if (excluirProduto($botao)) {
                    echo "<p>Produto excluído com sucesso!</p>";
                } else {
                    echo "<p>Erro: Produto não encontrado.</p>";
                }
            } 
            else {
                
                // remove os espaços em branco ou transforma em string vazia se for nulo
                $nome = trim($_POST["nome"]) ?? "";

                //transforma em string vazia se for nulo
                $preco = $_POST["preco"] ?? "";
                $estoque = $_POST["estoque"] ?? "";

                // Validação
                if ($nome === "" || !is_numeric($preco) || !is_numeric($estoque)) {
                    echo "<p>Preencha todos os campos corretamente!</p>";
                } else {
                    
                    // convertendo os valores para inteiro e real
                    $preco = (float)$preco;
                    $estoque = (int)$estoque;

                    if ($preco <= 0 || $estoque <= 0) {
                        echo "<p>Preço e estoque devem ser maiores que zero!</p>";
                    } else {
                        
                        //armazena os valores em cada array 
                        $_SESSION['produtos']['nomes'][] = $nome;
                        $_SESSION['produtos']['precos'][] = $preco;
                        $_SESSION['produtos']['estoques'][] = $estoque;
                        echo "<p>Produto cadastrado com sucesso!</p>";
                    }
                }
            }

            // valida novamente caso a sessão tenha um valor vazio em nomes.
            if (!empty($_SESSION['produtos']['nomes'])) {
                echo "<div class='container_resposta'>";
                echo "<h2>Estoque de Produtos</h2>";
                echo "<table>
                    <tr>
                        <th>Nome</th>
                        <th>Preço (R$)</th>
                        <th>Estoque</th>
                        <th>Ações</th>
                    </tr>";

                    // laço de repetição que executa conforme o tamanho da array / session nomes
                for ($i = 0; $i < count($_SESSION['produtos']['nomes']); $i++) {
                    echo "<tr>";
                    // Mostra os valores de cada indice, por isso o [$i].
                    echo "<td>" . htmlspecialchars($_SESSION['produtos']['nomes'][$i]) . "</td>";
                    // formata o valor para duas casas decimais.
                    echo "<td>" . number_format($_SESSION['produtos']['precos'][$i], 2, ',', '.') . "</td>";
                    echo "<td>" . $_SESSION['produtos']['estoques'][$i] . "</td>";
                    // Botão para excluir o produto
                    echo "<td>
                        <form method='POST'>
                        <button type='submit' name='excluir' value='$i'>Excluir</button>
                        </form>

                    </td>";
                    // aqui cada item recebe um botão e o mesmo recebe um valor de indice, ao clicar ele executa a função de excluir.
                    echo "</tr>";
                }
                echo "</table></div>";
            }
        }
        ?>
    </section>
</body>

</html>



<!-- /// Session ['produtos'] = [
    
        "nomes" =>      ['Maçã','Água'],
        "preco" =>      ['1.50','5.00'],
        "estoque" =>    ['4','2']
    
    ]

    Ao mostrar ficaria :

    Nome | Preco | Estoque |      Ação       | indice 

    Maçã | 1.50  |   4     | Excluir (botão) | 0 
    Água | 5.00  |   2     | Excluir (botão) | 1

    Ao clicar em excluir,como o botão está recebendo o valor do indice, ele envia o mesmo para o servidor que executa a função de excluir a partir do indice.  -->
