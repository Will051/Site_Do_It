<?php 
include "util.php";


echo "
<html>
<head>
<link rel='stylesheet' href='estiloEsqueci.css'/>
<link rel='preconnect' href='https://fonts.googleapis.com'>
<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
<link href='https://fonts.googleapis.com/css2?family=Bungee&display=swap' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap' rel='stylesheet'>
</head>
<body>
    <script type='text/javascript' lang='javascript' src='Esqueci.js'></script>
<div id='containerEsqueci'>        
    <h1 id='esqueceu'>Esqueceu sua senha?</h1>
    <div id='caixa_esqueci'>
    <label for='formEsqueci'>Digite seu e-mail de recuperação abaixo.</label>
    <label for='formEsqueci'>Enviaremos um e-mail com uma nova senha para a conta correspondente.</label>
    <form name='formEsqueci' id='formEsqueci' method='post' action=''>
        <input type='text' name='login' id='emailEsqueci' placeholder='(Digite seu e-mail)'>
        <span class='spanEsqueci'>Insira um e-mail válido.</span>
        <input type='submit' id='esqueci' value='Enviar'>
        <input type='button' id='esqueci' value='Voltar' onclick='window.location.href=\"../LoginAtualizado/login.php\"'>
    </form>
    </div>
</div>

   </body>
   </html>
   ";

if ($_POST)  
{
   
   $NovaSenha = GeraSenha();
   $login = $_POST['login'];
   $paramErro = "Erro";
   $paramHTML = "
   <html>
   <head>
   <link rel='stylesheet' href='estiloEsqueci.css'/>
   <link rel='preconnect' href='https://fonts.googleapis.com'>
   <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
   <link href='https://fonts.googleapis.com/css2?family=Bungee&display=swap' rel='stylesheet'>  
   <link href='https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap' rel='stylesheet'>
   <html>
   <body id='Email'>
   <div>
      <h1>Esqueceu sua senha?</h1>
      <p>Olá, recebemos um pedido de recuperação para esse endereço de e-mail.</p>
      <p>Se você não solicitou uma recuperação, basta ignorar esse e-mail.</p>
      <p>Sua nova senha: $NovaSenha</p>
      <br><br><br>
      <div id='infoEmail'>
      <p>DO IT PLANNERS LTDA.</p> 
      <p>Departamento de atendimento ao cliente - Suporte de senhas.</p>
      <p>Avenida Nações Unidas, 58-50</p>
      </div>
      <img src='../../Imagens/2.png'>
   </div>
   </body>
   </html>";

   if (EnviaEmail ($login,'Esqueceu sua senha?',
   $paramHTML))
   {
      echo"<script type='text/javascript' lang='javascript'>
            alert('O e-mail foi enviado. Cheque sua caixa de entrada.');
            </script>";
   } 
   else
   {
      echo"<script type='text/javascript' lang='javascript'>
            alert('Ocorreu um erro em sua recuperação. Por favor, tente novamente.');
            </script>";
   } 
}

?>