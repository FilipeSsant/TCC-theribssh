<?php
    session_start();

	//Conexão com o banco
    include_once('../conexao/mysql.php');

    $sql = "select * from tbl_cargopermissao where id_cargo = ".$_SESSION['idCargoFuncionarioU']." and id_permissao = 14";
    $select = mysql_query($sql) or die(mysql_error());

    if($rs=mysql_fetch_array($select)){

    }else{
        //Faz o usuário voltar para a home caso não seja cadastrado e queira entrar pela url
        ?>
            <script>window.location = "../index.php";</script>
        <?php
    }

	//Aumentar tamanho de upload pelo post
	ini_set('post_max_size', '8M');
	ini_set('upload_max_filesize', '8M');

	//Removendo Probabilidade de Erros Por Campos Não opcionais vazios
	$titulo = "";
	$textoArtigo = "";
    $caminho_imagem = "";
    //A variavel $imagemContinua serve para verificação de uma imagem que não quer ser alterada
    //assim pega a do banco e deixa como já esta
    $imagemContinua = 0;

    //Caso for cadastro se tornar requirido o campo imagem
    $requirido = "required";

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
        <link rel="stylesheet" href="css/crud_sobreNos.css">
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
            //Pegar dados do file para preview da imagem
            <?php include_once('jsFunctions/previewImagemUmInput.js');?>

            <?php

                //Pega o modo que esta sendo passado na url
                if(isset($_GET['modo'])){
                    //Pega os objetos após a ? e guarda na variavel
                    $modo = $_GET['modo'];
                    $id = $_GET['id'];

                    //Esse switch serve para usando a variavel modo tenha varios resultados
                    switch($modo){
                        //Case para ativar ou desativar o item
                        case 'ativar_desativar':
                            //Desativa todos os status
                            $sql = "update tbl_sobrenos set status = 0";
                            mysql_query($sql);
                            //Ativa somente o status que foi lançado no url pelo id
                            $sql = "update tbl_sobrenos set status = 1 where id_sobrenos = ".$id;
                            mysql_query($sql);
                            //Voltar para o php sem dados na url
                            ?>
                                window.location = "crud_sobreNos.php";
                            <?php
                            break;
                        //Case para deletar um item
                        case 'deletar':
                            //Deleta o item usando seu id
                            $sql = "delete from tbl_sobrenos where id_sobrenos = ".$id." and status != 1";
                            mysql_query($sql);
                            //Unlink que exclui a imagem da pasta
			                unlink($_GET['linkimg']);
                            //Voltar para o php sem dados na url
                            ?>
                                window.location = "crud_sobreNos.php";
                            <?php
                            break;
                        //Case para alterar um item
                        case 'alterar':
                            //Guarda o id na sessão
							$_SESSION['idSobreNos'] = $id;
                            //Campo imagem não requirido
                            $requirido = "";
							//Muda o titulo do PopUp
							$tituloPopUp = "Alterar";
							//Puxa os dados referente ao id
							$sql = "select * from tbl_sobrenos where id_sobrenos = ".$id;
							$select = mysql_query($sql);
							if($rs = mysql_fetch_array($select)){
								$titulo = $rs['titulo'];
								$textoArtigo = $rs['texto'];
                                $caminho_imagem = $rs['caminho_imagem'];
                                $_SESSION['imagem'] = $caminho_imagem;
							}

							?>
								$(document).ready(function(){
									abrirPopUp();
								});
							<?php

							//Muda o value do botão
							$valueBotao = "Alterar";
							break;

                    }

                }

            ?>

        </script>
    </head>
    <body>
        <!--Fundo Transparente-->
        <div id="fundo_transparente">

        </div>
        <div id="esqueleto">
            <?php include_once('externos/cadastros/crud_sobreNos/popupCadastro.php'); ?>
            <!--Cabeçalho-->
            <?php
                include_once('cabecalho/cabecalho.php');

                //Insere os dados
                if(isset($_POST['btnCadastrar_sobreNos'])){

                    //Resgata as variaveis
                    $titulo = $_POST['txt_tituloArtigo'];
                    $textoArtigo = $_POST['txt_conteudoArtigo'];

                    //Guarda a pasta de destino em uma variavel
                    $uploaddir = "arquivos/midia_sobreNos/";

                    //Pega o nome das fotos enviadas e guarda em uma variavel
                    //usando o comando strtolower para deixar o nome da imagem/video minusculo.
                    $arquivo = strtolower(basename($_FILES['filesimagemsobrenos']['name']));
                    $arquivo = str_replace(" ", "_", $arquivo);

                    //Salva numa variavel que junta a pasta de destino com o nome do arquivo
                    $uploadfile = $uploaddir.$arquivo;
                    $extensoes = strstr($uploadfile, '.jpg') || strstr($uploadfile, '.png') || strstr($uploadfile, '.jpeg');

                    //Se o botão for cadastrar
                    if($_POST['btnCadastrar_sobreNos'] == 'Cadastrar'){
                        //Verificar a extensão
                        if($extensoes){
                            //Move o arquivo para a pasta de destino
                            if(move_uploaded_file($_FILES['filesimagemsobrenos']['tmp_name'], $uploadfile)){

                                $sql = "insert into tbl_sobrenos (titulo, texto, caminho_imagem, status) values('".$titulo."', '".$textoArtigo."', '".$uploadfile."', 0)";

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
                                              window.location = "crud_sobreNos.php";
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
                                                window.location = "crud_sobreNos.php";
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
                                            window.location = "crud_sobreNos.php";
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
                                        window.location = "crud_sobreNos.php";
                                    }, 1800);
                                </script>
                            <?php
                        }
                    //Se o botão for alterar
                    }elseif($_POST['btnCadastrar_sobreNos'] == 'Alterar'){

                        if($arquivo == null){
                            $uploadfile = $_SESSION['imagem'];
                            $uploadfile = strtolower($uploadfile);
                            $imagemContinua = 1;
                        }

                        //Verificar a extensão
                        if(($extensoes) || ($imagemContinua == 1)){
                            if((move_uploaded_file($_FILES['filesimagemsobrenos']['tmp_name'], $uploadfile)) || ($imagemContinua == 1)){

                                $sql = "update tbl_sobrenos set titulo = '".$titulo."', texto = '".$textoArtigo."', caminho_imagem = '".$uploadfile."' where id_sobrenos = ".$_SESSION['idSobreNos'];

                                if(mysql_query($sql) or die(mysql_error())){
                                    unset($_SESSION['idSobreNos']);
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
                                              window.location = "crud_sobreNos.php";
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
                                                window.location = "crud_sobreNos.php";
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
                                            window.location = "crud_sobreNos.php";
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
                                        window.location = "crud_sobreNos.php";
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
                        Crud Sobre Nós
                    </div>
                    <!--Icone do Crud-->
                    <div id="div_icone_crud">
                        <img src="img/sobreNosIcon.png" alt="">
                    </div>
                </div>
                <!--Crud-->
                <div id="div_foraTabela">
                    <div id="div_conteudo">
                        <!--Tabela-->
                        <div id="tabela_crud_titulos">
                            <div class="titulo_coluna">
                                Titulo
                            </div>
                            <div class="titulo_colunaObs">
                                Artigo
                            </div>
                            <div class="titulo_3opcColuna">
                                Opções
                            </div>
                        </div>
                        <?php
                            //Seleciona o conteudo do artigo do sobre nos
                            $sql = "select * from tbl_sobrenos";

                            $select = mysql_query($sql);

                            while($rs=mysql_fetch_array($select)){
                                $id = $rs['id_sobrenos'];
                                $titulo = $rs['titulo'];
                                $texto = $rs['texto'];
                                $status = $rs['status'];

                                if($status == '0'){
                                    $imgAtivarDesativar = 'img/desativar.png';
                                }else{
                                    $imgAtivarDesativar = 'img/ativar.png';
                                }
                        ?>
                        <div class="tabela_crud_conteudo">
                            <div class="conteudo_coluna">
                                <?php echo($titulo); ?>
                            </div>
                            <div class="conteudo_colunaObs">
                                <div class="div_textoConteudoObs">
                                    <span class="span_centralizar"><?php echo($texto); ?></span>
                                </div>
                            </div>
                            <div class="coluna_3opcoesFaleConosco">
                                <!--Ativar-->
                                <a href="crud_sobreNos.php?id=<?php echo($id); ?>&modo=ativar_desativar">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="<?php echo($imgAtivarDesativar); ?>" alt="" title="Ativar/Desativar">
                                        </div>
                                    </div>
                                </a>
                                <!--Alterar-->
                                <a href="crud_sobreNos.php?id=<?php echo($id); ?>&modo=alterar">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="img/alterar.png" alt="" title="Alterar">
                                        </div>
                                    </div>
                                </a>
                                <!--Apagar-->
                                <a href="crud_sobreNos.php?id=<?php echo($id); ?>&linkimg=<?php echo($rs['caminho_imagem']); ?>&modo=deletar">
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
                    <img src="img/adicionarIcon.png" alt="" title="Cadastrar Título de Enquete">
                </button>
            </section>
            <!--Rodapé-->
            <?php include_once('rodape/rodape.php'); ?>
        </div>
    </body>
</html>
