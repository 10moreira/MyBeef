<?php 
/* @var $this SimulacaoController */
/* @var $model Simulacao */
?>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'simulacao-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => true,
        //'enableClientValidation' => true,
    ));
    ?>

<link rel="stylesheet" type="text/css" href="/mybeef2/themes/hebo/css/LucianoStyle.css" />

<?php $eixoX=""; ?> <!-- Variável que da nome ao gráfico cartesiano, de acordo com o índice selecionado! -->

<div class="titulos">Sensibilidade</div>

<table class="table table-striped table-bordered table-hover">
	     <th></th>
	     <th></th>
	     <th><center><label style="font-size: 18px">Minimo</label></center></th>
	     <th><center><label style="font-size: 18px">Máximo</label></center></th>
    <tr>
        <th>

            <?php 
             	echo CHtml::checkBox('Desmame', 'btn1', array('id'=>'Desmame', 'uncheckValue'=>null,'submit'=> array('/simulacao/sensibilidade', 				'grafico' => 0, 'label' => 1, 'novo' => $novo)));?>

	    <th><center><label style="font-size: 18px">Desmame(%)</label></center></th>	
			
	<?php if($label = 1){ ?>			
			
		  <script> $( "#Desmame" ).prop("checked", true);</script>	
		  <th><?php echo $form->textField($model_valor_outro41, '[41]valor', array('style' => 'width:50%;')); ?></th>
		  <th><?php echo $form->textField($model_valor_outro40, '[40]valor', array('style' => 'width:50%;')); ?></th>             

            <?php
		} else{ ?>
			
		    <script> $( "#Desmame" ).prop("checked", false);</script> 
		    <th><?php echo $form->textField($model_valor_outro41, '[41]valor', array('style' => 'width:50%;', 'readonly'=> true)); ?></th>
		    <th><?php echo $form->textField($model_valor_outro40, '[40]valor', array('style' => 'width:50%;', 'readonly'=> true)); ?></th> 
		    <?php
            }           
            ?>
	
        </th>		

    <tr>
        <th>    
	 
            <?php
            echo CHtml::checkBox('btn2', '', array('id'=>'IdadeAbate', 'uncheckValue'=>null,'submit'=> array('/simulacao/sensibilidade', 'grafico' 			=> 0, 'label' => 2, 'novo' => $novo))); ?>
	    <th><center><label style="font-size: 18px">Idade de Abate(anos)</label></center></th>

 	   <?php if($label = 2){ ?>
		
		    <script> $( "#IdadeAbate" ).prop( "checked", true );</script>
		    <th><?php echo $form->textField($model_valor_outro43, '[43]valor', array('style' => 'width:50%;')); ?></th>
		    <th><?php echo $form->textField($model_valor_outro42, '[42]valor', array('style' => 'width:50%;')); ?></th>

	    <?php 
	  }  else{ ?>
		
		    <script> $( "#IdadeAbate" ).prop( "checked", false );</script>
		    <th><?php echo $form->textField($model_valor_outro43, '[43]valor', array('style' => 'width:50%;', 'readonly'=> true)); ?></th>
		    <th><?php echo $form->textField($model_valor_outro43, '[42]valor', array('style' => 'width:50%;', 'readonly'=> true)); ?></th>
		    <?php
            }  
            ?>
        </th>
    </tr>
    <tr>
        <th>
	  
            <?php
            echo CHtml::checkBox('btn3', '', array('id'=>'IdadeAcasalamento', 'uncheckValue'=>null,'submit'=> array('/simulacao/sensibilidade', 		'grafico' => 0, 'label' => 3, 'novo' => $novo))); ?>
	    <th><center><label style="font-size: 18px">Idade de Acasalamento(anos)</label></center></th>

	  <?php if($label = 3){ ?>

		    <script> $( "#IdadeAcasalamento" ).prop( "checked", true);</script>           
		    <th><?php echo $form->textField($model_valor_outro45, '[45]valor', array('style' => 'width:50%;')); ?></th>
		    <th><?php echo $form->textField($model_valor_outro44, '[44]valor', array('style' => 'width:50%;')); ?></th>	    

            <?php } else{ ?>
			
		    <script> $( "#IdadeAcasalamento" ).prop( "checked", false);</script>
		    <th><?php echo $form->textField($model_valor_outro45, '[45]valor', array('style' => 'width:50%;', 'readonly'=> true)); ?></th>
		    <th><?php echo $form->textField($model_valor_outro44, '[44]valor', array('style' => 'width:50%;', 'readonly'=> true)); ?>       		<th>	            
	    <?php
            }  
            ?>
        </th>

    </tr>
    <tr>
        <th>
	
            <?php
           	 echo CHtml::checkBox('btn4', '', array('id'=>'Mortalidade', 'uncheckValue'=>null, 'submit'=> array('/simulacao/sensibilidade', 			'grafico' => 0, 'label' => 4, 'novo' => $novo))); ?>

	    <th><center><label style="font-size: 18px">Mortalidade(%)</label></center></th>

	    <?php if($label = 4){ ?>

		    <script> $( "#Mortalidade" ).prop( "checked", true );</script>
		    <th><?php echo $form->textField($model_valor_outro47, '[47]valor', array('style' => 'width:50%;')); ?></th>
		    <th><?php echo $form->textField($model_valor_outro46, '[46]valor', array('style' => 'width:50%;')); ?></th>

	    <?php } else{ ?>
		
		    <script> $( "#Mortalidade" ).prop( "checked", false );</script>
		    <th><?php echo $form->textField($model_valor_outro47, '[47]valor', array('style' => 'width:50%;', 'readonly'=> true)); ?></th>
		    <th><?php echo $form->textField($model_valor_outro46, '[46]valor', array('style' => 'width:50%;', 'readonly'=> true)); ?></th>
		    <?php
            }  
            ?>
        </th>


<?php if(($erro == 1)||($erro == 4)) { ?> <!-- $erro = 1 diz que houveram erros na entrada do desmame -->
                                          <!-- $erro = 4 diz que houveram erros na entrada da mortalidade -->
	<script>
	alert("Por favor digite apenas numéros positivos e menores que 100!")
	</script>
<?php } ?>
<?php if(($erro == 2)||($erro == 3)) { ?><!-- $erro = 2 diz que houveram erros na entrada da idade de abate -->
                                         <!-- $erro = 3 diz que houveram erros na entrada da idade de acasalamento -->
	<script>
	alert("Por favor digite apenas idades entre 1 e 3 anos!")
	</script>
<?php } ?>

<!-- ********* BOTÃO QUE FAZ A GERAÇÃO DO GRÁFICO CARTESIANO *********** -->
<table class="table table-striped table-bordered table-hover" align="center">
    <tr>
        <td>
            <div class="row buttons" align="center">
                <?php 
                echo CHtml::button('Voltar', array('class'=>'btn-success1', 
                'submit' => array('simulacao/simular', 'tipo' => 'sensibilidade', 'novo' => $novo, 'saida' => 0)));
                ?>
            </div>
        </td>
        <td>
            <div class="row buttons" align="center">
                <?php 
                echo CHtml::button('Gerar Gráfico', array('class'=>'btn-success1', 
                'submit' => array('simulacao/sensibilidade', 'grafico' => 1, 'label' => $label, 'novo' => $novo)));
                ?>
            </div>
        </td>
        <td>
            <div class="row buttons" align="center">
                <?php 
                echo CHtml::button('Calibragem', array('class'=>'btn-success1', 
                'title' => 'Clique aqui para alterar o preço médio, o preço de venda e as taxas de descarte e de touros.',
                'submit' => array('simulacao/calibragem', 'tipo' => 's', 'novo' => $novo)));
                ?>
            </div>
        </td>
    </tr>
</table>
<!-- ******************************************************************* -->

<!-- CASO $grafico seja 1, então o gráfico cartesiano de saída é exibido -->
<?php if($grafico == 1){ ?> 
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<div id="container3" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<?php $grafico = 0;

 } ?>
<!-- ******************************************************************** -->

<!-- ********************* As inputs da tela de simulação apenas para exibição ********************************** -->
<div class="titulos">Índices de entrada da simulação (apenas para visualização)</div>
<table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th class='titulos'><span style="line-height:normal;font-size: 18px">Taxa de Desmame (%)</span></th>
                <th class='titulos'><span style="line-height:normal;font-size: 18px">Idade de Abate (anos)</span></th>
                <th class='titulos'><span style="line-height:normal;font-size: 18px">Idade de Acasalamento (anos)</span></th>
            </tr>
        </thead>
        <tbody>
            <tr> 
                <td><?php echo $form->textField($model_valor_outro2, '[2]valor', array('style' => 'width:65%;text-align:center;background-color:#CCCCCC','readonly'=> true)); ?></td>
                <td><?php echo $form->textField($model_valor_outro5, '[5]valor', array('style' => 'width:65%;text-align:center;background-color:#CCCCCC','readonly'=> true)); ?></td>
                <td><?php echo $form->textField($model_valor_outro6, '[6]valor', array('style' => 'width:65%;text-align:center;background-color:#CCCCCC','readonly'=> true)); ?></td>
            </tr>
        </tbody>
</table>
<!-- ************************************************************************************************************ -->

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>



<!-- Função Jquery que cria o gráfico cartesiano -->
<script>
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Gráfico de produtividade <?php if($eixoX != ""){ echo "em função da $eixoX";} ?>'
        },
        subtitle: {
            text: 'Fonte: CCPSUL'
        },
        xAxis: {
            title: {
                text: '<span style="font-size:20px"><?php echo $eixoX; ?></span>'
            },
            categories: [
        '    <span style="font-size:17px"><?php echo number_format((float)$entrada[0], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[1], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[2], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[3], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[4], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[5], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[6], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[7], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[8], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[9], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[10], 2, '.', ''); ?></span>'
             ]
            },

        yAxis: {
            title: {
                text: 'Produtividade (KG PV/ ha)'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },

    
       <?php if(($label != 2)&&($label != 3)) {?> //CASO SEJA MORTALIDADE OU DESMAME O ÍNDICE DE ENTRADA, EXIBE 10 VALORES NO GRAFICO//
        series: [{
           name: 'Produtividade',
     data: [
            <?php echo number_format((float)$resultado[0], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[1], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[2], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[3], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[4], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[5], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[6], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[7], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[8], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[9], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[10], 2, '.', '');?>,
     
            ]
        }]
        <?php } 
       ?> 
     });
});


$(function(){
    $('#container1').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Gráfico de produtividade <?php if($eixoX != ""){ echo "em função da $eixoX";} ?>'
        },
        subtitle: {
            text: 'Fonte: CCPSUL'
        },
        xAxis: {
            title: {
                text: '<span style="font-size:20px"><?php echo $eixoX; ?></span>'
            },
            categories: [
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[0], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[1], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[2], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[3], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[4], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[5], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[6], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[7], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[8], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[9], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[10], 2, '.', ''); ?></span>'
                  ]
            },

        yAxis: {    
            title: {
                text: 'Produtividade (KG PV/ ha)'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },

    
    <?php    
            if(((abs($model_valor_outro43->valor - $model_valor_outro42->valor)) == 2)||
               ((abs($model_valor_outro42->valor - $model_valor_outro43->valor)) == 2)||
               ((abs($model_valor_outro45->valor - $model_valor_outro44->valor)) == 2)||
               ((abs($model_valor_outro44->valor - $model_valor_outro45->valor)) == 2)){?> // CASO SEJA IDADE DE ABATE OU ACASALAMENTO E 
                    series: [{                                                             // A DIFERENÇA ENTRE IDADE A MINIMA E MÁXIMA SEJA IGUAL A 2
                    name: 'Produtividade',                                                 // EXIBIR APENAS 3 VALORES NO GRAFICO
                    data: [
                    <?php echo number_format((float)$resultado[0], 2, '.', ''); ?>,
                    <?php echo number_format((float)$resultado[1], 2, '.', ''); ?>,
                    <?php echo number_format((float)$resultado[2], 2, '.', ''); ?>,
                    ]
                    }]

                <?php }
                        ?>
    });
});

$(function(){
    $('#container2').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Gráfico de produtividade <?php if($eixoX != ""){ echo "em função da $eixoX";} ?>'
        },
        subtitle: {
            text: 'Fonte: CCPSUL'
        },
        xAxis: {
            title: {
                text: '<span style="font-size:20px"><?php echo $eixoX; ?></span>'
            },
            categories: [
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[0], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[1], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[2], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[3], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[4], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[5], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[6], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[7], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[8], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[9], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[10], 2, '.', ''); ?></span>'
            ]
            },

        yAxis: {
            title: {
                text: 'Produtividade (KG PV/ ha)'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },

    
       <?php if(($label != 2)&&($label != 3)) {?> //CASO SEJA MORTALIDADE OU DESMAME O ÍNDICE DE ENTRADA, EXIBE 10 VALORES NO GRAFICO//
        series: [{
           name: 'Produtividade',
     data: [
            <?php echo number_format((float)$resultado[0], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[1], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[2], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[3], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[4], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[5], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[6], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[7], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[8], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[9], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[10],2, '.', '');?>,
     
            ]
        }]
        <?php } 

        else { 
            if(((abs($model_valor_outro43->valor - $model_valor_outro42->valor)) == 2)||
               ((abs($model_valor_outro42->valor - $model_valor_outro43->valor)) == 2)||
               ((abs($model_valor_outro45->valor - $model_valor_outro44->valor)) == 2)||
               ((abs($model_valor_outro44->valor - $model_valor_outro45->valor)) == 2)){?> // CASO SEJA IDADE DE ABATE OU ACASALAMENTO E 
                    series: [{                                                             // A DIFERENÇA ENTRE IDADE A MINIMA E MÁXIMA SEJA IGUAL A 2
                    name: 'Produtividade',                                                 // EXIBIR APENAS 3 VALORES NO GRAFICO
                    data: [
                    <?php echo number_format((float)$resultado[0], 2, '.', ''); ?>,
                    <?php echo number_format((float)$resultado[1], 2, '.', ''); ?>,
                    <?php echo number_format((float)$resultado[2], 2, '.', ''); ?>,
                    ]
                    }]

                <?php }
                else { 
                     if(((abs($model_valor_outro43->valor - $model_valor_outro42->valor)) == 1)||
                        ((abs($model_valor_outro42->valor - $model_valor_outro43->valor)) == 1)||
                        ((abs($model_valor_outro45->valor - $model_valor_outro44->valor)) == 1)||
                        ((abs($model_valor_outro44->valor - $model_valor_outro45->valor)) == 1)){?> // CASO SEJA IDADE DE ABATE OU ACASALAMENTO E 
                            series: [{                                                              // A DIFERENÇA ENTRE A IDADE MINIMA E MÁXIMA SEJA IGUAL A 1
                            name: 'Produtividade',                                                  // EXIBIR APENAS 2 VALORES NO GRAFICO
                            data: [
                            <?php echo number_format((float)$resultado[0], 2, '.', ''); ?>,
                            <?php echo number_format((float)$resultado[1], 2, '.', ''); ?>,
                            ]
                            }]
                    <?php }
                    else{ ?> // CASO SEJA IDADE DE ABATE OU ACASALAMENTO E A IDADE MÍNIMA E MÁXIMA SEJAM IGUAIS, EXIBIR APENAS 1 VALOR NO GRAFICO
                            series: [{
                            name: 'Produtividade',
                            data: [
                <?php echo number_format((float)$resultado[0], 2, '.', ''); ?>,
                            ]
                            }]
                    <?php }}} ?>
    });
});



     <?php if(($label != 2)&&($label != 3)) {?> //CASO SEJA MORTALIDADE OU DESMAME O ÍNDICE DE ENTRADA, EXIBE 10 VALORES NO GRAFICO//
        series: [{
           name: 'Produtividade',
     data: [
	        <?php echo number_format((float)$resultado[0], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[1], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[2], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[3], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[4], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[5], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[6], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[7], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[8], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[9], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[10],2, '.', '');?>,
	 
            ]
        }]
        <?php } 

        else { 
            if(((abs($model_valor_outro43->valor - $model_valor_outro42->valor)) == 2)||
               ((abs($model_valor_outro42->valor - $model_valor_outro43->valor)) == 2)||
               ((abs($model_valor_outro45->valor - $model_valor_outro44->valor)) == 2)||
               ((abs($model_valor_outro44->valor - $model_valor_outro45->valor)) == 2)){?> // CASO SEJA IDADE DE ABATE OU ACASALAMENTO E 
                    series: [{                                                             // A DIFERENÇA ENTRE IDADE A MINIMA E MÁXIMA SEJA IGUAL A 2
                    name: 'Produtividade',                                                 // EXIBIR APENAS 3 VALORES NO GRAFICO
                    data: [
		    <?php echo number_format((float)$resultado[0], 2, '.', ''); ?>,
                    <?php echo number_format((float)$resultado[1], 2, '.', ''); ?>,
                    <?php echo number_format((float)$resultado[2], 2, '.', ''); ?>,
                    ]
                    }]

                <?php }
                else { 
                     if(((abs($model_valor_outro43->valor - $model_valor_outro42->valor)) == 1)||
                        ((abs($model_valor_outro42->valor - $model_valor_outro43->valor)) == 1)||
                        ((abs($model_valor_outro45->valor - $model_valor_outro44->valor)) == 1)||
                        ((abs($model_valor_outro44->valor - $model_valor_outro45->valor)) == 1)){?> // CASO SEJA IDADE DE ABATE OU ACASALAMENTO E 
                            series: [{                                                              // A DIFERENÇA ENTRE A IDADE MINIMA E MÁXIMA SEJA IGUAL A 1
                            name: 'Produtividade',                                                  // EXIBIR APENAS 2 VALORES NO GRAFICO
                            data: [
			    <?php echo number_format((float)$resultado[0], 2, '.', ''); ?>,
                            <?php echo number_format((float)$resultado[1], 2, '.', ''); ?>,
                            ]
                            }]
                    <?php }
                    else{ ?> // CASO SEJA IDADE DE ABATE OU ACASALAMENTO E A IDADE MÍNIMA E MÁXIMA SEJAM IGUAIS, EXIBIR APENAS 1 VALOR NO GRAFICO
                            series: [{
                            name: 'Produtividade',
                            data: [
				<?php echo number_format((float)$resultado[0], 2, '.', ''); ?>,
                            ]
                            }]
                    <?php }}} ?>
    });
});


$(function(){
    $('#container3').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Gráfico de produtividade <?php if($eixoX != ""){ echo "em função da $eixoX";} ?>'
        },
        subtitle: {
            text: 'Fonte: CCPSUL'
        },
        xAxis: {
            title: {
                text: '<span style="font-size:20px"><?php echo $eixoX; ?></span>'
            },
            categories: [
	        '<span style="font-size:17px"><?php echo number_format((float)$entrada[0], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[1], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[2], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[3], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[4], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[5], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[6], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[7], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[8], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[9], 2, '.', ''); ?></span>',
            '<span style="font-size:17px"><?php echo number_format((float)$entrada[10], 2, '.', ''); ?></span>'
            ]
            },

        yAxis: {
            title: {
                text: 'Produtividade (KG PV/ ha)'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },

	
       <?php if(($label != 2)&&($label != 3)) {?> //CASO SEJA MORTALIDADE OU DESMAME O ÍNDICE DE ENTRADA, EXIBE 10 VALORES NO GRAFICO//
        series: [{
           name: 'Produtividade',
     data: [
	        <?php echo number_format((float)$resultado[0], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[1], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[2], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[3], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[4], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[5], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[6], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[7], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[8], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[9], 2, '.', '');?>,
            <?php echo number_format((float)$resultado[10],2, '.', '');?>,
	 
            ]
        }]
        <?php } 

        else { 
            if(((abs($model_valor_outro43->valor - $model_valor_outro42->valor)) == 2)||
               ((abs($model_valor_outro42->valor - $model_valor_outro43->valor)) == 2)||
               ((abs($model_valor_outro45->valor - $model_valor_outro44->valor)) == 2)||
               ((abs($model_valor_outro44->valor - $model_valor_outro45->valor)) == 2)){?> // CASO SEJA IDADE DE ABATE OU ACASALAMENTO E 
                    series: [{                                                             // A DIFERENÇA ENTRE IDADE A MINIMA E MÁXIMA SEJA IGUAL A 2
                    name: 'Produtividade',                                                 // EXIBIR APENAS 3 VALORES NO GRAFICO
                    data: [
		    <?php echo number_format((float)$resultado[0], 2, '.', ''); ?>,
                    <?php echo number_format((float)$resultado[1], 2, '.', ''); ?>,
                    <?php echo number_format((float)$resultado[2], 2, '.', ''); ?>,
                    ]
                    }]

                <?php }
                else { 
                     if(((abs($model_valor_outro43->valor - $model_valor_outro42->valor)) == 1)||
                        ((abs($model_valor_outro42->valor - $model_valor_outro43->valor)) == 1)||
                        ((abs($model_valor_outro45->valor - $model_valor_outro44->valor)) == 1)||
                        ((abs($model_valor_outro44->valor - $model_valor_outro45->valor)) == 1)){?> // CASO SEJA IDADE DE ABATE OU ACASALAMENTO E 
                            series: [{                                                              // A DIFERENÇA ENTRE A IDADE MINIMA E MÁXIMA SEJA IGUAL A 1
                            name: 'Produtividade',                                                  // EXIBIR APENAS 2 VALORES NO GRAFICO
                            data: [
			    <?php echo number_format((float)$resultado[0], 2, '.', ''); ?>,
                            <?php echo number_format((float)$resultado[1], 2, '.', ''); ?>,
                            ]
                            }]
                    <?php }
                    else{ ?> // CASO SEJA IDADE DE ABATE OU ACASALAMENTO E A IDADE MÍNIMA E MÁXIMA SEJAM IGUAIS, EXIBIR APENAS 1 VALOR NO GRAFICO
                            series: [{
                            name: 'Produtividade',
                            data: [
				<?php echo number_format((float)$resultado[0], 2, '.', ''); ?>,
                            ]
                            }]
                    <?php }}} ?>
    });
});

</script>


<!-- ********************************************************** -->

<?php $this->endWidget(); ?>
