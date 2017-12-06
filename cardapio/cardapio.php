<?php

    session_start();

    //Conexão com o banco
    include_once('../conexao/mysql.php');


    //inclui o php Universal que utilizara em todas as páginas
    include_once('../externos/phpUniversal.php');

    $idRestaurante = "";
    $tituloProdutos = "";
    $nomeIngrediente = "";
    $quantidade = "";
    $nomeTipoUnit = "";
    $idProduto = "";
    $idCardapio = "";
    

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>The Ribs Steakhouse - Cardápio</title>
        <link rel="stylesheet" href="../css/cardapio.css">
        <link rel="stylesheet" href="../css/cssUniversal.css">
        <link href="fontes/openSans" rel="stylesheet">
        <link rel="icon" href="../icon.png" type="image/x-icon" />
        <link rel="shortcut icon" href="../icon.png" type="image/x-icon" />
        <script type="text/javascript" src="../jquery/jquery-2.2.4.js" ></script>
        <script type="text/javascript" src="../jquery/jquerymaskplugin.js" ></script>
        <!--Script de Máscaras-->
        <script>
          //Máscaras
          <?php include_once('../jsFunctions/mascaraLoginCadastro.js')?>
        </script>
        <!--Script Funções-->
		<script>
        //Inclui o pop up do cadastro e do login
        <?php include_once('../jsFunctions/popup.js');?>
        //Inclui a função de mostrar a senha caso o usuario pressione o botão
        <?php include_once('../jsFunctions/mostrarSenha.js');?>
        //Inclui a janelinha informativa caso o usuário tenha alguma duvida
        //Passando o mouse por cima da figura e assim aparecendo a explicação
        <?php include_once('../jsFunctions/janelaInformativa.js');?>
        //Inclui uma mensagem que é aberta no passar do mouse em um botão na area de Login
        <?php include_once('../jsFunctions/abrirMensagemNaAreaLogin.js');?>
        //Inclui o Scroll do cabeçalho
        <?php include_once('../jsFunctions/cabecalho_scroll.js');?>

                   
            //Verificar se o restaurante foi selecionado
            function verificarSelect(){
                //Coloca na variavel a url que vai redirecionar para fazer o processo
                var url = "../ajax/verificarSelecao.php";

                $.ajax({
                    //Define o método
                    method:"POST",
                    //Define a url
                    url:url,
                    //Coloca em formato JSON as informações para passar pelo POST
                    data:{verificado:"verificado"},
                    success:function(dados){
                        //Manda os dados que será concebido como $resultado para a div ou input em questão
                        $("#div_botoes").css({"display":""+dados});
                    }

                });
            }

            //Enviar id do restaurante para uma variavel
            function enviarIdCardapio(){
                //Coloca na variavel o value que está na caixa
                var idRestaurante = $("#select_cardapio option:checked").val();
                
                //Coloca na variavel a url que vai redirecionar para fazer o processo
                var url = "../ajax/pegarIdCardapio.php";

                $.ajax({
                    //Define o método
                    method:"POST",
                    //Define a url
                    url:url,
                    //Coloca em formato JSON as informações para passar pelo POST
                    data:{idrestaurante:idRestaurante},
                    success:function(data){
                        var dados = data.split(",");
                        //Manda os dados que será concebido como $resultado para a div ou input em questão
                        $("#href_botao1").attr("href","cardapio.php?id_cardapio="+dados[0]+"&id_restaurante="+dados[1]+"&tipoBotao=todos");
                        $("#href_botao2").attr("href","cardapio.php?id_cardapio="+dados[0]+"&id_restaurante="+dados[1]+"&tipoBotao=principais");
                    }
                });
                
            }
            
            function enviarIdResHref(idres){
                
                var idRestauranteHref = idres;
                
                //Coloca na variavel a url que vai redirecionar para fazer o processo
                var url = "../ajax/pegarIdCardapio.php";

                $.ajax({
                    //Define o método
                    method:"POST",
                    //Define a url
                    url:url,
                    //Coloca em formato JSON as informações para passar pelo POST
                    data:{idhrefres:idRestauranteHref},
                    success:function(data){
                        var dados = data.split(",");
                        //Manda os dados que será concebido como $resultado para a div ou input em questão
                        $("#href_botao1").attr("href","cardapio.php?id_cardapio="+dados[0]+"&id_restaurante="+dados[1]+"&tipoBotao=todos");
                        $("#href_botao2").attr("href","cardapio.php?id_cardapio="+dados[0]+"&id_restaurante="+dados[1]+"&tipoBotao=principais");
                    }
                });
            }

		</script>
    </head>
    <body style="background-color:<?php echo($corSecundaria); ?>">
		<div id="esqueleto">
            <!--Fundo Transparente-->
            <div id="fundo_transparente" onClick="fecharPopUps()">

            </div>
			<!--Cabeçalho-->
			<?php
				//Inclui o cabeçalho para a página
				include_once('../cabecalho/cabecalho.php');
            
                //Inclui o cabeçalho para a página
                include_once('popUps/infoProduto.php');
            
                if(isset($_GET['id_restaurante'])){
                    $idRes = $_GET['id_restaurante'];
                    ?>
                        <script>
                            verificarSelect();
                            enviarIdResHref(<?php echo($idRes); ?>);
                        </script>
                    <?php
                }
            
			?>
			<section>
                <h6>The Ribs Steakhouse - Cardápio</h6>
				<!--Div do Título da Página-->
				<div class="div_titulo" style="background-color:<?php echo($corQuartenaria); ?>; border-top:20px solid <?php echo($corSecundaria)?>;">
					<!--Titulo-->
					<div class="titulo">
						<span style="color:<?php echo($corSecundaria); ?>">Cardápio</span>
					</div>
				</div>
                <!--Escolher um restaurante para ver o cardápio-->
                <!--Select Restaurante-->
                <select id="select_cardapio" name="selectRestaurante" onchange="verificarSelect(), enviarIdCardapio()">
                    <option selected disabled>Selecione um Restaurante</option>
                    <?php

                        //Comando SQL
                        $sql = "select r.nome, r.id_restaurante from tbl_restaurante as r
                                inner join tbl_cardapio as c on c.id_restaurante = r.id_restaurante
                                where c.status = 1";

                        $select = mysql_query($sql) or die(mysql_error());

                        while($rs=mysql_fetch_array($select)){
                    ?>
                    <option value="<?php echo($rs['id_restaurante']);?>"><?php echo($rs['nome']); ?></option>
                    <?php
                        }
                    ?>
                </select><br>
				<!--Botões para acesso aos pratos-->
				<div id="div_botoes">
					<!--Botão Todos-->
					<a href="#" id="href_botao1"><div class="botao_cardapio" style="background-color:<?php echo($corPrimaria); ?>;">
						<span style="color:<?php echo($corSecundaria); ?>">Todos</span>
					</div></a>
					<!--Botão Principais-->
					<a href="#" id="href_botao2"><div id="botao_cardapio2" class="botao_cardapio" style="background-color:<?php echo($corPrimaria); ?>;">
						<span style="color:<?php echo($corSecundaria); ?>">Principais</span>
					</div></a>
				</div>
				<!--Div dos Pratos-->
				<div id="div_foraProdutos">
					<div id="div_produtos" style="background-color:<?php echo($corSecundaria); ?>;">
                        <?php

                            //Verifica se na url existe um "tipoBotao"
                            if(isset($_GET['tipoBotao'])){
                                $tipoBotao = $_GET['tipoBotao'];
                                $idCardapio = $_GET['id_cardapio'];
                                $nomeRestaurante = "";
                                //Comando SQL para pegar o nome do restaurante através do id_cardapio
                                $sql2 = "select r.nome from tbl_restaurante as r
                                        inner join tbl_cardapio as c on r.id_restaurante = c.id_restaurante where id_cardapio = ".$idCardapio;
                                $select2 = mysql_query($sql2);
                                while($rs2 = mysql_fetch_array($select2)){
                                    $nomeRestaurante = $rs2['nome'];
                                }
                                //Faz um switch para dar condições a cada variavel que passar na url
                                switch($tipoBotao){
                                    case 'todos':
                                        $tituloProdutos = "Todos os produtos do ".$nomeRestaurante;
                                        break;
                                    case 'principais':
                                        $tituloProdutos = "Principais produtos do ".$nomeRestaurante;
                                        break;
                                }
                            }else{
                                //A variavel serve para determinar o que será escrito na caixa de Produtos
                                $tituloProdutos = "";
                            }


                        ?>
						<!--Titulo Todos ou Principais-->
						<div class="titulo_divProdutos" style="background-color:<?php echo($corTerciaria); ?>;">
							<span style="color:<?php echo($corSecundaria); ?>"><?php echo($tituloProdutos); ?></span>
						</div>
                        <!--Categorias-->
                        <div id="div_categorias">
                            <?php
                                //Comando SQL
                                $sql = "select * from tbl_categoria";
                                $select = mysql_query($sql) or die(mysql_error());

                                while($rs=mysql_fetch_array($select)){
                                    $tipoBotao = $_GET['tipoBotao'];
                                    $idCardapio = $_GET['id_cardapio'];
                                    $nomeCategoria = $rs['nome'];
                                    $iconeCategoria = $rs['imagem'];
                            ?>
                            <a href="cardapio.php?id_cardapio=<?php echo($idCardapio); ?>&tipoBotao=<?php echo($tipoBotao); ?>&id_categoria=<?php echo($rs['id_categoria']); ?>">
                                <div class="categoria" style="background-color:<?php echo($corTerciaria); ?>;">
                                    <img src="../cms/<?php echo($iconeCategoria); ?>" alt="" title="<?php echo($nomeCategoria); ?>">
                                </div>
                            </a>
                            <?php
                                }
                            ?>
                        </div>
						<!--Produtos-->
						<div id="div_infoProdutos" >
							<?php
                                //Verifica se na url existe um "tipoBotao"
                                if(isset($_GET['tipoBotao'])){
                                    $tipoBotao = $_GET['tipoBotao'];
                                    $idCardapio = $_GET['id_cardapio'];
                                    //Faz as categorias aparecerem
                                    ?>
                                        <script>
                                             $("#div_categorias").css({"display":"block"});
                                        </script>
                                    <?php
                                    //Faz um switch para dar condições a cada variavel que passar na url
                                    switch($tipoBotao){
                                        case 'todos':
                                            //Comando SQL
                                            $sql = "select p.id_produto, p.descricao, p.id_categoria, p.nome, p.imagem, format(p.preco,2,'de_DE')  as 'preco' from tbl_produto as p
                                            inner join tbl_cardapioproduto as cp on cp.id_produto = p.id_produto where cp.id_cardapio =".$idCardapio." and p.statusAprovacao = 1";

                                            if(isset($_GET['id_categoria'])){
                                                $idCategoria = $_GET['id_categoria'];
                                                //Comando SQL
                                                $sql = "select p.id_produto, p.descricao, p.id_categoria, p.nome, p.imagem, format(p.preco,2,'de_DE')  as 'preco' from tbl_produto as p
                                                inner join tbl_cardapioproduto as cp on cp.id_produto = p.id_produto where cp.id_cardapio =".$idCardapio." and p.id_categoria =".$idCategoria." and p.statusAprovacao = 1";
                                            }

                                            break;
                                        case 'principais':
                                            //Comando SQL
                                            $sql = "select p.id_produto, p.descricao, p.id_categoria, p.nome, p.imagem, format(p.preco,2,'de_DE')  as 'preco' from tbl_produto as p
                                            inner join tbl_cardapioproduto as cp on cp.id_produto = p.id_produto where cp.id_cardapio = ".$idCardapio." and cp.principais = 1";

                                            if(isset($_GET['id_categoria'])){
                                                $idCategoria = $_GET['id_categoria'];
                                                //Comando SQL
                                                $sql = "select p.id_produto, p.descricao, p.id_categoria, p.nome, p.imagem, format(p.preco,2,'de_DE')  as 'preco' from tbl_produto as p
                                            inner join tbl_cardapioproduto as cp on cp.id_produto = p.id_produto where cp.id_cardapio = ".$idCardapio." and cp.principais = 1 and p.id_categoria =".$idCategoria;
                                            }

                                            break;
                                    }

                                    $select = mysql_query($sql) or die(mysql_error());

								    while($rs=mysql_fetch_array($select)){
                                        $idProduto = $rs['id_produto'];

                                    ?>
                                        <!--Div produto e detalhes-->
                                        <div class="produtos_detalhes">
                                            <!--Produto-->
                                            <div class="produto">
                                                <img src="../cms/<?php echo($rs['imagem']); ?>" alt="">
                                            </div>
                                            <!--Detalhes Produto-->
                                            <div class="detalhes_produto" style="background-color:<?php echo($corPrimaria); ?>; border-bottom: 12px solid <?php echo($corTerciaria); ?>;">
                                                <!--Div agrupadora-->
                                                <div class="div_nome_desc_preco">
                                                    <!--Nome do Produto-->
                                                    <div class="nome_produto" style="background-color:<?php echo($corTerciaria); ?>; color:<?php echo($corSecundaria); ?>;">
                                                        <?php echo($rs['nome']); ?>
                                                    </div>
                                                    <!--Descrição do Produto-->
                                                    <div class="desc_produto" style="background-color:<?php echo($corSecundaria);?>;">
                                                        <span class="span_desc"><?php echo($rs['descricao']); ?></span>
                                                    </div>
                                                    <!--Preço do Produto-->
                                                    <div class="preco_produto" style="background-color:<?php echo($corTerciaria); ?>; color:<?php echo($corSecundaria); ?>;">
                                                        R$ <?php echo($rs['preco']); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="cardapio.php?id_cardapio=<?php echo($idCardapio); ?>&tipoBotao=<?php echo($tipoBotao); ?>&id_produto=<?php echo($idProduto); ?>&modo=verInfo">
                                                <div class="div_verInfoCardapio" style="background-color:<?php echo($corPrimaria); ?>;" title="Ver Ingredientes">
                                                </div>
                                            </a>
                                        </div>
                            <?php
                                    }

                                    if(isset($_GET['id_categoria'])){
                                        $msgCardapioAviso = "Não há produtos relacionados à essa categoria.";
                                    }else{
                                        $msgCardapioAviso = "Desculpe-nos, não há por enquanto produtos para a visualização.";
                                    }

                                    $qtdLinhas = mysql_num_rows($select);

                                    if($qtdLinhas == 0){
                                        $imgCardapioAviso = "procurando.png";
                                        $msgCardapioAviso;

                                        include_once("divMensagemAviso.php");
                                    }



                                }else{
                                    $imgCardapioAviso = "upward.png";
                                    $msgCardapioAviso = "Selecione um restaurante para poder ver o respectivo cardápio.";

                                    include_once("divMensagemAviso.php");

                                }
							?>
						</div>
					</div>
				</div>
			</section>
			<!--Rodapé-->
			<?php
				//Inclui o rodapé para a página
				include_once('../rodape/rodape.php');
			?>
		</div>
    </body>
</html>
