<?php 

   // mostra erros do php
   ini_set ( 'display_errors' , 1); 
   error_reporting (E_ALL);   
   
   include("util.php");
   echo"<link rel='stylesheet' type='text/css' href='estilo.css'>
   <link rel='stylesheet' href='tabela1.css'>
   <link rel='stylesheet' href='style.css'>";
   
   /// coloca esse css fora e abre do jeito certo ok?
   // faz conexao 
   $conn = conecta();

   if (isset($_POST['varPesquisa'])) 
   {
     $varPesquisa = $_POST['varPesquisa'];
   } else {
     $varPesquisa = "";
   }
  
   echo "Variavel pesquisa: $varPesquisa";

   $sql = " select * from tbl_usuario
            where nome like '%$varPesquisa%' and excluido<>true
            order by nome ";
   
   // faz um select basico
   $select = $conn->query($sql);
   
   echo "<form action='FormUsuarios.php' method='post'>
           <input type='text' name='varPesquisa'>
           <input type='submit' value='Procurar'>   
         </form>";

   // enquanto houver registro leia em $linha


   
   echo "
        <div class='table'>
            <div class='btn-novo-cad'> 
                <a href='Cadastro.html'>+ Novo Usuario</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
            <div class='row'>
                <div class='cell cod-usuario cellCabeca'>
                    Cód. usuario
                </div>
                <div class='cell nome cellCabeca'>
                    Nome
                </div>
                <div class='cell email cellCabeca'>
                    Email
                </div>
                <div class='cell senha cellCabeca'>
                    Senha
                </div>
                <div class='cell telefone cellCabeca'>
                    Telefone
                </div>
                <div class='cell cpf cellCabeca'>
                    CPF
                </div>
                <div class='cell endereco cellCabeca'>
                    Endereco
                </div>
                <div class='cell adm cellCabeca'>
                    Administrador
                </div>
                <div class='cell opcoes cellCabeca'>
                    Alternativas
                </div>      
            </div>
            ";

   // fetch significa carregar proxima linha
   // qdo nao tiver mais nenhuma retorna FALSE pro while
   while ( $linha = $select->fetch() )  
   {
     // imprime as posicoes de $linha que sao os campos carregados  
     $codigousuario = $linha['cod_usuario'];
     $nome          = $linha['nome'];
     $email     = $linha['email'];
     $senha         = $linha['senha'];
     $telefone           = $linha['telefone'];
     $cpf     = $linha['cpf'];
     $endereco         = $linha['endereco'];
     $administrador         = $linha['administrador'];


     
     echo "<div class='row'>
                    <div class='cell cod-usuario'>
                        ".$codigousuario."
                    </div>
                    <div class='cell nome'>
                        ".$nome."
                    </div>
                    <div class='cell email'>
                        ".$email."
                    </div>
                    <div class='cell senha'>
                        ".$senha."
                    </div>
                    <div class='cell telefone'>
                        ".$telefone."
                    </div>
                    <div class='cell cpf'>
                        ".$cpf."
                    </div>
                    <div class='cell endereco'>
                        ".$endereco."
                    </div>
                    <div class='cell adm'>
                        ".$administrador."
                    </div>
                    <div class='cell opcoes'>
                        <a href='cad_altera_usuarios_front.php?cod_usuario=".$linha['cod_usuario']."'>Alterar</a>&nbsp;
                        <a href='cad_exclui_usuarios_front.php?cod_usuario=".$linha['cod_usuario']."'>Excluir</a>&nbsp;
                    </div>
                </div>"; 
   }

   echo "</table>
"; 
?>
