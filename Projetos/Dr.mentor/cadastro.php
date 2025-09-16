<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "dr_mentor_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$nascimento = $_POST['nascimento'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nome_completo, endereco, email, telefone, nascimento, senha)
VALUES ('$nome', '$endereco', '$email', '$telefone', '$nascimento', '$senha')";

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Cadastro de Usuário</title>
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
<?php
if ($conn->query($sql) === TRUE) {
    echo "<div class='sucesso'>Cadastro realizado com sucesso! <br> Acesse o botão a baixo para ter acesso a plataforma</div>";
    echo "<a href='plataforma.html'>Acessar a plataforma</a>";
} else {
    echo "<div class='erro'>Erro ao salvar: " . $conn->error . "</div>";
    echo "<a href='cadastro.html'>Tentar Novamente</a>";
}
$conn->close();
?>
</div>

</body>
</html>

