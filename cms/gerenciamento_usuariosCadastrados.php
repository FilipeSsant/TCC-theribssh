<?php

    session_start();

    //Conexão com o banco
    include_once('../conexao/mysql.php');

    $sql = "select * from tbl_cargopermissao where id_cargo = ".$_SESSION['idCargoFuncionarioU']." and id_permissao = 10";
    $select = mysql_query($sql) or die(mysql_error());

    if($rs=mysql_fetch_array($select)){

    }else{
        //Faz o usuário voltar para a home caso não seja cadastrado e queira entrar pela url
        ?>
            <script>window.location = "../index.php";</script>
        <?php
    }

    $foto = "";
    $nome = "";
    $sobrenome = "";
    $login = "";
    $senha = "";
    $email = "";
    $celular = "";
    $telefone = "";

    $logradouro = "";
    $bairro = "";
    $rua = "";
    $aptBloco = "";
    $numero = "";
    $idEndereco = "";
    $idCidade = "";
    $cidade = "";
    $idEstado = "";
    $estado = "";

    $numeroCartao = "";
    $nomeCartao = "";
    $dataValidade = "";
    $cvv = "";

    $idBanco = "";
    $nomeBanco = "";


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>CMS - Sistema de Gerenciamento</title>
        <link rel="stylesheet" href="css/cssUniversal.css">
        <link rel="stylesheet" href="css/gerenciamento_usuariosCadastrados.css">
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

            function aumentarFooter(){
                //Após o $ é o id ou a classe na qual se deseja implementar uma função css
                //No .css é implementada o comando css dentro do {}
                $('footer').css({"height":"800px"});
            }

            function normalizarFooter(){
                //Após o $ é o id ou a classe na qual se deseja implementar uma função css
                //No .css é implementada o comando css dentro do {}
                $('footer').css({"height":"75px"});
            }

        </script>
    </head>
    <body>
        <!--Fundo Transparente-->
        <div id="fundo_transparente">

        </div>
        <div id="esqueleto">
            <!--Cabeçalho-->
            <?php include_once('cabecalho/cabecalho.php');?>
            <?php
				//Pega o modo que esta sendo passado na url
				if(isset($_GET['modo'])){
					//Pega os objetos após a ? e guarda na variavel
					$modo = $_GET['modo'];
					$id = $_GET['id'];
                    $id_enderecoCliente = $_GET['idEndereco'];

					//Esse switch serve para usando a variavel modo tenha varios resultados
					switch($modo){
						//Case para deletar um item
						case 'deletar':
                            //Seleciona na tbl_pedido para verificar se o usuário tem pedidos
                            //Assim sua exclusão não é possivel
                            $sql = "select * from tbl_pedido where id_cliente = ".$id;
                            $select = mysql_query($sql);
                            if($rs=mysql_fetch_array($select)){
                                
                                //Deleta o endereço relacionado com o cliente
                                $sql = "delete from tbl_endereco where id_endereco = ".$id_enderecoCliente;
                                mysql_query($sql);
                                //Deleta a relação do cliente com o cartão de crédito
                                $sql = "delete from tbl_cartaocredito where id_cliente = ".$id;
                                mysql_query($sql);
                                //Deleta o item usando seu id
                                $sql = "delete from tbl_cliente where id_cliente = ".$id;
                                mysql_query($sql);
                                //Voltar para o php sem dados na url
                                ?>
            
                                    <script> 
                                        window.location = "gerenciamento_usuariosCadastrados.php";
                                    </script>
                                        
                                <?php
                                
                            }else{
                                ?>
                                <script>
                                    swal({
                                      title: "Erro!",
                                      text: "Não é possivel excluir clientes com histórico de pedidos.",
                                      type: "error",
                                      icon: "error",
                                      button: {
                                                 text: "Ok",
                                               },
                                      closeOnEsc: true,
                                    });
                                    //Voltar para o php sem dados na url
                                    setTimeout(function(){
                                        window.location = "gerenciamento_usuariosCadastrados.php";
                                    }, 4000);
                                </script>
                            <?php
                            }
							break;
						case 'verInfo':
							//Guarda o id na sessão
							$_SESSION['idUsuario'] = $id;
							//Select dos dados básicos do usuário
							$sql = "select * from tbl_cliente where id_cliente = ".$id;
							$select = mysql_query($sql);
							if($rs = mysql_fetch_array($select)){
                                $foto = $rs['foto'];
								$nome = $rs['nome'];
                                $sobrenome = $rs['sobrenome'];
                                $login = $rs['login'];
                                $senha = $rs['senha'];
                                $email = $rs['email'];
                                $celular = $rs['celular'];
                                $telefone = $rs['telefone'];
                                
                                $idEndereco = $rs['id_endereco'];
							}

                            //Select do Endereço
                            $sqlEnd = "select * from tbl_endereco where id_endereco = ".$idEndereco;

                            $selectEnd = mysql_query($sqlEnd) or die(mysql_error());

                            while($rsEnd = mysql_fetch_array($selectEnd)){
                                $logradouro = $rsEnd['logradouro'];
                                $bairro = $rsEnd['bairro'];
                                $rua = $rsEnd['rua'];
                                $aptBloco = $rsEnd['aptbloco'];
                                $numero = $rsEnd['numero'];

                                $idCidade = $rsEnd['id_cidade'];
                            }

                            //Select da Cidade
                            $sqlCid = "select * from tbl_cidade where id_cidade = ".$idCidade;

                            $selectCid = mysql_query($sqlCid) or die(mysql_error());

                            while($rsCid = mysql_fetch_array($selectCid)){
                                $cidade = $rsCid['nome'];

                                $idEstado = $rsCid['id_estado'];
                            }

                            //Select do Estado
                            $sqlEst = "select * from tbl_estado where id_estado = ".$idEstado;

                            $selectEst = mysql_query($sqlEst) or die(mysql_error());

                            while($rsEst = mysql_fetch_array($selectEst)){
                                $estado = $rsEst['nome'];
                            }

                            //Select Cartão de Crédito
                            $sqlCred = "select * from tbl_cartaocredito where id_cliente = ".$id;

                            $selectCred = mysql_query($sqlCred) or die(mysql_error());

                            while($rsCred = mysql_fetch_array($selectCred)){
                                $numeroCartao = $rsCred['numero'];
                                $nomeCartao = strtoupper($rsCred['nome_cartao']);
                                $dataValidade = $rsCred['data'];
                                $cvv = $rsCred['cvv'];

                                $idBanco = $rsCred['id_banco'];

                                //Select do banco
                                $sqlBanco = "select * from tbl_banco where id_banco = ".$idBanco;

                                $selectBanco = mysql_query($sqlBanco) or die(mysql_error());

                                while($rsBanco = mysql_fetch_array($selectBanco)){
                                    $nomeBanco = $rsBanco['nome'];
                                }

                            }



							?>
                                <script>
                                    $(document).ready(function(){
                                        abrirPopUp();
                                        aumentarFooter();
                                    });  
                                </script>    
							<?php
							break;
					}
				}
                //Pop up
                include_once("externos/verInformacoes/gerenciamento_usuariosCadastrados/popupCadastro.php");
			?>
            <!--Conteúdo-->
            <section>
                <!--Menu-->
                <!--Inclui o menu que irá aparecer em todas as páginas-->
                <?php include_once('externos/menu_universal.php'); ?>
                <!--Título do Crud-->
                <div id="div_titulo_crud">
                    <div id="titulo_crud">
                        Gerenciamento de Usuários Cadastrados
                    </div>
                    <!--Icone do Crud-->
                    <div id="div_icone_crud">
                        <img src="img/usuariosCadaIcon.png" alt="">
                    </div>
                </div>
                <!--Crud-->
                <div id="div_foraTabela">
                    <div id="div_conteudo">
                        <!--Tabela-->
                        <div id="tabela_crud_titulos">
                            <div class="titulo_colunaPoucosCampos">
                                Nome Completo
                            </div>
                            <div class="titulo_colunaPoucosCampos">
                                Login
                            </div>
                            <div class="titulo_2opcColuna">
                                Opções
                            </div>
                        </div>
                        <div class="tabela_crud_conteudo">

                            <?php
                                $sql = "select cliente.id_cliente,
                                        cliente.login,
                                        cliente.id_endereco,
                                        cliente.nome
                                        from tbl_cliente as cliente;";

                                $select = mysql_query($sql);

                            while($rs = mysql_fetch_array($select)){
                            ?>
                            <div class="conteudo_colunaPoucosCampos">
                                <?php echo($rs['nome']); ?>
                            </div>
                            <div class="conteudo_colunaPoucosCampos">
                                <?php echo($rs['login']); ?>
                            </div>
                            <div class="coluna_2opcoes">
                                <!--Informações-->
                                <a href="gerenciamento_usuariosCadastrados.php?modo=verInfo&id=<?php echo($rs['id_cliente']); ?>&idEndereco=<?php echo($rs['id_endereco']); ?>">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="img/infoIcon.png" alt="" title="Ver Informações">
                                        </div>
                                    </div>
                                </a>
                                <!--Apagar-->
                                <a href="gerenciamento_usuariosCadastrados.php?modo=deletar&id=<?php echo($rs['id_cliente']); ?>">
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
            </section>
            <!--Rodapé-->
            <?php include_once('rodape/rodape.php'); ?>
        </div>
    </body>
</html>
