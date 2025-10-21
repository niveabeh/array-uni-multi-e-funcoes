<!DOCTYPE variavel>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Manipulação de Arrays em PHP</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="container">


        <h1>Manipulação de Arrays em PHP</h1>

        <?php

        $nomes = ["Maria", "João", "Ana", "Carlos", "Beatriz"];

        // Função para imprimir array com índices
        function mostrarArray($array) {
            $variavel = '';
            foreach ($array as $i => $valor) {
                $variavel .= "<div class='linha'>Índice <strong>$i</strong>: $valor</div>";
            }
            return $variavel;
        }
        echo "<div class='exemplo'><h2>Array original:</h2>";
        echo mostrarArray($nomes);
        echo "</div>";



        // 1. Adicionar um nome no final da array
        array_push($nomes, "Pedro");
        echo "<div class='exemplo'><h2>Após array_push('Pedro'):</h2>";
        echo mostrarArray($nomes);
        echo "</div>";





        // 2. Adicionar um nome no começo da array
        array_unshift($nomes, "Lucas");
        echo "<div class='exemplo'><h2>Após array_unshift('Lucas'):</h2>";
        echo mostrarArray($nomes);
        echo "</div>";




        // 3. Remover o último nome da array
        $ultimo = array_pop($nomes);
        echo "<div class='exemplo'><h2>Após array_pop(), removido: <strong>$ultimo</strong></h2>";
        echo mostrarArray($nomes);
        echo "</div>";





        // 4. Remover o primeiro nome da array
        $primeiro = array_shift($nomes);
        echo "<div class='exemplo'><h2>Após array_shift(), removido: <strong>$primeiro</strong></h2>";
        echo mostrarArray($nomes);
        echo "</div>";





        // 5. Ordenar os dados da array em ordem alfabética 
        sort($nomes);
        echo "<div class='exemplo'><h2>Após sort():</h2>";
        echo mostrarArray($nomes);
        echo "</div>";





        // 6. Ordenar os dados da array em ordem reversa (rsort)
        rsort($nomes);
        echo "<div class='exemplo'><h2>Após rsort():</h2>";
        echo mostrarArray($nomes);
        echo "</div>";






        // 7. Contar quantos elementos contém na array 
        $quantidade = count($nomes);
        echo "<div class='exemplo'><h2>Quantidade de nomes:</h2>";
        echo "<div class='linha'><strong>$quantidade</strong></div>";
        echo "</div>";





        // 8. Procurar índice de um nom  
        $busca     = "Ana";
        $palavraProcurada  = array_search($busca, $nomes);
        echo "<div class='exemplo'><h2>Buscar índice do nome '$busca':</h2>";
        if ($palavraProcurada == true) {

            $i = $palavraProcurada;
            
            echo "<div class='linha'>O nome <strong>'$busca'</strong> está no índice: <strong>$i</strong></div>";
        } else {
            echo "<div class='linha'>O nome <strong>'$busca'</strong> não foi encontrado</div>";
        }
        echo "</div>";




        // 9. Inverter a array (array_reverse)
        $ArrayInvertida = array_reverse($nomes);
        echo "<div class='exemplo'><h2>Array invertida (array_reverse):</h2>";
        echo mostrarArray($ArrayInvertida);
        echo "</div>";






        // 10. Transformar array em string (implode)
        $string_nomes = implode(", ", $nomes);
        echo "<div class='exemplo'><h2>Array transformada em string (implode):</h2>";
        echo "<div class='linha'>$string_nomes</div>";
        echo "</div>";




        // 11. Transformar string em array (explode)
        $nova_array = explode(", ", $string_nomes);
        echo "<div class='exemplo'><h2>String transformada de volta em array (explode):</h2>";
        echo mostrarArray($nova_array);
        echo "</div>";




        // 12. Remover elementos duplicados (array_unique)
        $nomes_duplicados = ["Maria", "Ana", "Carlos", "Ana", "João", "Carlos"];
        echo "<div class='exemplo'><h2>Array com duplicados:</h2>";
        echo mostrarArray($nomes_duplicados);
        echo "</div>";

        $unicos = array_unique($nomes_duplicados);
        echo "<div class='exemplo'><h2>Após array_unique():</h2>";
        echo mostrarArray($unicos);
        echo "</div>";





        // 13. Mesclar arrays (array_merge)
        $outros_nomes = ["Fernanda", "Gustavo"];
        $mesclado = array_merge($nomes, $outros_nomes);
        echo "<div class='exemplo'><h2>Após array_merge com outros nomes:</h2>";
        echo mostrarArray($mesclado);
        echo "</div>";




        // 14. Filtrar array (array_filter) - nomes com mais de 4 letras
        $filtrados = array_filter($mesclado, function($nome) {
            return strlen($nome) > 4;
        });
        echo "<div class='exemplo'><h2>Nomes com mais de 4 letras (array_filter):</h2>";
        echo mostrarArray($filtrados);
        echo "</div>";



        ?>

    </div>
</body>
</html>
