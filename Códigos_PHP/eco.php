<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include("cabecalho1.php");
echo "

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0'>

    <title>Home</title>
    <link rel='stylesheet' href='slide.css'>
    <link rel='stylesheet' href='ecocss.css'>
    <link rel='stylesheet' media='screen and (min-width: 900px)' href='widescreen.css'>
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500&display=swap' rel='stylesheet'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css' integrity='sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==' crossorigin='anonymous' referrerpolicy='no-referrer' />

    <link rel='stylesheet' href='https://unpkg.com/boxicons@latest/css/boxicons.min.css'>
    <script src='Slider.js'></script>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/css/lightslider.css' integrity='sha512-+1GzNJIJQ0SwHimHEEDQ0jbyQuglxEdmQmKsu8KI7QkMPAnyDrL9TAnVyLPEttcTxlnLVzaQgxv2FpLCLtli0A==' crossorigin='anonymous' referrerpolicy='no-referrer' />




    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css'>
</head>
<body>

    
    
   <div class='slider'>
        <div class='list'>
            <div class='item'>
                <img src='https://projetoscti.com.br/projetoscti16/Ecommerce/doit/imagens/test.jpeg'>
            </div>

            <div class='item'>
                <img src='https://projetoscti.com.br/projetoscti16/Ecommerce/doit/imagens/test1.jpeg'>
            </div>

            <div class='item'>
                <img src='https://projetoscti.com.br/projetoscti16/Ecommerce/doit/imagens/test2.jpeg'>
            </div>
        </div>
    </div>

    <div class='buttons'>
        <button id='prev'><</button>
        <button id='next'>></button>
    </div>

    <script src='slide1.js'></script>
  
    <hr>
   <section class='main-home'>
        <div class='main-text'>
            <h5>Confira novas ofertas</h5>
            <h1>Novo Planner<br> Coleção 2023</h1>
            <p>Ultimas unidades</p>
            <br>

            <a href='Produto2.php' class='main-btn'>Compre agora<i class='bx bx-right-arrow-alt'></i></a>
        
    
            <div class='down-arrow'>
                <a href='#ancora' class='down'><i class='bx bx-down-arrow-alt'></i></a>
            </div>

                                                    
        </div>
    </section>


   <br><hr>

   
   <h1 class='txt-sobre'>Sobre</h1>
   
   <!-- VIDEO E DESCRIÇÃO -->
   <section class='descricao'>
        <div class='video'><iframe width='560' height='315' src='https://www.youtube.com/embed/H5zCV80FP84?si=zB35jkskeugIk41Z' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' allowfullscreen></iframe></div>
        <div class='sobre'><p>
        O vestibular é um dos momentos mais desafiadores na vida de um estudante. A preparação exige dedicação, foco e, acima de tudo, organização. Afinal, são diversas matérias para estudar, prazos a cumprir e muitos conteúdos para revisar. É aí que entra o 'Planejador para Vestibulares', uma ferramenta criada para auxiliar e facilitar a vida dos estudantes nessa jornada tão importante.

        O principal objetivo desse planner é simplificar o processo de preparação para o vestibular. Ele não é apenas uma agenda comum, mas sim uma poderosa ferramenta de organização. Com ele, os estudantes podem planejar cada etapa do estudo, definir metas, acompanhar o progresso e nunca mais se perder no emaranhado de matérias e datas.
        </p></div>
   </section>

        <section class='doit-populares'>
            <div class='center-text'>
                <h2>Produtos em <span>Promoção</span> </h2>
            </div>
            <!--Produto 1-->
            <div class='products' id='#trending'>
                <div class='row'>
                    <img src='https://projetoscti.com.br/projetoscti16/Ecommerce/doit/imagens/31.jpg'>
                    <div class='product-text'>
                        <h5>Sale</h5>
                    </div>
                   
                    <div class='price'>
                        <h4>Planner Personalizado</h4>
                        <p>R$18</p>
                        <a href='carrinho.php?operacao=incluir&codigoProduto=31' class='button'>Comprar</a>
                    </div>
                    
                
                </div>


                <!--produto2-->
                <div class='row'>
                    <img src='https://projetoscti.com.br/projetoscti16/Ecommerce/doit/imagens/5.jpg'>
                    <div class='product-text'>
                        <h5>Sale</h5>
                    </div>
                    
                   
                    <div class='price'>
                        <h4>Kit área de churrasco</h4>
                        <p>R$35,00</p>
                        <a href='carrinho.php?operacao=incluir&codigoProduto=5' class='button'>Comprar</a>
                    </div>
                </div>

                <!--Produto3-->
                <div class='row'>
                    <img src='https://projetoscti.com.br/projetoscti16/Ecommerce/doit/imagens/3.png'>
                    <div class='product-text'>
                        <h5>Hot</h5>
                    </div>
                    
                    <div class='price'>
                        <h4>Quadro-desenhos</h4>
                        <p>R$10,00</p>
                        <a href='carrinho.php?operacao=incluir&codigoProduto=13' class='button'>Comprar</a>
                    </div>
                </div>


                <!--Produto4-->
                <div class='row'>
                    <img src='https://projetoscti.com.br/projetoscti16/Ecommerce/doit/imagens/4.png'>
                    <div class='product-text'>
                        <h5>NEW</h5>
                    </div>
                   
                   
                    <div class='price'>
                        <h4>Quadro cozinha</h4>
                        <p>R$10,00</p>
                        <a href='carrinho.php?operacao=incluir&codigoProduto=21' class='button'>Comprar</a>
                    </div>
                </div>

                <!--Produto5-->
                <div class='row'>
                    <img src='https://projetoscti.com.br/projetoscti16/Ecommerce/doit/imagens/22.png'>
                    <div class='product-text'>
                        <h5>NEW</h5>
                    </div>
                  
                    
                    <div class='price'>
                        <h4>Quadro cozinha</h4>
                        <p>R$10,00</p>
                        <a href='carrinho.php?operacao=incluir&codigoProduto=22' class='button'>Comprar</a>
                    </div>
                </div>


                <!--Produto6-->
                <div class='row'>
                    <img src='https://projetoscti.com.br/projetoscti16/Ecommerce/doit/imagens/23.png'>
                    <div class='product-text'>
                        <h5>NEW</h5>
                    </div>
     
                    <div class='price'>
                        <h4>Quadro cozinha</h4>
                        <p>R$10,00</p>
                        <a href='carrinho.php?operacao=incluir&codigoProduto=23' class='button'>Comprar</a>
                    </div>
                </div>




            </div>
        </section> 
    
    <h1><strong class='produ'>Produtos</strong></h1>
    <section class='product-slider'>
    
        <ul id='autoWidth' class='cs-hidden'>
            <li class='item-a'>
            <div class='product-box'>
                    <a href='down'>
                        <strong>Planner</strong>
                        <!---IMG---------->
                        <img src='https://projetoscti.com.br/projetoscti16/Ecommerce/doit/imagens/31.jpg' alt='Planner Personalizado'>
        
                        <!--preco de compra-->
                        <div class='buy-price'>
                            <!--Preço-->
                            <p>R$18,00</p>
                            <!--btn-->
                            <a href='carrinho.php?operacao=incluir&codigoProduto=31' class='buy-btn'>Comprar</a>
                        </div>
                    </a>
            </div>
            </li>

            <li class='item-a'>
                <div class='product-box'>
                        <a href='#'>
                            <strong>Kit área de churrasco</strong>
                            <!---IMG---------->
                            <img src='https://projetoscti.com.br/projetoscti16/Ecommerce/doit/imagens/5.jpg' alt='Planner Personalizado'>
                            <!--Color------>
                           
                            <!--preco de compra-->
                            <div class='buy-price'>
                                <!--Preço-->
                                <p>R$35,00</p>
                                <!--btn-->
                                <a href='carrinho.php?operacao=incluir&codigoProduto=5' class='buy-btn'>Comprar</a>
                            </div>
                        </a>
                </div>
                </li>


                <li class='item-a'>
                    <div class='product-box'>
                            <a id='ancora'>
                                <strong>Adesivos</strong>
                                <!---IMG---------->
                                <img src='https://projetoscti.com.br/projetoscti16/Ecommerce/doit/imagens/32.png' alt='Planner Personalizado'>
                                <!--Color------>
                               
                                <!--preco de compra-->
                                <div class='buy-price'>
                                    <!--Preço-->
                                    <p> 2 adesivos por R$1,00</p>
                                    <!--btn-->
                                    <a href='carrinho.php?operacao=incluir&codigoProduto=32' class='buy-btn'>Comprar</a>
                                </div>
                            </a>
                    </div>
                    </li>


                    <li class='item-a'>
                        <div class='product-box'>
                                <a href='#ancora'>
                                    <strong>Quadro cozinha</strong>
                                    <!---IMG---------->
                                    <img src='https://projetoscti.com.br/projetoscti16/Ecommerce/doit/imagens/22.png' alt='Planner Personalizado'>
                                    <!--Color------>
                                   
                                    <!--preco de compra-->
                                    <div class='buy-price'>
                                        <!--Preço-->
                                        <p>R$10,00</p>
                                        <!--btn-->
                                        <a href='carrinho.php?operacao=incluir&codigoProduto=22' class='buy-btn'>Comprar</a>
                                    </div>
                                </a>
                        </div>
                        </li>


        
        </ul>




    </section>

    
   
    <!--Script-->
    <script src='https://code.jquery.com/jquery-3.7.1.js' integrity='sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=' crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/js/lightslider.min.js' integrity='sha512-Gfrxsz93rxFuB7KSYlln3wFqBaXUc1jtt3dGCp+2jTb563qYvnUBM/GP2ZUtRC27STN/zUamFtVFAIsRFoT6/w==' crossorigin='anonymous' referrerpolicy='no-referrer'></script>

    <script>

        $(document).ready(function() {
            $('#autoWidth').lightSlider({
                autoWidth: true,
                loop: true,
                auto: true, // Ativar rolagem automática
                pause: 10000, // Pausa de 12 segundos entre cada slide
                onSliderLoad: function() {
                    $('#autoWidth').removeClass('cs-hidden');
                }
            });
        });
    </script>



    <a class='float-btn' href='https://linktr.ee/doitplanners?fbclid=PAAaZZFZ404buHhHG1lMVH7iF-cWcXYAMb0XMYX8rPUQrA-p9jppfvGkRdhqY'> 
    <svg xmlns='http://www.w3.org/2000/svg' width='20px' height='20' fill='currentColor' class='bi bi-instagram' viewBox='0 0 16 16'>
    <path d='M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z'/>
    </svg>
    
    
    
    
    
    </a>
    <a  class='whats'  href='https://wa.me/5514998460106?text=Adorei%20seu%20artigo' target='_blank'>
    <i style='margin-top:16px;' class='fa fa-whatsapp'></i>
    </a>



 <footer class='footer'>
 <div class='container'>
  <div class='roww'>
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



       
    



    <script src='https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js'></script>
    <script src='Slider.js'></script>
                              




</body>
</html>







";
?>