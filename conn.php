<?php
//conexão com banco de dados
$servername = "localhost"; //nome do servidor na minha maquina
$username = "root"; //nome do usuario banco de dados
$password = ""; //senha do banco de dados
$dbname = "projeto_setta"; //nome do banco de dados

//criando conexao com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

//verifica se a conexao teve erro
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);//retorna erro da conexao
}
?>