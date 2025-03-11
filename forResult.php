<?php
date_default_timezone_set('America/Mexico_City');
$meses = [
    "January" => "Enero", "February" => "Febrero", "March" => "Marzo",
    "April" => "Abril", "May" => "Mayo", "June" => "Junio",
    "July" => "Julio", "August" => "Agosto", "September" => "Septiembre",
    "October" => "Octubre", "November" => "Noviembre", "December" => "Diciembre"
];

$mes = date("F");
$mes_es = $meses[$mes];

?>
<div class="container-result">
	<header>
		<h1 class="m-resultados-title">Diagnostico empresarial</h1>
		<p>
			<?php echo "Formulario llenado el ".date("d").' de '.$mes_es." de ".date('Y');?>
		</p>
	</header>

	<?php
	foreach ($resultados as $resultado){
		$ponderacion_total += $resultado['ponderacion'];
	}
	
	foreach($tabla_final as $rangos){
		if ($ponderacion_total > $rangos['rango_inicial'] && $ponderacion_total <= $rangos['rango_final']): ?>
		<div class="flex">
			<div class="col-3">
				<h2>Resultado global: 2.26 de 5</h2>
				<p>
					<?php
					echo $rangos['resultado'];
					?>
				</p>
			</div>
			<div class="col-1">
				<img class="grafica" src="" alt="grafica">
			</div>
		</div>
		<?php endif;?>
		<?php
	}
	
	?>
	<table class="l-resultados">
  <?php foreach ($all_questions as $area => $questions): ?>
    <thead>
      <tr>
        <th colspan="2"><?php echo $questions[0]['area']; ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($questions as $index => $question): ?>
        <?php foreach ($question['answers'] as $answer): ?>
          <?php if ($answer['question_weight'] == $respuestas[$area][$index]): ?>
            <tr class="m-resultado">
              <td class="m-resultado__num"><strong><?php echo $index + 1; ?></strong></td>
              <td class="m-resultado__preguntas"><?php echo $answer['consecuencia']; ?></td>
            </tr>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endforeach; ?>
    </tbody>
  <?php endforeach; ?>
</table>

</div>