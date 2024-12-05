<?php 
// Configurações do banco de dados
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "agenda";

// Conectando ao banco de dados
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Erro de conexão: " . mysqli_connect_error());
}

// Verifica se o ID do contato foi fornecido
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepara a consulta para excluir o contato com segurança
    $delete_sql = "DELETE FROM contatos WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $delete_sql)) {
        // Bind da variável ID
        mysqli_stmt_bind_param($stmt, "i", $id);

        // Executa a consulta
        if (mysqli_stmt_execute($stmt)) {
            $message = "Contato excluído com sucesso!";
            $message_type = "success";
        } else {
            $message = "Erro ao excluir o contato.";
            $message_type = "error";
        }

        // Fecha a declaração
        mysqli_stmt_close($stmt);
    }
} else {
    $message = "ID não fornecido.";
    $message_type = "error";
}

// Fecha a conexão com o banco
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Contato</title>
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
            margin-top: 30px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
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
        /* Estilo do formulário */
        .form-container {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.8s ease-in-out;
        }

        .form-container p {
            font-size: 1.2em;
            text-align: center;
        }

        .form-container a {
            display: block;
            margin-top: 20px;
            text-align: center;
            font-size: 1.2em;
            color: #333;
            text-decoration: none;
        }

        .form-container a:hover {
            color: #A59D84;
        }

        /* Estilo das mensagens */
        .message {
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            text-align: center;
        }

        .message.success {
            background-color: #3C3D37;
            color: white;
        }

        .message.error {
            background-color: #f44336;
            color: white;
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

        /* Link de voltar */
        .back-link {
            text-align: center;
            font-size: 1.2em;
            color: #333;
            text-decoration: none;
        }

        .back-link:hover {
            color: #4CAF50;
        }
    </style>
</head>
<body>
    <nav>
        <a href="index.php">Adicionar Contatos</a>
        <a href="contatos.php">Lista de Contatos</a>
    </nav>

    <h1>Excluir Contato</h1>

    <div class="form-container">
        <?php if (isset($message)): ?>
            <div class="message <?php echo $message_type; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <a href="contatos.php" class="back-link">Voltar para a lista de contatos</a>
    </div>

    <footer style="background-color: #164863; color: white; text-align: center; padding: 2px; position: absolute; width: 100%; bottom: 0;">
    <p><strong>&copy; 2024 - MaisWeb</strong></p>
</footer>
</body>
</html>
