<?php

    session_start();

	//Conexão com o banco
    include_once('../conexao/mysql.php');

    $sql = "select * from tbl_cargopermissao where id_cargo = ".$_SESSION['idCargoFuncionarioU']." and id_permissao = 2";
    $select = mysql_query($sql) or die(mysql_error());

    if($rs=mysql_fetch_array($select)){

    }else{
        //Faz o usuário voltar para a home caso não seja cadastrado e queira entrar pela url
        ?>
            <script>window.location = "../index.php";</script>
        <?php
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cms - Sistema de Gerenciamento</title>
        <link rel="stylesheet" href="css/cssUniversal.css">
        <link rel="stylesheet" href="css/paginaAprovacao_produtos.css">
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
                $('footer').css({"height":"500px"});
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
            <?php

                include_once('cabecalho/cabecalho.php');

                //Pega o modo que esta sendo passado na url
                    if(isset($_GET['modo'])){
                        //Pega os objetos após a ? e guarda na variavel
                        $modo = $_GET['modo'];
                        $id = $_GET['id'];

                        //Esse switch serve para usando a variavel modo tenha varios resultados
                        switch($modo){
                            //Case para ativar ou desativar o item
                            case 'aprovar':
                                //Ativa somente o status que foi lançado no url pelo id
                                $sql = "update tbl_produto set statusAprovacao = 1 where id_produto = ".$id;
                                if(mysql_query($sql)){
                                    ?>
                                        <script>
                                            swal({
                                              title: "Produto Aprovado!",
                                              text: "Agora ele pode ser inserido no cardápio do restaurante!",
                                              type: "success",
                                              icon: "success",
                                              button: {
                                                         text: "Ok",
                                                     },
                                              closeOnEsc: true,
                                              });
                                              //Voltar para o php sem dados na url
                                              setTimeout(function(){
                                                  window.location = "paginaAprovacao_produtos.php";
                                              }, 5000);
                                        </script>
                                    <?php
                                }
                                break;
                            case 'verInfo':
                                $sql="select c.nome as 'nomeCategoria', p.nome as 'nomeProduto', p.descricao,       p.imagem, format(preco,2,'de_DE')  as 'preco', p.statusTabelaNuticional
                                      from tbl_produto as p inner join tbl_categoria as c on c.id_categoria = p.id_categoria where id_produto = ".$id;
                                $select = mysql_query($sql) or die(mysql_error());
                                if($rs=mysql_fetch_array($select)){
                                    $nomeProduto = $rs['nomeProduto'];
                                    $nomeCategoria = $rs['nomeCategoria'];
                                    $descricaoProduto = $rs['descricao'];
                                    $imagemProduto = $rs['imagem'];
                                    $preco = $rs['preco'];
                                    $tabelaNutricional = $rs['statusTabelaNuticional'];
                                }

                                ?>
                                    <script>
                                        $(document).ready(function(){
                                            abrirPopUp();
                                            aumentarFooter();
                                        });
                                    </script>
                                <?php
                        }
                    }

                    include_once('externos/verInformacoes/paginaAprovacao_produtos/popupCadastro.php');

            ?>
            <!--Conteúdo-->
            <section>
                <!--Menu-->
                <!--Inclui o menu que irá aparecer em todas as páginas-->
                <?php
                    include_once('externos/menu_universal.php');
                ?>
                <!--Título do Crud-->
                <div id="div_titulo_crud">
                    <div id="titulo_crud">
                        Aprovação de Produtos
                    </div>
                    <!--Icone do Crud-->
                    <div id="div_icone_crud">
                        <img src="img/aprovarProdutosIcon.png" alt="">
                    </div>
                </div>
                <div id="div_foraTabela">
                    <!--Crud-->
                    <div id="div_conteudo">
                        <!--Tabela Cargos-->
                        <div id="tabela_crud_titulos">
                            <!--Título da Tabela-->
                            <div class="titulo_colunaPoucosCampos">
                                Nome do Produto
                            </div>
                            <div class="titulo_coluna">
                                Preço
                            </div>
                            <div class="titulo_colunaImagem">
                                Foto
                            </div>
                            <div class="titulo_2opcColuna">
                                Opções
                            </div>
                        </div>
                        <?php

                            //Comando SQL
                            $sql = "select id_produto, statusTabelaNuticional, nome, format(preco,2,'de_DE')  as 'preco', imagem from tbl_produto where statusAprovacao = 0";

                            $select = mysql_query($sql) or die(mysql_error());

                            while($rs=mysql_fetch_array($select)){
                                $id = $rs['id_produto'];

                        ?>
                        <div class="tabela_crud_conteudo">
                            <div class="conteudo_colunaPoucosCampos">
                                <?php echo($rs['nome']); ?>
                            </div>
                            <div class="conteudo_coluna">
                                R$<?php echo($rs['preco']); ?>
                            </div>
                            <div class="conteudo_colunaImagem">
                                <div class="tabela_conteudoVideoImagem">
                                    <img src=" <?php echo($rs['imagem']); ?>" alt="">
                                </div>
                            </div>
                            <div class="coluna_2opcoes">
                                <!--Informações-->
                                <a href="paginaAprovacao_produtos.php?id=<?php echo($id);?>&modo=verInfo">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="img/infoIcon.png" alt="" title="Informações">
                                        </div>
                                    </div>
                                </a>
                                <!--Aprovar-->
                                <a href="paginaAprovacao_produtos.php?id=<?php echo($id);?>&modo=aprovar">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="img/aprovarIcon.png" alt="" title="Aprovar">
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
            </section>
            <!--Rodapé-->
            <?php include_once('rodape/rodape.php'); ?>
        </div>
    </body>
</html>
