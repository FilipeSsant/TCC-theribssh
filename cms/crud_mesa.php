<?php

    session_start();

	//Conexão com o banco
    include_once('../conexao/mysql.php');

    $sql = "select * from tbl_cargopermissao where id_cargo = ".$_SESSION['idCargoFuncionarioU']." and id_permissao = 11";
    $select = mysql_query($sql) or die(mysql_error());

    if($rs=mysql_fetch_array($select)){

    }else{
        //Faz o usuário voltar para a home caso não seja cadastrado e queira entrar pela url
        ?>
            <script>window.location = "../index.php";</script>
        <?php
    }

    //Removendo Probabilidade de Erros Por Campos Não opcionais vazios
    $nomeMesa = "";
    $selectRestaurante = "";
    $selectTipoMesa = "";

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
        <link rel="stylesheet" href="css/crud_mesa.css">
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
						//Case para deletar um item
						case 'deletar':
							//Deleta o item usando seu id
							$sql = "delete from tbl_mesa where id_mesa = ".$id;
							mysql_query($sql);
							//Voltar para o php sem dados na url
							header('location:crud_mesa.php');
							break;
                        //Case para alterar um item
						case 'alterar':
							//Guarda o id na sessão
							$_SESSION['idMesa'] = $id;
							//Muda o titulo do PopUp
							$tituloPopUp = "Alterar";
							//Puxa os dados referente ao id
							$sql = "select m.nome as 'nomeMesa', m.id_tipomesa, m.id_restaurante, r.nome as 'nomeRestaurante',
                                    tm.nome as 'nomeTipoMesa' from tbl_mesa as m
                                    inner join tbl_restaurante as r on m.id_restaurante = r.id_restaurante
                                    inner join tbl_tipomesa as tm on m.id_tipomesa = tm.id_tipomesa where id_mesa = ".$id;
							$select = mysql_query($sql);
							if($rs = mysql_fetch_array($select)){
								$nomeMesa = $rs['nomeMesa'];
                                $idRestauranteBanco = $rs['id_restaurante'];
                                $idTipoMesaBanco = $rs['id_tipomesa'];
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
            <?php include_once('externos/cadastros/mesa/popupCadastro.php'); ?>
            <!--Cabeçalho-->
            <?php

                include_once('cabecalho/cabecalho.php');

                if(isset($_POST['btnCadastrar_mesa'])){
                    //Resgata os valores
                    $nomeMesa = $_POST['txt_nomeMesa'];
                    $selectRestaurante = $_POST['selectRestaurante'];
                    $selectTipoMesa = $_POST['selectTipoMesa'];

                    if($_POST['btnCadastrar_mesa'] == 'Cadastrar'){

                        //Insere os dados no banco
                        $sql = "insert into tbl_mesa (id_restaurante, id_tipomesa, nome)";
                        $sql = $sql."values (".$selectRestaurante.", ".$selectTipoMesa.", '".$nomeMesa."')";

                        if(mysql_query($sql) or die(mysql_error())){
                            ?>
                                <script>
                                    swal({
                                      title: "Sucesso!",
                                      text: "Mesa cadastrada!",
                                      type: "success",
                                      icon: "success",
                                      button: {
                                                 text: "Ok",
                                             },
                                      closeOnEsc: true,
                                  });
                                  //Voltar para o php sem dados na url
                                  setTimeout(function(){
                                      window.location = "crud_mesa.php";
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
                                        window.location = "crud_mesa.php";
                                    }, 1800);
                                </script>
                            <?php
                        }

                    }elseif($_POST['btnCadastrar_mesa'] == 'Alterar'){

                        //Altera os dados do banco
                        $sql = "update tbl_mesa set id_restaurante = ".$selectRestaurante.", id_tipomesa = ".$selectTipoMesa.", nome = '".$nomeMesa."' where id_mesa = ". $_SESSION['idMesa'];

                        if(mysql_query($sql) or die(mysql_error())){
                            unset($_SESSION['idMesa']);
                            ?>
                                <script>
                                    swal({
                                      title: "Sucesso!",
                                      text: "Mesa alterada!",
                                      type: "success",
                                      icon: "success",
                                      button: {
                                                 text: "Ok",
                                             },
                                      closeOnEsc: true,
                                  });
                                  //Voltar para o php sem dados na url
                                  setTimeout(function(){
                                      window.location = "crud_mesa.php";
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
                                        window.location = "crud_mesa.php";
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
                        Crud de Mesas
                    </div>
                    <!--Icone do Crud-->
                    <div id="div_icone_crud">
                        <img src="img/mesaIcon.png" alt="">
                    </div>
                </div>
                <div id="div_foraTabela">
                    <!--Crud-->
                    <div id="div_conteudo">
                        <!--Tabela Cargos-->
                        <div id="tabela_crud_titulos">
                            <!--Título da Tabela-->
                            <div class="titulo_coluna">
                                Nome
                            </div>
                            <div class="titulo_colunaPoucosCampos">
                                Restaurante
                            </div>
                            <div class="titulo_coluna">
                                Tipo de Mesa
                            </div>
                            <div class="titulo_2opcColuna">
                                Opções
                            </div>
                        </div>
                        <?php

                            //Comando SQL
                            $sql = "select m.nome as 'nomeMesa' , m.id_mesa, r.nome as 'nomeRestaurante' , tm.nome as 'nomeTipoMesa'
                                    from tbl_mesa as m
                                    inner join tbl_restaurante as r on m.id_restaurante = r.id_restaurante
                                    inner join tbl_tipomesa as tm on m.id_tipomesa = tm.id_tipomesa order by m.nome asc";

                            $select = mysql_query($sql) or die(mysql_error());

                            while($rs=mysql_fetch_array($select)){
                                $idMesa = $rs['id_mesa'];
                        ?>
                        <div class="tabela_crud_conteudo">
                            <div class="conteudo_coluna">
                                <?php echo($rs['nomeMesa']); ?>
                            </div>
                            <div class="conteudo_colunaPoucosCampos">
                                <?php echo($rs['nomeRestaurante']); ?>
                            </div>
                            <div class="conteudo_coluna">
                                <?php echo($rs['nomeTipoMesa']); ?> Assentos
                            </div>
                            <div class="coluna_2opcoes">
                                <!--Alterar-->
                                <a href="crud_mesa.php?id=<?php echo($idMesa); ?>&modo=alterar">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="img/alterar.png" alt="" title="Alterar">
                                        </div>
                                    </div>
                                </a>
                                <!--Apagar-->
                                <a href="crud_mesa.php?id=<?php echo($idMesa); ?>&modo=deletar">
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
