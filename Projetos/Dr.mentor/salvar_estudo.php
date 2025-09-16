<?php
// Exibir erros para debug durante o desenvolvimento
ini_set('display_errors', 1); // Ativa a exibição de erros
error_reporting(E_ALL); // Mostra todos os tipos de erro (avisos, alertas, erros fatais, etc.)

// Dados de conexão com o banco de dados
$host = 'localhost';       // Endereço do servidor MySQL
$dbname = 'dr_mentor_db';  // Nome do banco de dados
$user = 'root';            // Nome de usuário do MySQL
$pass = 'root';            // Senha do MySQL

try {
    // Tenta criar uma nova conexão com o banco usando PDO(blibioteca nativa do PHP)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);

    // Define o modo de erro para exceções, facilitando o tratamento de erros
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Captura os dados enviados pelo formulário via POST
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $data_nascimento = $_POST['data_nascimento'];
    $tempo_estudo = $_POST['tempo_estudo'];
    $dia_semana = $_POST['dia_semana'];
    $conteudo_gosta = $_POST['conteudo_gosta'];
    $conteudo_precisa = $_POST['conteudo_precisa'];
    $finalidade_estudo = $_POST['finalidade_estudo'];
    $conheceu_por = $_POST['conheceu_por'];

    // Prepara o comando SQL para inserir os dados na tabela "estudos"
    $sql = "INSERT INTO estudos (
                email, nome_completo, telefone, data_nascimento, tempo_estudo,
                dia_semana, conteudo_gosta, conteudo_precisa,
                finalidade_estudo, conheceu_por
            ) VALUES (
                :email, :nome_completo, :telefone, :data_nascimento, :tempo_estudo,
                :dia_semana, :conteudo_gosta, :conteudo_precisa,
                :finalidade_estudo, :conheceu_por
            )";

    // Prepara a instrução SQL para execução com os valores associados aos marcadores
    $stmt = $pdo->prepare($sql);

    // Executa a instrução SQL com os dados do formulário
    $stmt->execute([
        ':email' => $email,
        ':nome_completo' => $nome,
        ':telefone' => $telefone,
        ':data_nascimento' => $data_nascimento,
        ':tempo_estudo' => $tempo_estudo,
        ':dia_semana' => $dia_semana,
        ':conteudo_gosta' => $conteudo_gosta,
        ':conteudo_precisa' => $conteudo_precisa,
        ':finalidade_estudo' => $finalidade_estudo,
        ':conheceu_por' => $conheceu_por
    ]);
?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <title>Confirmação</title>
        <style>
            body {
                background-color: #e8f5e9;
                /* Verde claro */
                font-family: Arial, sans-serif;
                color: #2e7d32;
                /* Verde escuro para o texto */
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }

            .mensagem {
                background-color: #c8e6c9;
                /* Verde mais suave */
                padding: 40px 60px;
                border-radius: 12px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                text-align: center;
            }

            h2 {
                margin-bottom: 10px;
                font-size: 26px;
            }

            a {
                display: inline-block;
                margin-top: 20px;
                text-decoration: none;
                background-color: #2e7d32;
                color: white;
                padding: 10px 20px;
                border-radius: 6px;
                transition: background-color 0.3s ease;
            }

            a:hover {
                background-color: #1b5e20;
            }
        </style>
    </head>

    <body>
        <div class="mensagem">
            <h2>Dados salvos com sucesso!</h2>
            <p>Obrigado por preencher o formulário.</p>
            <a href="cadastro.html">Continuar com o cadastro</a>
        </div>
    </body>

    </html>

<?php
} catch (PDOException $e) {
    echo "Erro ao salvar: " . $e->getMessage();
}
?>