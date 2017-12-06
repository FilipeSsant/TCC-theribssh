<!--Div de Cadastro-->
<div id="div_foraCadastro">
    <!--Botão fechar-->
    <a href="crud_produtos.php">
    <div class="botao_fecharPopUp" onClick="fecharPopUp(), normalizarFooter()">
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
                <span><?php echo($tituloPopUp); ?> Produto</span>
            </div>
        </div>
        <!--Formulário de preenchimento para Cadastro-->
        <div id="formulario_cadastro">
            <form name="formCadastroProdutos" method="post" action="crud_produtos.php" enctype="multipart/form-data">
                <!--Nome-->
                <input value="<?php echo($nomeProduto); ?>" class="input_texto" type="text" name="txt_nomeProduto" placeholder="Nome do Produto" required><br>
                <!--Caixa com titulo-->
                <div class="titulo_popCadastro">
                    Selecione uma imagem
                </div>
                <!--Selecionar imagem-->
                <input class="botao_tipoFile" type="file" name="filesimagemproduto" id="btn_img" <?php echo($requirido); ?>><br>
                <!--Preço-->
                <input value="<?php echo($precoProduto); ?>" id="preco" class="input_texto" type="text" name="txt_preco" onkeypress="semEspaco(event)" placeholder="Preço do Produto" required><br>
                <!--Caixa com titulo-->
                <div class="titulo_popCadastro">
                    Categoria
                </div>
                <!--Select Categoria-->
                <select class="select" name="selectCategoria" required>
                    <option selected disabled>Selecione uma Categoria</option>
                    <?php

                        //Comando SQL
                        $sql = "select * from tbl_categoria";
                        $select = mysql_query($sql) or die(mysql_error());

                        while($rs=mysql_fetch_array($select)){
                            $idCategoria = $rs['id_categoria'];
                            $categoria = $rs['nome'];
                            
                            //Se o id que é pego no select do alterar for igual
                            //Um dos selects encotrados aqui, ele automaticamente
                            //Adiciona o value "selected" para esse ID
                            if($selectCategoria == $idCategoria){
                                $optionSelecionado = "selected";
                            }else{
                                $optionSelecionado = "";
                            }
                    ?>
                    <option <?php echo($optionSelecionado); ?> value="<?php echo($idCategoria);?>"><?php echo($categoria); ?></option>
                    <?php
                        }
                    ?>
                </select><br>
                <!--Caixa com titulo-->
                <div class="titulo_popCadastro">
                    Descrição
                </div>
                <!--Descrição-->
                <textarea name="txt_descricao" class="textArea" required><?php echo($descProduto); ?></textarea><br>
                <button id="botao_cadastrar" value="<?php echo($valueBotao); ?>" type="submit" name="btnCadastrar_produto">
                    <?php echo($valueBotao); ?>
                </button>
            </form>
        </div>
    </div>
</div>

<div id="div_mostrarImagem">
    <div class="imagemPreview">
        <img src="<?php echo($imgProduto); ?>" id="imagem" alt="">
    </div>
</div>