<?php

    session_start();

    //Conexão com o banco
    include_once('../conexao/mysql.php');

    $sql = "select * from tbl_cargopermissao where id_cargo = ".$_SESSION['idCargoFuncionarioU']." and id_permissao = 4";
    $select = mysql_query($sql) or die(mysql_error());

    if($rs=mysql_fetch_array($select)){

    }else{
        //Faz o usuário voltar para a home caso não seja cadastrado e queira entrar pela url
        ?>
            <script>window.location = "../index.php";</script>
        <?php
    }
    //Removendo Probabilidade de Erros Por Campos Não opcionais vazios
    $nomeCardapio = "";
    $selectRestaurante = "";

    //Muda o titulo do PopUp
	$tituloPopUp = "Cadastrar";
	//Muda o value do botão
	$valueBotao = "Cadastrar";

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cms - Sistema de Gerenciamento</title>
        <link rel="stylesheet" href="css/cssUniversal.css">
        <link rel="stylesheet" href="css/crud_cardapio.css">
        <link href="fontes/openSans" rel="stylesheet">
        <link href="fontes/openSans" rel="stylesheet">
        <link rel="icon" href="../icon.png" type="image/x-icon" />
        <script type="text/javascript" src="jquery/jquery-2.2.4.js" ></script>
        <script type="text/javascript" src="jquery/jquerymaskplugin.js" ></script>
        <script>
            //Inclui uma janelinha que mostra os detalhes do usuário quando é passado
            //o mouse por cima da foto
            <?php include_once('jsFunctions/mostrarJanelaDetalhes.js');?>
            //Inclui o pop up do cadastro da página
            <?php include_once('jsFunctions/popup.js');?>
        </script>
    </head>
    <body>
        <!--Fundo Transparente-->
        <div id="fundo_transparente">

        </div>
        <div id="esqueleto">
            <?php include_once('externos/cadastros/cardapio/popupCadastro.php'); ?>
            <?php include_once('externos/cadastros/cardapio/popupAdicionar.php'); ?>
            <!--Cabeçalho-->
            <?php

                include_once('cabecalho/cabecalho.php');

                if(isset($_POST['btnCadastrar'])){

                    //Resgata os valores
                    $nomeCardapio = $_POST['txt_nomeCardapio'];
                    $selectRestaurante = $_POST['selectRestaurante'];

                    if($_POST['btnCadastrar'] == 'Cadastrar'){

                        //Comando SQL
                        $sql = "insert into tbl_cardapio (id_restaurante, nome, status)";
                        $sql = $sql." values(".$selectRestaurante.", '".$nomeCardapio."', 0)";

                        if(mysql_query($sql) or die(mysql_error())){
                            $idCardapio = mysql_insert_id();
                        }else{
                            ?>
                                <script>
                                    swal({
                                      title: "Erro!",
                                      text: "Houve um erro no nosso Banco de Dados.",
                                      type: "error",
                                      icon: "error",
                                      button: {
                                                 text: "Ok",
                                               },
                                      closeOnEsc: true,
                                    });
                                    //Voltar para o php sem dados na url
                                    setTimeout(function(){
                                        window.location = "crud_cardapio.php";
                                    }, 1800);
                                </script>
                            <?php
                        }

                        //Seleciona os ingredientes existentes no banco
                        $sql = "select * from tbl_produto where statusAprovacao = 1";

                        $select = mysql_query($sql) or die(mysql_error());

                        while($rs = mysql_fetch_array($select)){
                            $nome = $rs['nome'];
                            $retirarAcentos = str_replace('á', 'a', $nome);
                            $retirarAcentos = str_replace('ã', 'a', $retirarAcentos);
                            $retirarAcentos = str_replace('é', 'e', $retirarAcentos);
                            $retirarAcentos = str_replace('ê', 'e', $retirarAcentos);
                            $retirarAcentos = str_replace('ó', 'o', $retirarAcentos);
                            $retirarAcentos = str_replace('ô', 'o', $retirarAcentos);
                            $nameInput = str_replace(' ', '_', $retirarAcentos);
                            $nameInput = strtolower($nameInput);

                            //Se for marcado e achado no post a opção das marcações
                            if(isset($_POST[$nameInput])){

                                if($nameInput != null){

                                    $idProduto = $_POST[$nameInput];
                                    //Insert na tabela relação entre o produto e ingredientes
                                    $sql2 = "insert into tbl_cardapioproduto(id_cardapio, id_produto, principais)";

                                    $sql2 = $sql2." values('".$idCardapio."', '".$idProduto."', 0)";

                                    if(mysql_query($sql2) or die(mysql_error())){
                                        ?>
                                            <script>
                                                swal({
                                                  title: "Sucesso!",
                                                  text: "Cadastro realizado com Sucesso!",
                                                  type: "success",
                                                  icon: "success",
                                                  button: {
                                                             text: "Ok",
                                                         },
                                                  closeOnEsc: true,
                                              });
                                              //Voltar para o php sem dados na url
                                              setTimeout(function(){
                                                  window.location = "crud_cardapio.php";
                                              }, 1800);
                                            </script>
                                        <?php
                                    }else{
                                        ?>
                                            <script>
                                                swal({
                                                  title: "Erro!",
                                                  text: "Houve um erro no nosso Banco de Dados.",
                                                  type: "error",
                                                  icon: "error",
                                                  button: {
                                                             text: "Ok",
                                                           },
                                                  closeOnEsc: true,
                                                });
                                                //Voltar para o php sem dados na url
                                                setTimeout(function(){
                                                    window.location = "crud_cardapio.php";
                                                }, 1800);
                                            </script>
                                        <?php
                                    }

                                }else{
                                    $nameInput = "";
                                }
                            }
                        }

                    }elseif($_POST['btnCadastrar'] == 'Alterar'){

                        //O id que é pego da sessão
                        $idHref = $_SESSION["idCardapio"];

                        //Update na tabela produto
                        $sql = "update tbl_cardapio set id_restaurante = ".$selectRestaurante.", nome = '".$nomeCardapio."' where id_cardapio = ".$idHref;

                        if(mysql_query($sql) or die(mysql_error())){
                            $idCardapio = mysql_insert_id();
                        }else{
                            ?>
                                <script>
                                    swal({
                                      title: "Erro!",
                                      text: "Houve um erro no nosso Banco de Dados.",
                                      type: "error",
                                      icon: "error",
                                      button: {
                                                 text: "Ok",
                                               },
                                      closeOnEsc: true,
                                    });
                                    //Voltar para o php sem dados na url
                                    setTimeout(function(){
                                        window.location = "crud_cardapio.php";
                                    }, 1800);
                                </script>
                            <?php
                        }



                        //Deleta os dadados da tabela antes de fazer o insert das novas alterações
                        $sql = "delete from tbl_cardapioproduto where id_cardapio = ".$idHref;
                        mysql_query($sql);

                        //Seleciona os cargos existentes no banco
                        $sql = "select * from tbl_produto";

                        $select = mysql_query($sql) or die(mysql_error());

                        while($rs = mysql_fetch_array($select)){
                            $nome = $rs['nome'];
                            $retirarAcentos = str_replace('á', 'a', $nome);
                            $retirarAcentos = str_replace('ã', 'a', $retirarAcentos);
                            $retirarAcentos = str_replace('é', 'e', $retirarAcentos);
                            $retirarAcentos = str_replace('ê', 'e', $retirarAcentos);
                            $retirarAcentos = str_replace('ó', 'o', $retirarAcentos);
                            $retirarAcentos = str_replace('ô', 'o', $retirarAcentos);
                            $nameInput = str_replace(' ', '_', $retirarAcentos);
                            $nameInput = strtolower($nameInput);


                            if(isset($_POST[$nameInput])){

                                if($nameInput != null){

                                    $idProduto = $_POST[$nameInput];
                                    //Insert na tabela relação entre cargo e permissão
                                    $sql2 = "insert into tbl_cardapioproduto (id_cardapio, id_produto)";

                                    $sql2 = $sql2." values('".$idHref."', '".$idProduto."')";

                                    if(mysql_query($sql2) or die(mysql_error())){
                                        unset($_SESSION["idCardapio"]);
                                        ?>
                                            <script>
                                                swal({
                                                  title: "Sucesso!",
                                                  text: "Dados Alterados com sucesso!",
                                                  type: "success",
                                                  icon: "success",
                                                  button: {
                                                             text: "Ok",
                                                         },
                                                  closeOnEsc: true,
                                                  });
                                                  //Voltar para o php sem dados na url
                                                  setTimeout(function(){
                                                      window.location = "crud_cardapio.php";
                                                  }, 1800);
                                            </script>
                                        <?php
                                    }else{
                                        ?>
                                            <script>
                                                swal({
                                                  title: "Erro!",
                                                  text: "Houve um erro no nosso Banco de Dados.",
                                                  type: "error",
                                                  icon: "error",
                                                  button: {
                                                             text: "Ok",
                                                           },
                                                  closeOnEsc: true,
                                                });
                                                //Voltar para o php sem dados na url
                                                setTimeout(function(){
                                                    window.location = "crud_cardapio.php";
                                                }, 1800);
                                            </script>
                                        <?php
                                    }


                                }else{
                                    $nameInput = "";
                                }
                            }
                        }
                    }
                }

                if(isset($_POST['btnAdicionar_produtos'])){

                    //Deleta os dadados da tabela antes de fazer o insert das novas alterações
                    $sql = "update tbl_cardapioproduto set principais = 0 where id_cardapio = ".$_SESSION['idCardapioPrincipal'];
                    mysql_query($sql);

                    //Seleciona os cargos existentes no banco
                    $sql = "select * from tbl_produto";

                    $select = mysql_query($sql) or die(mysql_error());

                    while($rs = mysql_fetch_array($select)){
                        $nome = $rs['nome'];
                        $retirarAcentos = str_replace('á', 'a', $nome);
                        $retirarAcentos = str_replace('ã', 'a', $retirarAcentos);
                        $retirarAcentos = str_replace('é', 'e', $retirarAcentos);
                        $retirarAcentos = str_replace('ê', 'e', $retirarAcentos);
                        $retirarAcentos = str_replace('ó', 'o', $retirarAcentos);
                        $retirarAcentos = str_replace('ô', 'o', $retirarAcentos);
                        $nameInput = str_replace(' ', '_', $retirarAcentos);
                        $nameInput = strtolower($nameInput);


                        if(isset($_POST[$nameInput])){

                            if($nameInput != null){

                                $idProduto = $_POST[$nameInput];
                                //Insert na tabela relação entre cargo e permissão
                                $sql2 = "update tbl_cardapioproduto set principais = 1 where id_cardapio = ".$_SESSION['idCardapioPrincipal']." and id_produto = ".$idProduto;

                                if(mysql_query($sql2) or die(mysql_error())){
                                    unset($_SESSION["idCardapio"]);
                                    ?>
                                        <script>
                                            swal({
                                              title: "Sucesso!",
                                              text: "Produtos adicionados aos principais!",
                                              type: "success",
                                              icon: "success",
                                              button: {
                                                         text: "Ok",
                                                     },
                                              closeOnEsc: true,
                                              });
                                              //Voltar para o php sem dados na url
                                              setTimeout(function(){
                                                  window.location = "crud_cardapio.php";
                                              }, 1800);
                                        </script>
                                    <?php
                                }else{
                                    ?>
                                        <script>
                                            swal({
                                              title: "Erro!",
                                              text: "Houve um erro no nosso Banco de Dados.",
                                              type: "error",
                                              icon: "error",
                                              button: {
                                                         text: "Ok",
                                                       },
                                              closeOnEsc: true,
                                            });
                                            //Voltar para o php sem dados na url
                                            setTimeout(function(){
                                                window.location = "crud_cardapio.php";
                                            }, 1800);
                                        </script>
                                    <?php
                                }


                            }else{
                                $nameInput = "";
                            }
                        }
                    }
                }

            ?>
            <!--Conteúdo-->
            <section>
                <!--Menu-->
                <!--Inclui o menu que irá aparecer em todas as páginas-->
                <?php include_once('externos/menu_universal.php'); ?>
                <!--Título do Crud-->
                <div id="div_titulo_crud">
                    <div id="titulo_crud">
                        Crud do Cardápio
                    </div>
                    <!--Icone do Crud-->
                    <div id="div_icone_crud">
                        <img src="img/cardapioIcon.png" alt="">
                    </div>
                </div>
                <!--Crud-->
                <div id="div_foraTabela">
                    <div id="div_conteudo">
                        <!--Tabela-->
                        <div id="tabela_crud_titulos">
                            <div class="titulo_colunaPoucosCampos">
                                Nome
                            </div>
                            <div class="titulo_colunaPoucosCampos">
                                Restaurante
                            </div>
                            <div class="titulo_4opcColuna">
                                Opções
                            </div>
                        </div>
                        <?php
                            
                            $idRestaurante = $_SESSION['idRestauranteFuncionarioU'];
                        
                            $sql = "select nome from tbl_cargo where id_cargo = ".$_SESSION['idCargoFuncionarioU'];
                            $select = mysql_query($sql);
                            if($rs=mysql_fetch_array($select)){
                                $nomeCargo = $rs['nome'];
                            }
                        
                            if($nomeCargo == 'Administrador'){
                                //Comando SQL
                                $sql = "select c.id_cardapio, c.nome as 'nomeCardapio', c.id_restaurante, c.status, r.nome as 'nomeRestaurante'
                                        from tbl_cardapio as c inner join tbl_restaurante as r on c.id_restaurante = r.id_restaurante";
                            }else{
                                //Comando SQL
                                $sql = "select c.id_cardapio, c.nome as 'nomeCardapio', c.id_restaurante, c.status, r.nome as 'nomeRestaurante'
                                        from tbl_cardapio as c 
                                        inner join tbl_restaurante as r on c.id_restaurante = r.id_restaurante 
                                        where c.id_restaurante = ".$idRestaurante;
                            }
                            
                            $select = mysql_query($sql) or die(mysql_error());

                            while($rs=mysql_fetch_array($select)){
                                $id = $rs['id_cardapio'];
                                $status = $rs['status'];

                                if($status == '0'){
                                    $imgAtivarDesativar = 'img/desativar.png';
                                }else{
                                    $imgAtivarDesativar = 'img/ativar.png';
                                }
                        ?>
                        <div class="tabela_crud_conteudo">
                            <div class="conteudo_colunaPoucosCampos">
                                <?php echo($rs['nomeCardapio']); ?>
                            </div>
                            <div class="conteudo_colunaPoucosCampos">
                                <?php echo($rs['nomeRestaurante']); ?>
                            </div>
                            <div class="coluna_4opcoes">
                                <!--Ativar-->
                                <a href="crud_cardapio.php?id=<?php echo($id); ?>&idR=<?php echo($rs['id_restaurante']); ?>&modo=ativar_desativar">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="<?php echo($imgAtivarDesativar); ?>" alt="" title="Ativar/Desativar">
                                        </div>
                                    </div>
                                </a>
                                <!--Adicionar Produto aos Principais-->
                                <a href="crud_cardapio.php?id=<?php echo($id); ?>&modo=principais">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="img/adicionarProdutoIcon.png" alt="" title="Adicionar Produto">
                                        </div>
                                    </div>
                                </a>
                                <!--Alterar-->
                                <a href="crud_cardapio.php?id=<?php echo($id); ?>&modo=alterar">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="img/alterar.png" alt="" title="Alterar">
                                        </div>
                                    </div>
                                </a>
                                <!--Apagar-->
                                <a href="crud_cardapio.php?id=<?php echo($id); ?>&modo=deletar">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="img/apagar.png" alt="" title="Apagar">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <!--Botão Cadastrar-->
                <button id="botao_cadastrar2" onclick="abrirPopUp()">
                    <img src="img/adicionarIcon.png" alt="" title="Cadastrar Permissão">
                </button>
            </section>
            <!--Rodapé-->
            <?php include_once('rodape/rodape.php'); ?>
        </div>
    </body>
</html>
