<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contatos</title>
    <style>
        /* Estilos gerais */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
            overflow-x: hidden;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        /* Navbar */
         nav {
            background-color: #FF7F3E;
            padding: 10px 20px;
            text-align: center;
            font-size: 20px;
        }

        nav a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #A59D84;
        }

        /* Tabela de contatos */
        .table-container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeIn 0.8s ease-in-out;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4A628A;
            color: white;
        }

        td {
            background-color: #f9f9f9;
        }

        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            margin-right: 5px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .btn-delete {
            background-color: #f44336;
        }

        .btn-delete:hover {
            background-color: #e53935;
        }

        /* Animação para o conteúdo */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <nav>
        <a href="index.php">Adicionar Contatos</a>
        <a href="contatos.php">Lista de Contatos</a>
    </nav>

    <footer style="background-color: #164863; color: white; text-align: center; padding: 2px; position: absolute; width: 100%; bottom: 0;">
    <p><strong>&copy; 2024 - MaisWeb</strong></p>
</footer>

    <div class="table-container">
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Contato</th>
                <th>E-mail</th>
                <th>Ações</th>
            </tr>

            <?php
            // Conexão com o banco de dados
            include('database.php');

            // Busca todos os contatos
            $result = mysqli_query($conn, "SELECT * FROM contatos");

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nomes']}</td>
                            <td>{$row['numeros']}</td>
                            <td>{$row['emails']}</td>
                            <td>
                                <a href='excluir.php?id={$row['id']}' class='btn btn-delete'>Excluir</a> |
                                <a href='alterar.php?id={$row['id']}' class='btn'>Alterar</a>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='message error'>Nenhum contato encontrado.</td></tr>";
            }

            mysqli_close($conn);
            ?>
        </table>
    </div>
</body>
</html>
