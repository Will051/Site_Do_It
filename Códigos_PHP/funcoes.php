<?php
  ini_set ( 'display_errors' , 1); 
  error_reporting (E_ALL);  
  function conecta () 
  {
    try {
        $varConn = new PDO("pgsql:host=pgsql.projetoscti.com.br; 
    dbname=projetoscti28; user=projetoscti28; 
    password=721794"); //Tenta realizar a PDO com os parametros enviados
    } catch (PDOException $e) {
        echo '<script language="javascript">;';
        echo 'alert("Erro na conexão")';
        echo'</script>';
    }
     return $varConn;
  }

function GeraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
{
//$lmin = 'abcdefghijklmnopqrstuvwxyz';
$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$num = '1234567890';
$simb = '!@#$%*-';
$retorno = '';
$caracteres = '';

//$caracteres .= $lmin;
if ($maiusculas) $caracteres .= $lmai;
if ($numeros) $caracteres .= $num;
if ($simbolos) $caracteres .= $simb;

$len = strlen($caracteres);
for ($n = 1; $n <= $tamanho; $n++) {
$rand = mt_rand(1, $len);
$retorno .= $caracteres[$rand-1];
}
return $retorno;
}

function EnviaEmail ($pEmailDestino, $pAssunto, $pHtml, $pUsuario = "doit@projetoscti.com.br" )   
  {
    
   // troque usuario e senha !!!! 
   error_reporting(E_ALL);
   ini_set("display_errors", 1);
  
   require "PHPMailer/PHPMailer/PHPMailerAutoload.php";
      
   try {
 
     //cria instancia de phpmailer
     echo "<br>Tentando enviar para ".$pEmailDestino."...";
     $mail = new PHPMailer(); 
     $mail->IsSMTP();  
  
     // servidor smtp
     $mail->Host = "smtp.projetoscti.com.br";
     $mail->SMTPAuth = true;      // requer autenticacao com o servidor                         
     $mail->SMTPSecure = 'tls';                            
      
     $mail-> SMTPOptions = array (
       'ssl' => array (
       'verificar_peer' => false,
       'verify_peer_name' => false,
       'allow_self_signed' => true ) );
      
     $mail->Port = 587;      
      
     $mail->Username = $pUsuario; 
     $mail->Password = "D0it#2023"; 
     $mail->From = $pUsuario; 
     $mail->FromName = "Do It LTDA. suporte"; 
  
     $mail->AddAddress($pEmailDestino, "Usuario"); 
     $mail->IsHTML(true); 
     $mail->Subject = $pAssunto; 
     $mail->Body = $pHtml;
     $enviado = $mail->Send(); 
       
     if (!$enviado) {
        echo "<br>Erro: " . $mail->ErrorInfo;
        echo "<br>Voltar para a home: <a href='eco.php'>Home</a>";
      } else {
        echo "<br><b>Enviado!</b>";
        echo "<br>Voltar para a home: <a href='eco.php'>Home</a>";
      }
     return $enviado;         
      
   } catch (phpmailerException $e) {
     echo $e->errorMessage(); // erros do phpmailer
   } catch (Exception $e) {
     echo $e->getMessage(); // erros da aplica��o - gerais
   }      
  }



  function funcaoLogin ($paramLogin, $paramSenha, &$paramAdmin)  
  {
   $conn = conecta();  
   $varSQL = "select senha, administrador from tbl_usuario 
               where email = '$paramLogin'"; 
   $linha =  $conn->query($varSQL)->fetch();
   if (!$linha)
   {
    return false;
   }
   else
   {
    $paramAdmin = $linha['admin'] == false;
    return $linha['senha'] == $paramSenha;
   }
  
  }
  function DefineCookie($paramNome, $paramValor, $paramMinutos) 
  {
   setcookie($paramNome, $paramValor, time() + $paramMinutos * 60); 
  }
  
  function ImprimeForm($paramId, $login, $senha)
  {
    $erro = '';
    if($login<>'')
    {
      $idLogin = '';
    }
    else
    {
      $idLogin = $paramId;
      $erro = "Dados inválidos";
    }
    if($senha<>'')
    {
      if(!funcaoLogin($login, $senha, $admin))
      {
        $idLogin = $paramId;
        $idSenha = $paramId;
        $erro = "Dados inválidos";
      }

    }
    else
    {
      $idSenha = $paramId;
      $erro = "Dados inválidos";
    }
    echo "
    <html lang='en'>
    <head>

    <meta charset='utf-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1' />
    <title>Login</title>
    <!-- CSS/Fontes -->
    <link rel='stylesheet' href='estilologin.css'/>
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Bungee&display=swap' rel='stylesheet'> 
  </head>

  <body>
    <!--Cabeçalho-->
    <div id='header1'>
      <header>
          <a href='#' class='logo'><img src='../d (1)(1).png'></a>
          <ul class='navmenu'>
              <li><a href=''>Home</a></li>
              <li><a href=''>shop</a></li>
              <li><a href=''>products</a></li>
              <li><a href=''>devs</a></li>
              <li><a href=''>docs</a></li>
          </ul>
          <div class='nav-icon'>
              <a href='#'><i class='bx bx-search'></i></a>
              <a href='#'><i class='bx bx-user'></i></a>
              <a href='#'><i class='bx bx-cart'></i></a>

          </div>
      </header>
  </div>
<br><br>

    <!--Cabeçalho --Fim>
    <!-- Container -->
    <div class='container'>
      <div class='caixa'>
        <div class='conteudo'>
            <h2 id='head_cadastro'>Bem vindo de volta!</h2>
            <p id='erro_head'>$erro</p>
          <form id='form_login' method='post' action='login_sessao.php'>
          <div class='grid_cadastro'>
            <div class='container_input_cadastro' id='login'>
              <label for='login'>Login</label>
                <input class='esquerda' id='$idLogin'
                type='text'
                name='login'
                placeholder='Login'
                aria-label='Login'
                autocomplete off
                tabindex='1'
                required
                id='login_input'
                value='$loginCookie'
              />
            </div>
            <div class='container_input_cadastro' id='senha_login'>
              <label for='senha_login'>Senha</label>
              <input class='direita' id='$idSenha'
                type='password'
                name='senha_login'
                placeholder='Confirme a senha'
                aria-label='Password'
                required
                tabindex='6'
                id='senha_input'
                required
              />
            </div>
          </form>
          <div class='extra_cadastro' id='extra_login'>
              <div class='botoes_cadastro'>
                <div class='botao_criarconta'>
                  <a href='#' onClick='document.getElementById(\"form_login\").submit();' id='submit'>Entrar</a>                  
                  <div class='icon'>
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 268.832 268.832'>
                      <path d='M265.17 125.577l-80-80c-4.88-4.88-12.796-4.88-17.677 0-4.882 
                      4.882-4.882 12.796 0 17.678l58.66 58.66H12.5c-6.903 0-12.5 5.598-12.5 12.5 
                      0 6.903 5.597 12.5 12.5 12.5h213.654l-58.66 58.662c-4.88 4.882-4.88 12.796 
                      0 17.678 2.44 2.44 5.64 3.66 8.84 3.66s6.398-1.22 8.84-3.66l79.997-80c4.883-4.882 4.883-12.796 0-17.678z'/>
                    </svg>
                  </div>
                </div>
                <a href='youtube.com' id='link_login'>Não tenho conta</a>
                <a href='youtube.com' id='link_esqueci'>Esqueci a senha</a>
              </div>
              </div>
            </div>
          </div>
          </div> <!--Conteudo-->
        </div>
      </div><!--Caixa-->
    </div>
    <!-- Container -->
  </body>
</html>";      
  }
  
?>