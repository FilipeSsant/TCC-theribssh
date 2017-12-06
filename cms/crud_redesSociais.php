<?php

    session_start();

	//Conexão com o banco
    include_once('../conexao/mysql.php');

    $sql = "select * from tbl_cargopermissao where id_cargo = ".$_SESSION['idCargoFuncionarioU']." and id_permissao = 17";
    $select = mysql_query($sql) or die(mysql_error());

    if($rs=mysql_fetch_array($select)){

    }else{
        //Faz o usuário voltar para a home caso não seja cadastrado e queira entrar pela url
        ?>
            <script>window.location = "../index.php";</script>
        <?php
    }

    //Removendo Probabilidade de Erros Por Campos Não opcionais vazios
    $nomeRedeSocial = "";
    $linkRedeSocial = "";
	$imgRedeSocial = "";
    //A variavel $imagemContinua serve para verificação de uma imagem que não quer ser alterada
    //assim pega a do banco e deixa como já esta
    $imagemContinua = 0;

    //Caso for cadastro se tornar requirido o campo imagem
    $requirido = "required";

    //Funcionamento para a função de cadastrar um novo registro
    $abrirPopUp = "";

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
        <link rel="stylesheet" href="css/crud_redesSociais.css">
        <link href="fontes/openSans" rel="stylesheet">
        <link href="fontes/openSans" rel="stylesheet">
        <link rel="icon" href="../icon.png" type="image/x-icon" />
        <script type="text/javascript" src="jquery/jquery-2.2.4.js" ></script>
        <script type="text/javascript" src="jquery/jquerymaskplugin.js" ></script>
        <!--Include no SweetAlert-->
        <script src = "../sweetalert/sweetalert.min.js" > </script>
        <!-- Include a polyfill for ES6 Promises (optional) for IE11 and Android browser -->
        <script src="../sweetalert/core.js"></script>
        <script>
            //Inclui uma janelinha que mostra os detalhes do usuário quando é passado
            //o mouse por cima da foto
            <?php include_once('jsFunctions/mostrarJanelaDetalhes.js');?>
            //Inclui o pop up do cadastro da página
            <?php include_once('jsFunctions/popup.js');?>
            //Pegar dados do file para preview da imagem
            <?php include_once('jsFunctions/previewImagemUmInput.js');?>
        </script>
    </head>
    <body>
        <!--Fundo Transparente-->
        <div id="fundo_transparente">

        </div>
        <div id="esqueleto">
            <?php include_once('externos/cadastros/redes_sociais/popupCadastro.php'); ?>
            <!--Cabeçalho-->
            <?php
                include_once('cabecalho/cabecalho.php');

                //Insere os dados
                if(isset($_POST['btnCadastrar_redeSocial'])){
                    //Resgata os valores
                    $nomeRedeSocial = $_POST['txt_nomeRedeSocial'];
                    $linkRedeSocial = $_POST['txt_linkRedeSocial'];

                    //Guarda a pasta de destino em uma variavel
                    $uploaddir = "arquivos/imagem_redesSociais/";

                    //Pega o nome das fotos enviadas e guarda em uma variavel
                    //usando o comando strtolower para deixar o nome da imagem/video minusculo.
                    $arquivo = strtolower(basename($_FILES['filesimagemredes']['name']));
                    $arquivo = str_replace(" ", "_", $arquivo);

                    //Salva numa variavel que junta a pasta de destino com o nome do arquivo
                    $uploadfile = $uploaddir.$arquivo;
                    $extensoes = strstr($uploadfile, '.jpg') || strstr($uploadfile, '.png') || strstr($uploadfile, '.jpeg');

                        if($_POST['btnCadastrar_redeSocial'] == 'Cadastrar'){
                            //Verificar a extensão
                            if($extensoes){
                                //Move o arquivo para a pasta de destino
                                if(move_uploaded_file($_FILES['filesimagemredes']['tmp_name'], $uploadfile)){
                                    $sql = "insert into tbl_redesocial (nome, imagem, link, status) values ('".$nomeRedeSocial."', '".$uploadfile."', '".$linkRedeSocial."', 0)";
                                    if(mysql_query($sql) or die(mysql_error())){
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
                                                  window.location = "crud_redesSociais.php";
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
                                                    window.location = "crud_redesSociais.php";
                                                }, 1800);
                                            </script>
                                        <?php
                                    }
                                }else{
                                    ?>
                                        <script>
                                            swal({
                                              title: "Erro!",
                                              text: "Um dos arquivos não foram enviados.",
                                              type: "error",
                                              icon: "error",
                                              button: {
                                                         text: "Ok",
                                                       },
                                              closeOnEsc: true,
                                            });
                                            //Voltar para o php sem dados na url
                                            setTimeout(function(){
                                                window.location = "crud_redesSociais.php";
                                            }, 1800);
                                        </script>
                                    <?php
                                }
                            }else{
                                ?>
                                    <script>
                                        swal({
                                          title: "Erro!",
                                          text: "Extensão Inválida!",
                                          type: "error",
                                          icon: "error",
                                          button: {
                                                     text: "Ok",
                                                   },
                                          closeOnEsc: true,
                                        });
                                        //Voltar para o php sem dados na url
                                        setTimeout(function(){
                                            window.location = "crud_redesSociais.php";
                                        }, 1800);
                                    </script>
                                <?php
                            }
                        }elseif($_POST['btnCadastrar_redeSocial'] == 'Alterar'){

                            if($arquivo == null){
                                $uploadfile = $_SESSION['imagem'];
                                $imagemContinua = 1;
                            }

                            //Verificar a extensão
                            if(($extensoes) || ($imagemContinua == 1)){
                                //Move o arquivo para a pasta de destino
                                if((move_uploaded_file($_FILES['filesimagemredes']['tmp_name'], $uploadfile)) || ($imagemContinua == 1)){
                                    $sql="update tbl_redesocial set nome = '".$nomeRedeSocial."', imagem = '".$uploadfile."', link = '".$linkRedeSocial."' where id_redesocial =".$_SESSION['idRedeSocial'];

                                    if(mysql_query($sql) or die(mysql_error())){
                                        unset($_SESSION['idSobreNos'], $_SESSION['imgRede']);
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
                                                  window.location = "crud_redesSociais.php";
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
                                                    window.location = "crud_redesSociais.php";
                                                }, 1800);
                                            </script>
                                        <?php
                                    }
                                }else{
                                    ?>
                                        <script>
                                            swal({
                                              title: "Erro!",
                                              text: "Um dos arquivos não foram enviados.",
                                              type: "error",
                                              icon: "error",
                                              button: {
                                                         text: "Ok",
                                                       },
                                              closeOnEsc: true,
                                            });
                                            //Voltar para o php sem dados na url
                                            setTimeout(function(){
                                                window.location = "crud_redesSociais.php";
                                            }, 1800);
                                        </script>
                                    <?php
                                }
                        }else{
                            ?>
                                <script>
                                    swal({
                                      title: "Erro!",
                                      text: "Extensão Inválida!",
                                      type: "error",
                                      icon: "error",
                                      button: {
                                                 text: "Ok",
                                               },
                                      closeOnEsc: true,
                                    });
                                    //Voltar para o php sem dados na url
                                    setTimeout(function(){
                                        window.location = "crud_redesSociais.php";
                                    }, 1800);
                                </script>
                            <?php
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
                        Crud de Redes Sociais
                    </div>
                    <!--Icone do Crud-->
                    <div id="div_icone_crud">
                        <img src="img/redesSociaisIcon.png" alt="">
                    </div>
                </div>
                <div id="div_foraTabela">
                    <!--Crud-->
                    <div id="div_conteudo">
                        <!--Tabela Cargos-->
                        <div id="tabela_crud_titulos">
                            <!--Título da Tabela-->
                            <div class="titulo_colunaPoucosCampos">
                                Nome
                            </div>
                            <div class="titulo_coluna">
                                Link
                            </div>
                            <div class="titulo_colunaImagem">
                                Imagem
                            </div>
                            <div class="titulo_3opcColuna">
                                Opções
                            </div>
                        </div>
                        <?php

                                //Seleciona o conteudo do artigo das redes sociais
                                $sql = "select * from tbl_redesocial";

                                $select = mysql_query($sql);

                                while($rs=mysql_fetch_array($select)){
                                    $id = $rs['id_redesocial'];
                                    $nomeRedeSocial = $rs['nome'];
                                    $imgRedeSocial = $rs['imagem'];
                                    $linkRedeSocial = $rs['link'];

                                    $status = $rs['status'];

                                    if($status == '0'){
                                        $imgAtivarDesativar = 'img/desativar.png';
                                    }else{
                                        $imgAtivarDesativar = 'img/ativar.png';
                                    }

                        ?>
                        <div class="tabela_crud_conteudo">
                            <div class="conteudo_colunaPoucosCampos">
                                <?php echo($nomeRedeSocial); ?>
                            </div>
                            <div class="conteudo_coluna">
                                <?php echo($linkRedeSocial); ?>
                            </div>
                            <div class="conteudo_colunaImagem">
                                <div class="tabela_conteudoVideoImagem">
                                    <img src="<?php echo($imgRedeSocial); ?>" alt="">
                                </div>
                            </div>
                            <div class="coluna_3opcoes">
                                <!--Ativar-->
                                <a href="crud_redesSociais.php?id=<?php echo($id); ?>&modo=ativar_desativar">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="<?php echo($imgAtivarDesativar); ?>" alt="" title="Ativar/Desativar">
                                        </div>
                                    </div>
                                </a>
                                <!--Alterar-->
                                <a href="crud_redesSociais.php?id=<?php echo($id); ?>&modo=alterar">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="img/alterar.png" alt="" title="Alterar">
                                        </div>
                                    </div>
                                </a>
                                <!--Apagar-->
                                <a href="crud_redesSociais.php?id=<?php echo($id); ?>&linkimg=<?php echo($rs['imagem']); ?>&modo=deletar">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="img/apagar.png" alt="" title="Apagar">
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <!--Botão Cadastrar-->
                <button id="botao_cadastrar2" onclick="abrirPopUp()">
                    <img src="img/adicionarIcon.png" alt="" title="Cadastrar Rede Social">
                </button>
            </section>
            <!--Rodapé-->
            <?php include_once('rodape/rodape.php'); ?>
        </div>
    </body>
</html>
