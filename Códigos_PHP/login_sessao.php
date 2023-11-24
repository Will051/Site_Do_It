<?php

  // mostra erros do php
  ini_set ( 'display_errors' , 1); 
  error_reporting (E_ALL);  
  include('util.php');
  
  // inicia a sessao
  session_start();   

  // login que veio do form
  $login = $_POST['login'];
  $senha = $_POST['senha_login'];

  $conn = conecta();
  $sql = " select administrador from tbl_usuario where email = '$login'";

  $select = $conn->query($sql);

  while ( $linha = $select->fetch() ) {
              $admin          = $linha['administrador'];
      }

  if ($login<>'') {
      
      //DefineCookie('loginCookie', $login, 60); 
     
      $_SESSION['sessaoConectado'] = funcaoLogin($login,$senha,$admin); 
      $_SESSION['sessaoAdmin']     = $admin;
     
      //Login bem-sucedido
      if ( $_SESSION['sessaoConectado'] ) {
           $_SESSION['sessaoLogin']  = $login;
            echo"Login bem-sucedido";
            header("Location: eco.php?login=$login");      } 
      
     //CASO DE LOGIN INVALIDO 
      else 
      {
        $_SESSION['sessaoLogin'] = '';
        echo"Login invalido";
      }
  }
  else
  {
      echo"login vazio";
  }
     
  
?> 