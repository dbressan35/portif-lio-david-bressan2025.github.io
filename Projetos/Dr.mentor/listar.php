<?php
$conn = new mysqli("localhost", "root", "root", "dr_mentor_db");
if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM usuarios");
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f5;
            padding: 20px;
        }
        
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e0f7e0;
        }

        a {
            color: #2196F3;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <h2>Lista de Usuários Cadastrados</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Nome Completo</th>
            <th>Email</th>
            <th>Endereço</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>

        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['nome_completo']}</td>
            <td>{$row['email']}</td>
            <td>{$row['endereco']}</td>
            <td>{$row['telefone']}</td>
            <td><a href='editar.php?id={$row['id']}'>Editar</a></td>
          </tr>";
        }
        ?>

    </table>

</body>

</html>

<?php
$conn->close();
?>