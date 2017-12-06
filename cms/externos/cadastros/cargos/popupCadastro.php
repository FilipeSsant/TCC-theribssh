<!--Div de Cadastro-->
<div id="div_foraCadastro">
    <!--Botão fechar-->
    <a href="crud_cargos.php">
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
                <?php
                
                    if(isset($_GET['modo'])){
                        $tituloPopUp = "Alterar";
                    }
                
                ?>
                <span><?php echo($tituloPopUp); ?> Cargo</span>
            </div>
        </div>
        <!--Formulário de preenchimento para Login-->
        <div id="formulario_cadastro">
            <form name="formCadastroCargos" method="post" action="crud_cargos.php">
                <!--Nome cargo-->
                <input class="input_texto" type="text" name="txt_nomeCargo" placeholder="Nome do Cargo" required><br>
                <!--Caixa com titulo-->
                <div class="titulo_popCadastro">
                    Permissões
                </div>
                <!--CheckBox para Páginas relacionadas-->
                <div class="div_checkbox">
                    <?php
                        //Pega o modo que esta sendo passado na url
                        if(isset($_GET['modo'])){
                            //Pega os objetos após a ? e guarda na variavel
                            $modo = $_GET['modo'];

                            //Esse switch serve para usando a variavel modo tenha varios resultados
                            switch($modo){

                                case 'alterar':
                                    //Guarda o id na sessão
                                    $_SESSION['idCargo'] = $id;
                                    //Muda o titulo do PopUp
                                    $tituloPopUp = "Alterar";

                                    $sql = "select nome from tbl_cargo where id_cargo = ".$id;
                                    $select = mysql_query($sql);

                                    if($rs = mysql_fetch_array($select)){
                                        $nomeCargo = $rs['nome'];
                                    }

                                    //Puxa os dados referente ao id
                                    $sql = "select * from tbl_permissao";
                                    $select = mysql_query($sql);

                                    while($rs = mysql_fetch_array($select)){
                                        $idPermissao = $rs['id_permissao'];
                                        $nome = $rs['nome'];
                                        $retirarAcentos = str_replace('á', 'a', $nome);
                                        $retirarAcentos = str_replace('ã', 'a', $retirarAcentos);
                                        $retirarAcentos = str_replace('é', 'e', $retirarAcentos);
                                        $retirarAcentos = str_replace('ê', 'e', $retirarAcentos);
                                        $nameInput = str_replace(' ', '_', $retirarAcentos);
                                        $nameInput = strtolower($nameInput);
                                        
                                        $sql2 = "select * from tbl_cargopermissao where id_cargo = ".$id." and id_permissao = ".$idPermissao;
                                    
                                        $select2 = mysql_query($sql2);

                                        if($rs2=mysql_fetch_array($select2)){        
                                            ?>
                                            <input class="checkbox_cadastro" type="checkbox" name="<?php echo($nameInput); ?>" value="<?php echo($rs['id_permissao']); ?>" checked><?php echo($nome);?><br>
                                            <?php
                                        }else{
                                            ?>
                                            <input class="checkbox_cadastro" type="checkbox" name="<?php echo($nameInput); ?>" value="<?php echo($rs['id_permissao']); ?>"><?php echo($nome);?><br>
                                            <?php
                                        }
                                    }

                                    ?>
                                        <script>
                                            $(".input_texto[name='txt_nomeCargo']").attr('value','<?php echo($nomeCargo); ?>');
                                            $(document).ready(function(){
                                                abrirPopUp();
                                            });
                                        </script>    
                                    <?php

                                    //Muda o value do botão
                                    $valueBotao = "Alterar";
                                    break;
                            }
                        }else{
                            //Seleciona os cargos existentes no banco
                            $sql = "select * from tbl_permissao";

                            $select = mysql_query($sql) or die(mysql_error());

                            while($rs = mysql_fetch_array($select)){
                                $nome = $rs['nome'];
                                $retirarAcentos = str_replace('á', 'a', $nome);
                                $retirarAcentos = str_replace('ã', 'a', $retirarAcentos);
                                $retirarAcentos = str_replace('é', 'e', $retirarAcentos);
                                $retirarAcentos = str_replace('ê', 'e', $retirarAcentos);
                                $retirarAcentos = str_replace('ó', 'o', $retirarAcentos);
                                $retirarAcentos = str_replace('ô', 'o', $retirarAcentos);
                                $nameInput = str_replace(' ', '_', $retirarAcentos);
                                $nameInput = strtolower($nameInput);

                                ?>
                                <input class="checkbox_cadastro" type="checkbox" name="<?php echo($nameInput); ?>" value="<?php echo($rs['id_permissao']); ?>"><?php echo($nome);?><br>
                                <?php

                            }
                        }
                    ?>
                </div>
                <!--Botão Cadastrar-->
                <button id="botao_cadastrar" value="<?php echo($valueBotao); ?>" type="submit" name="btnCadastrar_nivel">
                    <?php echo($valueBotao); ?>
                </button>
            </form>
        </div>
    </div>
</div>
