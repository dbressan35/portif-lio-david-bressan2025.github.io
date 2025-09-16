<?php       //CONEXÃO DO BANCO DE DADOS
$host = 'localhost';  
$dbname = 'dr_mentor_db';
$user = 'root';
$pass = 'root';
            //INSERINDO DADOS NO BANCO
try {
    // Cria uma nova conexão PDO com o banco de dados MySQL usando as variáveis $host, $dbname, $user e $pass
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);

    // Define o modo de tratamento de erros do PDO para exceção (lançar erros com mensagens)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifica se o parâmetro 'todos' foi enviado pela URL (GET)
    if (isset($_GET['todos'])) {
        // Se 'todos' estiver definido, realiza uma consulta SQL para selecionar *todos* os registros da tabela 'estudos'
        $stmt = $pdo->query("SELECT * FROM estudos");
    } 
    // Caso contrário, verifica se foi enviado um parâmetro 'nome' e se ele não está vazio
    elseif (!empty($_GET['nome'])) {
        // Monta o parâmetro de busca adicionando % para realizar a pesquisa do tipo LIKE no SQL
        $nome = "%" . $_GET['nome'] . "%";

        // Prepara a consulta SQL com um parâmetro nomeado (:nome) para evitar SQL Injection
        $stmt = $pdo->prepare("SELECT * FROM estudos WHERE nome_completo LIKE :nome");

        // Executa a consulta passando o valor real para o parâmetro :nome
        $stmt->execute([':nome' => $nome]);
    } 
    else {
        // Caso nenhum parâmetro 'todos' ou 'nome' seja fornecido na URL, exibe uma mensagem e encerra o script
        echo "<p>Nenhum nome informado para busca.</p>";
        echo '<a href="buscar_estudos.html">← Voltar</a>';
        exit;
    }

    // Obtém todos os resultados da consulta como um array associativo
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <title>Resultados da Busca</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 40px auto;
                max-width: 1400px;
                padding: 20px;
                background-color: rgb(221, 221, 221);
            }

            table {
                width: 100%;
                border-collapse: collapse;
                background-color: #d4edda;
                font-size: 11px;
                table-layout: fixed;
            }

            th,
            td {
                border: 1px solid #ccc;
                padding: 14px 10px;
                text-align: left;
                vertical-align: auto;
                word-wrap: break-word;
            }

            th {
                background-color: #a3cfbb;
                font-weight: bold;
            }

            th:nth-child(1) {
                width: 4%;
            }

            th:nth-child(2) {
                width: 18%;
            }

            th:nth-child(3) {
                width: 14%;
            }

            th:nth-child(4) {
                width: 10%;
            }

            th:nth-child(5) {
                width: 10%;
            }

            th:nth-child(6) {
                width: 10%;
            }

            th:nth-child(7) {
                width: 10%;
            }

            th:nth-child(8) {
                width: 15%;
            }

            th:nth-child(9) {
                width: 15%;
            }

            th:nth-child(10) {
                width: 20%;
            }

            th:nth-child(11) {
                width: 15%;
            }

            h1 {
                color: #155724;
                margin-bottom: 20px;
            }

            a {
                display: inline-block;
                margin-top: 20px;
                text-decoration: none;
                color: #155724;
                font-weight: bold;
            }
        </style>
    </head>

    <body>

        <h1>Resultado de mentorado cadastrado no sistema:</h1>

       <?php
    // Verifica se a consulta retornou algum resultado
    if (count($resultados) > 0) {

        // Inicia a criação da tabela HTML
        echo "<table>";

        // Cria a linha de cabeçalho da tabela com os nomes das colunas
        echo "<tr>
                <th>ID</th>
                <th>Email</th>
                <th>Nome Completo</th>
                <th>Telefone</th>
                <th>Data de Nascimento</th>
                <th>Tempo de Estudo</th>
                <th>Dia da Semana</th>
                <th>Conteúdo que Gosta</th>
                <th>Conteúdo que Precisa</th>
                <th>Finalidade do Estudo</th>
                <th>Conheceu Por</th>
              </tr>";

        // Percorre o array de resultados ($resultados), linha por linha
        foreach ($resultados as $linha) {
            echo "<tr>"; // Inicia uma nova linha na tabela

            // Exibe o conteúdo de cada coluna da linha atual
            echo "<td>{$linha['id']}</td>";
            echo "<td>{$linha['email']}</td>";
            echo "<td>{$linha['nome_completo']}</td>";
            echo "<td>{$linha['telefone']}</td>";
            echo "<td>{$linha['data_nascimento']}</td>";
            echo "<td>{$linha['tempo_estudo']}</td>";
            echo "<td>{$linha['dia_semana']}</td>";
            echo "<td>{$linha['conteudo_gosta']}</td>";
            echo "<td>{$linha['conteudo_precisa']}</td>";
            echo "<td>{$linha['finalidade_estudo']}</td>";
            echo "<td>{$linha['conheceu_por']}</td>";

            echo "</tr>"; // Finaliza a linha da tabela
        }

        // Finaliza a tabela HTML
        echo "</table>";
    } else {
        // Caso não existam resultados, exibe uma mensagem informando
        echo "<p>Nenhum resultado encontrado.</p>";
    }

    // Exibe um link para voltar à página de busca
    echo '<a href="buscar_estudos.html">← Voltar</a>';
?>

    </body>

    </html>

<?php
} catch (PDOException $e) {
    // Captura exceções específicas do PDO (erros relacionados a banco de dados)
    echo "Erro ao buscar: " . $e->getMessage(); // Exibe a mensagem de erro detalhada
}
?>
