<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Contatos</title>
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


        h1,
        h2 {
            color: #333;
            text-align: center;
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
            color: #A59D84
        }

        /* Estilo do botão */
        .button {
            display: inline-block;
            padding: 12px 24px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            background-color: #0A97B0;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #0A3981;
        }


        /* Formulário */
        .form-container {
            width: 40%;
            margin: 5px auto;
            padding: 30px 30px 10px 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.8s ease-in-out;
            font-weight: bold;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box;

        }

        .form-container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
            font-weight: bold;
            font-size: medium;
        }

        .form-container input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Animação para o formulário */
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

        /* Mensagens de erro ou sucesso */
        .message {
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
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


    <h1>Bem-vindo à sua agenda!</h1>
    <h2>Escreva o nome, contato e o e-mail da pessoa desejada:</h2>

    <div class="form-container">
        <form action="index.php" method="post">
            Nome:<br>
            <input type="text" name="usernames" required><br><br>
            Número de WhatsApp ou contato:<br>
            <input type="text" name="contato" required><br><br>
            E-mail:<br>
            <input type="email" name="gmail" required><br><br>
            <input type="submit" name="submit" value="Adicionar à sua Lista de Contatos">
        </form>

        <?php
        // Se o formulário foi enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
            // Recebe os dados do formulário
            $nome = isset($_POST["usernames"]) ? trim($_POST["usernames"]) : "";
            $contato = isset($_POST["contato"]) ? trim($_POST["contato"]) : "";
            $gmail = isset($_POST["gmail"]) ? trim($_POST["gmail"]) : "";

            // Verifica se os campos estão vazios
            if (empty($nome) || empty($contato) || empty($gmail)) {
                echo "<p class='message error'>Você não registrou contatos! Todos os campos são obrigatórios.</p>";
            } else {
                // Inclui o arquivo de conexão e salva os dados
                include('database.php');
                if (saveContact($nome, $contato, $gmail)) {
                    echo "<p class='message success'>Você registrou um contato com sucesso!</p>";
                } else {
                    echo "<p class='message error'>Erro ao registrar o contato. Tente novamente.</p>";
                }
            }
        }
        ?>

        <div style="text-align: center; margin-top: 20px;">
            <p><a href="contatos.php" class="button">Ver Lista de Contatos</a></p>

        </div>
    </div>
</body>

</html>