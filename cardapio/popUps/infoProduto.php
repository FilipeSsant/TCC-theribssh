<!--Ingrediente do Produto-->
<div id="div_ingredienteProduto" class="ingrediente_produto" style="background-color:<?php echo($corTerciaria); ?>;">
    <?php
        if(isset($_GET['modo']) == 'verInfo'){
            $idCardapio = $_GET['id_cardapio'];
            $tipoBotao = $_GET['tipoBotao'];
    ?>
    <!--Botão fechar-->
    <a href="cardapio.php?id_cardapio=<?php echo($idCardapio); ?>&tipoBotao=<?php echo($tipoBotao); ?>">
        <div id="botao_fecharCard" onClick="fecharPopUp()" style="background-color:<?php echo($corQuartenaria); ?>;">
            <img src="../img/fecharPopUp.png" alt="">
        </div>
    </a>    
    <!--Título-->
    <div class="titulo_ingrediente" style="background-color:<?php echo($corSecundaria); ?>;">
        <div class="ing_texto">
            <span class="ing_textoS">Ingredientes</span>
        </div>
    </div>
    <!--Texo Ingredientes-->
    <div class="ingredientes_detalhes" style="background-color:<?php echo($corSecundaria); ?>;">
        <?php
                $idProduto = $_GET['id_produto'];

                //Comando SQL
                $sql = "select i.nome as 'nomeIngrediente' , i.id_ingrediente, ip.quantidade, ip.detalhe, tu.sigla, tu.nome as 'nomeTipoUnit' from  tbl_ingrediente as i
                inner join tbl_ingredienteproduto as ip on ip.id_ingrediente = i.id_ingrediente
                inner join tbl_produto as p on p.id_produto = ip.id_produto
                inner join tbl_tipounit as tu on tu.id_tipounit = ip.id_tipounit where ip.id_produto = ".$idProduto;

                $select = mysql_query($sql) or die(mysql_error());

                while($rs=mysql_fetch_array($select)){

                    $nomeIngrediente = $rs['nomeIngrediente'];
                    $quantidade = $rs['quantidade'];
                    $nomeTipoUnit = $rs['nomeTipoUnit'];
                    $detalhe = $rs['detalhe'];
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
            <p>
                <?php echo($quantidade); ?> <?php echo($sigla); ?> <?php echo($nomeIngrediente); ?> <?php echo($detalhe); ?>
            </p>
        <?php

                    ?> 
                    <script>
                        $(document).ready(function(){
                            abrirInfoCard();
                        });
                    </script>    
                    <?php
                }
        ?>
        </div>
        <?php
            }
        ?>
</div>