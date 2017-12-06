<?php

    session_start();

    //Conexão com o banco
    include_once('../conexao/mysql.php');

    //inclui o php Universal que utilizara em todas as páginas
    include_once('../externos/phpUniversal.php');

    //If para verificar se o usuário tem uma sessão
    if(isset($_SESSION['id_cliente'])){

    }else{
        header('location:../home/home.php');
    }

    $horarioBR = "";
    $dataBR = "";
    $data = "";
    $nomeProduto = "";
    $preco = "";

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Histórico de Pedidos</title>
        <link rel="stylesheet" href="../css/historico_pedidos.css">
        <link rel="stylesheet" href="../css/cssUniversal.css">
        <link href="fontes/openSans" rel="stylesheet">
        <link rel="icon" href="../icon.png" type="image/x-icon" />
        <link rel="shortcut icon" href="../icon.png" type="image/x-icon" />
        <script type="text/javascript" src="../jquery/jquery-2.2.4.js" ></script>
        <script type="text/javascript" src="../jquery/jquery-2.1.1.js" ></script>
        <script type="text/javascript" src="../jquery/jquerymaskplugin.js" ></script>
        <!--Script de Máscaras-->
        <script>
            //Máscaras
            <?php include_once('../jsFunctions/mascaraLoginCadastro.js')?>
        </script>
        <!--Script Funções-->
		<script>

            //Inclui o pop up do cadastro e do login
            <?php include_once('../jsFunctions/popup.js')?>
            //Inclui o pop up do histórico
            <?php include_once('../jsFunctions/historico.js')?>
            //Inclui a função de mostrar a senha caso o usuario pressione o botão
            <?php include_once('../jsFunctions/mostrarSenha.js')?>
            //Inclui a janelinha informativa caso o usuário tenha alguma duvida
            //Passando o mouse por cima da figura e assim aparecendo a explicação
            <?php include_once('../jsFunctions/janelaInformativa.js')?>
            //Inclui o Scroll do cabeçalho
            <?php include_once('../jsFunctions/cabecalho_scroll.js');?>
            
            //Muda tamanho do rodapé
            $(document).ready(function(){
                $("#rodapeBg").css({"height":"1100px"});
            })
            
		</script>
    </head>
    <body style="background-color:<?php echo($corSecundaria); ?>">
		<div id="esqueleto">
			<!--Cabeçalho-->
			<?php
				//Inclui o cabeçalho para a página
				include_once('../cabecalho/cabecalho.php');
			?>
			<!--Corpo-->
			<section>
                  <h6>The Ribs Steakhouse - Meu Perfil - Histórico de Pedidos</h6>
				  <!--Div do Título do Restaurante-->
				  <div class="div_titulo" style="background-color:<?php echo($corPrimaria); ?>; border-top:20px solid <?php echo($corSecundaria)?>;">
					  <!--Titulo-->
					  <div class="titulo">
						  <span style="color:<?php echo($corSecundaria); ?>">Histórico de Pedidos</span>
					  </div>
				  </div>
                  <?php
                    
                    $idCliente = $_SESSION['id_cliente'];
                    
                    //Comando SQL
                    $sql = "select ped.id_pedido, r.nome as 'nomerestaurante', ped.data as 'datafeita' from tbl_pedido as ped
                            inner join tbl_funcionario as f on f.id_funcionario = ped.id_funcionario
                            inner join tbl_restaurante as r on r.id_restaurante = f.id_restaurante where id_cliente = ".$idCliente;
                    $select = mysql_query($sql);
                
                    while($rs=mysql_fetch_array($select)){
                        
                        $resultado = "";
                        $resultadoBanco = "";
                        
                        $data = $rs['datafeita'];
                        
                        //Separa a hora da data
                        $separadorHorarioData = explode(" ", $data);

                        //Formata a data para formato BR
                        $dataParteProxima = explode("-", $separadorHorarioData[0]);
                        //Ano
                        $anoProxima = $dataParteProxima[0];
                        //Mês
                        $mesProxima = $dataParteProxima[1];
                        //Dia
                        $diaProxima = $dataParteProxima[2];

                        $dataBR = $diaProxima."/".$mesProxima."/".$anoProxima;

                        //Pega só a hora e os minutos
                        $separaHorario = explode(":", $separadorHorarioData[1]);
                        //Hora
                        $hora = $separaHorario[0];
                        //Minutos
                        $minutos = $separaHorario[1];

                        $horarioBR = $hora.":".$minutos;
                        
                        $sql2 = "select count(*) as 'qtd' from tbl_pedidoproduto where id_pedido = ".$rs['id_pedido'];
                        $select2 = mysql_query($sql2);
                        if($rs2=mysql_fetch_array($select2)){
                            $qtdTotalProdutos = $rs2['qtd'];
                        
                            if($qtdTotalProdutos > 1){
                                $qtdTotal = $qtdTotalProdutos." produtos";
                            }else{
                                $qtdTotal = $qtdTotalProdutos." produto";
                            }
                        }
                                                
                        
                  ?>
                      <div class="informacoes_historico">

                          <div class="informacoes_segunda_linha" style="background-color:<?php echo($corTerciaria); ?>;">
                              <div class="botao">
                                <a><img src="../img/abrirHistorico.png" alt="" class="botao_mostrar_detalhes" data-element=".informacoes_produto" title="1"  ></a>
                              </div>
                              <div class="pedido_data_produto">
                                  <span class="centralizar_texto" style="color:<?php echo($corSecundaria); ?>"><?php echo($rs['nomerestaurante']); ?></span>
                              </div>
                              <div class="pedido_data_produto">
                                  <span class="centralizar_texto" style="color:<?php echo($corSecundaria); ?>"><?php echo($dataBR); ?></span>
                              </div>
                              <div class="pedido_data_produto">
                                  <span class="centralizar_texto" style="color:<?php echo($corSecundaria); ?>"><?php echo($qtdTotal); ?></span>
                              </div>
                          </div>
                          <div class="informacoes_produto" hidden>
                              <div class="informacoes_terceira_linha" style="background-color:<?php echo($corTerciaria); ?>;">
                                  <div class="img_produtoTitulo">
                                      <span style="color:<?php echo($corSecundaria); ?>">Produto</span>
                                  </div>
                                  <div class="img_produtoTitulo">
                                      <span style="color:<?php echo($corSecundaria); ?>">Descrição do Produto</span>
                                  </div>
                                  <div class="produto_desc_qntd_preco">
                                      <span style="color:<?php echo($corSecundaria); ?>">Quantidade</span>
                                  </div>
                                  <div class="produto_desc_qntd_preco">
                                      <span style="color:<?php echo($corSecundaria); ?>">Preço</span>
                                  </div>
                              </div>
                              <?php
                                $sql2= "select p.nome, p.imagem, format(p.preco,2,'de_DE') as 'preco', p.preco as 'precoNaoFormatado', p.descricao, p.id_produto from tbl_produto as p
                                        inner join tbl_pedidoproduto as ped on p.id_produto = ped.id_produto
                                        where ped.id_pedido = ".$rs['id_pedido'];

                                $select2 = mysql_query($sql2);
                                while($rs2=mysql_fetch_array($select2)){
                                    
                                    $sql3 = "select count(*) as 'qtdProduto' from tbl_pedidoproduto where id_produto = ".$rs2['id_produto']." and id_pedido = ".$rs['id_pedido'];
                                    $select3 = mysql_query($sql3);
                                    while($rs3=mysql_fetch_array($select3)){
                                        $preco = $rs2['precoNaoFormatado'];
                                        $resultado = $preco + $resultado;
                              ?>
                                      <div class="informacoes_quarta_linha">
                                          <div class="img_produtoFoto">
                                              <div class="img_nome_produto">
                                                  <img src="../cms/<?php echo($rs2['imagem']); ?>" alt=""/>
                                                <span class="centralizar_texto" style="color:<?php echo($corPrimaria); ?>"><?php echo($rs2['nome']); ?></span>
                                              </div>
                                          </div>
                                          <div class="img_produtoFoto">
                                              <span style="color:<?php echo($corMarromPrimaria); ?>"><?php echo($rs2['descricao']); ?></span>
                                          </div>
                                          <div class="img_desc_qntd_preco">
                                              <span class="centralizar_texto" style="color:<?php echo($corMarromPrimaria); ?>"><?php echo($rs3['qtdProduto']); ?></span>
                                          </div>
                                          <div class="img_desc_qntd_preco">
                                              <span class="centralizar_texto" style="color:<?php echo($corMarromPrimaria); ?>">R$ <?php echo($rs2['preco']); ?></span>
                                          </div>
                                      </div>
                              <?php
                                    }    
                                }
                              ?>
                          </div>
                          <?php 
                          
                            //Converter pra formato brasileiro
                            $sql4 = "select format(".$resultado.",2,'de_DE') as 'resultado'";
                            $select4 = mysql_query($sql4);
                            if($rs4=mysql_fetch_array($select4)){
                                $resultadoBanco = $rs4['resultado'];
                            }
                          ?>
                          <div class="informacoes_segunda_linha" style="background-color:<?php echo($corTerciaria); ?>;">
                              <div class="total" style="background-color:<?php echo($corTerciaria); ?>;">
                                  <span style="color:<?php echo($corSecundaria); ?>">Total: R$ <?php echo($resultadoBanco); ?></span>
                              </div>
                          </div>
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
