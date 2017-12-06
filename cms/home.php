<?php

    session_start();

	//Conexão com o banco
    include_once('../conexao/mysql.php');

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cms - Sistema de Gerenciamento</title>
        <link rel="stylesheet" href="css/cssUniversal.css">
        <link rel="stylesheet" href="css/home.css">
        <link href="fontes/openSans" rel="stylesheet">
        <link rel="icon" href="../icon.png" type="image/x-icon" />
        <link rel="shortcut icon" href="../icon.png" type="image/x-icon" />
        <script type="text/javascript" src="jquery/jquery-2.2.4.js" ></script>
        <script type="text/javascript" src="jquery/jquerymaskplugin.js" ></script>
        <script>
            //Inclui uma janelinha que mostra os detalhes do usuário quando é passado
            //o mouse por cima da foto
            <?php include_once('jsFunctions/mostrarJanelaDetalhes.js');?>
            
            //Abaixa as informações e boas vindas
            $(document).ready(function(){
                setInterval(function(){
                    $("#div_infos").animate({"margin-top":"0"});
                }, 500)
            })
            
        </script>
    </head>
    <body>
        <div id="esqueleto">
            <!--Cabeçalho-->
            <?php include_once('cabecalho/cabecalho.php');?>
            <!--Conteúdo-->
            <section>
                <!--Menu-->
                <!--Inclui o menu que irá aparecer em todas as páginas-->
                <?php include_once('externos/menu_universal.php'); ?>
                <!--Título do Crud-->
                <div id="div_titulo_crud">
                    <div id="titulo_crud">
                        Olá!
                    </div>
                    <!--Icone do Crud-->
                    <div id="div_icone_crud">
                        <img src="img/welcomeIcon.png" alt="">
                    </div>
                </div>
                <!--Crud-->
                <div id="div_foraTabela">
                    <div id="div_conteudo">
                        <!--Img do funcionário-->
                        <div id="div_imgHomeF" onclick="teste()">
                            <div id="imgHomeF">
                                <img src="<?php echo($fotoFuncionarioU); ?>" alt="">
                            </div>
                        </div>
                        <div id="div_infos">
                            <div class="div_infoF2">
                                <div class="infoF">
                                    <?php

                                    $nomeFCapitalizado = "";

                                    //Deixa minusculo as palavras e depois capitaliza o inicio de cada uma
                                    $nomeF = strtolower($nomeFuncionarioU);

                                    //Separa os nomes dos espaço
                                    $partesNome = explode(" ", $nomeF);
                                    //Condição para contar quantas palavras o nome da pessoa tem
                                    $i = 0;
                                    while($i < count($partesNome)){
                                        $nomeFCapitalizado = $nomeFCapitalizado." ".ucfirst($partesNome[$i]);
                                        $i++;
                                    }

                                    ?>
                                    Bem Vindo(a) <?php echo($nomeFCapitalizado); ?>
                                </div>
                            </div>
                            <div class="div_infoF">
                                <div class="infoF">
                                    Passo a passo para dúvidas
                                </div>
                            </div>
                            <div class="div_infoF2">
                                <div class="infoF">
                                    Utilize os botões à esquerda para acessar o gerenciamento de uma página específica.
                                </div>
                            </div>
                            <div class="div_infoF">
                                <div class="infoF">
                                    Passe o mouse sobre sua imagem de perfil para poder ver suas informações básicas e também
                                    sair se for de sua vontade.
                                </div>
                            </div>
                            <div class="div_infoF2">
                                <div class="infoF">
                                    Clique na imagem do perfil para voltar a esta página.
                                </div>
                            </div>
                            <div class="div_infoF">
                                <div class="infoF">
                                    Clique no logo do restaurante para sair do CMS.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--Rodapé-->
            <?php include_once('rodape/rodape.php'); ?>
        </div>    
    </body>
</html>
