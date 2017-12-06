<?php


    //Pega o modo que esta sendo passado na url
    if(isset($_GET['modo'])){
        //Pega os objetos após a ? e guarda na variavel
        $modo = $_GET['modo'];
        $id = $_GET['id'];

        //Esse switch serve para usando a variavel modo tenha varios resultados
        switch($modo){
            //Case para adicionar quantidade de ingredientes
            case 'gerenciar_ingredientes':
                $_SESSION['idProdutoIngrediente'] = $id;
                ?>
                    <script>
                    $(document).ready(function(){
                        abrirAdicionar();
                    });  
                    </script>
                <?php
                break;
            //Case para deletar ingredientes
            case 'gerenciar_ingredientesDeletar':
                $idIngrediente = $_GET['idIng'];
                //Comando SQL
                $sql = "delete from tbl_ingredienteproduto where id_ingrediente = ".$idIngrediente." and id_produto = ".$id;
                mysql_query($sql);
                //Voltar para o php sem dados na url
                ?>
                    <script>window.location = "crud_produtos.php?id=<?php echo($id); ?>&modo=gerenciar_ingredientes";</script>
                <?php
                break;
            //Case para alterar ingredientes
            case 'gerenciar_ingredientesAlterar':
                //Guarda o id na sessão
                $idIngredienteGet = $_GET['idIng'];
                $_SESSION['idIngrediente'] = $idIngredienteGet;
                //Guarda o id na sessão
                $_SESSION['idProdutoIngrediente'] = $id;
                
                //Muda o titulo do PopUp Adicionar
                $tituloPopUp2 = "Alterar";
                
                //Comando SQL
                $sql = "select ip.id_ingrediente, ip.quantidade, ip.id_tipounit, ip.detalhe from tbl_ingrediente as i
                    inner join tbl_ingredienteproduto as ip on ip.id_ingrediente = i.id_ingrediente
                    inner join tbl_produto as p on p.id_produto = ip.id_produto
                    inner join tbl_tipounit as tu on tu.id_tipounit = ip.id_tipounit where ip.id_produto = ".$id." and ip.id_ingrediente = ".$idIngredienteGet;
                
                $select = mysql_query($sql) or die(mysql_error());
                
                if($rs=mysql_fetch_array($select)){
                    $quantidadeBd = $rs['quantidade'];
                    $detalheBd = $rs['detalhe'];
                    $idTipoUniBd = $rs['id_tipounit'];
                }
                
                //Muda o value do botão Adicionar
                $valueBotao2 = "Alterar";
                
                ?>
                    <script>
                    $(document).ready(function(){
                        abrirAdicionar();
                    });  
                    </script>
                <?php
                
                break;
        }
    }

?>
<!--Div de Cadastro-->
<div id="div_foraAdicionar">
    <!--Botão fechar-->
    <a href="crud_produtos.php">
        <div class="botao_fecharPopUp" onClick="fecharAdicionar()">
            <img src="img/fecharPopUp.png" alt="">
        </div>
    </a>    
    <!--Div de Login-->
    <div id="div_adicionar">
        <!--Título div Cadastro-->
        <div class="titulo_loginCadastro">
            <!--Linha atras do Titulo-->
            <div class="linha_atrasDoTitulo">
            </div>
            <!--Texto do Título-->
            <div class="div_tituloCadastro">
                <span><?php echo($tituloPopUp2); ?> Ingrediente</span>
            </div>
        </div>
        <!--Formulário de preenchimento para Login-->
        <div id="formulario_cadastro">
            <form id="formAdicionarIngrediente" name="formAdicionarIngrediente" method="post" action="crud_produtos.php">
                <!--Caixa com titulo-->
                <div class="titulo_popCadastro">
                    Ingredientes
                </div>
                <!--Select do Ingrediente-->
                <select class="select" name="selectIng" required>
                    <option selected disabled>Selecione um ingrediente</option>
                    <?php

                        //Comando SQL
                        $sql = "select * from tbl_ingrediente order by nome";
                        $select = mysql_query($sql) or die(mysql_error());

                        while($rs=mysql_fetch_array($select)){

                            $idIngrediente = $rs['id_ingrediente'];
                            $nomeIngrediente = $rs['nome'];
                            
                            //Se o id que é pego no select do alterar for igual
                            //Um dos selects encotrados aqui, ele automaticamente
                            //Adiciona o value "selected" para esse ID
                            if($idIngredienteGet == $idIngrediente){
                                $optionSelecionado = "selected";
                            }else{
                                $optionSelecionado = "";
                            }
                    ?>
                    <option <?php echo($optionSelecionado); ?> value="<?php echo($idIngrediente);?>"><?php echo($nomeIngrediente); ?></option>
                    <?php
                        }
                    ?>
                </select><br>
                <!--Quantidade-->
                <input class="input_texto" value="<?php echo($quantidadeBd); ?>" type="text" name="txt_qtdIng" placeholder="Quantidade" onkeypress="semEspaco(event)" required><br>
                <!--Detalhe-->
                <input class="input_texto" value="<?php echo($detalheBd); ?>" type="text" name="txt_detalheIng" placeholder="Detalhe(ex:a gosto)"><br>
                <!--Caixa com titulo-->
                <div class="titulo_popCadastro">
                    Valor Unitário
                </div>
                <!--Select Valor Unitário-->
                <select class="select" name="selectTpUnitario" required>
                    <option selected disabled>Selecione um tipo unitário</option>
                    <?php

                        //Comando SQL
                        $sql2 = "select * from tbl_tipounit";
                        $select2 = mysql_query($sql2) or die(mysql_error());

                        while($rs2=mysql_fetch_array($select2)){
                            $idTipoUnit = $rs2['id_tipounit'];
                            $nomeTipoUnit = $rs2['nome'];
                            
                            //Se o id que é pego no select do alterar for igual
                            //Um dos selects encotrados aqui, ele automaticamente
                            //Adiciona o value "selected" para esse ID
                            if($idTipoUniBd == $idTipoUnit){
                                $optionSelecionado = "selected";
                            }else{
                                $optionSelecionado = "";
                            }

                    ?>
                    <option <?php echo($optionSelecionado); ?> value="<?php echo($idTipoUnit);?>"><?php echo($nomeTipoUnit); ?></option>
                    <?php
                        }
                    ?>
                </select><br>   
                <!--Botão Cadastrar-->
                <button id="botao_cadastrar" value="<?php echo($valueBotao2); ?>" type="submit" name="btnAdicionarIngredientes">
                    <?php echo($valueBotao2); ?>
                </button>
            </form>
        </div>
    </div>
</div>
<div id="div_ingredientesRegistrados">
    <div id="conteudo_ingredientesRegistrados">
        <div id="titulo_ingredientesRegistrados">
            Ingredientes Registrados
        </div>
        <?php
        
            if(isset($_GET['modo']) == 'gerenciar_ingredientes'){
                $idProdutoIngrediente = $_GET['id'];

                //Comando SQL
                $sql = "select i.nome as 'nomeIngrediente' , i.id_ingrediente, tu.sigla, ip.quantidade, ip.detalhe, tu.nome as           'nomeTipoUnit' from tbl_ingrediente as i
                        inner join tbl_ingredienteproduto as ip on ip.id_ingrediente = i.id_ingrediente
                        inner join tbl_produto as p on p.id_produto = ip.id_produto
                        inner join tbl_tipounit as tu on tu.id_tipounit = ip.id_tipounit where ip.id_produto = ".$idProdutoIngrediente;
                $select = mysql_query($sql) or die(mysql_error());

                while($rs=mysql_fetch_array($select)){
                    $idIngrediente = $rs['id_ingrediente'];
                    $nomeIngrediente = $rs['nomeIngrediente'];
                    $quantidade = $rs['quantidade'];
                    $detalhe = $rs['detalhe'];
                    $nomeTipoUnit = $rs['nomeTipoUnit'];
                    $sigla = $rs['sigla'];

                    //Substitui , por .
                    $quantidade = str_replace('.',',',$quantidade);

                    if($nomeTipoUnit == "Unidade"){
                        $nomeTipoUnit = "";
                        $sigla = "";
                        if($quantidade > 1){
                            $nomeIngrediente  = $nomeIngrediente."s ";
                        }
                    }else{
                        $sigla = $sigla." de ";
                    }
        ?>
                    <div class="ingredientesRegistrados">
                        <span><?php echo($quantidade); ?> <?php echo($sigla); ?> <?php echo($nomeIngrediente); ?> <?php echo($detalhe); ?></span>
                            <div class="div_opcoesIngredientes">
                                <a href="crud_produtos.php?idIng=<?php echo($idIngrediente); ?>&id=<?php echo($idProdutoIngrediente); ?>&modo=gerenciar_ingredientesDeletar">
                                    <div class="opcoesIngredientes">
                                        <img src="img/lixeiraIcon.png" alt="">
                                    </div>
                                </a>  
                                <a href="crud_produtos.php?idIng=<?php echo($idIngrediente); ?>&id=<?php echo($idProdutoIngrediente); ?>&modo=gerenciar_ingredientesAlterar">
                                    <div class="opcoesIngredientes">
                                        <img src="img/editarIngredientesIcon.png" alt="">
                                    </div>
                                </a> 
                            </div>
                    </div>
        <?php
                }
            }    
        ?>
    </div>
</div>