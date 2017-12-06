<?php

    session_start();

	//Conexão com o banco
    include_once('../conexao/mysql.php');

	//Removendo Probabilidade de Erros Por Campos Não opcionais vazios
	$textoArtigo = "";
	$caminhoImagem = "";

	$sql = "select * from tbl_sobrenos where status = 1";

	$select = mysql_query($sql);

	if($rs=mysql_fetch_array($select)){
		$textoArtigo = $rs['texto'];
		$caminhoImagem = $rs['caminho_imagem'];
	}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>The Ribs Steakhouse - Sobre Nós</title>
        <link rel="stylesheet" href="../css/sobrenos.css">
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
		</script>
    </head>
    <body style="background-color:<?php echo($corSecundaria); ?>">
        <!--Cabeçalho-->
        <!--Fundo Transparente-->
        <div id="fundo_transparente" onClick="fecharPopUps()">

        </div>
		<div id="esqueleto">
			<?php
				//Inclui o cabeçalho para a página
				include_once('../cabecalho/cabecalho.php');
			?>
			<section>
                <h6>The Ribs Steakhouse - Sobre Nós</h6>
				<!--Div do Título do Restaurante-->
				<div class="div_titulo" style="background-color:<?php echo($corQuartenaria); ?>; border-top:20px solid <?php echo($corSecundaria)?>;">
					<!--Titulo-->
					<div class="titulo">
						<span style="color:<?php echo($corSecundaria); ?>">The Ribs Steakhouse</span>
					</div>
				</div>
				<!--Slider-->
				<div id="sliderSn" style="background-image:url('../cms/<?php echo($caminhoImagem);?>'); background-position:center;">
				</div>

				<div class="div_titulo" style="background-color:<?php echo($corSecundaria); ?>; border-top:20px solid <?php echo($corSecundaria)?>;">
					<!--Titulo-->
					<div class="titulo">
						<span style="color:<?php echo($corTerciaria); ?>">Nossa História</span>
					</div>
				</div>
				<!--Texto da página-->
				<div id="div_textoSn">
					<div id="textoSn">
						<p>
							<?php echo($textoArtigo); ?>
						</p>
					</div>
				</div>
				<!--Div do Título dos Cozinheiros-->
				<div class="div_titulo" style="background-color:<?php echo($corSecundaria); ?>; border-top:20px solid <?php echo($corSecundaria)?>;">
					<!--Titulo-->
					<div class="titulo">
						<span style="color:<?php echo($corTerciaria); ?>">Nossos Chefes</span>
					</div>
				</div>
				<?php
					//Comando SQL
                    $sql = "select r.nome as 'nomeRestaurante', r.id_restaurante, c.nome as 'nomeCidade' from tbl_restaurante as r
                            inner join tbl_endereco as e on e.id_endereco = r.id_endereco
                            inner join tbl_cidade as c on c.id_cidade = e.id_cidade";

                    $select = mysql_query($sql) or die(mysql_error());

					while($rs=mysql_fetch_array($select)){
                        $idRestaurante = $rs['id_restaurante'];
				?>
				<!--Div Título Unidade-->
				<div class="titulo_unidadeCidade">
					<span><?php echo($rs['nomeRestaurante']); ?> - <?php echo($rs['nomeCidade']); ?></span>
				</div>
				<!--Div Conjunto de Cozinheros-->
				<div class="div_conjuntoCozinheiros">
                    <?php

                        $sql2 = "select * from tbl_funcionario where id_restaurante = ".$idRestaurante." and statusMDM = 1";
                        $select2 = mysql_query($sql2) or die(mysql_error());

                        while($rs2=mysql_fetch_array($select2)){
                            $nomeCozinheiroCapitalizado = "";
                            
                            //Deixa minusculo as palavras e depois capitaliza o inicio de cada uma
                            $nomeCozinheiro = strtolower($rs2['nome_completo']);
                            
                            //Separa os nomes dos espaço
                            $partesNome = explode(" ", $nomeCozinheiro);
                            //Condição para contar quantas palavras o nome da pessoa tem
                            $i = 0;
                            while($i < count($partesNome)){
                                $nomeCozinheiroCapitalizado = $nomeCozinheiroCapitalizado." ".ucfirst($partesNome[$i]);
                                $i++;
                            }
                            
                            $dtNasc  = $rs2['dt_nasc'];
                            //usa o comando explode para separar em vetor as informações
                            //que estão agrupadas por "/"
                            $partesData = explode("-", $dtNasc);
                            //Dia
                            $ano = $partesData[0];
                            //Mês
                            $mes = $partesData[1];
                            //Ano
                            $dia = $partesData[2];

                            $dtNascOriginal = $dia."/".$mes."/".$ano;
                    ?>
					<div class="div_cozinheiro">
						<!--Foto do Cozinheiro-->
						<div class="foto_cozinheiro">
							<img src="../cms/<?php echo($rs2['foto']); ?>" alt="">
						</div>
						<!--Nome Cozinheiro-->
						<div class="nome_cozinheiro">
							<?php echo($nomeCozinheiroCapitalizado); ?>
						</div>
						<!--Especialidae Cozinheiro-->
						<div class="especialidade_cozinheiro">
							Data de Aniversário: <?php echo($dtNascOriginal); ?>
						</div>
					</div>
                    <?php
                        }
                    ?>
				</div>
                <?php
                    }
                ?>
        </section>
        <!--Rodapé-->
        <?php
            //Inclui o rodapé para a página
            include_once('../rodape/rodape.php');
        ?>
        </div>    
    </body>
</html>
