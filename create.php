<?php
/* @var $this SimulacaoController */
/* @var $model Simulacao */
/* @var $form CActiveForm */

if (Yii::app()->session['id_prop'] != null){
$this->breadcrumbs = array(
Propriedade::model()->findByPk(Yii::app()->session['id_prop'])->nome => array('propriedade/info_propriedade', 'id'=> Yii::app()->session['id_prop']),
    'Simulação',

);
}

if ((Yii::app()->user->id) != null) {
    $this->menu = array(
        array('label' => 'Voltar para Propriedade', 'url' => array('propriedade/info_propriedade', 'id' => Yii::app()->session['id_prop'])),
        array('label' => 'Manage Simulacao', 'url' => array('admin')),
    );
}
?>


<link rel="stylesheet" type="text/css" href="/mybeef2/themes/hebo/css/LucianoStyle.css" />


<!-- ************ Exibe msg de erro, caso hajam erros na entrada dos dados ********** -->
<?php if($erro == 1) { ?>
<script> alert("Por favor, digite valores entre 1-100 para desmame, entre 0-100 para mortalidade, entre 1-3 para idade de abate e acasalamento, e valores positivos para lotação animal e área.");</script>
<?php } ?>
<!-- ******************************************************************************** -->

<!-- ***********************TÍTULOS DAS PÁGINAS DE SIMULAÇÃO ************************ -->
<?php if ($tipo == 's') { ?>
    <div class="titulos">Tela de Simulação</div>
<?php } ?>

<?php if ($tipo == 'a') { ?>
    <div class="titulos">Simulação: Cenário Atual</div>
<?php } ?>

<?php if ($tipo == 'f') { ?>
    <div class="titulos">Simulação: Cenário Futuro</div>
<?php } ?>

<?php if ($tipo == 'f2') { ?>
    <h2 style="text-align: center">O Limite de Investimento necessário para atingir a meta desejada é de R$: 
        <?php echo "$investimento,00"; ?>.</h2>
<?php } ?>

<h3> Esta é a tela de simulação do MyBeef. Preencha os campos abaixo e clique em <b>Simular</b> para obter a taxa de desfrute (Kg %) e 
produtividade a partir dos índices de entrada. Após a simulação, para efetuar alterações nos pesos dos animais, descarte de vacas entre outros, clique
em Sensibilidade e logo após em Calibragem e para ver o estoque e produção animal após a simulação, clique em Detalhes. </h3>
<!-- ******************************************************************************** -->

<!-- *************************** Mensagens de dicas exibidas ************************ -->
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <b>É importante não deixar campos em branco, pois todos são fundamentais à Simulação!</b>
</div>
<!-- ******************************************************************************** -->

<!-- *********************** Passa os dados para  o _form.php *********************** -->
<?php
$this->renderPartial('_form', array(
	'saida' => $saida,
    'tipo' => $tipo,
    'novo' => $novo,
    'model_valor_outro1' => $model_valor_outro1,
    'model_valor_outro2' => $model_valor_outro2,
    'model_valor_outro3' => $model_valor_outro3,
    'model_valor_outro4' => $model_valor_outro4,
    'model_valor_outro5' => $model_valor_outro5,
    'model_valor_outro6' => $model_valor_outro6,
    'model_valor_outro7' => $model_valor_outro7,

    'model_valor_outro9' => $model_valor_outro9,
    'model_valor_outro10' => $model_valor_outro10,
    'model_valor_outro11' => $model_valor_outro11,
    'model_valor_cat_pm_pv_farea1' => $model_valor_cat_pm_pv_farea1,
    'model_valor_cat_pm_pv_farea2' => $model_valor_cat_pm_pv_farea2,
    'model_valor_cat_pm_pv_farea3' => $model_valor_cat_pm_pv_farea3,
    'model_valor_cat_pm_pv_farea4' => $model_valor_cat_pm_pv_farea4,
    'model_valor_cat_pm_pv_farea5' => $model_valor_cat_pm_pv_farea5,
    'model_valor_cat_pm_pv_farea6' => $model_valor_cat_pm_pv_farea6,
    'model_valor_cat_pm_pv_farea7' => $model_valor_cat_pm_pv_farea7,
    'model_valor_cat_pm_pv_farea8' => $model_valor_cat_pm_pv_farea8,
    'model_valor_cat_pm_pv_farea9' => $model_valor_cat_pm_pv_farea9,
    'model_categoria_sim' => $model_categoria_sim,
));
?>

<!-- *******************************************************************************-->

<?php
$prod_areaTEMP = new CNumberFormatter(Yii::app()->getLocale());
//echo $prod_areaTEMP->formatDecimal($prod_area);
$pc_desfruteTEMP = new CNumberFormatter(Yii::app()->getLocale());
// echo $pc_desfruteTEMP->formatDecimal($pc_desfrute);
?>

<!-- $saida =1 indica que o gráfico com os resultados da simulação devem ser mostrados -->
<?php if (($saida == 1)&&((Yii::app()->user->id) == null)) { ?>          
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    Faça o cadastro no MyBeef. São só alguns passos, é simples e Grátis! <br/>
</div>
<?php } ?>
<!-- *******************************************************************************-->

<?php if($saida == 1) { ?>

<!-- ***** Gráfico de saída do velocímetro para o desfrute e produtividade ******** -->
<table class="table table-striped table-bordered table-hover" align="center">
    <tr>
        <td rowspan="4" width="70%">
	<?php if($tipo == 's') { ?>
        <div id="graficoVelocimetro" class="myChart3" style="width: 670px; height: 200px; margin: 0 auto"></div>
	<table>	
	<td><div id="graficoBenchmarkDesfrute" class="myChart1" style="width: 300px; height: 250px"></div></td>
	<td><div id="graficoBenchmarkProdutividade" class="myChart4" style="width: 300px; height: 250px"></div></td>
	<td><div id="graficoBenchmarkArea" class="myChart5" style="width: 300px; height: 250px"></div></td>
	</table>
	<table>
	<td><div id="graficoBenchmarkMortalidade" class="myChart6" style="width: 300px; height: 250px"></div></td>
	<td><div id="graficoBenchmarkDesmame" class="myChart7" style="width: 300px; height: 250px"></div></td>
	<td><div id="graficoBenchmarkLotacao" class="myChart8" style="width: 300px; height: 250px"></div></td>
	</table>	
 	<?php } else { ?>
	<div style="font-size:17px; line-height:15px">
	A seguir demonstra-se um exemplo para estimar o aumento da produção por área quando se pretende melhorar o desempenho do rebanho, especialmente em alguns indicadores zootécnicos. Se um produtor utiliza 1.000 hectares para a pecuária, com carga animal de 315kg de peso vivo por hectare, comercializando seus produtos em média por R$4,20 o quilograma de peso vivo e considerando os indicadores taxa de natalidade(TN), idade de acasalamento(IAC), idade de abate(IAB), sair de um patamar 50% - 2 anos - 3 anos, para 65% - 2 anos - 2 anos, respectivamente, qual será a sua produção por hectare? Em quanto aumentará a receita bruta(faturamento) devido a esse aumento de produtividade? Considerando as tabelas do relatório 27x5, na tabela 3 associe a linha do cenário atual com o cenário futuro para achar o Incremento Padronizado(valor encontrado: 27,1kg, use 28). Na tabela 4 associe o incremento padronizado com a carga do cenário futuro para achar o Incremento Ajustado(valor encontrado: 19,6 use 20). Na tabela 5 associe o incremento ajustado com o preço médio vendido do kg vivo para achar o Benefício Bruto por Hectare(valor encontrado: R$90,00). Na tabela 6 associe o benefício bruto por hectare com a área da fazenda utilizada com a pecuária(valor encontrado: RS90.000,00) Este valor representa um valor máximo de despesas que pode investir em tecnologias e processos para que se torne viável economicamente aumentar a produtividade.
	</div>
	<?php } ?>
	<div id="graficoBarrasDesfruteEProdutividade" class="myChart0" style= "display:none; width: 670px; height: 200px; margin: 0 auto" ></div>

	<div id="graficoBarras" class="myChart" style=" display:none; width: 670px; height: 200px; margin: 0 auto"></div>
     
	<div id="graficoPizza" class="myChart2" style=" display:none; width: 670px; height: 200px; margin: 0 auto"></div> 

        </td>
    </tr>
</table>
<!-- ****************************************************************************** -->

<!-- Se for simulação simples, exibir botões:  Detalhes, Calibragem e Sensibilidade -->
<?php if (($tipo != 'f')&&($tipo != 'a')&&($tipo!='f2')) { ?>  
           <table class="table table-striped table-bordered table-hover" align="center">

                <div class="row buttons" align="center">
                <?php 
                echo CHtml::button('Detalhes', array('class'=>'btn-success1', 
                'title' => 'Clique em detalhes para conferir o preço médio, o preço de venda e as taxas de descarte e de touros.',
                'submit' => array('simulacao/detalhess', 'tipo' => $tipo, 'novo' => $novo, 'figuras' => 0)));
                ?>

		<?php 
                echo CHtml::button('Sensibilidade', array('class'=>'btn-success1', 'title' => 'Sensibilidade',
                'submit' => array('simulacao/sensibilidade', 'grafico' => 0, 'label' => 0, 'novo' => $novo)));
                ?>
                </div>
	  </table>
<?php } ?>

<!-- *************************************************************************************** -->


<!-- Após efetuar simulação intensificação, mostrar botões Nova Simulação Simples e Nova Intensificação -->
<?php if (($saida == 1)&&($tipo == 'f2')) { ?>  
    <table class="table table-striped table-bordered table-hover">
        <th width="50%">
            <div class="row buttons" align="center" >
                <?php 
                    echo CHtml::button('Nova Simulação Simples', array('class'=>'btn-success2', 'title' => 'Clique para começar uma nova simulação simples.',
                    'submit' => array('simulacao/simular', 'tipo' => 's', 'novo' => 3, 'saida' => 0)));
                ?>
            </div>
        </th>
        <th>
            <div class="row buttons" align="center">
                <?php
                    echo CHtml::button('Nova Intensificação', array('class'=>'btn-success2', 'submit' => array('simulacao/simular', 
                    'tipo' => 'a', 'novo' => $novo, 'saida' => 0)));
                    echo "<br /><br />";
                ?>          
            </div>
        </th>
    </table>
<?php }} ?>

<!-- *************************************************************************************************** -->


<!--***************************************************************************************************** -->
<script type="text/javascript" src="../../protected/views/simulacao/highcharts.js"></script>
<script type="text/javascript" src="../../protected/views/simulacao/data.js"></script>
<script type="text/javascript" src="../../protected/views/simulacao/drilldown.js"></script>
<script type="text/javascript" src="../../protected/views/simulacao/highcharts-more.js"></script>
<script type="text/javascript" src="../../protected/views/simulacao/rgbcolor.js"></script>
<script type="text/javascript" src="../../protected/views/simulacao/canvg.js"></script>
<script type="text/javascript" src="../../protected/views/simulacao/exporting.js"></script>
<script type="text/javascript" src="../../protected/views/simulacao/jspdf.js"></script>
<script type="text/javascript" src="../../protected/views/simulacao/jspdf.min.js"></script>
<script type="text/javascript" src="../../protected/views/simulacao/jspdf.plugin.autotable.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<br><br><br>
				<!-- GERAR JANELA POPUP -->
<head>
  <style type="text/css">
  .popup{
     position: fixed;
     top: 0; bottom: 0;
     left: 0; right: 0;
     margin: auto;
     width: 300px;
     height: 270px;
     padding: 20px;
     border: solid 1px #331;
     background: #ffffd0;
     display: none;
  }
  </style>

  <script type="text/javascript">

   function fechar(){
     document.getElementById('popup').style.display = 'none';
   }

   function abrir(){
     document.getElementById('popup').style.display = 'block';
     setTimeout ("fechar()", 5000);
   }

  </script>

</head>

<body>

   <DIV id="popup" class="popup"> 
	<div style="position: top: 100;" align="right">
	<p><small class="fechar"><a href="javascript: fechar();">Fechar[x]</a></small></p>
	</div>
	<p>Você deseja o laudo em:</p>     
	<div align="center">
	<?php if($tipo == 's') { ?>	
	<p><?php echo CHtml::button("PDF",array('class'=>'btn-success1','PDF'=>"PDF", 'id'=>'pdf_simples')); ?></p>
	<p><?php echo CHtml::button("Enviar por Email",array('class'=>'btn-success1','submit'=> array ('simulacao/PDF','tipo'=>'s'))); ?></p>
	<?php } else if($tipo == 'f2') { ?>
	<p><?php echo CHtml::button("PDF",array('class'=>'btn-success1','PDF'=>"PDF", 'id'=>'pdf_intensificado')); ?></p>
	<p><?php echo CHtml::button("Enviar por Email",array('class'=>'btn-success1','submit'=> array('simulação/PDF','id'=> Yii::app()->session['id_prop'], 'tipo'=>'f', 'novo' =>0, 'saida' => 0))); ?></p>
	<?php } ?>
	<p><?php echo CHtml::button("Excel",array('class'=>'btn-success1','Excel'=>"Excel", 'id'=>'laudo')); ?></p>
	<p><?php echo CHtml::button("Relatório 27x5", array('class'=>'btn-success1','Relatório 27x5'=>"Relatório 27x5", 'onclick'=>'relatorio()')); ?></p>	
	<!--<?php echo '<a class="btn-success1" target="_blank" href="/var/www/mybeef3/images/Relatorio">Relatório 27x5</a>';?>-->     	
	</div>
   </DIV>
	<table class="table table-striped table-bordered table-hover">
	<?php if($saida == 1) { ?>
		
                 <div class="row buttons" align = "center">
   		  <?php echo CHtml::button("Relatorios",array('class'=>'btn-success1','Relatorios'=>"Relatorios", 'onclick' => 'abrir()')); ?>
		  <?php if((Yii::app()->user->id) != null) { ?>
		     <?php echo CHtml::button('Salvar', array('class'=>'btn-success1', 'submit' => array('simulacao/salvar', 'id' => Yii::app()->session['id_prop'], 'tipo' => 'f', 'novo' => 0, 'saida' => 0), 'onclick' => 'var ano = prompt ("Digite o ano dos dados:"); alert (ano); header("location: http://10.163.250.11/mybeef3/index.php/simulacao/simular?tipo=a&novo=0&saida=0");')); ?>
		  <?php } else { ?>
		     <?php echo CHtml::button('Salvar', array('class'=>'btn-success1', 'submit' => array('simulacao/salvar', 'id' => Yii::app()->session['id_prop'], 'tipo' => 'f', 'novo' => 0, 'saida' => 0))); ?>
		  <?php } ?>
                 </div>   
	<?php } ?>
	</table>	
</body>

</html>



					<!-- TABELA HTML PARA GERAR RELATÓRIO EXCEL -->
    <div id="dvData" style="display:none">
        <table>
            <tr>
                <th>Area</th>
                <td><?php echo CPropertyValue::ensureFloat(Yii::app()->session['areaTEMP']);?></td>
                <th>Rebanho</th>
		<td><?php echo CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhas_3_anosTEMP'])+CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhas_2_anosTEMP'])+CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhas_1_anoTEMP'])+CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhos_3_anosTEMP'])+CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhos_2_anosTEMP'])+CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhos_1_anoTEMP'])+CPropertyValue::ensureInteger(Yii::app()->session['f_area_terneiros_asTEMP'])+CPropertyValue::ensureInteger(Yii::app()->session['f_area_tourosTEMP'])+CPropertyValue::ensureInteger(Yii::app()->session['f_area_vacasTEMP']);?></td>
                <th>Idade Abate</th>
		<td><?php echo CPropertyValue::ensureFloat(Yii::app()->session['id_venda_1_3_anosTEMP']);?></td>
            </tr>
            <tr>
                <th>Lotacao</th>
                <td><?php echo CPropertyValue::ensureFloat(Yii::app()->session['lotacaoTEMP']);?></td>
                <th>Motalidade</th>
                <td><?php echo Yii::app()->session['mortalidadeTEMP']?></td>
                <th>Taxa Desmame</th>
                <td><?php echo CPropertyValue::ensureFloat(Yii::app()->session['desmameTEMP']);?></td>
            </tr>
		<tr></tr>
		<td></td>
		<th>Estoque Animal<th>
		
            <tr>
                <th>Categoria</th>
                <th>Quantidade</th>
                <th>Peso Medio (Kg)</th>
            </tr>
		<!--novilhas 3 anos-->
            <tr>
                
				
				
				<td><?php echo CategoriaSim::model()->findByPk(14)->descricao ?></td>
                		<td><?php echo CPropertyValue::ensureInteger($f_area_novilhos_3_anos); ?></td>
                		<td><?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea1->pm); ?></td>
				
				
            </tr>
            <tr><!--novilhas 2 anos-->
				
                		<td><?php echo CategoriaSim::model()->findByPk(15)->descricao ?></td>
                		<td><?php echo CPropertyValue::ensureInteger($f_area_novilhas_2_anos); ?></td>
                		<td><?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea2->pm); ?></td>
				
				
            </tr>
            <tr> <!--novilhas 1 anos-->
                		<td><?php echo CategoriaSim::model()->findByPk(16)->descricao ?></td>
                		<td><?php echo CPropertyValue::ensureInteger($f_area_novilhas_1_ano); ?></td>
                		<td><?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea3->pm); ?></td>
            </tr>
            <tr> <!--novilhos 3 anos-->
			
			    	
                	  	<td><?php echo CategoriaSim::model()->findByPk(17)->descricao ?></td>
                		<td><?php echo CPropertyValue::ensureInteger($f_area_novilhos_3_anos); ?></td>
                		<td><?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea4->pm); ?></td>
				
            </tr>
            <tr> <!--novilhos 2 anos-->
				
                		<td><?php echo CategoriaSim::model()->findByPk(18)->descricao ?></td>
               			<td><?php echo CPropertyValue::ensureInteger($f_area_novilhas_2_anos); ?></td>
                		<td><?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea5->pm); ?></td>
				
            </tr>
           <tr> <!--novihos 1 anos-->
                		<td><?php echo CategoriaSim::model()->findByPk(19)->descricao ?></td>
                		<td><?php echo CPropertyValue::ensureInteger($f_area_novilhos_1_ano); ?></td>
                		<td><?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea6->pm); ?></td>
            </tr>
            <tr> <!--terneiros-->
                <td><?php echo CategoriaSim::model()->findByPk(20)->descricao ?></td>
                <td><?php echo CPropertyValue::ensureInteger($f_area_terneiros_as); ?></td>
                <td><?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea7->pm); ?></td>
            </tr>
            <tr> <!--touros-->
                <td><?php echo CategoriaSim::model()->findByPk(21)->descricao ?></td>
                <td><?php echo CPropertyValue::ensureInteger($f_area_touros); ?></td>
                <td><?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea8->pm); ?></td>
            </tr>
            <tr> <!--vacas-->
                <td><?php echo CategoriaSim::model()->findByPk(13)->descricao ?></td>
                <td><?php echo CPropertyValue::ensureInteger($f_area_vacas); ?></td>
                <td><?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea9->pm); ?></td>
            </tr>
	    <tr>
		<td>Total</td>
		<td><?php echo CPropertyValue::ensureInteger($f_area_novilhos_3_anos) + CPropertyValue::ensureInteger($f_area_novilhas_2_anos) +
 CPropertyValue::ensureInteger($f_area_novilhas_1_ano) + CPropertyValue::ensureInteger($f_area_novilhos_3_anos) + CPropertyValue::ensureInteger($f_area_novilhas_2_anos) + CPropertyValue::ensureInteger($f_area_novilhos_1_ano) + CPropertyValue::ensureInteger($f_area_terneiros_as) + CPropertyValue::ensureInteger($f_area_touros) + CPropertyValue::ensureInteger($f_area_vacas); ?></td>
		<td></td>
	    </tr>

<!-- *************************************************************************************************** -->

<!-- ********************** FORMULÁRIOS DE SAÍDA QUE MOSTRAM A PRODUÇÃO ANIMAL ************************* -->
		<tr></tr>
		<td></td>
		<th>Producao Animal<th>
		
        <tr>
            <th>Categoria</th>
            <th>Quantidade</th>
            <th>Peso de Venda (Kg)</th>
        </tr>
        <tr><!--novilhas cab-->
            <td><?php echo CategoriaSim::model()->findByPk(23)->descricao ?></td>
            <td><?php echo CPropertyValue::ensureInteger($f_vaca_novilhas_cab); ?></td>   
            	<td><?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea1->pv); ?> (3 anos)</td>
            	<td><?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea2->pv); ?> (2 anos)</td>
            	<td><?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea3->pv); ?> (1 ano)</td>   	
        </tr>
        <tr><!--novilhos cab-->
            <td><?php echo CategoriaSim::model()->findByPk(22)->descricao ?></td>
            <td><?php echo CPropertyValue::ensureInteger($f_vaca_novilhos_cab); ?></td>
                <td><?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea4->pv); ?> (3 anos)</td>
            	<td><?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea5->pv); ?> (2 anos)</td>
            	<td><?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea6->pv); ?> (1 ano)</td> 
        </tr>
        <tr><!--touros descarte-->
            <td><?php echo CategoriaSim::model()->findByPk(25)->descricao ?></td>
            <td><?php echo CPropertyValue::ensureInteger($f_vaca_touros_descarte); ?></td>
            <td><?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea8->pv); ?></td> 
        </tr>
        <tr><!--vacas descarte-->
            <td><?php echo CategoriaSim::model()->findByPk(24)->descricao ?></td>
            <td><?php echo CPropertyValue::ensureInteger($f_vaca_vacas_descarte); ?></td>
            <td><?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea9->pv); ?></td> 
        </tr>
	<tr>
	    <td>Total</td>
	    <td><?php echo CPropertyValue::ensureInteger($f_vaca_novilhas_cab) + CPropertyValue::ensureInteger($f_vaca_novilhos_cab) +
 CPropertyValue::ensureInteger($f_vaca_touros_descarte) + CPropertyValue::ensureInteger($f_vaca_vacas_descarte); ?></td>
	    <td></td>
	</tr>
<!-- ************************************************************************************************* -->


<!-- ******* FORMULÁRIOS DE SAÍDA QUE MOSTRAM A % DE TOUROS, DESCARTE DE VACAS E DESCARTE DE TOUROS (%) ******* -->
		<tr></tr> 		
        <tr>
                <th>Categoria</th>
                <th>Porcentagem</th>
        </tr>

		<tr>
		<td><?php echo CategoriaSim::model()->findByPk(21)->descricao ?> (%)</td>
		<td>4</td> <!-- TOUROS -->
        
		</tr>
		<tr>
		<td><?php echo CategoriaSim::model()->findByPk(24)->descricao ?> ao ano (%)</td>
		<td>20</td><!-- descarte vacas -->

		</tr>
		<tr>
		<td><?php echo CategoriaSim::model()->findByPk(25)->descricao ?> ao ano (%)</td>
		<td>25</td><!-- descarte touros -->

		</tr>

</table>

</div>

<script>
    $("#laudo").click(function (e) {
        window.open('data:application/vnd.ms-excel,' + $('#dvData').html());
        e.preventDefault();
    });
</script>

<script>
    $("#relatorio").click(function (e) {
	//Implementar função para buscar arquivo no servidor e disponibilizar para download
    });
</script>

<script>
// ******** Função que gera o gráfico de saída de taxa de desfrute (KG %) e produtividade *************
// create canvas function from highcharts example http://jsfiddle.net/highcharts/PDnmQ/
(function (H) {
    H.Chart.prototype.createCanvas = function (divId) {
        var svg = this.getSVG(),
            width = parseInt(svg.match(/width="([0-9]+)"/)[1]),
            height = parseInt(svg.match(/height="([0-9]+)"/)[1]),
            canvas = document.createElement('canvas');

        canvas.setAttribute('width', width);
        canvas.setAttribute('height', height);

        if (canvas.getContext && canvas.getContext('2d')) {

            canvg(canvas, svg);

            return canvas.toDataURL("image/jpeg");

        } 
        else {
            alert("Your browser doesn't support this feature, please use a modern browser");
            return false;
        }

    }
}(Highcharts)); 


$('#pdf_intensificado').click(function () {
	var doc = new jsPDF();
    // chart height defined here so each chart can be palced
    // in a different position
    var chartHeight = 140;
     
    // All units are in the set measurement for the document
    // This can be changed to "pt" (points), "mm" (Default), "cm", "in"
    
	
	var columns = ["Lotação", "var. lotação", "Mortalidade", "var. mortalidade", "Idade desmame", "var. idade desmame"];
    var rows = [
    ["Área:", "<?php echo CPropertyValue::ensureFloat(Yii::app()->session['areaTEMP']);?>", "Rebanho:", "<?php echo CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhas_3_anosTEMP'])+CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhas_2_anosTEMP'])+CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhas_1_anoTEMP'])+CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhos_3_anosTEMP'])+CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhos_2_anosTEMP'])+CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhos_1_anoTEMP'])+CPropertyValue::ensureInteger(Yii::app()->session['f_area_terneiros_asTEMP'])+CPropertyValue::ensureInteger(Yii::app()->session['f_area_tourosTEMP'])+CPropertyValue::ensureInteger(Yii::app()->session['f_area_vacasTEMP']); ?>", 
"Idade abate:", "<?php echo CPropertyValue::ensureFloat(Yii::app()->session['id_venda_1_3_anosTEMP']);?>"],["Lotação:", "<?php echo CPropertyValue::ensureFloat(Yii::app()->session['lotacaoTEMP']);?>", "Mortalidade:", "<?php echo Yii::app()->session['mortalidadeTEMP']?>", "Taxa desmame:", "<?php echo CPropertyValue::ensureFloat(Yii::app()->session['desmameTEMP']);?>"]
];
	var doc = new jsPDF('p', 'pt');
    doc.autoTable(columns, rows, {
	theme: 'grid',
    styles: {fillColor: [255, 255, 255]},
    columnStyles: {
        id: {fillColor: 0}
    },
    margin: {top: 110},
});
	
	
	var logoEmbrapa = 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD//gA7Q1JFQVRPUjogZ2QtanBlZyB2MS4wICh1c2luZyBJSkcgSlBFRyB2NjIpLCBxdWFsaXR5ID0gOTAK/9sAQwADAgIDAgIDAwMDBAMDBAUIBQUEBAUKBwcGCAwKDAwLCgsLDQ4SEA0OEQ4LCxAWEBETFBUVFQwPFxgWFBgSFBUU/9sAQwEDBAQFBAUJBQUJFA0LDRQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQU/8AAEQgBGAJEAwEiAAIRAQMRAf/EAB8AAAEFAQEBAQEBAAAAAAAAAAABAgMEBQYHCAkKC//EALUQAAIBAwMCBAMFBQQEAAABfQECAwAEEQUSITFBBhNRYQcicRQygZGhCCNCscEVUtHwJDNicoIJChYXGBkaJSYnKCkqNDU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6g4SFhoeIiYqSk5SVlpeYmZqio6Slpqeoqaqys7S1tre4ubrCw8TFxsfIycrS09TV1tfY2drh4uPk5ebn6Onq8fLz9PX29/j5+v/EAB8BAAMBAQEBAQEBAQEAAAAAAAABAgMEBQYHCAkKC//EALURAAIBAgQEAwQHBQQEAAECdwABAgMRBAUhMQYSQVEHYXETIjKBCBRCkaGxwQkjM1LwFWJy0QoWJDThJfEXGBkaJicoKSo1Njc4OTpDREVGR0hJSlNUVVZXWFlaY2RlZmdoaWpzdHV2d3h5eoKDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uLj5OXm5+jp6vLz9PX29/j5+v/aAAwDAQACEQMRAD8A/VOiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKK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uG+Z7GQ54w44/UCvE60/C2syeHPE+j6pE2x7O8imDemHGf0zQnZ3OvCVfYYinVXRp/ifufS1R0TU49a0aw1CLBiu4EnXHoyhh/Or1eqfv6aaugooooGFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABTXRXUqyhlPBBGQadRQBwHi/4B/D3x5uOt+EtMvJGGPMEIR/rlcV5LrP/BPX4R6o7PBY6hphPOLW7IA/Ag19M0VDhF7o4KuAwtd3qU0/kfJR/wCCavwzJJGq+IFHp9pT/wCIpP8Ah2p8NP8AoLeIP/AlP/iK+tqKn2UOxy/2Nl//AD5R8k/8O1Php/0FvEH/AIEp/wDEUf8ADtT4af8AQW8Qf+BKf/EV9bUUeyh2D+xsv/58o+Sf+Hanw0/6C3iD/wACU/8AiKP+Hanw0/6C3iD/AMCU/wDiK+tqKPZQ7B/Y2X/8+UfJP/DtT4af9BbxB/4Ep/8AEUf8O1Php/0FvEH/AIEp/wDEV9bUUeyh2D+xsv8A+fKPkn/h2p8NP+gt4g/8CU/+Io/4dqfDT/oLeIP/AAJT/wCIr62oo9lDsH9jZf8A8+UfJP8Aw7U+Gn/QW8Qf+BKf/EUf8O1Php/0FvEH/gSn/wARX1tRR7KHYP7Gy/8A58o+Sf8Ah2p8NP8AoLeIP/AlP/iKP+Hanw0/6C3iD/wJT/4ivraij2UOwf2Nl/8Az5R8k/8ADtT4af8AQW8Qf+BKf/EUj/8ABNL4ZshB1bxCARji5T/4ivreij2UOwf2Nl//AD5Rj+EPDUPg3wxpeh2081xbafbpbRy3DbpGVRgbiOpxWxRRWp68YqKUVsgooooKCiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigD//2Q==';
	var logoNesPro = 'data:image/jpeg;base64,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';
	doc.addImage (logoEmbrapa, 'JPEG', 45, 10, 80, 50);
	                                  //coluna, linha, largura, altura
	doc.addImage (logoNesPro, 'JPEG', 470, 10, 90, 50);
	doc.setFontSize(17);
    doc.text(240, 45, "Simulação Mybeef");
	doc.setFontSize(14);
	doc.text (260, 62, "(Intensificação)");
	doc.setFontSize(12);
	<?php if (((Yii::app()->user->id) != null)) { ?>
	doc.text (44, 75, "Nome da propriedade: <?php echo Propriedade::model()->findByPk(Yii::app()->session['id_prop']);?>");
	<?php } ?>
	doc.setFontSize(14);
	doc.text (2, 78, "____________________________________________________________________________");
	doc.setFontSize(11);
	doc.text (207, 105, "DESCRIÇÃO DO SISTEMA PRODUTIVO:");
	doc.text (450, 830, "<?php echo (date('d-m-Y / H:i:s'));?>");
	
	
	
	
	
	//doc.text(35, 55, "Tipo da Simulação: Intensificação");
	//doc.text (35, 60, "Data da Simulação: <?php echo (date('d-m-Y'));?>");
	//doc.setFontSize(12);
	//doc.text (35, 71, "INDICADORES DE ENTRADA");
	//doc.setFontSize(11);
	//doc.text(35, 78, "Desmame: cenário atual: <?php echo Yii::app()->session['desmameTEMP']?>%, cenário futuro: <?php echo Yii::app()->session['desmameFUT']?>%");
	//doc.text(35, 83, "Mortalidade:  cenário atual: <?php echo Yii::app()->session['mortalidadeTEMP']?>%, cenário futuro: <?php echo Yii::app()->session['mortalidadeFUT']?>%");
	//doc.text(35, 88, "Touros: cenário atual: <?php echo Yii::app()->session['tourosTEMP']?>%, cenário futuro: <?php echo Yii::app()->session['tourosTEMP']?>%");
	//doc.text(35, 93, "Idade de Venda: cenário atual: <?php echo Yii::app()->session['id_venda_1_3_anosTEMP']?> ano(s), cenário futuro: <?php echo Yii::app()->session['id_venda_1_3_anosFUT']?> ano(s)  ");
	//doc.text (35, 98, "Idade de Entoure: cenário atual: <?php echo Yii::app()->session['id_entoure_1_3_anosTEMP']?> ano(s), cenário futuro: <?php echo Yii::app()->session['id_entoure_1_3_anosFUT']?> ano(s)  ");
	
   
    //loop through each chart
    $('.myChart').each(function (index) {
	   var imageData = $(this).highcharts().createCanvas();
        // add image to doc, if you have lots of charts,
        // you will need to check if you have gone bigger 
        // than a page and do doc.addPage() before adding 
        // another image.
        
        /**
        * addImage(imagedata, type, x, y, width, height)
        */
        doc.addImage(imageData, 'JPEG', 50, (index * chartHeight) + 200, 480, 150);
    });

	
	$('.myChart2').each(function (index) {
	   var imageData = $(this).highcharts().createCanvas();
        // add image to doc, if you have lots of charts,
        // you will need to check if you have gone bigger 
        // than a page and do doc.addPage() before adding 
        // another image.
        
        /**
        * addImage(imagedata, type, x, y, width, height)
        */
        doc.addImage(imageData, 'JPEG', 70, (index * chartHeight) + 400, 430, 230);

	});

	doc.text (45, 650, "A seguir demonstra-se um exemplo para estimar o aumento da produção por área quando se pretende");
	doc.text (45, 660, "melhorar o desempenho do rebanho, especialmente em alguns indicadores zootécnicos.");
	doc.text (45, 670, "Se um produtor utiliza 1.000 hectares para a pecuária,  com carga animal de 315kg de peso vivo por hectare,"); 		doc.text (45, 680, "comercializando seus produtos em média por R$4,20 o quilograma de peso vivo e considerando"); 		
	doc.text (45, 690, "os indicadores taxa de natalidade(TN), idade de acasalamento(IAC), idade de abate(IAB),");
	doc.text (45, 700, "sair de um patamar 50% - 2 anos - 3 anos, para 65% - 2 anos - 2 anos, respectivamente,");
	doc.text (45, 710, "qual será a sua produção por hectare? Em quanto aumentará a receita bruta(faturamento) devido a esse");
	doc.text (45, 720, "aumento de produtividade?");
	doc.text (45, 730, "Considerando as tabelas do relatório 27x5, na tabela 3 associe a linha do cenário atual com o cenário futuro");
	doc.text (45, 740, "para achar o Incremento Padronizado(valor encontrado: 27,1kg, use 28). Na tabela 4 associe o incremento");
	doc.text (45, 750, "padronizado com a carga do cenário futuro para achar o Incremento Ajustado(valor encontrado: 19,6 use 20).");
	doc.text (45, 760, "Na tabela 5 associe o incremento ajustado com o preço médio vendido do kg vivo para achar o");
	doc.text (45, 770, "Benefício Bruto por Hectare(valor encontrado: R$90,00). Na tabela 6 associe o benefício bruto por hectare");
	doc.text (45, 780, "com a área da fazenda utilizada com a pecuária(valor encontrado: RS90.000,00)");
	doc.text (45, 790, "Este valor representa um valor máximo de despesas que pode investir em tecnologias e processos para que se");
	doc.text (45, 800, "torne viável economicamente aumentar a produtividade.");

	doc.text (450, 830, "<?php echo (date('d-m-Y / H:i:s'));?>");
    
    
    //save with name
    //doc.save('laudo.pdf');
	doc.output('dataurlnewwindow');
});


$('#pdf_simples').click(function () {
	var doc = new jsPDF();
    // chart height defined here so each chart can be palced
    // in a different position
    var chartHeight = 140;
     
    // All units are in the set measurement for the document
    // This can be changed to "pt" (points), "mm" (Default), "cm", "in"
    
	
	var columns = ["Lotação", "var. lotação", "Mortalidade", "var. mortalidade", "Idade desmame", "var. idade desmame"];
    var rows = [
    ["Área:", "<?php echo CPropertyValue::ensureFloat(Yii::app()->session['areaTEMP']);?>", "Rebanho:", "<?php echo CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhas_3_anosTEMP'])+CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhas_2_anosTEMP'])+CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhas_1_anoTEMP'])+CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhos_3_anosTEMP'])+CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhos_2_anosTEMP'])+CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhos_1_anoTEMP'])+CPropertyValue::ensureInteger(Yii::app()->session['f_area_terneiros_asTEMP'])+CPropertyValue::ensureInteger(Yii::app()->session['f_area_tourosTEMP'])+CPropertyValue::ensureInteger(Yii::app()->session['f_area_vacasTEMP']); ?>", 
"Idade abate:", "<?php echo CPropertyValue::ensureFloat(Yii::app()->session['id_venda_1_3_anosTEMP']);?>"],["Lotação:", "<?php echo CPropertyValue::ensureFloat(Yii::app()->session['lotacaoTEMP']);?>", "Mortalidade:", "<?php echo Yii::app()->session['mortalidadeTEMP']?>", "Taxa desmame:", "<?php echo CPropertyValue::ensureFloat(Yii::app()->session['desmameTEMP']);?>"],["", "Estoque Animal", "", "Produção Animal"],["Categoria", "Quantidade", "Peso Médio(kg)", "Quantidade", "Peso de Venda(kg)"],["<?php echo CategoriaSim::model()->findByPk(14)->descricao?>", "<?php echo CPropertyValue::ensureInteger($f_area_novilhos_3_anos); ?>", "<?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea1->pm); ?>", "<?php echo CPropertyValue::ensureInteger($f_vaca_novilhas_cab); ?>", "<?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea1->pv); ?>"],["<?php echo CategoriaSim::model()->findByPk(15)->descricao ?>", "<?php echo CPropertyValue::ensureInteger($f_area_novilhas_2_anos); ?>", "<?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea2->pm); ?>", "<?php echo CPropertyValue::ensureInteger($f_vaca_novilhas_cab); ?>", "<?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea2->pv); ?>"],["<?php echo CategoriaSim::model()->findByPk(16)->descricao ?>", "<?php echo CPropertyValue::ensureInteger($f_area_novilhas_1_ano); ?>", "<?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea3->pm); ?>", "<?php echo CPropertyValue::ensureInteger($f_vaca_novilhas_cab); ?>", "<?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea3->pv); ?>"],["<?php echo CategoriaSim::model()->findByPk(17)->descricao ?>", "<?php echo CPropertyValue::ensureInteger($f_area_novilhos_3_anos); ?>", "<?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea4->pm); ?>", "<?php echo CPropertyValue::ensureInteger($f_vaca_novilhos_cab); ?>", "<?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea4->pv); ?>"],["<?php echo CategoriaSim::model()->findByPk(18)->descricao ?>", "<?php echo CPropertyValue::ensureInteger($f_area_novilhas_2_anos); ?>", "<?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea5->pm); ?>", "<?php echo CPropertyValue::ensureInteger($f_vaca_novilhos_cab); ?>", "<?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea5->pv); ?>"],["<?php echo CategoriaSim::model()->findByPk(19)->descricao ?>", "<?php echo CPropertyValue::ensureInteger($f_area_novilhos_1_ano); ?>", "<?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea6->pm); ?>", "<?php echo CPropertyValue::ensureInteger($f_vaca_novilhos_cab); ?>", "<?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea6->pv); ?>"],["<?php echo CategoriaSim::model()->findByPk(20)->descricao ?>", "<?php echo CPropertyValue::ensureInteger($f_area_terneiros_as); ?>", "<?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea7->pm); ?>"],["<?php echo CategoriaSim::model()->findByPk(21)->descricao ?>", "<?php echo CPropertyValue::ensureInteger($f_area_touros); ?>", "<?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea8->pm); ?>", "<?php echo CPropertyValue::ensureInteger($f_vaca_touros_descarte); ?>", "<?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea8->pv); ?>"],["<?php echo CategoriaSim::model()->findByPk(13)->descricao ?>", "<?php echo CPropertyValue::ensureInteger($f_area_vacas); ?>", "<?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea9->pm); ?>", "<?php echo CPropertyValue::ensureInteger($f_vaca_vacas_descarte); ?>", "<?php echo CPropertyValue::ensureInteger($model_valor_cat_pm_pv_farea9->pv); ?>"],["Total", "<?php echo CPropertyValue::ensureInteger($f_area_novilhos_3_anos) + CPropertyValue::ensureInteger($f_area_novilhas_2_anos) + CPropertyValue::ensureInteger($f_area_novilhas_1_ano) + CPropertyValue::ensureInteger($f_area_novilhos_3_anos) + CPropertyValue::ensureInteger($f_area_novilhas_2_anos) + CPropertyValue::ensureInteger($f_area_novilhos_1_ano) + CPropertyValue::ensureInteger($f_area_terneiros_as) + CPropertyValue::ensureInteger($f_area_touros) + CPropertyValue::ensureInteger($f_area_vacas); ?>", "", "<?php echo CPropertyValue::ensureInteger($f_vaca_novilhas_cab) + CPropertyValue::ensureInteger($f_vaca_novilhos_cab) + CPropertyValue::ensureInteger($f_vaca_touros_descarte) + CPropertyValue::ensureInteger($f_vaca_vacas_descarte); ?>"]
];
	var doc = new jsPDF('p', 'pt');
    doc.autoTable(columns, rows, {
	theme: 'grid',
    styles: {fillColor: [255, 255, 255]},
    columnStyles: {
        id: {fillColor: 0}
    },
    margin: {top: 110},
});

	
	var logoEmbrapa = 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD//gA7Q1JFQVRPUjogZ2QtanBlZyB2MS4wICh1c2luZyBJSkcgSlBFRyB2NjIpLCBxdWFsaXR5ID0gOTAK/9sAQwADAgIDAgIDAwMDBAMDBAUIBQUEBAUKBwcGCAwKDAwLCgsLDQ4SEA0OEQ4LCxAWEBETFBUVFQwPFxgWFBgSFBUU/9sAQwEDBAQFBAUJBQUJFA0LDRQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQU/8AAEQgBGAJEAwEiAAIRAQMRAf/EAB8AAAEFAQEBAQEBAAAAAAAAAAABAgMEBQYHCAkKC//EALUQAAIBAwMCBAMFBQQEAAABfQECAwAEEQUSITFBBhNRYQcicRQygZGhCCNCscEVUtHwJDNicoIJChYXGBkaJSYnKCkqNDU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6g4SFhoeIiYqSk5SVlpeYmZqio6Slpqeoqaqys7S1tre4ubrCw8TFxsfIycrS09TV1tfY2drh4uPk5ebn6Onq8fLz9PX29/j5+v/EAB8BAAMBAQEBAQEBAQEAAAAAAAABAgMEBQYHCAkKC//EALURAAIBAgQEAwQHBQQEAAECdwABAgMRBAUhMQYSQVEHYXETIjKBCBRCkaGxwQkjM1LwFWJy0QoWJDThJfEXGBkaJicoKSo1Njc4OTpDREVGR0hJSlNUVVZXWFlaY2RlZmdoaWpzdHV2d3h5eoKDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uLj5OXm5+jp6vLz9PX29/j5+v/aAAwDAQACEQMRAD8A/VOiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKK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uG+Z7GQ54w44/UCvE60/C2syeHPE+j6pE2x7O8imDemHGf0zQnZ3OvCVfYYinVXRp/ifufS1R0TU49a0aw1CLBiu4EnXHoyhh/Or1eqfv6aaugooooGFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABTXRXUqyhlPBBGQadRQBwHi/4B/D3x5uOt+EtMvJGGPMEIR/rlcV5LrP/BPX4R6o7PBY6hphPOLW7IA/Ag19M0VDhF7o4KuAwtd3qU0/kfJR/wCCavwzJJGq+IFHp9pT/wCIpP8Ah2p8NP8AoLeIP/AlP/iK+tqKn2UOxy/2Nl//AD5R8k/8O1Php/0FvEH/AIEp/wDEUf8ADtT4af8AQW8Qf+BKf/EV9bUUeyh2D+xsv/58o+Sf+Hanw0/6C3iD/wACU/8AiKP+Hanw0/6C3iD/AMCU/wDiK+tqKPZQ7B/Y2X/8+UfJP/DtT4af9BbxB/4Ep/8AEUf8O1Php/0FvEH/AIEp/wDEV9bUUeyh2D+xsv8A+fKPkn/h2p8NP+gt4g/8CU/+Io/4dqfDT/oLeIP/AAJT/wCIr62oo9lDsH9jZf8A8+UfJP8Aw7U+Gn/QW8Qf+BKf/EUf8O1Php/0FvEH/gSn/wARX1tRR7KHYP7Gy/8A58o+Sf8Ah2p8NP8AoLeIP/AlP/iKP+Hanw0/6C3iD/wJT/4ivraij2UOwf2Nl/8Az5R8k/8ADtT4af8AQW8Qf+BKf/EUj/8ABNL4ZshB1bxCARji5T/4ivreij2UOwf2Nl//AD5Rj+EPDUPg3wxpeh2081xbafbpbRy3DbpGVRgbiOpxWxRRWp68YqKUVsgooooKCiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigD//2Q==';
	var logoNesPro = 'data:image/jpeg;base64,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';
	doc.addImage (logoEmbrapa, 'JPEG', 45, 10, 100, 50);
	                                  //coluna, linha, largura, altura
	doc.addImage (logoNesPro, 'JPEG', 470, 10, 80, 60);
	doc.setFontSize(17);
    doc.text(240, 45, "Simulação Mybeef");
	doc.setFontSize(14);
	doc.text (275, 62, "(Simples)");
	doc.setFontSize(12);
	<?php if (((Yii::app()->user->id) != null)) { ?>
	doc.text (44, 125, "Nome da propriedade: <?php echo Propriedade::model()->findByPk(Yii::app()->session['id_prop']);?>");
	<?php } ?>
	doc.setFontSize(14);
	doc.text (2, 78, "____________________________________________________________________________");
	doc.setFontSize(11);
	doc.text (207, 105, "DESCRIÇÃO DO SISTEMA PRODUTIVO:");
	doc.text (450, 830, "<?php echo (date('d-m-Y / H:i:s'));?>");
	
	
	
	
	
	//doc.text(35, 55, "Tipo da Simulação: Intensificação");
	//doc.text (35, 60, "Data da Simulação: <?php echo (date('d-m-Y'));?>");
	//doc.setFontSize(12);
	//doc.text (35, 71, "INDICADORES DE ENTRADA");
	//doc.setFontSize(11);
	//doc.text(35, 78, "Desmame: cenário atual: <?php echo Yii::app()->session['desmameTEMP']?>%, cenário futuro: <?php echo Yii::app()->session['desmameFUT']?>%");
	//doc.text(35, 83, "Mortalidade:  cenário atual: <?php echo Yii::app()->session['mortalidadeTEMP']?>%, cenário futuro: <?php echo Yii::app()->session['mortalidadeFUT']?>%");
	//doc.text(35, 88, "Touros: cenário atual: <?php echo Yii::app()->session['tourosTEMP']?>%, cenário futuro: <?php echo Yii::app()->session['tourosTEMP']?>%");
	//doc.text(35, 93, "Idade de Venda: cenário atual: <?php echo Yii::app()->session['id_venda_1_3_anosTEMP']?> ano(s), cenário futuro: <?php echo Yii::app()->session['id_venda_1_3_anosFUT']?> ano(s)  ");
	//doc.text (35, 98, "Idade de Entoure: cenário atual: <?php echo Yii::app()->session['id_entoure_1_3_anosTEMP']?> ano(s), cenário futuro: <?php echo Yii::app()->session['id_entoure_1_3_anosFUT']?> ano(s)  ");
	
   
    //loop through each chart
    $('.myChart').each(function (index) {
	   var imageData = $(this).highcharts().createCanvas();
        // add image to doc, if you have lots of charts,
        // you will need to check if you have gone bigger 
        // than a page and do doc.addPage() before adding 
        // another image.
        
        /**
        * addImage(imagedata, type, x, y, width, height)
        */
        doc.addImage(imageData, 'JPEG', 50, (index * chartHeight) + 450, 440, 300);
    });
	doc.addPage();
	$('.myChart2').each(function (index) {
	   var imageData = $(this).highcharts().createCanvas();
        // add image to doc, if you have lots of charts,
        // you will need to check if you have gone bigger 
        // than a page and do doc.addPage() before adding 
        // another image.
        
        /**
        * addImage(imagedata, type, x, y, width, height)
        */
        doc.addImage(imageData, 'JPEG', 70, (index * chartHeight) + 10, 480, 200);

	});

	$('.myChart1').each(function (index) {
	   var imageData = $(this).highcharts().createCanvas();
        // add image to doc, if you have lots of charts,
        // you will need to check if you have gone bigger 
        // than a page and do doc.addPage() before adding 
        // another image.
        
        /**
        * addImage(imagedata, type, x, y, width, height)
        */
        doc.addImage(imageData, 'JPEG', 75, (index * chartHeight) + 220, 200, 200);
    });
	$('.myChart4').each(function (index) {
	   var imageData = $(this).highcharts().createCanvas();
        // add image to doc, if you have lots of charts,
        // you will need to check if you have gone bigger 
        // than a page and do doc.addPage() before adding 
        // another image.
        
        /**
        * addImage(imagedata, type, x, y, width, height)
        */
        doc.addImage(imageData, 'JPEG', 275, (index * chartHeight) + 220, 200, 200);
    });
	$('.myChart5').each(function (index) {
	   var imageData = $(this).highcharts().createCanvas();
        // add image to doc, if you have lots of charts,
        // you will need to check if you have gone bigger 
        // than a page and do doc.addPage() before adding 
        // another image.
        
        /**
        * addImage(imagedata, type, x, y, width, height)
        */
        doc.addImage(imageData, 'JPEG', 75, (index * chartHeight) + 420, 200, 200);
    });
	$('.myChart6').each(function (index) {
	   var imageData = $(this).highcharts().createCanvas();
        // add image to doc, if you have lots of charts,
        // you will need to check if you have gone bigger 
        // than a page and do doc.addPage() before adding 
        // another image.
        
        /**
        * addImage(imagedata, type, x, y, width, height)
        */
        doc.addImage(imageData, 'JPEG', 275, (index * chartHeight) + 420, 200, 200);
    });
	$('.myChart7').each(function (index) {
	   var imageData = $(this).highcharts().createCanvas();
        // add image to doc, if you have lots of charts,
        // you will need to check if you have gone bigger 
        // than a page and do doc.addPage() before adding 
        // another image.
        
        /**
        * addImage(imagedata, type, x, y, width, height)
        */
        doc.addImage(imageData, 'JPEG', 75, (index * chartHeight) + 620, 200, 200);
    });
	$('.myChart8').each(function (index) {
	   var imageData = $(this).highcharts().createCanvas();
        // add image to doc, if you have lots of charts,
        // you will need to check if you have gone bigger 
        // than a page and do doc.addPage() before adding 
        // another image.
        
        /**
        * addImage(imagedata, type, x, y, width, height)
        */
        doc.addImage(imageData, 'JPEG', 275, (index * chartHeight) + 620, 200, 200);
    });

	doc.text (450, 830, "<?php echo (date('d-m-Y / H:i:s'));?>");
	

  pdfBase64 = doc.output('dataurlnewwindow');

  window.plugin.email.open({
  to: ['pam.saraiva@hotmail.com'],
  subject: 'New PDF!',
  body: 'Hi there, here is that new PDF you wanted!',
  isHTML: false,
  attachments: [pdfBase64]
});
	
	});


    $('#graficoVelocimetro').highcharts({
        chart: {
            type: 'gauge',
            plotBorderWidth: 1,
            plotBackgroundColor: {
                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                stops: [
                    [0, '#C6FFC6'],
                    [0.3, '#FFFFFF'],
                    [1, '#C6FFC6']
                ]
            },
            plotBackgroundImage: null,
            height: 200
        },
        title: {
            text: ''
        },
        pane: [{
            startAngle: -50,
            endAngle: 50,
            background: null,
            center: ['25%', '125%'],
            size: 300
        }, {
            startAngle: -50,
            endAngle: 50,
            background: null,
            center: ['75%', '125%'],
            size: 300
        }],
        tooltip: {
            enabled: false
        },
        yAxis: [{
            min: 0,
            max: <?php echo CPropertyValue::ensureInteger($mediaProdutividade)*2;?>,
            minorTickPosition: 'outside',
            tickPosition: 'outside',
            labels: {
                rotation: 'auto',
                distance: 20
            },
            plotBands: [{
                from: 0,
                to: <?php echo CPropertyValue::ensureInteger($mediaProdutividade)/2;?>,
                color: '#FF2316',
                innerRadius: '100%',
                outerRadius: '110%'
            },
                        {
                from: <?php echo CPropertyValue::ensureInteger($mediaProdutividade)/2;?>,
                to: <?php echo CPropertyValue::ensureInteger($mediaProdutividade);?>,
                color: '#FF8B16',
                innerRadius: '100%',
                outerRadius: '110%'
                        },
                {
                from: <?php echo CPropertyValue::ensureInteger($mediaProdutividade);?>,
                to: <?php echo (CPropertyValue::ensureInteger($mediaProdutividade)+(CPropertyValue::ensureInteger($mediaProdutividade)/2));?>,
                color: '#FFFF16',
                innerRadius: '100%',
                outerRadius: '110%'
                        },
						{
                from: <?php echo (CPropertyValue::ensureInteger($mediaProdutividade)+(CPropertyValue::ensureInteger($mediaProdutividade)/2));?>,
                to: <?php echo CPropertyValue::ensureInteger($mediaProdutividade)*2;?>,
                color: '#16FF16',
                innerRadius: '100%',
                outerRadius: '110%'
            },],
            pane: 0,
            title: {
                text: '<br/><span style="font-size:20px">Desfrute (Kg): <?php echo CPropertyValue::ensureInteger($pc_desfrute); ?>%</span>',
                y: -10
            }
        }, {
            min: 0,
            max: <?php echo CPropertyValue::ensureInteger($mediaDesfrute)*2;?>,
            minorTickPosition: 'outside',
            tickPosition: 'outside',
            labels: {
                rotation: 'auto',
                distance: 20
            },
            plotBands: [{
                from: 0,
                to: <?php echo CPropertyValue::ensureInteger($mediaDesfrute)/2;?>,
                color: '#FF2316',
                innerRadius: '100%',
                outerRadius: '110%'
            },
			

            {
                from: <?php echo CPropertyValue::ensureInteger($mediaDesfrute)/2;?>,
                to: <?php echo CPropertyValue::ensureInteger($mediaDesfrute);?>,
                color: '#FF8B16',
                innerRadius: '100%',
                outerRadius: '110%'
            },
			 {
                from: <?php echo CPropertyValue::ensureInteger($mediaDesfrute);?>,
                to: <?php echo (CPropertyValue::ensureInteger($mediaDesfrute)+(CPropertyValue::ensureInteger($mediaDesfrute)/2));?>,
                color: '#FFFF16',
                innerRadius: '100%',
                outerRadius: '110%'
            },
            {
                from: <?php echo (CPropertyValue::ensureInteger($mediaDesfrute)+(CPropertyValue::ensureInteger($mediaDesfrute)/2));?>,
                to: <?php echo CPropertyValue::ensureInteger($mediaDesfrute)*2;?>,
                color: '#16FF16',
                innerRadius: '100%',
                outerRadius: '110%'
            },],
            pane: 1,
            title: {
                text: '<br/><span style="font-size:20px">Produtividade: <?php echo CPropertyValue::ensureInteger($prod_area);?> Kg/ha*ano</span>',
                y: -10
            }
        }],
        plotOptions: {
            gauge: {
                dataLabels: {
                    enabled: false
                },
                dial: {
                    radius: '100%'
                }
            }
        },
        series: [{
            name: '<b>Desfrute (Kg %)</b>',
            data: [40],
            yAxis: 0
        }, {
            name: 'Produtividade',
            data: [40],
            yAxis: 1
        
	}]
    },
        function (chart) {
            setInterval(function () {
                if (chart.series) { // the chart may be destroyed
                    var left = chart.series[0].points[0],
                        right = chart.series[1].points[0],
                        leftVal,
                        rightVal,
                        inc = 1;
                    left.update(<?php echo CPropertyValue::ensureInteger($pc_desfrute); ?>, false);
                    right.update(<?php echo CPropertyValue::ensureInteger($prod_area); ?>, false);
                    chart.redraw();
                }
            }, 50);

        });
		
		$('#graficoPizza').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: '<b>Produção Animal (Porcentagem)</b>'
            },
            subtitle: {
            },
			credits: {
            enabled: false
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Quantidade',
                colorByPoint: true,
                data: [{
                    name: 'Novilhos',
                    y: <?php echo CPropertyValue::ensureFloat(Yii::app()->session['f_vaca_novilhos_cabTEMP']); ?>
                }, {
                    name: 'Novilhas',
                    y: <?php echo CPropertyValue::ensureFloat(Yii::app()->session['f_vaca_novilhas_cabTEMP']); ?>
                }, {
                    name: 'Vacas Descarte',
                    y: <?php echo CPropertyValue::ensureFloat(Yii::app()->session['f_vaca_vacas_descarteTEMP']); ?>
                }, {
                    name: 'Touros Descarte',
                    y: <?php echo CPropertyValue::ensureFloat(Yii::app()->session['f_vaca_touros_descarteTEMP']); ?>
                }],

		dataLabels: {
                enabled: true,
                rotation: 0,
                color: 'black',
                align: 'center',
                format: '{point.y:.1f}', // one decimal
                y: 5, // 10 pixels down from the top
                style: {
                    fontSize: '10px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
            }]
        });

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$(function () {
    $('#graficoBarras').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: '<b> Estoque Animal (Quantidade) </b>'
        },
        subtitle: {
            text: 'Fonte: Embrapa Pecuária Sul'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: 0,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Quantidade'
            }
        },
        legend: {
            enabled: false
        },
		credits: {
        enabled: false
        },
        tooltip: {
            pointFormat: 'Quantidade: <b>{point.y:.0f} </b>'
        },
        series: [{
            name: 'Population',
            data: [
	<?php if (CPropertyValue::ensureInteger(Yii::app()->session['f_area_vacasTEMP']) == 0) { ?>
	<?php } else { ?>
	['Vacas', <?php echo CPropertyValue::ensureInteger(Yii::app()->session['f_area_vacasTEMP']); ?>],
	<?php } ?>
	<?php if (CPropertyValue::ensureInteger(Yii::app()->session['f_area_terneiros_asTEMP']) == 0) { ?>
	<?php } else { ?>
	['Terneiros', <?php echo CPropertyValue::ensureInteger(Yii::app()->session['f_area_terneiros_asTEMP']); ?>],
	<?php } ?>		
	<?php if (CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhas_1_anoTEMP']) == 0) { ?>
	<?php } else { ?>
	['Novilhas <br> 1 ano', <?php echo CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhas_1_anoTEMP']); ?>],
	<?php } ?>	
	<?php if (CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhos_1_anoTEMP']) == 0) { ?>
	<?php } else { ?>
	['Novilhos <br> 1 ano', <?php echo CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhos_1_anoTEMP']); ?>],
	<?php } ?>	
	<?php if (CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhos_2_anosTEMP']) == 0) { ?>
	<?php } else { ?>
	['Novilhos <br> 2 anos', <?php echo CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhos_2_anosTEMP']); ?>],
	<?php } ?>	
	<?php if (CPropertyValue::ensureInteger(Yii::app()->session['f_area_tourosTEMP']) == 0) { ?>
	<?php } else { ?>
	['Touros', <?php echo CPropertyValue::ensureInteger(Yii::app()->session['f_area_tourosTEMP']); ?>],
	<?php } ?>	
	<?php if (CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhas_2_anosTEMP']) == 0) { ?>
	<?php } else { ?>
	['Novilhas <br> 2 anos', <?php echo CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhas_2_anosTEMP']); ?>],
	<?php } ?>	
	<?php if (CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhas_3_anosTEMP']) == 0) { ?>
	<?php } else { ?>
	['Novilhas <br> 3 anos', <?php echo CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhas_3_anosTEMP']);  ?>],
	<?php } ?>	
	<?php if (CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhos_3_anosTEMP']) == 0) { ?>
	<?php } else { ?>
	['Novilhos <br> 3 anos', <?php echo CPropertyValue::ensureInteger(Yii::app()->session['f_area_novilhos_3_anosTEMP']); ?>]
	<?php } ?>        
        ],

		dataLabels: {
                enabled: true,
                rotation: 0,
                color: 'black',
                align: 'center',
                format: '{point.y:.0f}', // one decimal
                y: 5, // 10 pixels down from the top
                style: {
                    fontSize: '10px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$(function () {
    $('#graficoBarrasDesfruteEProdutividade').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: '<b> Desfrute e Produtividade </b>'
        },
        subtitle: {
            text: 'Fonte: Embrapa Pecuária Sul'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: 0,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Quantidade'
            }
        },
        legend: {
            enabled: true
        },
		credits: {
        enabled: false
        },
        tooltip: {
            pointFormat: 'Quantidade: <b>{point.y:.0f} </b>'
        },
        series: [{
            name: 'Produtor',
            data: [
                ['Desfrute', <?php echo (($pc_desfrute-$mediaDesfrute)/$mediaDesfrute)*100; ?>],
                ['Produtividade', <?php echo ((($prod_area)-($mediaProdutividade))/($mediaProdutividade))*100; ?>],
                                
            ],
		dataLabels: {
                enabled: true,
                rotation: 0,
                color: 'black',
                align: 'center',
                format: '{point.y:.1f}', // one decimal
                y: 5, // 10 pixels down from the top
                style: {
                    fontSize: '10px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
		{
            name: 'Outros produtores',
            data: [
                ['Desfrute', <?php echo ($mediaDesfrute);  ?>],
                ['Produtividade', <?php echo ($mediaProdutividade); ?>],
                                
            ],
		dataLabels: {
                enabled: true,
                rotation: 0,
                color: 'black',
                align: 'center',
                format: '{point.y:.1f}', // one decimal
                y: 5, // 10 pixels down from the top
                style: {
                    fontSize: '10px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$(function () {
    $('#graficoBenchmarkDesfrute').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Desfrute'
        },
        xAxis: {           

            },
        yAxis: {
            title: {
                text: ''
            }
        },
	tooltip: {
            pointFormat: 'Quantidade: <b>{point.y:.1f} </b>'
        },
        series: [{
            name: 'Meus dados',
	    <?php if ((($pc_desfrute-$mediaDesfrute)/$mediaDesfrute)*100 < $mediaDesfrute) { ?>
	    color: "#FF3030",
	    <?php } else { ?>
	    color: "#32CD32",
	    <?php } ?>
            data: [ <?php echo (($pc_desfrute-$mediaDesfrute)/$mediaDesfrute)*100?>],
		dataLabels: {
                	enabled: true,
                	rotation: 0,
                	color: 'black',
                	align: 'center',
                	format: '{point.y:.1f}', // one decimal
                	y: 5, // 10 pixels down from the top
                	style: {
                    		fontSize: '10px',
                    		fontFamily: 'Verdana, sans-serif'
                	}
		}
            		
	}, {
	<!-- Produtores ---->
            name: 'Outros produtores',
	    color: "#DCDCDC",
            data: [<?php echo ($mediaDesfrute)?>],
      }]                    
    });
});
$(function () {
    $('#graficoBenchmarkProdutividade').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Produtividade'
        },
        xAxis: {           

            },
        yAxis: {
            title: {
                text: ''
            }
        },
	tooltip: {
            pointFormat: 'Quantidade: <b>{point.y:.1f} </b>'
        },
        series: [{
            name: 'Meus dados',
	    <?php if (((($prod_area)-($mediaProdutividade))/($mediaProdutividade))*100 < $mediaProdutividade) { ?>
	    color: "#FF3030",
	    <?php } else { ?>
	    color: "#32CD32",
	    <?php } ?>
	    data: [<?php echo ((($prod_area)-($mediaProdutividade))/($mediaProdutividade))*100?>],
		dataLabels: {
                	enabled: true,
                	rotation: 0,
                	color: 'black',
                	align: 'center',
                	format: '{point.y:.1f}', // one decimal
                	y: 5, // 10 pixels down from the top
                	style: {
                    		fontSize: '10px',
                    		fontFamily: 'Verdana, sans-serif'
                	}
		}
	}, {
	<!-- Produtores -->
            name: 'Outros produtores',
	    color: "#DCDCDC",	    
	    data: [<?php echo ($mediaProdutividade)?>],
      }]                    
    });
});
$(function () {
    $('#graficoBenchmarkArea').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Área'
        },
        xAxis: {           

            },
        yAxis: {
            title: {
                text: ''
            }
        },
	tooltip: {
            pointFormat: 'Quantidade: <b>{point.y:.1f} </b>'
        },
        series: [{
            name: 'Meus dados',
	    <?php if ((CPropertyValue::ensureFloat(((Yii::app()->session['areaTEMP']-($medianaArea))/($medianaArea)))*100) < $medianaArea) { ?>
	    color: "#FF3030",
	    <?php } else { ?>
	    color: "#32CD32",
	    <?php } ?>
	    data: [<?php echo (CPropertyValue::ensureFloat(((Yii::app()->session['areaTEMP']-($medianaArea))/($medianaArea)))*100)?>],
		dataLabels: {
                	enabled: true,
                	rotation: 0,
                	color: 'black',
                	align: 'center',
                	format: '{point.y:.1f}', // one decimal
                	y: 5, // 10 pixels down from the top
                	style: {
                    		fontSize: '10px',
                    		fontFamily: 'Verdana, sans-serif'
                	}
		}
	}, {
            name: 'Outros produtores',
	    color: "#DCDCDC",
	    data: [<?php echo ($medianaArea)?>],
      }]                    
    });
});
$(function () {
    $('#graficoBenchmarkMortalidade').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Mortalidade'
        },
        xAxis: {           

            },
        yAxis: {
            title: {
                text: ''
            }
        },
	tooltip: {
            pointFormat: 'Quantidade: <b>{point.y:.1f} </b>'
        },
        series: [{
            name: 'Meus dados',
	    <?php if ((CPropertyValue::ensureFloat(((Yii::app()->session['mortalidadeTEMP']-($medianaTaxa_mortalidade))/($medianaTaxa_mortalidade)))*100) < $medianaTaxa_mortalidade) { ?>
	    color: "#FF3030",
	    <?php } else { ?>
	    color: "#32CD32",
	    <?php } ?>
	    data: [<?php echo (CPropertyValue::ensureFloat(((Yii::app()->session['mortalidadeTEMP']-($medianaTaxa_mortalidade))/($medianaTaxa_mortalidade)))*100)?>],
		dataLabels: {
                	enabled: true,
                	rotation: 0,
                	color: 'black',
                	align: 'center',
                	format: '{point.y:.1f}', // one decimal
                	y: 5, // 10 pixels down from the top
                	style: {
                    		fontSize: '10px',
                    		fontFamily: 'Verdana, sans-serif'
                	}
		}
	}, {
            name: 'Outros produtores',
	    color: "#DCDCDC",
	    data: [<?php echo ($medianaTaxa_mortalidade)?>],
      }]                    
    });
});
$(function () {
    $('#graficoBenchmarkDesmame').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Desmame'
        },
        xAxis: {           

            },
        yAxis: {
            title: {
                text: ''
            }
        },
	tooltip: {
            pointFormat: 'Quantidade: <b>{point.y:.1f} </b>'
        },
        series: [{
            name: 'Meus dados',
	    <?php if ((CPropertyValue::ensureFloat(((Yii::app()->session['desmameTEMP']-($medianaTaxa_desmame))/($medianaTaxa_desmame)))*100) < $medianaTaxa_desmame) { ?>
	    color: "#FF3030",
	    <?php } else { ?>
	    color: "#32CD32",
	    <?php } ?>
	    data: [<?php echo (CPropertyValue::ensureFloat(((Yii::app()->session['desmameTEMP']-($medianaTaxa_desmame))/($medianaTaxa_desmame)))*100)?>],
		dataLabels: {
                	enabled: true,
                	rotation: 0,
                	color: 'black',
                	align: 'center',
                	format: '{point.y:.1f}', // one decimal
                	y: 5, // 10 pixels down from the top
                	style: {
                    		fontSize: '10px',
                    		fontFamily: 'Verdana, sans-serif'
                	}
		}
	}, {
            name: 'Outros produtores',
	    color: "#DCDCDC",
	    data: [<?php echo ($medianaTaxa_desmame)?>],
      }]                    
    });
});
$(function () {
    $('#graficoBenchmarkLotacao').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Lotação'
        },
        xAxis: {           

            },
        yAxis: {
            title: {
                text: ''
            }
        },
	tooltip: {
            pointFormat: 'Quantidade: <b>{point.y:.1f} </b>'
        },
        series: [{
            name: 'Meus dados',
	    <?php if ((CPropertyValue::ensureFloat(((Yii::app()->session['lotacaoTEMP']-($medianaLotacao))/($medianaLotacao)))*100) < $medianaLotacao) { ?>
	    color: "#FF3030",
	    <?php } else { ?>
	    color: "#32CD32",
	    <?php } ?>
 	    data: [<?php echo (CPropertyValue::ensureFloat(((Yii::app()->session['lotacaoTEMP']-($medianaLotacao))/($medianaLotacao)))*100)?>],
	    	
		dataLabels: {
                enabled: true,
                rotation: 0,
                color: 'black',
                align: 'center',
                format: '{point.y:.1f}', // one decimal
                y: 5, // 10 pixels down from the top
                style: {
                    fontSize: '10px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
	}, {
            name: 'Outros produtores',
	    color: "#DCDCDC",
	    data: [<?php echo ($medianaLotacao)?>], 
      }]                    
    });
});
</script>

