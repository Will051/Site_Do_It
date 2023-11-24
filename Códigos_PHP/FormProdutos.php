<?php 

   // mostra erros do php
   ini_set ( 'display_errors' , 1); 
   error_reporting (E_ALL);   
   
   include("util.php");
   echo"<link rel='stylesheet' type='text/css' href='estilo.css'>
   <link rel='stylesheet' href='tabela.css'>
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

   $sql = " select * from tbl_produto
            where nome like '%$varPesquisa%' and excluido<>true
            order by nome ";
   
   // faz um select basico
   $select = $conn->query($sql);
   
   echo "<form action='produtos.php' method='post'>
           <input type='text' name='varPesquisa'>
           <input type='submit' value='Procurar'>   
         </form>";

   // enquanto houver registro leia em $linha

     
   echo "
        <div class='table'>
            <div class='btn-novo-cad'> 
                <a href='formProduto.php'>+ Novo Produto</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
            <div class='row'>
                <div class='cell cod-produto cellCabeca'>
                    Cód. Produto
                </div>
                <div class='cell nome cellCabeca'>
                    Nome
                </div>
                <div class='cell descricao cellCabeca'>
                    Descrição
                </div>
                <div class='cell preco cellCabeca'>
                    Preço
                </div>
                <div class='cell quantidade cellCabeca'>
                    Quantidade
                </div>
                <div class='cell cod-visual cellCabeca'>
                    Cód. Visual
                </div>
                <div class='cell custo cellCabeca'>
                    Custo
                </div>
                <div class='cell margem-lucro cellCabeca'>
                    Margem de lucro
                </div>
                <div class='cell icms cellCabeca'>
                    Icms
                </div>
                <div class='cell imagem cellCabeca'>
                    Imagem
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
     $codigoProduto = $linha['cod_produto'];
     $nome          = $linha['nome'];
     $descricao     = $linha['descricao'];
     $preco         = $linha['preco'];
     $qtd           = $linha['quantidade'];
     $codVisual     = $linha['codigovisual'];
     $custo         = $linha['custo'];
     $lucro         = $linha['margem_lucro'];
     $icms          = $linha['icms'];
     $imagem        = $linha['campo_imagem'];
     $excluido      = $linha['excluido'];
     $dataexclusao  = $linha['data_exclusao'];
     
     echo "<div class='row'>
                    <div class='cell cod-produto'>
                        ".$codigoProduto."
                    </div>
                    <div class='cell nome'>
                        ".$nome."
                    </div>
                    <div class='cell descricao'>
                        ".$descricao."
                    </div>
                    <div class='cell preco'>
                        ".$preco."
                    </div>
                    <div class='cell quantidade'>
                        ".$qtd."
                    </div>
                    <div class='cell cod-visual'>
                        ".$codVisual."
                    </div>
                    <div class='cell custo'>
                        ".$custo."
                    </div>
                    <div class='cell margem-lucro'>
                        ".$lucro."
                    </div>
                    <div class='cell icms'>
                        ".$icms."
                    </div>
                    <div class='cell imagem'>
                        ".$imagem."
                    </div>
                    <div class='cell opcoes'>
                        <a href='formProduto.php?codigoProduto=$codigoProduto'>Alterar</a>&nbsp;
                        <a href='excluirProduto.php?codigoProduto=$codigoProduto'>Excluir</a>&nbsp;
                    </div>
                </div>"; 
   }


   echo "</table>
         <br>
"; 
?>
