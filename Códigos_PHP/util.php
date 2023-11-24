<?php 
////////////////////////////////////////////////////////////////
function CriaPDF ( $paramTitulo, $paramHtml, $paramArquivoPDF )
  {
   $arq = false;     
   try {  
    require "html_table.php"; 
    // abre classe fpdf estendida com recurso que converte <table> em pdf
  
    $pdf = new PDF();  
    // cria um novo objeto $pdf da classe 'pdf' que estende 'fpdf' em 'html_table.php'
    $pdf->AddPage();  // cria uma pagina vazia
    $pdf->SetFont('helvetica','B',20);       
    $pdf->Write(5,$paramTitulo);    
    $pdf->SetFont('helvetica','',8);     
    $pdf->WriteHTML($paramHtml); // renderiza $html na pagina vazia
    ob_end_clean();    
    // fpdf requer tela vazia, essa instrucao 
    // libera a tela antes do output
    
    // gerando um arquivo 
    $pdf->Output($paramArquivoPDF,'F');
    // gerando um download 
    $pdf->Output('D',$paramArquivoPDF);  // disponibiliza o pdf gerado pra download
    $arq = true;
   } catch (Exception $e) {
     echo $e->getMessage(); // erros da aplicaÃ§Ã£o - gerais
   }
   return $arq;
  }


function EnviaEmail ($pEmailDestino, $pAssunto, $pHtml, $pUsuario = "mipron@projetoscti.com.br" )   
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
     $mail->Password = "M1#pr0n2023"; 
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
     echo $e->getMessage(); // erros da aplica  o - gerais
   }      
  }


/**
* Função para executasql frases sql
* marcelo c peres - 2023
* Função para gerar senhas aleatórias
*
* @author    Thiago Belem <contato@thiagobelem.net>
*
* @param integer $tamanho Tamanho da senha a ser gerada
* @param boolean $maiusculas Se terá letras maiúsculas
* @param boolean $numeros Se terá números
* @param boolean $simbolos Se terá símbolos
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

function VerificaSQL( $paramConn, $paramSQL ) 
  {
    $execucao = $paramConn->query($paramSQL);

    if ($execucao->rowCount() > 0) { 
        return TRUE; 
    } else { 
        return FALSE; 
    }  
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
  * Fun  o para executasql frases sql
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
  * Fun  o para gerar senhas aleat rias
  *
  * @author    Thiago Belem <contato@thiagobelem.net>
  *
  * @param integer $tamanho Tamanho da senha a ser gerada
  * @param boolean $maiusculas Se ter  letras mai sculas
  * @param boolean $numeros Se ter  n meros
  * @param boolean $simbolos Se ter  s mbolos
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
   $varSQL = "select senha, administrador from tbl_usuario 
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
  function DefineCookie($paramNome, $paramValor, $paramMinutos) 
  {
   echo "Cookie: $paramNome Valor: $paramValor";  
   setcookie($paramNome, $paramValor, time() + $paramMinutos * 60); 
  }
?>