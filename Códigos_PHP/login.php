<?php
  ini_set ( 'display_errors' , 1); 
  error_reporting (E_ALL);   

  if(isset($_GET['teste']))
  {
    $erro='erro';
    $span = 'Credenciais inválidas!';
  }
  else{
    $erro="";
    $span="";
  }

//Verifica se a sessão está ativa (conectada), se não, ele pedirá o Login.
  if (isset($_SESSION['sessaoConectado'])) {
      $sessaoConectado = $_SESSION['sessaoConectado'];
  } else { 
    $sessaoConectado = false; 
  }

  if (!$sessaoConectado) { 
     
     //Se existe um cookie para o usuário, ele aparecerá no form.    
     if (isset($_COOKIE['loginCookie'])) {
        $loginCookie = $_COOKIE['loginCookie']; 
     }
     else
     {
        $loginCookie = '';
     }

     echo " 
     <html lang='en'>
     <head>
     
     <meta charset='utf-8' />
     <meta name='viewport' content='width=device-width, initial-scale=1' />
     <title>Login</title>
     <!-- CSS/Fontes -->
     <link rel='stylesheet' href='estilologin.css'>
     <link rel='preconnect' href='https://fonts.googleapis.com'>
     <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
     <link href='https://fonts.googleapis.com/css2?family=Bungee&display=swap' rel='stylesheet'>
     <link href='https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap' rel='stylesheet'> 
   </head>
 
   <body>
   <!--Cabeçalho-->
  
 
     <!--Cabeçalho -->
     <!--- Container --->
     <div class='container'>
       <div class='caixa'>
       <div id='head_login'><h2>Bem vindo de volta!</h2></div>
       <span id='ErroLogin'>$span</span>
         <div class='conteudo'>
           <form id='form_login' method='post' action='login_sessao.php'>
           <div class='grid_login'>
             <div class='container_input_cadastro' id='login'>
               <label for='login'>Login</label>
                 <input class='esquerda $erro'
                 type='text'
                 name='login'
                 placeholder='Login'
                 aria-label='Login'
                 autocomplete off
                 tabindex='1'
                 id='login_input'
                 value='$loginCookie'
               >
             </div>
             <div class='container_input_cadastro' id='senha_login'>
               <label for='senha_login'>Senha</label>
               <input class='direita $erro'
                 type='password'
                 name='senha_login'
                 placeholder='Confirme a senha'
                 aria-label='Password'
                 tabindex='2'
                 id='senha_input'
               >
             </div>
           </form>
           <div class='extra_cadastro'>
              <div class='botoes_cadastro' id='botoes_login'>               
                    <div class='btn_criarconta'>
                      <input type='submit' value='Entrar'>
                      <div class='icon'>
                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 268.832 268.832'>
                          <path d='M265.17 125.577l-80-80c-4.88-4.88-12.796-4.88-17.677 0-4.882 4.882-4.882 12.796 0 17.678l58.66 58.66H12.5c-6.903 0-12.5 5.598-12.5 12.5 0 6.903 5.597 12.5 12.5 12.5h213.654l-58.66 58.662c-4.88 4.882-4.88 12.796 0 17.678 2.44 2.44 5.64 3.66 8.84 3.66s6.398-1.22 8.84-3.66l79.997-80c4.883-4.882 4.883-12.796 0-17.678z'>
                        </svg>
                      </div>
                      <input type='button' value='Não tenho conta' onclick='window.location.href=\"Cadastro.html\"'>
                      <input type='button' value='Esqueci a senha' onclick='window.location.href=\"enviasenha.php\"'>
                </div>
              </div>
          </div>
           </div>
           </div> <!--Conteudo-->
         </div>
       </div><!--Caixa-->
     </div>
     <!-- Container -->
     <footer class='footer'>
    <div class='container'>
     <div class='roww'>
       <div class='footer-col'>
         <h4>A Empresa</h4>
         <ul>
           <li><a href='sobre.php'>Sobre nós</a></li>
           <li><a href='devs.php'>Desenvolvedores</a></li>
           <li><a href='https://linktr.ee/doitplanners'>Siga nossas redes sociais!</a></li>
         </ul>
       </div>
       <div class='footer-col'>
         <h4>Conheça mais</h4>
         <ul>
          <li><a href='https://www.cti.feb.unesp.br'>Nosso colégio</a></li>
          <li><a href='https://www.instagram.com/s/aGlnaGxpZ2h0OjE4MDM5NDg2NjI4NTExNjM2?igshid=MWlyamF0NHFicm5mag=='
           >Conheça a Viva CTI</a></li>
           <li><a href='https://wa.link/m4v06v'>Nossos patrocinadores</a></li>
         </ul>
       </div>
       <div class='footer-col'>
       <h4>Patrocinador:</h4>
       <a href='https://wa.link/m4v06v'><img class='Gi' src='../Imagens/GISEMFUNDO.png' alt='Gi Copiadoras'></a>
      </div>       
   </body>
 </html>

 ";
  }

?>
