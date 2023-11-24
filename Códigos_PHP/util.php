<?php 
////////////////////////////////////////////////////////////////
function EnviaEmail ( $pEmailDestino, $pAssunto, $pHtml, $pRemetente )   
{
 error_reporting(E_ALL);
 ini_set("display_errors", 1);
 
 require "PHPMailer/PHPMailerAutoload.php";
    
 try {

 //cria instancia de phpmailer
 echo "<br>Tentando enviar para ".$pEmailDestino."...";
 $mail = new PHPMailer(); 
 $mail->IsSMTP();  
 
 // servidor smtp
 //$mail->SMTPDebug = SMTP::DEBUG_SERVER;   // use se tiver problemas, ele lista toda a transacao com o servidor
 $mail->Host = "smtp....";
 $mail->SMTPAuth = true;      // requer autenticacao com o servidor                         
 $mail->SMTPSecure = 'tls';                            
     
 $mail-> SMTPOptions = array (
   'ssl' => array (
   'verificar_peer' => false,
   'verify_peer_name' => false,
   'allow_self_signed' => true ) );
     
 $mail->Port = 587;      
    
 $mail->Username = "...@..."; 
 $mail->Password = "..."; 
 $mail->From = "...@..."; 
 $mail->FromName = "Suporte de senhas"; 
 
 $mail->AddAddress($pEmailDestino, "Usuario"); 
 $mail->IsHTML(true); 
 $mail->Subject = "Nova Senha !"; 
 $mail->Body = $pHtml;
 $enviado = $mail->Send(); 
     
 if (!$enviado) {
    echo "<br>Erro: " . $mail->ErrorInfo;
 } else {
    echo "<br><b>Enviado!</b>";
 }
 return $enviado;         
     
 } catch (phpmailerException $e) {
   echo $e->errorMessage(); // erros do phpmailer
 } catch (Exception $e) {
   echo $e->getMessage(); // erros da aplicaÃ§Ã£o - gerais
 }       
 
}


/**
* FunÃ§Ã£o para executasql frases sql
* marcelo c peres - 2023
* FunÃ§Ã£o para gerar senhas aleatÃ³rias
*
* @author    Thiago Belem <contato@thiagobelem.net>
*
* @param integer $tamanho Tamanho da senha a ser gerada
* @param boolean $maiusculas Se terÃ¡ letras maiÃºsculas
* @param boolean $numeros Se terÃ¡ nÃºmeros
* @param boolean $simbolos Se terÃ¡ sÃ­mbolos
*
* @return string A senha gerada
*/


////////////////////////////////////////////////////////////////
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


////////////////////////////////////////////////////////////////
function ExecutaSQL( $paramConn, $paramSQL ) 
{
 $linhas = $paramConn->exec($paramSQL);
 
 if ($linhas > 0) { 
     return TRUE; 
 } else { 
     return FALSE; 
 }  
}          
   

  /*
  * Funï¿½ï¿½o para executasql frases sql
  * marcelo c peres - 2023
  */

  // ValorSQL 
  // retorna o valor de um campo de um select
  // Set 2023 - Marcelo C Peres 


  ////////////////////////////////////////////////////////////////

  
  function ValorSQL( $pConn, $pSQL ) 
  {
   $linhas = $pConn->query($pSQL)->fetch();
  
   if ($linhas > 0) { 
       return $linhas[0]; 
   } else { 
       return "0"; 
   }  
  }


  /**
  * Funï¿½ï¿½o para gerar senhas aleatï¿½rias
  *
  * @author    Thiago Belem <contato@thiagobelem.net>
  *
  * @param integer $tamanho Tamanho da senha a ser gerada
  * @param boolean $maiusculas Se terï¿½ letras maiï¿½sculas
  * @param boolean $numeros Se terï¿½ nï¿½meros
  * @param boolean $simbolos Se terï¿½ sï¿½mbolos
  *
  * @return string A senha gerada
  */

  //////  funcao de conexao
  //////  14-8-2023
  ////////////////////////////////////////////////////////////////
  function conecta ($params = "")  // igual a nada pra indicar q aceita vazio !! 
  {
    if ($params == "") {
        $params="pgsql:host=pgsql.projetoscti.com.br; dbname=projetoscti28; 
                 user=projetoscti28; password=721794";
    }
  
    $varConn = new PDO($params);

    if (!$varConn) {
        echo "Nao foi possivel conectar";
    } else { return $varConn; }
  }
  /////////////////////////

  //////  funcao de login
  //////  11-9-2023

  ////////////////////////////////////////////////////////////////
  function funcaoLogin ($paramLogin, $paramSenha, $paramAdmin)  
  {
   $conn = conecta();  
   $varSQL = "select senha, administrador, usuario from tbl_usuario 
               where email = '$paramLogin'"; 
   $linha =  $conn->query($varSQL)->fetch();
   if (!$linha)
   {
    return false;
   }
   else
   {
    $paramAdmin = $linha['administrador'] == false;
    return $linha['senha'] == $paramSenha;
   }
  
  }

  //////  funcao de definir cookie
  //////  11-9-2023

  ////////////////////////////////////////////////////////////////
  /*function DefineCookie($paramNome, $paramValor, $paramMinutos) 
  {
   echo "Cookie: $paramNome Valor: $paramValor";  
   setcookie($paramNome, $paramValor, time() + $paramMinutos * 60); 
  }*/
?>