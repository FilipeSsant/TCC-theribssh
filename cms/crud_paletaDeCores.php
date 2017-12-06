<?php

	//Starta a sessão
	session_start();

	//Conexão com o banco
    include_once('../conexao/mysql.php');

    //Removendo Probabilidade de Erros Por Campos Não opcionais vazios
    $tituloPaleta = "";
    $corPrimaria = "";
    $corSecundaria=  "";
    $corTerciaria = "";
    $corQuartenaria = "";
    $imgAtivarDesativar = "";

    $corPrimariaBanco =  "";
    $corSecundariaBanco = "";
    $corTerciariaBanco = "";
    $corQuartenariaBanco = "";

	$onClickCodigoAlterar = "";

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
        <link rel="stylesheet" href="css/crud_PaletaCores.css">
        <link href="fontes/openSans" rel="stylesheet">
        <link href="fontes/openSans" rel="stylesheet">
        <link rel="icon" href="../icon.png" type="image/x-icon" />
        <script type="text/javascript" src="jquery/jquery-2.2.4.js" ></script>
        <script type="text/javascript" src="jquery/jquerymaskplugin.js" ></script>
        <script type="text/javascript">
            <?php
            //Inclui uma janelinha que mostra os detalhes do usuário quando é passado
            //o mouse por cima da foto
            include_once('jsFunctions/mostrarJanelaDetalhes.js');
            //Inclui o pop up do cadastro da página
            include_once('jsFunctions/popup.js');

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
        				$sql = "update tbl_paletacor set status = 0";
        				mysql_query($sql);
        				//Ativa somente o status que foi lançado no url pelo id
        				$sql = "update tbl_paletacor set status = 1 where id_paletacor = ".$id;
        				mysql_query($sql);
        				//Voltar para o php sem dados na url
        				header('location:crud_paletaDeCores.php');
        				break;
        			//Case para deletar um item
        			case 'deletar':
        				//Deleta o item usando seu id
        				$sql = "delete from tbl_paletacor where id_paletacor = ".$id." and status != 1";
        				mysql_query($sql);
        				//Voltar para o php sem dados na url
        			    header('location:crud_paletaDeCores.php');
        				break;

                    case 'alterar':
                        //Guarda o id na sessão
                        $_SESSION['idPaleta'] = $id;
                        //Muda o titulo do PopUp
                    	$tituloPopUp = "Alterar";
                        //Puxa os dados referente ao id
                        $sql = "select * from tbl_paletacor where id_paletacor = ".$id;
                        $select = mysql_query($sql);
        				if($rs = mysql_fetch_array($select)){
                            $tituloPaleta = $rs["titulo"];
                            $corPrimaria = $rs["cor_primaria"];
                            $corSecundaria=  $rs["cor_secundaria"];
                            $corTerciaria = $rs["cor_terciaria"];
                            $corQuartenaria = $rs["cor_quartenaria"];
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
            <?php include_once('externos/cadastros/paleta_cores/popupCadastro.php'); ?>
            <!--Cabeçalho-->
            <?php
                include_once('cabecalho/cabecalho.php');

                //Insere os dados
                if(isset($_POST['btnCadastrar_paleta'])){

                    //Resgata os valores
                    $tituloPaleta = $_POST['txt_tituloPaleta'];
                    $corPrimaria = $_POST['input_corPrimaria'];
                    $corTerciaria = $_POST['input_corTerciaria'];
                    $corQuartenaria = $_POST['input_corQuartenaria'];

                    if($_POST['btnCadastrar_paleta'] == 'Cadastrar'){
                        //Inserir os dados dos campos na tabela
                        $sql = "insert into tbl_paletacor (titulo, cor_primaria, cor_secundaria, cor_terciaria, cor_quartenaria, status)";

                        $sql = $sql."values('".$tituloPaleta."', '".$corPrimaria."', '#ffffff', '".$corTerciaria."', '".$corQuartenaria."', 0)";

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
                                      window.location = "crud_paletaDeCores.php";
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
                                        window.location = "crud_paletaDeCores.php";
                                    }, 1800);
                                </script>
                            <?php
                        }
                    }elseif($_POST['btnCadastrar_paleta'] == 'Alterar'){
                        //Alterar os dados dos campos na tabela
                        $sql = "update tbl_paletacor set titulo = '".$tituloPaleta."', cor_primaria = '".$corPrimaria."',
                        cor_terciaria = '".$corTerciaria."', cor_quartenaria = '".$corQuartenaria."' where id_paletacor = ".$_SESSION['idPaleta'];

                        if(mysql_query($sql) or die(mysql_error())){
                            unset($_SESSION['idPaleta']);
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
                                      window.location = "crud_paletaDeCores.php";
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
                                        window.location = "crud_paletaDeCores.php";
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
                        Crud Paleta de Cores
                    </div>
                    <!--Icone do Crud-->
                    <div id="div_icone_crud">
                        <img src="img/paletaIcon.png" alt="">
                    </div>
                </div>
                <!--Crud-->
                <div id="div_foraTabela">
                    <div id="div_conteudo">
                        <!--Tabela-->
                        <div id="tabela_crud_titulos">
                            <div class="titulo_coluna">
                                Título
                            </div>
                            <div class="titulo_coluna">
                                Cor primária
                            </div>
                            <div class="titulo_coluna">
                                Cor terciária
                            </div>
                            <div class="titulo_coluna">
                                Cor quartenária
                            </div>
                            <div class="titulo_3opcColuna">
                                Opções
                            </div>
                        </div>
                        <?php
                            //Seleciona as paletas de cores existentes no banco
                            $sql = "select * from tbl_paletacor";

                            $select = mysql_query($sql) or die(mysql_error());

                            while($rs = mysql_fetch_array($select)){
                                $idPaleta = $rs['id_paletacor'];
                                $tituloCorBanco = $rs['titulo'];
                                $corPrimariaBanco =  $rs['cor_primaria'];
                                $corSecundariaBanco = $rs['cor_secundaria'];
                                $corTerciariaBanco = $rs['cor_terciaria'];
                                $corQuartenariaBanco = $rs['cor_quartenaria'];
                                $status = $rs['status'];

                                if($status == '0'){
                                    $imgAtivarDesativar = 'img/desativar.png';
                                }else{
                                    $imgAtivarDesativar = 'img/ativar.png';
                                }

                        ?>
                        <div class="tabela_crud_conteudo">
                            <div class="conteudo_coluna">
                                <?php echo($tituloCorBanco); ?>
                            </div>
                            <div class="conteudo_coluna_cor">
                                <div class="cor" style="background-color:<?php echo($corPrimariaBanco); ?>">
                                </div>
                                <div class="hexa_cor">
                                    <?php echo($corPrimariaBanco); ?>
                                </div>
                            </div>
                            <div class="conteudo_coluna_cor">
                                <div class="cor" style="background-color:<?php echo($corTerciariaBanco); ?>">
                                </div>
                                <div class="hexa_cor">
                                    <?php echo($corTerciariaBanco); ?>
                                </div>
                            </div>
                            <div class="conteudo_coluna_cor">
                                <div class="cor" style="background-color:<?php echo($corQuartenariaBanco); ?>">
                                </div>
                                <div class="hexa_cor">
                                    <?php echo($corQuartenariaBanco); ?>
                                </div>
                            </div>
                            <div class="coluna_3opcoes">
                                <!--Ativar-->
                                <a href="crud_paletaDeCores.php?id=<?php echo($idPaleta); ?>&modo=ativar_desativar">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="<?php echo($imgAtivarDesativar); ?>" alt="" title="Ativar/Desativar">
                                        </div>
                                    </div>
                                </a>
                                <!--Alterar-->
                                <a href="crud_paletaDeCores.php?id=<?php echo($idPaleta); ?>&modo=alterar">
                                    <div class="opcao_registro" >
                                        <div class="imagem_opcao">
                                            <img src="img/alterar.png" alt="" title="Alterar">
                                        </div>
                                    </div>
                                </a>
                                <!--Apagar-->
                                <a href="crud_paletaDeCores.php?id=<?php echo($idPaleta); ?>&modo=deletar">
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
                <button id="botao_cadastrar3" onclick="abrirPopUp()">
                    <img src="img/adicionarIcon.png" alt="" title="Cadastrar Paleta de Cor">
                </button>
            </section>
            <!--Rodapé-->
            <?php include_once('rodape/rodape.php'); ?>
        </div>
    </body>
</html>
