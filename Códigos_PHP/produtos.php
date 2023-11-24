<?php
include("util.php");
$conn = conecta();
ini_set ( 'display_errors' , 1); 
error_reporting (E_ALL); 
include("cabecalho1.php"); 
echo
"
<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='style_produto.css'>
    <title>Produto</title>
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap' rel='stylesheet'> 
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Bungee&display=swap' rel='stylesheet'>
    
</head>
<body>
<!--CabeÃ§alho-->

    <main>
        <div class='titulo_pagina'><h2>Catálogo</h2></div>

        <div class='produtos'>
";
if (isset($_POST['varPesquisa'])) 
   {
     $varPesquisa = ucwords(strtolower($_POST['varPesquisa']));
     $sql = " select * from tbl_produto
     where nome like '%$varPesquisa%' and excluido = false
     order by nome ";
   } else {
     $varPesquisa = "";
     $sql = "select * from tbl_produto where excluido = false order by nome";
   }
   
   echo 
   "
    <div class='box'>
            <form name='search' action='produtos.php' method='POST'>
            <input type='text' name=varPesquisa class='varPesquisa' 
            onmouseout='this.value =\"\"; this.placeholder=\"\"; this.blur();'
            onmouseover='this.placeholder=\"Pesquisa\";'
            >
    </div>
        
   </form>
   <i class='fas fa-search'></i>
   
   ";

$select = $conn->query($sql);


$select = $conn->query($sql);

while($linha = $select->fetch())
{ 
    $codigo = $linha['cod_produto'];
    $nome = $linha['nome'];
    $qtde = $linha['quantidade'];
    $preco = $linha['preco'];
    $img = $linha['campo_imagem'];

echo
"                
    <div class='houver' style='flex-wrap: nowrap;'>
        <div class='position' style='flex-wrap: nowrap;
        width: 250px;
        height: 512.800px; display: flex;'>
            <a href='compra_produto.html'><img src='https://projetoscti.com.br/projetoscti16/Ecommerce/doit/imagens/$img'></a>
            <div class='nome'><h3>$nome</h3></div>
            <div class='valor'>R$$preco</div>";

            if($qtde > 0){
            echo "<a href='carrinho.php?operacao=incluir&codigoProduto=$codigo' class='btn_comprar'>Comprar</a>";}
            else{
            echo "<a class='btn_comprar'>Indisponivel</a>";}
        echo"</div>
    </div>
";
}

echo
"
    </div>
    </main>
    <footer class='footer'>
    <div class='container'>
     <div class='row'>
       <div class='footer-col'>
         <h4>A Empresa</h4>
         <ul>
           <li><a href='sobre.html'>Sobre nós</a></li>
           <li><a href='devs.html'>Desenvolvedores</a></li>
           <li><a href='#'>Política de privacidade</a></li>
         </ul>
       </div>
       <div class='footer-col'>
         <h4>Ajuda</h4>
         <ul>
           <li><a href='#'>Perguntas frequentes</a></li>
           <li><a href='#'>Envio</a></li>
           <li><a href='#'>Devoluções</a></li>
           <li><a href='#'>Status de pedido</a></li>
           <li><a href='#'>Opções de pagamento</a></li>
         </ul>
       </div>
       <div class='footer-col'>
       <h4>Patrocinador:</h4>
        <img class='Gi' src='GISEMFUNDO.png' alt='Gi Copiadoras'>
       </div>
    </div>
 </footer>
</body>
</html>";
?>