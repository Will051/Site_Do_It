
<?php
 ini_set ( 'display_errors' , 1); 
 error_reporting (E_ALL);  


include("util.php");

session_start();

echo"
<div id='header1'>
    <header>
       
        <ul class='navmenu'>
            <li class='logo'><a href='eco.php' class='logo'><img src='https://projetoscti.com.br/projetoscti16/Ecommerce/doit/imagens/d (1).png'></a></li>
            <li><a href='eco.php'>Home</a></li>
            <li><a href='produtos.php'>products</a></li>
            <li><a href='Pag_Devs.html'>devs</a></li>
            <li><a href='PaginaSobre.html'>Sobre</a></li>";

	    if ($_GET) { 
  		$login      = $_GET['login'];
		$conn = conecta();
	    $sql = " select nome from tbl_usuario where email = '$login'";
 	    $select = $conn->query($sql);

	  while ( $linha = $select->fetch() ) {
                  $nome          = $linha['nome'];
          }

	    } 
          		
            if (isset($_SESSION['sessaoConectado'])) {
                echo "<li><a href='logout.php'>Sair</a></li>";
                echo "<li><a href='carrinho.php'>Carrinho</a></li>";

                echo "<li><a href='#'>Bom dia, $nome</a></li>";

                if ($_SESSION['sessaoAdmin']) {
                    echo "<li><a href='FormUsuarios.php'>Usuários</a></li>";
                    echo "<li><a href='FormProdutos.php'>Produtos</a></li>";
                    echo "<li><a href='Relatorio.php'>Relatório</a></li>";
                    // Adicione outras opções de administração aqui
                }
            } else {
                echo "<li><a href='login.php'>Login</a></li>";
            }
            ?>
        </ul>
        <div class='nav-icon'>
            <a href='login.php'><i class='bx bx-user'></i></a>
            <a href='carrinho.php'><i class='bx bx-cart'></i></a>
        </div>
    </header>
</div>