<?php
    session_start();

	//Conexão com o banco
    include_once('../conexao/mysql.php');

    $sql = "select * from tbl_cargopermissao where id_cargo = ".$_SESSION['idCargoFuncionarioU']." and id_permissao = 13";
    $select = mysql_query($sql) or die(mysql_error());

    if($rs=mysql_fetch_array($select)){

    }else{
        //Faz o usuário voltar para a home caso não seja cadastrado e queira entrar pela url
        ?>
            <script>window.location = "../index.php";</script>
        <?php
    }

    //Removendo Probabilidade de Erros Por Campos Não opcionais vazios
    $tituloEnquete = "";

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
        <link rel="stylesheet" href="css/crud_tituloEnquetes.css">
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
							$sql = "update tbl_enquete set status = 0";
							mysql_query($sql);
							//Ativa somente o status que foi lançado no url pelo id
							$sql = "update tbl_enquete set status = 1 where id_enquete = ".$id;
							mysql_query($sql);
							//Voltar para o php sem dados na url
							header('location:crud_tituloEnquetes.php');
							break;
						//Case para deletar um item
						case 'deletar':
							//Deleta o item usando seu id
							$sql = "delete from tbl_enquete where id_enquete = ".$id." and status != 1";
							mysql_query($sql);
							//Voltar para o php sem dados na url
							header('location:crud_tituloEnquetes.php');
							break;
                        //Case para alterar um item
						case 'alterar':
							//Guarda o id na sessão
							$_SESSION['idEnquete'] = $id;
							//Muda o titulo do PopUp
							$tituloPopUp = "Alterar";
							//Puxa os dados referente ao id
							$sql = "select * from tbl_enquete where id_enquete = ".$id;
							$select = mysql_query($sql);
							if($rs = mysql_fetch_array($select)){
								$tituloEnquete = $rs['titulo'];
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
            <?php include_once('externos/cadastros/enquetes/popupCadastro.php'); ?>
            <!--Cabeçalho-->
            <?php

                include_once('cabecalho/cabecalho.php');

                if(isset($_POST['btnCadastrar_tituloEnquete'])){
                    //Resgata os valores
                    $tituloEnquete = $_POST['txt_nomeEnquete'];

                    if($_POST['btnCadastrar_tituloEnquete'] == 'Cadastrar'){

                        //Insere os dados no banco
                        $sql = "insert into tbl_enquete (titulo, status)";
                        $sql = $sql."values ('".$tituloEnquete."', 0)";

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
                                      window.location = "crud_tituloEnquetes.php";
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
                                        window.location = "crud_tituloEnquetes.php";
                                    }, 1800);
                                </script>
                            <?php
                        }

                    }elseif($_POST['btnCadastrar_tituloEnquete'] == 'Alterar'){

                        //Altera os dados do banco
                        $sql = "update tbl_enquete set titulo = '".$tituloEnquete."' where id_enquete = ". $_SESSION['idEnquete'];

                        if(mysql_query($sql) or die(mysql_error())){
                            unset($_SESSION['idEnquete']);
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
                                      window.location = "crud_tituloEnquetes.php";
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
                                        window.location = "crud_tituloEnquetes.php";
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
                        Crud de Titulos das Enquetes
                    </div>
                    <!--Icone do Crud-->
                    <div id="div_icone_crud">
                        <img src="img/enquetesIcon.png" alt="">
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
                            <div class="titulo_3opcColuna">
                                Opções
                            </div>
                        </div>
                        <?php
                            //Comando SQL
                            $sql = "select * from tbl_enquete";
                            $select = mysql_query($sql);
                            while($rs=mysql_fetch_array($select)){
                                $id = $rs['id_enquete'];
                                $titulo = $rs['titulo'];
                                $status = $rs['status'];

                                if($status == '0'){
                                    $imgAtivarDesativar = 'img/desativar.png';
                                }else{
                                    $imgAtivarDesativar = 'img/ativar.png';
                                }
                        ?>
                        <div class="tabela_crud_conteudo">
                            <div class="conteudo_colunaPoucosCampos">
                                <?php echo($titulo); ?>
                            </div>
                            <div class="coluna_3opcoes">
                                <!--Ativar-->
                                <a href="crud_tituloEnquetes.php?id=<?php echo($id); ?>&modo=ativar_desativar">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="<?php echo($imgAtivarDesativar); ?>" alt="" title="Ativar/Desativar">
                                        </div>
                                    </div>
                                </a>
                                <!--Alterar-->
                                <a href="crud_tituloEnquetes.php?id=<?php echo($id); ?>&modo=alterar">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="img/alterar.png" alt="" title="Alterar">
                                        </div>
                                    </div>
                                </a>
                                <!--Apagar-->
                                <a href="crud_tituloEnquetes.php?id=<?php echo($id); ?>&modo=deletar">
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
                <!--Seta pra voltar-->
                <a href="paginaAgrupadora_enquetes.php">
                    <div id="seta_voltarPraAgrupador">
                        <img src="img/setaVoltarIcon.png" alt="" title="Voltar para página anterior">
                    </div>
                </a>
            </section>
            <!--Rodapé-->
            <?php include_once('rodape/rodape.php'); ?>
        </div>
    </body>
</html>
