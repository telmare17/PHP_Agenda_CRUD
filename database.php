<?php

//Infos do banco de dados
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "agenda";

// Conectando ao banco de dados
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

// Verifica se a conexão foi bem-sucedida
if (!$conn) {
    die("Erro de conexão: " . mysqli_connect_error());
}

// Função para salvar o contato na tabela 'contatos'
function saveContact($nome, $contato, $gmail) {
    global $conn;
    $sql = "INSERT INTO contatos (nomes, numeros, emails) VALUES ('$nome', '$contato', '$gmail')";
    return mysqli_query($conn, $sql);
}
?>