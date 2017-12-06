<!--Div de Cadastro-->
<div id="div_foraCadastro">
    <!--Botão fechar-->
    <a href="crud_cardapio.php">
        <div class="botao_fecharPopUp" onClick="fecharPopUp()">
            <img src="img/fecharPopUp.png" alt="">
        </div>
    </a>
    <!--Div de Login-->
    <div id="div_cadastro">
        <!--Título div Cadastro-->
        <div class="titulo_loginCadastro">
            <!--Linha atras do Titulo-->
            <div class="linha_atrasDoTitulo">
            </div>
            <!--Texto do Título-->
            <div class="div_tituloCadastro">
                <span id="titulo_janela"><?php echo($tituloPopUp); ?> Cardápio</span>
            </div>
        </div>
        <!--Formulário de preenchimento para Login-->
        <div id="formulario_cadastro">
            <form name="formCadastroCardapio" method="post" action="crud_cardapio.php">
                <!--Nome cardapio-->
                <input class="input_texto" value="" type="text" name="txt_nomeCardapio" placeholder="Nome" required><br>
                <!--Caixa com titulo-->
                <div class="titulo_popCadastro">
                    Produtos Relacionados
                </div>
                <!--CheckBox para Produtos-->
                <div class="div_checkbox">
                    <?php

                    //Pega o modo que esta sendo passado na url
                    if(isset($_GET['modo'])){
                        //Pega os objetos após a ? e guarda na variavel
                        $modo = $_GET['modo'];
                        $id = $_GET['id'];

                        //Esse switch serve para usando a variavel modo tenha varios resultados
                        switch($modo){
                            //Caso ativar tabela nutricional
                            case 'ativar_desativar':
                                $idRestaurante = $_GET['idR'];
                                $sql = "select status from tbl_cardapio where id_restaurante = ".$idRestaurante;
                                $select = mysql_query($sql) or die(mysql_error());
                                if($rs=mysql_fetch_array($select)){

                                    $sql2 = "update tbl_cardapio set status = 0 where id_restaurante = ".$idRestaurante;
                                    mysql_query($sql2);

                                    $sql2 = "update tbl_cardapio set status = 1 where id_cardapio = ".$id;
                                    mysql_query($sql2);
                                }
                                //Voltar para o php sem dados na url
                                ?>
                                    <script>window.location = "crud_cardapio.php";</script>
                                <?php
                                break;
                            //Case para deletar um registro
                            case 'deletar':
                                //Deleta da tabela relação primeiro
                                $sql = "delete from tbl_cardapioproduto where id_cardapio =".$id;
                                mysql_query($sql);
                                //Deleta o item usando seu id
                                $sql = "delete from tbl_cardapio where id_cardapio = ".$id." and status != 1";
                                mysql_query($sql);
                                //Voltar para o php sem dados na url
                                ?>
                                    <script>window.location = "crud_cardapio.php";</script>
                                <?php
                                break;
                            //Case para alterar um item
                            case 'alterar':
                                //Guarda o id na sessão
                                $_SESSION['idCardapio'] = $id;
                                //Puxa os dados referente ao id
                                $sql = "select * from tbl_cardapio where id_cardapio = ".$id;
                                $select = mysql_query($sql) or die(mysql_error());
                                if($rs = mysql_fetch_array($select)){
                                    $nomeCardapio = $rs['nome'];
                                    $selectRestaurante = $rs['id_restaurante'];
                                }

                                //Puxa os dados referente ao $id
                                $sql = "select * from tbl_produto where statusAprovacao = 1";

                                $select = mysql_query($sql);

                                while($rs = mysql_fetch_array($select)){
                                    $idProduto = $rs['id_produto'];
                                    $nome = $rs['nome'];
                                    $retirarAcentos = str_replace('á', 'a', $nome);
                                    $retirarAcentos = str_replace('ã', 'a', $retirarAcentos);
                                    $retirarAcentos = str_replace('é', 'e', $retirarAcentos);
                                    $retirarAcentos = str_replace('ê', 'e', $retirarAcentos);
                                    $nameInput = str_replace(' ', '_', $retirarAcentos);
                                    $nameInput = strtolower($nameInput);

                                    $sql2 = "select * from tbl_cardapioproduto where id_cardapio = ".$id." and id_produto = ".$idProduto;

                                    $select2 = mysql_query($sql2);

                                    if($rs2 = mysql_fetch_array($select2)){
                                        ?>
                                            <input class="checkbox_cadastro" type="checkbox" name="<?php echo($nameInput); ?>" value="<?php echo($rs['id_produto']); ?>" checked><?php echo($nome);?><br>
                                        <?php
                                    }else{
                                        ?>
                                            <input class="checkbox_cadastro" type="checkbox" name="<?php echo($nameInput); ?>" value="<?php echo($rs['id_produto']); ?>"><?php echo($nome);?><br>
                                        <?php
                                    }
                                }

                                ?>
                                    <script>
                                        //Coloca o value do Nome do Produto porque ele esta acima do select do 'alterar'
                                        $(".input_texto[name='txt_nomeCardapio']").attr('value','<?php echo($nomeCardapio); ?>');
                                        $("#titulo_janela").html("Alterar Cardápio");
                                        $(document).ready(function(){
                                            abrirPopUp();
                                            aumentarFooter();
                                        });
                                    </script>
                                <?php

                                //Muda o value do botão
                                $valueBotao = "Alterar";
                                break;
                        }
                }else{
                    //Seleciona os cargos existentes no banco
                    $sql = "select * from tbl_produto where statusAprovacao = 1";

                    $select = mysql_query($sql) or die(mysql_error());

                    while($rs = mysql_fetch_array($select)){
                        $nome = $rs['nome'];
                        $retirarAcentos = str_replace('á', 'a', $nome);
                        $retirarAcentos = str_replace('ã', 'a', $retirarAcentos);
                        $retirarAcentos = str_replace('é', 'e', $retirarAcentos);
                        $retirarAcentos = str_replace('ê', 'e', $retirarAcentos);
                        $nameInput = str_replace(' ', '_', $retirarAcentos);
                        $nameInput = strtolower($nameInput);

                        ?>
                        <input class="checkbox_cadastro" type="checkbox" name="<?php echo($nameInput); ?>" value="<?php echo($rs['id_produto']); ?>"><?php echo($nome);?><br>
                        <?php
                    }
                }
                ?>
            </div>
            <!--Caixa com titulo-->
            <div class="titulo_popCadastro">
                Restaurante
            </div>
            <!--Select Restaurante-->
            <select class="select" name="selectRestaurante" required>
                <option selected disabled>Selecione um Restaurante</option>
                <?php

                    $idRestaurante = $_SESSION['idRestauranteFuncionarioU'];
                
                    $sql = "select * from tbl_restaurante where id_restaurante = ".$idRestaurante;
                    $select = mysql_query($sql) or die(mysql_error());
                    while($rs=mysql_fetch_array($select)){
                        $idRestaurante = $rs['id_restaurante'];
                        $nomeRestaurante = $rs['nome'];

                        //Se o id que é pego no select do alterar for igual
                        //Um dos selects encotrados aqui, ele automaticamente
                        //Adiciona o value "selected" para esse ID
                        if($selectRestaurante == $idRestaurante){
                            $optionSelecionado = "selected";
                        }else{
                            $optionSelecionado = "";
                        }
                ?>
                <option <?php echo($optionSelecionado); ?> value="<?php echo($idRestaurante);?>"><?php echo($nomeRestaurante); ?></option>
                <?php
                    }
                ?>
                </select><br>
                <!--Botão Cadastrar-->
                <button id="botao_cadastrar" value="<?php echo($valueBotao); ?>" type="submit" name="btnCadastrar">
                    <?php echo($valueBotao); ?>
                </button>
            </form>
        </div>
    </div>
</div>
