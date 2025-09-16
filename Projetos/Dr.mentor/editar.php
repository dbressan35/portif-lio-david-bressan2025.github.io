<?php
// Cria uma conexão com o banco de dados MySQL usando mysqli
$conn = new mysqli("localhost", "root", "root", "dr_mentor_db");

// Verifica se ocorreu algum erro na conexão com o banco
if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error); // Se houver erro, encerra o script e mostra a mensagem
}

// Obtém o ID do usuário passado via URL (GET) e o converte para inteiro
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verifica se o formulário foi enviado (requisição POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recebe os novos dados enviados pelo formulário (via POST)
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $nascimento = $_POST['nascimento'];

    // Monta a consulta SQL para atualizar os dados do usuário com o ID correspondente
    $sql = "UPDATE usuarios 
            SET nome_completo='$nome', endereco='$endereco', email='$email', telefone='$telefone', nascimento='$nascimento' 
            WHERE id=$id";

    // Executa a consulta de atualização no banco de dados
    if ($conn->query($sql) === TRUE) {
        // Caso a atualização ocorra com sucesso, exibe uma mensagem de confirmação
        echo "<div style='text-align:center; padding:20px; background:#d4edda; color:#155724; border-radius:8px; text-decoration:none'>
                Atualizado com sucesso. 
                <a href='buscar_estudos.html'>Voltar para Busca</a>
              </div>";
    } else {
        // Caso ocorra um erro na atualização, exibe o erro
        echo "Erro: " . $conn->error;
    }
} else {
    // Caso NÃO seja um envio POST (ou seja, apenas abriu a página), faz uma consulta para buscar os dados do usuário com o ID informado
    $sql = "SELECT * FROM usuarios WHERE id=$id";
    $result = $conn->query($sql);

    // Verifica se encontrou um usuário correspondente no banco
    if ($result->num_rows > 0) {
        // Armazena os dados do usuário encontrado na variável $row
        $row = $result->fetch_assoc();
?>

        <!DOCTYPE html>
        <html lang="pt-BR">

        <head>
            <meta charset="UTF-8">
            <title>Editar Usuário</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f0f0f5;
                    padding: 20px;
                }

                h2 {
                    text-align: center;
                    color: #333;
                    margin-bottom: 20px;
                }

                form {
                    max-width: 400px;
                    margin: auto;
                    background: #fff;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
                }

                label {
                    display: block;
                    margin-top: 10px;
                    color: #333;
                    font-weight: bold;
                }

                input {
                    width: 100%;
                    padding: 8px;
                    margin-top: 4px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                }

                button {
                    margin-top: 20px;
                    padding: 10px;
                    width: 100%;
                    background-color: #4CAF50;
                    color: #fff;
                    border: none;
                    border-radius: 5px;
                    font-size: 16px;
                    cursor: pointer;
                }

                button:hover {
                    background-color: #45a049;
                }

                a {
                    color: #2196F3;
                    text-decoration: none;
                }

                a:hover {
                    text-decoration: underline;
                }
            </style>
        </head>

        <body>

            <h2>Editar Usuário</h2>

            <form method="post">
                <label>Nome Completo</label>
                <input type="text" name="nome" value="<?= htmlspecialchars($row['nome_completo']) ?>" required>

                <label>Endereço</label>
                <input type="text" name="endereco" value="<?= htmlspecialchars($row['endereco']) ?>" required>

                <label>E-mail</label>
                <input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" required>

                <label>Telefone</label>
                <input type="text" name="telefone" value="<?= htmlspecialchars($row['telefone']) ?>" required>

                <label>Data de Nascimento</label>
                <input type="date" name="nascimento" value="<?= $row['nascimento'] ?>" required>

                <button type="submit">Salvar Alterações</button>
            </form>

        </body>

        </html>
<?php
    } else {
        echo "<p style='text-align:center; color:red;'>Usuário não encontrado.</p>";
    }
}
$conn->close();
?>