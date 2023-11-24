
<?php
 ini_set ( 'display_errors' , 1); 
 error_reporting (E_ALL);  
echo"
<div id='header1'>
    <header>
       
        <ul class='navmenu'>
            <li class='logo'><a href='eco.php' class='logo'><img src='https://projetoscti.com.br/projetoscti16/Ecommerce/PRODUTOS/d (1).png'></a></li>
            <li><a href='eco.php'>Home</a></li>
            <li><a href='produtos.php'>products</a></li>
            <li><a href='Pag_Devs.html'>devs</a></li>
            <li><a href='PaginaSobre.html'>Sobre</a></li>";


            if (isset($_SESSION['sessaoConectado'])) {
                echo "<li><a href='logout.php'>Sair</a></li>";
                echo "<li><a href='carrinho.php'>Carrinho</a></li>";

                echo "<li><a href='#'>Bom dia, $login</a></li>";

                if ($_SESSION['sessaoAdmin']) {
                    echo "<li><a href='usuarios.php'>UsuÃ¡rios</a></li>";
                    echo "<li><a href='produtos.php'>Produtos</a></li>";
                    echo "<li><a href='relatorio.php'>RelatÃ³rio</a></li>";
                    // Adicione outras opÃ§Ãµes de administraÃ§Ã£o aqui
                }
            } else {
                echo "<li><a href='login.php'>Login</a></li>";
            }
            ?>
        </ul>
        <div class='nav-icon'>
            <a href='#'><i class='bx bx-user'></i></a>
            <a href='carrinho.php'><i class='bx bx-cart'></i></a>
        </div>
    </header>
</div>