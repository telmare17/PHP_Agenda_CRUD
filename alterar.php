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
    $sql = "SELECT * FROM contatos WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    
    // Verifica se o contato foi encontrado
    if ($result && mysqli_num_rows($result) > 0) {
        $contact = mysqli_fetch_assoc($result);
    } else {
        echo "<div id='error-message' style='display:none;'>Contato não encontrado.</div>";
        exit;
    }
} else {
    echo "<div id='error-message' style='display:none;'>ID não fornecido.</div>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário de alteração
    $nome = $_POST["usernames"];
    $contato = $_POST["contato"];
    $gmail = $_POST["gmail"];

    // Atualiza o contato no banco de dados
    $update_sql = "UPDATE contatos SET nomes='$nome', numeros='$contato', emails='$gmail' WHERE id=$id";
    if (mysqli_query($conn, $update_sql)) {
        echo "<div id='success-message' style='display:none;'>Contato atualizado com sucesso!</div>";
    } else {
        echo "<div id='error-message' style='display:none;'>Erro ao atualizar o contato.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Contato</title>
    <style>
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

        .form-container {
            width: 50%;
            margin: 20px auto;
            padding: 30px 40px 30px 40px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.8s ease-in-out;
        }

        .form-container label {
            font-size: 1.1em;
            margin-bottom: 10px;
            display: block;
            font-weight: bold;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: medium;
            font-weight: bold;
        }

        .form-container input[type="submit"]:hover {
            background-color: #45a049;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            font-size: 1.2em;
            color: #333;
            text-decoration: none;
        }

        .back-link:hover {
            color: #697565;
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            animation: fadeInOut 4s ease-in-out;
            z-index: 1000;
            display: none;
        }

        .notification.error {
            background-color: #f44336;
        }

        @keyframes fadeInOut {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            10%, 90% {
                opacity: 1;
                transform: translateY(0);
            }
            100% {
                opacity: 0;
                transform: translateY(-20px);
            }
        }
    </style>
</head>
<body>
    <nav>
        <a href="index.php">Adicionar Contatos</a>
        <a href="contatos.php">Lista de Contatos</a>
    </nav>

    <h1>Alterar Contato</h1>

    <div class="form-container">
        <form method="post">
            <label for="usernames">Nome:</label>
            <input type="text" name="usernames" id="usernames" value="<?php echo isset($contact['nomes']) ? $contact['nomes'] : ''; ?>" required><br>

            <label for="contato">Número de WhatsApp ou Contato:</label>
            <input type="text" name="contato" id="contato" value="<?php echo isset($contact['numeros']) ? $contact['numeros'] : ''; ?>" required><br>

            <label for="gmail">E-mail:</label>
            <input type="email" name="gmail" id="gmail" value="<?php echo isset($contact['emails']) ? $contact['emails'] : ''; ?>" required><br>

            <input type="submit" value="Atualizar Contato">
        </form>

        <a href="contatos.php" class="back-link">Voltar para a Lista de Contatos</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const successMessage = document.getElementById('success-message');
            const errorMessage = document.getElementById('error-message');
            
            if (successMessage) {
                showNotification(successMessage.textContent, 'success');
            }
            if (errorMessage) {
                showNotification(errorMessage.textContent, 'error');
            }
        });

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.textContent = message;

            document.body.appendChild(notification);

            notification.style.display = 'block';

            // Remove a notificação após 4 segundos
            setTimeout(() => {
                notification.remove();
            }, 4000);
        }
    </script>

<footer style="background-color: #164863; color: white; text-align: center; padding: 2px; position: absolute; width: 100%; bottom: 0;">
    <p><strong>&copy; 2024 - MaisWeb</strong></p>
    </footer>
</body>
</html>

<?php
// Fecha a conexão com o banco de dados
mysqli_close($conn);
?>
