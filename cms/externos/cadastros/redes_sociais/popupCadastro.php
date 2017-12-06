<?php

    //Pega o modo que esta sendo passado na url
    if(isset($_GET['modo'])){
        //Pega os objetos após a ? e guarda na variavel
        $modo = $_GET['modo'];
        $id = $_GET['id'];

        //Esse switch serve para usando a variavel modo tenha varios resultados
        switch($modo){
            //Case para ativar ou desativar o item
            case 'ativar_desativar':
                $quantidade = "";
                //Pega a contagem de status
                $sql = "select count(status) as 'quantidade' from tbl_redesocial where status = 1";
                $select = mysql_query($sql) or die(mysql_error());
                if($rs=mysql_fetch_array($select)){
                    $quantidade = $rs['quantidade'];
                }

                //Faz um select para pegar o valor do status do registro atual
                $sql = "select status from tbl_redesocial where id_redesocial = ".$id;
                $select = mysql_query($sql) or die(mysql_error());
                if($rs=mysql_fetch_array($select)){
                    if($rs['status'] == '1'){
                        //Ativa somente o status que foi lançado no url pelo id
                        $sql = "update tbl_redesocial set status = 0 where id_redesocial = ".$id;
                        mysql_query($sql);
                        ?>
                            <script>
                                window.location = "crud_redesSociais.php";
                            </script>    
                        <?php
                    }else{
                        //Verifica a quantidade se for maior que 3 (que é o maximo) da uma mensagem de erro
                        if($quantidade == 3){
                            ?>
                                <script>
                                    swal({
                                      title: "Só é permitido a ativação de três registros",
                                      text: "Desabilite um registro para poder ativar este.",
                                      type: "error",
                                      icon: "error",
                                      button: {
                                                 text: "Ok",
                                               },
                                      closeOnEsc: true,
                                    });  
                                    //Voltar para o php sem dados na url
                                    setTimeout(function(){
                                        window.location = "crud_redesSociais.php";
                                    }, 5000);
                                </script>    
                            <?php 
                        }else{
                            //Ativa somente o status que foi lançado no url pelo id
                            $sql = "update tbl_redesocial set status = 1 where id_redesocial = ".$id;
                            mysql_query($sql);
                        }
                    }
                } 
                ?>
                    <script>
                        window.location = "crud_redesSociais.php";
                    </script>    
                <?php
                break;
            //Case para deletar um registro    
            case 'deletar':	
                //Deleta o item usando seu id
                $sql = "delete from tbl_redesocial where id_redesocial = ".$id;
                mysql_query($sql);
                //Unlink que exclui a imagem da pasta
                unlink($_GET['linkimg']);
                //Voltar para o php sem dados na url
                ?>
                    <script>
                        window.location = "crud_redesSociais.php";
                    </script>    
                <?php
                break;
            //Case para alterar um item
            case 'alterar':
                //Guarda o id na sessão
                $_SESSION['idRedeSocial'] = $id;
                //Muda o titulo do PopUp
                $tituloPopUp = "Alterar";
                //Campo imagem não requirido
                $requirido = "";
                //Puxa os dados referente ao id
                $sql = "select * from tbl_redesocial where id_redesocial = ".$id;
                $select = mysql_query($sql);
                if($rs = mysql_fetch_array($select)){
                    $nomeRedeSocial = $rs['nome'];
                    $imgRedeSocial = $rs['imagem'];
                    //Guarda a imagem na sessão
                    $_SESSION['imagem'] = $imgRedeSocial;
                    $linkRedeSocial = $rs['link'];
                }

                ?>
                    <script>
                        $(document).ready(function(){
                            abrirPopUp();
                        });   
                    </script>    
                <?php

                $requirido = "";
                //Muda o value do botão
                $valueBotao = "Alterar";
                break;
        }

    }

?>
<!--Div de Cadastro-->
<div id="div_foraCadastro">
    <!--Botão fechar-->
    <a href="crud_redesSociais.php">
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
                <span><?php echo($tituloPopUp); ?> Rede Social</span>
            </div>
        </div>
        <!--Formulário de preenchimento para Cadastro-->
        <div id="formulario_cadastro">
            <form name="formCadastroRedeSocial" method="post" action="crud_redesSociais.php" enctype="multipart/form-data">
                <!--Nome-->
                <input value="<?php echo($nomeRedeSocial); ?>" class="input_texto" type="text" name="txt_nomeRedeSocial" placeholder="Nome da Rede Social" required><br>
                <!--Link-->
                <input value="<?php echo($linkRedeSocial); ?>" class="input_texto" type="url" name="txt_linkRedeSocial" placeholder="http://www.redesocial.com" required><br>
                <!--Caixa com titulo-->
                <div class="titulo_popCadastro">
                    Selecione uma imagem
                </div>
                <!--Selecionar imagem-->
                <input class="botao_tipoFile" type="file" name="filesimagemredes" id="btn_img" <?php echo($requirido); ?>><br>
                <!--Botão Cadastrar-->
                <button id="botao_cadastrar" value="<?php echo($valueBotao); ?>" type="submit" name="btnCadastrar_redeSocial">
                    <?php echo($valueBotao); ?>
                </button>
            </form>
        </div>
    </div>
</div>

<div id="div_mostrarImagem">
    <div class="imagemPreview">
        <img src="<?php echo($imgRedeSocial); ?>" id="imagem" alt="">
    </div>
</div>
