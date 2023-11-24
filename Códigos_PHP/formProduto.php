<?php 
   // mostra erros do php
   ini_set ( 'display_errors' , 1); 
   error_reporting (E_ALL);

   include("util.php");

   // pra nao ter que em todo arquivo colocar a mesma linha de conexao
   // manda vazio e no util.php deixa fixa 
   $conn = conecta();

   session_start();
   
   // se receber o codigousuario, EDITA !
   // senao INCLUE !
   if (isset($_GET['codigoProduto'])) {
       $codigoProduto = $_GET['codigoProduto']; 
   } else {
       $codigoProduto = ""; 
   }

   if ($codigoProduto == "") {
      // aqui se chegou um pedido de INCLUSAO

      $IncluiOuAtualiza = "incluirProduto.php";

     $codigoProduto = "";
     $nome          = "";
     $descricao       = "";
     $preco         = "";
     $qtd        = "";
     $codVisual          = "";
     $custo       = "";
     $lucro         = "";
     $icms       = "";
     $imagem          = "";
    

   } else {
     // aqui se chegou um pedido de ALTERACAO

     $sql = "SELECT * from tbl_produto  
             where cod_produto = $codigoProduto;" ;
     
     echo $sql;
     
     // faz um select basico
     $select = $conn->query($sql)->fetch();

     $IncluiOuAtualiza = "salvarProduto.php";

     $codigoProduto = $select['cod_produto'];
     $nome          = $select['nome'];
     $descricao     = $select['descricao'];
     $preco         = $select['preco'];
     $qtd           = $select['quantidade'];
     $codVisual     = $select['codigovisual'];
     $custo         = $select['custo'];
     $lucro         = $select['margem_lucro'];
     $icms          = $select['icms'];
     $imagem        = $select['campo_imagem'];
     $excluido      = $select['excluido'];
     $dataexclusao  = $select['data_exclusao'];
   } 

   // abaixo veja que ao usar hidden vc impede q que o campo seja editado 
   // mas envia o valor como $_POST
   $varHTML = "


   
     <html><header><head>
     <link rel='stylesheet' href='estilocadastro.css'/>
     <link rel='preconnect' href='https://fonts.googleapis.com'>
     <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
     <link href='https://fonts.googleapis.com/css2?family=Bungee&display=swap' rel='stylesheet'>
     </head></header>
      <body>
      <div class='container'>
      <div class='caixa'>
        <div class='conteudo'>
          <hgroup>
            <h1 id='head_cadastro'>Cadastro de Produtos</h1>
          </hgroup>
        <form action='$IncluiOuAtualiza' id='form_cadastro' method='post' enctype='multipart/form-data'>
        <div class='grid_cadastro'>

            <input type='hidden'  name='cod_produto' value = '$codigoProduto'>
            <div class='container_input_cadastro' id='nome'>
              <label for='nome'>Nome</label>
                <input 
                type='text'
                name='nome'
                placeholder='Nome'
                aria-label='Login'
                autocomplete off
                tabindex='1'
                value = '$nome'
                required
              />
            </div>
            
            <div class='container_input_cadastro' id='descricao'>
              <label for='descricao'>Descricao</label>
                <input 
                type='text'
                name='descricao'
                placeholder='Descricao'
                autocomplete off
                aria-label='Login'
                tabindex='2'
                value = '$descricao'
              />
            </div>

            <div class='container_input_cadastro' id='preco'>
              <label for='Preco'>Preco</label>
              <input
                type='text'
                name='preco'
                placeholder='Preco'
                aria-label='Login'
                autocomplete=off
                tabindex='3'
                value = '$preco'
                required
               />
            </div>

            <div class='container_input_cadastro' id='qtd'>
              <label for='Quantidade' >Quantidade</label>
              <input 
                type='text'
                name='quantidade'
                tabindex='4'
                placeholder='Quantidade'
                aria-label='Login'
                value = '$qtd'
                required
              />
              </div>

            <div class='container_input_cadastro' id='lucro'>
              <label for='custo'>Margem de lucro</label>
              <input 
                type='text'
                name='margem_lucro'
                placeholder='Margem de lucro'
                aria-label='Login'
                tabindex='5'
                value = '$lucro'
                required
            />
            </div>

            <div class='container_input_cadastro' id='custo'>
              <label for='custo'>Custo</label>
              <input 
                type='text'
                name='custo'
                placeholder='Custo'
                aria-label='Login'
                required
                maxlength='14'
                tabindex='6'
                value = '$custo'
                required
            />
            </div>

            <div class='container_input_cadastro' id='codv'>
              <label for='codigovisual'>Código Visual</label>
              <input 
                type='text'
                name='codigovisual'
                placeholder='Codigo visual'
                aria-label='Password'
                tabindex='7'
                value = '$codVisual'
                required
              />
            </div>
            
            
            <div class='container_input_cadastro' id='icms'>
              <label for='icms'>ICMS</label>
              <input 
                type='text'
                name='icms'
                placeholder='ICMS'
                aria-label='Password'
                tabindex='8'
                value = '$icms'
                required
              />
            </div>
            
            <div class='container_input_cadastro' id='campo_img'>
              <label for='imagem'>Imagem</label>
              <input
                type='file'
                name='campo_imagem'
                placeholder='Imagem'
                aria-label='Password'
                tabindex='9'
                style='
                padding-bottom: 26.462;
                padding-top: 8.462;'
                required
              />
            </div>";

   $varHTML = $varHTML.
    "   <div class='container_input_cadastro' id='salvar'>
        <input type='submit' value='Salvar' style='
        padding-bottom: 30.462;
        margin-top: 20px;'>
        </div>
        </form>
      </body>
     </html>
     ";
     
    echo $varHTML;
   
?>

          </div>
          </div> <!--Conteudo-->
        </div>
      </div><!--Caixa-->
    </div>
