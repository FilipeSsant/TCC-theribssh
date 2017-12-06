<?php
	session_start();

	//Conexão com o banco
    include_once('../conexao/mysql.php');

    $sql = "select * from tbl_cargopermissao where id_cargo = ".$_SESSION['idCargoFuncionarioU']." and id_permissao = 5";
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
	$caminhoImagemSuperior = "";
	$caminhoImagemInferior = "";
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
        <link rel="stylesheet" href="css/crud_home.css">
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
            $(document).ready(function(){
                function readURL(input, img) {
                    if (input.files && input.files[0]) {
                        //FileReader lê arquivos locais do input file
                        var reader = new FileReader();
                        //Carrega a função com o resultado do reader
                        reader.onload = function (e) {
                            //Da um attr no src da div com o resultado
                            $(img).attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
                /* Ambos utilizam a função on para pegar o onchange do botão (se for modificado o conteudo dentro)*/
                //Se for o botão superior
                $("#btn_imgsuperior").on('change',function(){
                    //Variavel do img que será mudado
                    var img = "#imagem_superior";
                    //Envia para a função o link do file e o id do img
                    readURL(this, img);
                });
                //Se for o botão inferior
                $("#btn_imginferior").on('change',function(){
                    //Variavel do img que será mudado
                    var img = "#imagem_inferior";
                    //Envia para a função o link do file e o id do img
                    readURL(this, img);
                });
            });

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
							$sql = "update tbl_home set status = 0";
							mysql_query($sql);
							//Ativa somente o status que foi lançado no url pelo id
							$sql = "update tbl_home set status = 1 where id_home = ".$id;
							mysql_query($sql);
							//Voltar para o php sem dados na url
                            ?>
                                window.location = "crud_home.php";
                            <?php
							break;
						//Case para deletar um item
						case 'deletar':
							//Deleta o item usando seu id
							$sql = "delete from tbl_home where id_home = ".$id." and status != 1";
							mysql_query($sql);
                            //Unlink que exclui a imagem da pasta
			                unlink($_GET['linkimg1']);
                            unlink($_GET['linkimg2']);
							//Voltar para o php sem dados na url
                            ?>
                                window.location = "crud_home.php";
                            <?php
							break;

						case 'alterar':
							//Guarda o id na sessão
							$_SESSION['idHome'] = $id;
                            //Campo imagem não requirido
                            $requirido = "";
							//Muda o titulo do PopUp
							$tituloPopUp = "Alterar";
							//Puxa os dados referente ao id
							$sql = "select * from tbl_home where id_home = ".$id;
							$select = mysql_query($sql);
							if($rs = mysql_fetch_array($select)){
								$caminhoImagemSuperior = $rs['caminho_imagemSuperior'];
								$caminhoImagemInferior = $rs['caminho_imagemInferior'];
                                //Session para as imagens
                                $_SESSION['caminhoSuperior'] = $caminhoImagemSuperior;
                                $_SESSION['caminhoInferior'] = $caminhoImagemInferior;
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
            <?php include_once('externos/cadastros/crud_home/popupCadastro.php'); ?>
            <!--Cabeçalho-->
            <?php
                include_once('cabecalho/cabecalho.php');

                if(isset($_POST['btnCadastrar_home'])){

                    //Guarda a pasta de destino em uma variavel
                    $uploaddir = "arquivos/midia_home/";

                    //Pega o nome das fotos enviadas e guarda em uma variavel
                    //usando o comando strtolower para deixar o nome da imagem/video minusculo.
                    $arquivo_superior = strtolower(basename($_FILES['filesimgsuperior']['name']));
                    $arquivo_inferior = strtolower(basename($_FILES['filesimginferior']['name']));
                    $arquivo_superior = str_replace(" ", "_", $arquivo_superior);
                    $arquivo_inferior = str_replace(" ", "_", $arquivo_inferior);


                    //Salva numa variavel que junta a pasta de destino com o nome do arquivo
                    $uploadfile_superior = $uploaddir.$arquivo_superior;
                    $uploadfile_inferior = $uploaddir.$arquivo_inferior;

                    //Strings para enviar para a pasta
                    $moveUp_superior = move_uploaded_file($_FILES['filesimgsuperior']['tmp_name'], $uploadfile_superior);
                    $moveUp_inferior = move_uploaded_file($_FILES['filesimginferior']['tmp_name'], $uploadfile_inferior);
                    //Strings para verificar extensões
                    $verificacaoUploadfile1 = strstr($uploadfile_superior, '.jpg') || strstr($uploadfile_superior, '.jpeg') || strstr($uploadfile_superior, '.png');
                    $verificacaoUploadfile2 = strstr($uploadfile_inferior, '.jpg') || strstr($uploadfile_inferior, '.jpeg') || strstr($uploadfile_inferior, '.png');

                    //Se o botão for cadastrar
                    if($_POST['btnCadastrar_home'] == 'Cadastrar'){
                        //Verificar se é uma extensão JPG
                        if($verificacaoUploadfile1 && $verificacaoUploadfile2){
                            if($moveUp_superior && $moveUp_inferior){

                                $sql = "insert into tbl_home (caminho_imagemSuperior, caminho_imagemInferior, status) values ('".$uploadfile_superior."', '".$uploadfile_inferior."', 0)";

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
                                              window.location = "crud_home.php";
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
                                                window.location = "crud_home.php";
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
                                            window.location = "crud_home.php";
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
                                        window.location = "crud_home.php";
                                    }, 1800);
                                </script>
                            <?php
                        }
                    //Se o botão for alterar
                    }elseif($_POST['btnCadastrar_home'] == 'Alterar'){

                        if($arquivo_superior == null){
                            $uploadfile_superior = $_SESSION['caminhoSuperior'];
                            $uploadfile_superior = strtolower($uploadfile_superior);
                            $imagemContinua = 1;
                        }

                        if($arquivo_inferior == null){
                            $uploadfile_inferior = $_SESSION['caminhoInferior'];
                            $uploadfile_inferior = strtolower($uploadfile_inferior);
                            $imagemContinua = 1;
                        }

                        //Verificar se é uma extensão JPG
                        if(($verificacaoUploadfile1 && $verificacaoUploadfile2) || ($imagemContinua == 1)){
                            if((($moveUp_superior) && ($moveUp_inferior)) || ($imagemContinua == 1)){

                                $sql = "update tbl_home set caminho_imagemSuperior = '".$uploadfile_superior."', caminho_imagemInferior = '".$uploadfile_inferior."' where id_home = ".$_SESSION['idHome'];

                                if(mysql_query($sql) or die(mysql_error())){
                                        unset($_SESSION['idHome'], $_SESSION['caminhoInferior'], $_SESSION['caminhoSuperior']);
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
                                                window.location = "crud_home.php";
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
                                            window.location = "crud_home.php";
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
                                        window.location = "crud_home.php";
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
                        Crud Elementos da Home
                    </div>
                    <!--Icone do Crud-->
                    <div id="div_icone_crud">
                        <img src="img/homeIcon.png" alt="">
                    </div>
                </div>
                <div id="div_foraTabela">
                    <!--Crud-->
                    <div id="div_conteudo">
                        <!--Tabela Videos-->
                        <div id="tabela_crud_titulos">
                            <!--Título da Tabela-->
                            <div class="titulo_colunaPoucosCampos">
                                Imagem Superior
                            </div>
                            <!--Título da Tabela-->
                            <div class="titulo_colunaPoucosCampos">
                                Imagem Inferior
                            </div>
                            <div class="titulo_3opcColuna">
                                Opções
                            </div>
                        </div>
                        <?php
                            $sql = "select * from tbl_home";

                            $select = mysql_query($sql);

                            while($rs=mysql_fetch_array($select)){
                                $id = $rs['id_home'];
                                $caminhoImagemSuperior = $rs['caminho_imagemSuperior'];
                                $caminhoImagemInferior = $rs['caminho_imagemInferior'];
                                $status = $rs['status'];


                                if($status == '0'){
                                    $imgAtivarDesativar = 'img/desativar.png';
                                }else{
                                    $imgAtivarDesativar = 'img/ativar.png';
                                }
                        ?>
                        <div class="tabela_crud_conteudo">
                            <div class="conteudo_colunaPoucosCampos">
                                <div class="tabela_conteudoVideoImagem">
                                    <img src="<?php echo($caminhoImagemSuperior); ?>" alt="">
                                </div>
                            </div>
                            <div class="conteudo_colunaPoucosCampos">
                                <div class="tabela_conteudoVideoImagem">
                                    <div class="tabela_conteudoVideoImagem">
                                    <img src="<?php echo($caminhoImagemInferior); ?>" alt="">
                                </div>
                                </div>
                            </div>
                            <div class="coluna_3opcoes">
                                <!--Ativar-->
                                <a href="crud_home.php?id=<?php echo($id); ?>&modo=ativar_desativar">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="<?php echo($imgAtivarDesativar); ?>" alt="" title="Ativar/Desativar">
                                        </div>
                                    </div>
                                </a>
                                <!--Alterar-->
                                <a href="crud_home.php?id=<?php echo($id); ?>&modo=alterar">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="img/alterar.png" alt="" title="Alterar">
                                        </div>
                                    </div>
                                </a>
                                <!--Apagar-->
                                <a href="crud_home.php?id=<?php echo($id); ?>&linkimg1=<?php echo($rs['caminho_imagemSuperior']); ?>&linkimg2=<?php echo($rs['caminho_imagemSuperior']); ?>&modo=deletar">
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
                <button id="botao_cadastrar2" onclick="abrirPopUp(null,'Cadastrar Elementos Home')">
                    <img src="img/adicionarIcon.png" alt="" title="Cadastrar Video">
                </button>
            </section>
            <!--Rodapé-->
            <?php include_once('rodape/rodape.php'); ?>
        </div>
    </body>
</html>
