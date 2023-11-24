<?php
   ini_set ('display_errors' ,1); 
   error_reporting (E_ALL);
   include "util.php";
   $conn = conecta();
   session_start();
    $js = 'text/javascript';
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $confirma = $_POST['confirma_senha'];
    $cpf = $_POST['CPF'];
    $email = $_POST['email'];

    $jaexiste = "select * from tbl_usuario where excluido = false and cpf = '$cpf' or email = '$email';";
    $linha =  $conn->prepare($jaexiste);
    $linha->execute();

    if($linha->rowCount() > 0)
    {
        echo"
        <script type=$js lang='javascript'>
            alert('Usuário já existe. Vamos te redirecionar para a página de Login.');
            setTimeout(function(){
                window.location.href = 'login.php';
            }, 2000);
        </script>";
    }
   else
    {
        $sql = "insert into tbl_usuario (cod_usuario, nome, email, senha, telefone, cpf, excluido, administrador) 
        VALUES (DEFAULT, '$nome', '$email', '$senha', '$telefone', '$cpf', false, false);";
        $insert = $conn->prepare($sql);
        $insert->execute();
        echo"
        <script type=$js lang='javascript'>
            alert('Cadastro bem sucedido. Seja bem-vindo!');
        </script>";
        $_SESSION['sessaoConectado'] = true;
        header('Location: login.php');
       
    }
?>