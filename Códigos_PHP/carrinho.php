<?php

 // visualizar todos os erros
 error_reporting(E_ALL);
 ini_set("display_errors", 1);
 
 // incluir util.php
 include ("util.php");
 
 session_start();

 include ('cabecalho1.php');

 // captura session_id (garante o acesso concorrente)
 $session_id = session_id();  

 // chama conecta() e guarda a conexao default em $conn
 $conn = conecta();   // conecta com o banco e obtem a var de controle $conecta

 // se estiver logado pega o codigo do usuario atraves do $login 
 if ( isset($_SESSION['sessaoLogin']) ) {
      $login = $_SESSION['sessaoLogin'];
      $codigoUsuario = ValorSQL($conn, " select cod_usuario from tbl_usuario 
                                         where usuario = '$login'");
 }
     
 // existe alguma compra associada ao session_id ??
 $existe = intval ( ValorSQL($conn," select count(*) from tbl_compra 
                                     inner join tbl_tmp_compra
                                     on tbl_compra.cod_compra = tbl_tmp_compra.cod_compra  
                                     where tbl_tmp_compra.sessao = '$session_id' ") ) == 1;
 // se nao existe
 if (!$existe) {   

    $dataHoje = date('Y/m/d');
 
    $statusCompra = 'Pendente';

    // cria um registro de tbl_compra com o usuario nulo
    ExecutaSQL($conn," insert into tbl_compra (data_compra, status) 
                       values ('$dataHoje','$statusCompra') ");

    // recupera o codigo usado no auto-incremento
    $codigoCompra = ValorSQL($conn,"select max(cod_compra) from tbl_compra");

    // insere o tbl_tmp_compra
    ExecutaSQL($conn," insert into tbl_tmp_compra (cod_compra, sessao) 
                       values ($codigoCompra,'$session_id') ");  
 
 } else {

    // como o teste mostrou que ja existe um registro de compra
    // retorna esse codigo de compra
    $codigoCompra = intval ( ValorSQL($conn," select tbl_compra.cod_compra from tbl_compra
                                              inner join tbl_tmp_compra on tbl_compra.cod_compra = 
                                              tbl_tmp_compra.cod_compra 
                                              where tbl_tmp_compra.sessao = '$session_id' "));

    // obtem o status dessa compra, se criou agora, entao eh 'pendente'
    $statusCompra = ValorSQL($conn, " select status from tbl_compra 
                                      where cod_compra = $codigoCompra ");
        
 } 

 ////////////// se estiver logado atualiza e 'liga' a compra com o 
 ////////////// usuario

 if (isset($codigoUsuario)) {
    ExecutaSQL($conn,"update tbl_compra 
                         set cod_usuario = $codigoUsuario 
                      where 
                         cod_usuario is null and 
                         cod_compra = $codigoCompra"); 
 }

 // se o carrinho foi chamado por COMPRAR, EXCLUIR ou FECHAR
 if(isset($_GET['codigoCompra'])){

    $codigoCompra = $_GET['codigoCompra'];

}

if (isset($_GET['compra_falhou']) && $_GET['compra_falhou'] === 'true') {
    // Exibir a mensagem de falha na compra
    echo "<script>alert('Nao ha estoque suficiente para concluir a compra.');</script>";
}

 if ($_GET) { 
     
    $operacao      = $_GET['operacao'];
    if(isset($_GET['codigoProduto'])){
    $codigoProduto = $_GET['codigoProduto'];
    
    // obtem a qtd atual desse produto no carrinho  
    $quantidade = intval ( ValorSQL($conn," select qtde 
                                            from tbl_carrinho 
                                            where 
                                               cod_produto = $codigoProduto and 
                                               cod_compra = $codigoCompra ") ); 
    } 
    if ($operacao == 'incluir') {
        echo "<br> >> Vamor incluir...<br>";
        if ($quantidade == 0) {
            ExecutaSQL($conn,
                      " insert into tbl_carrinho 
                           (cod_produto,cod_compra,qtde) 
                        values ($codigoProduto,$codigoCompra,1) "); 
        } else {
            ExecutaSQL($conn,
                      " update tbl_carrinho 
                           set qtde = qtde + 1 
                        where 
                           cod_produto = $codigoProduto and 
                           cod_compra = $codigoCompra "); 
                       
        }
    } else 
    if ($operacao == 'diminuir') {
        echo "<br> >> Vamor excluir...<br>";     
        if ($quantidade == 1) { 
            ExecutaSQL($conn," delete from 
                                  tbl_carrinho 
                               where 
                                  cod_produto = $codigoProduto and 
                                  cod_compra = $codigoCompra ");         
        } else {
            ExecutaSQL($conn," update tbl_carrinho 
                                   set qtde = qtde - 1 
                               where 
                                  cod_produto = $codigoProduto and 
                                  cod_compra = $codigoCompra ");       
        }
    } else 
    if ($operacao == 'excluir')
    {
    ExecutaSQL($conn," delete from 
    tbl_carrinho 
    where 
    cod_produto = $codigoProduto and 
    cod_compra = $codigoCompra ");
    $total=null;
    } else
    if ($operacao == 'fechar') {
       // Verificar se h· produtos suficientes em estoque
    $produtosNoCarrinho = $conn->query("SELECT cod_produto, qtde FROM tbl_carrinho WHERE cod_compra = $codigoCompra");

    $estoqueSuficiente = true;
    while ($produtoNoCarrinho = $produtosNoCarrinho->fetch()) {
        $codigoProduto = $produtoNoCarrinho['cod_produto'];
        $quantidadeNoCarrinho = $produtoNoCarrinho['qtde'];

        // Verificar a quantidade em estoque
        $quantidadeEmEstoque = ValorSQL($conn, "SELECT quantidade FROM tbl_produto WHERE cod_produto = $codigoProduto");

        if ($quantidadeNoCarrinho > $quantidadeEmEstoque) {
            $estoqueSuficiente = false;
            break;
        }
    }

    if ($estoqueSuficiente) {
        // Baixar a quantidade de produtos no estoque
        $produtosNoCarrinho = $conn->query("SELECT cod_produto, qtde FROM tbl_carrinho WHERE cod_compra = $codigoCompra");
        while ($produtoNoCarrinho = $produtosNoCarrinho->fetch()) {
            $codigoProduto = $produtoNoCarrinho['cod_produto'];
            $quantidadeNoCarrinho = $produtoNoCarrinho['qtde'];

            // Atualizar a quantidade no banco de dados
            ExecutaSQL($conn, "UPDATE tbl_produto SET quantidade = quantidade - $quantidadeNoCarrinho WHERE cod_produto = $codigoProduto");
        }

        // Aqui vocÍ pode definir o status da compra como "ConcluÌda" e fazer outros procedimentos necess·rios.
        // ...
    header("Location: fim.html");
    exit; 
    } else {
        // Se n„o houver estoque suficiente, exiba uma mensagem de erro.
    header("Location: carrinho.php?compra_falhou=true");
    exit; 
    }
    }
    
}
    
 
 $sql = " select tbl_produto.cod_produto, 
                 tbl_produto.descricao as descprod, 
                 tbl_produto.quantidade,
		 tbl_produto.nome,
                 tbl_carrinho.qtde, 
                 tbl_produto.preco, 
                 tbl_produto.preco * tbl_carrinho.qtde as sub,
                 tbl_produto.campo_imagem 
          from tbl_produto 
               inner join tbl_carrinho on 
                  tbl_produto.cod_produto = tbl_carrinho.cod_produto 
          where tbl_carrinho.cod_compra = $codigoCompra  
          order by tbl_produto.descricao ";
 
 $select = $conn->query($sql);
   
 // cria table com itens no carrinho e seus subtotais
 

 echo "<!DOCTYPE html>
 <html lang='pt-br'>
 <head>
     <meta charset='UTF-8'>
     <meta name='viewport' content='width=device-width, initial-scale=1.0'>
     <title>Carrinho de Compras</title>
     <link rel='stylesheet' href='carrinho.css'>
     <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
 </head>
 <body>  
 
     <main>
         <div class='content'>
 
         
 
            <div class='table'>
 
                 <div class='head'>
                     <div class='alinhamento'>
                         <div class='produto'>Produto</div>
                         <div class='preco'>Pre√ßo</div>
                         <div class='qtd'>Quantidade</div>
                         <div class='total'>Total</div>
                         <div class='nada'>-</divm>
                     </div>
                 </div>";
                    $total=0;
                 while ( $linha = $select->fetch() ) {
      
                  $codigoProduto = $linha['cod_produto']; 
                  $descProd      = $linha['descprod'];
                  $nome          = $linha['nome'];
                  $quant         = $linha['qtde'];
                  $vunit         = $linha['preco'];
                  $sub           = $linha['sub'];
                  $quantidade    =$linha['quantidade'];
                  $imagem        =$linha['campo_imagem'];

                  if ($quantidade == 0) {
                    $produtoEsgotado = true;
                    // Exibe a mensagem de produto esgotado
                    echo "<section>
                        <div class='body'>
                            <div class='linha'>
                                <div class='area_prod'>
                                    <div class='product'>
                                        <img src='https://projetoscti.com.br/projetoscti16/Ecommerce/doit/imagens/$imagem' alt=''>
                                        <div class='info'>
                                            <div class='nome' style='width: 110.350;'>$nome</div>
                                            <div class='categoria'>Produto Esgotado</div>
                                        </div>
                                        <div class='alinhamento'>
                                            <div class='total'>R$ $sub</div>
                                            <div class='preco'>R$ $vunit</div>
                                            <div class='remove'><button id='remove'><a style='color:gray' href='carrinho.php?operacao=excluir&codigoProduto=$codigoProduto'>X</a></button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>";
                    }else{

                 echo "<section> 
                 <div class='body'>
                     <div class='linha'>
                         <div class='area_prod'>
                             <div class='product'>
                                 <img src='https://projetoscti.com.br/projetoscti16/Ecommerce/doit/imagens/$imagem' alt=''>
                                 <div class='info'>
                                     <div class='nome' style='width: 110.350;'>$nome</div>
                                     <div class='categoria'>Categoria</div>
                                 </div>
                                     <div class='alinhamento'>
                                         <div class='total'>R$ $sub</div>
                                         <div class='preco'>R$ $vunit</div>
                                         <div class='qty'><button><a style='color:gray' href='carrinho.php?operacao=incluir&codigoProduto=$codigoProduto'>+</a></button> <span>$quant</span> <button><a style='color:gray' href='carrinho.php?operacao=diminuir&codigoProduto=$codigoProduto'>-</a></button></div>
                                         <div class='remove'><button id='remove'><a style='color:gray' href='carrinho.php?operacao=excluir&codigoProduto=$codigoProduto'>X</a></button></div>
                                       
                                     </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                      </section>";
                    }
         
         $total = ValorSQL($conn," select sum (tbl_produto.preco * tbl_carrinho.qtde)  
         from tbl_produto 
              inner join tbl_carrinho on 
                 tbl_produto.cod_produto = tbl_carrinho.cod_produto                           
         where tbl_carrinho.cod_compra = $codigoCompra "); 
         
}

if($total!=null){
echo "<aside>
             <div class='box'>
                 
                 <div class='info'>
                     <div><span>Sub-total</span><span>$total</span></div>
                     <div><span>Frete</span><span>Gratuito</span></div>
                     <div><button>
                         Adicionar cupom de desconto 
                         <i class='bx bx-right-arrow-alt'></i>
                     </button>
                 </div>
             </div>
                 <footer>
                     <span>Total</span>
                     <span>R$ $total</span>
                 </footer>
             </div>
             <button><a href='carrinho.php?operacao=fechar&codigoCompra=$codigoCompra'>Finalizar Compra</a></button>
         </aside>
         </div>";
}

echo"
 </main>
 </body>
 </html>";


/* 
 echo "<br><strong>Compras ateh o momento...</strong><br>
 
       <table border='1'>
        <tr>
         <td>Produto</td>
         <td>Qtd</td>
         <td>$ unit</td>
         <td>$ sub</td>
         <td></td>
        </tr>";
   
 $select = $conn->query($sql);
   
 // cria table com itens no carrinho e seus subtotais
 while ( $linha = $select->fetch() ) {
      
      $codigoProduto = $linha['cod_produto']; 
      $descProd      = $linha['descprod'];
      $quant         = $linha['qtde'];
      $vunit         = $linha['preco'];
      $sub           = $linha['sub'];

      // vc poderia incluir links para 'incluir' alem dos 'excluir'
      // com isso, o usuario nao precisaria voltar na home pra incrementar 
      // a quantidade do mesmo produto

      echo "<tr>
             <td>$descProd</td>
             <td>$quant</td>
             <td>$vunit</td>
             <td>$sub</td>
             <td><a href='carrinho.php?operacao=excluir&codigoProduto=$codigoProduto'>Excluir</a></td>
            </tr>";    
 }
 
 echo "</table>";
 
 // calcula o total e mostra junto com o status da compra     
 $total = ValorSQL($conn," select sum (tbl_produto.preco * tbl_carrinho.qtde)  
                           from tbl_produto 
                                inner join tbl_carrinho on 
                                   tbl_produto.cod_produto = tbl_carrinho.cod_produto                           
                           where tbl_carrinho.cod_compra = $codigoCompra AND tbl_produto.quantidade > 0"); 

 echo "Status da compra: $statusCompra<br>";
 echo "Total: $total <br><br>";
 
 // se o login foi obtido (se esta logado), mostra link 'fechar carrinho' 
 if ( isset($login) ) 
 {
   if ($statusCompra == 'Pendente' && $login <> '') {
     echo "<a href='carrinho.php?operacao=fechar&codigoProduto=0'>Fechar o carrinho</a>";         
   }
 }

 // link pra voltar pra home
 echo "<br>
       <a href='index.php'>Home</a>";   
 */
 
?>