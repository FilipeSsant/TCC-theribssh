<!--Div de Cadastro-->
<div id="div_foraAdicionar">
    <!--Botão fechar-->
    <a href="crud_cardapio.php">
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
                <span>Adicionar aos Principais</span>
            </div>
        </div>
        <!--Formulário de preenchimento para Login-->
        <div id="formulario_cadastro">
            <form name="formAdicionarProduto" method="post" action="crud_cardapio.php">
                <!--CheckBox para Produtos-->
                <div class="div_checkbox">
                    <?php
                    //Pega o modo que esta sendo passado na url
                    if(isset($_GET['modo'])){
                        //Guarda o id na sessão
                        $_SESSION['idCardapioPrincipal'] = $id;
                        //Pega os objetos após a ? e guarda na variavel
                        $modo = $_GET['modo'];
                        $id = $_GET['id'];

                        //Se for principais
                        if($modo =='principais'){
                            //Puxa os dados referente ao $id
                            $sql = "select p.nome as 'nomeProduto', cp.principais, p.id_produto as 'idProduto' from tbl_cardapioproduto as cp inner join tbl_produto as p on p.id_produto = cp.id_produto where cp.id_cardapio = ".$id." order by p.id_produto asc";

                            $select = mysql_query($sql);

                            while($rs = mysql_fetch_array($select)){

                                $nome = $rs['nomeProduto'];
                                $retirarAcentos = str_replace('á', 'a', $nome);
                                $retirarAcentos = str_replace('ã', 'a', $retirarAcentos);
                                $retirarAcentos = str_replace('é', 'e', $retirarAcentos);
                                $retirarAcentos = str_replace('ê', 'e', $retirarAcentos);
                                $nameInput = str_replace(' ', '_', $retirarAcentos);
                                $nameInput = strtolower($nameInput);    

                                if($rs['principais'] == 1){
                                    ?>
                                        <input class="checkbox_cadastro" type="checkbox" name="<?php echo($nameInput); ?>" value="<?php echo($rs['idProduto']); ?>" checked><?php echo($nome);?><br>
                                    <?php
                                }else{
                                    ?>
                                        <input class="checkbox_cadastro" type="checkbox" name="<?php echo($nameInput); ?>" value="<?php echo($rs['idProduto']); ?>"><?php echo($nome);?><br>
                                    <?php
                                }
                            }

                            ?>
                                <script>
                                    $(document).ready(function(){
                                        abrirAdicionar();
                                    });   
                                </script>    
                            <?php
                        }
                    }
                    ?>
                </div>
                <!--Botão Cadastrar-->
                <button id="botao_cadastrar" type="submit" name="btnAdicionar_produtos">
                    Adicionar
                </button>
            </form>
        </div>
    </div>
</div>