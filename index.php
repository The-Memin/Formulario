<?php
/*
Displays single posts
*/
require_once 'data/form-questions.php';
require_once 'backend/post-formulario.php';
$img_url = get_template_directory_uri() . '/assets/images/logo-dip-insait.png';
?>
<?php get_header() ?>

<div class="l-container">
	<?php if (empty($mensaje) && !$form_true) : ?>
		<img class="m-logo" src="<?php echo esc_url(get_field('logo','option'));?>" alt="logo-dip-insait">
		<p class="m-welcome">Bienvenido. Empecemos con tu diagnóstico empresarial</p>
		<form class="m-form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="POST">
			<legend>¿La empresa es familiar?</legend>
			<div class="m-flex-col my-2">
				<label>
					<input class="" type="radio" name="familiar" value="yes" required> 
					Si
				</label>
				<label>
					<input class="" type="radio" name="familiar" value="no" required> 
					No
				</label>
			</div>
			<button class="btn btn-submit" type="submit" name="familiar-send">Enviar</button>
		</form>
	<?php endif;?>
	<?php if ($form_true) : ?>
	<img class="m-logo" src="<?php echo esc_url(get_field('logo','option'));?>" alt="logo-dip-insait">

	<div class="progress-container">
		<div class="m-precentajes">
			<span id="js-percent">0%</span>
			<span>100%</span>
		</div>
    	<div class="progress-bar"></div>
	</div>
	
	<form class="m-form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="POST">
		
		<?php 
		    $index = 0; 
			$fam_length = count($all_questions['familiar']);
			$total_length = $is_familiar ? $total_length: $total_length - $fam_length;
			foreach ($all_questions as $area => $questions) {
				// Si el área no es "familiar" o si es "familiar" y $is_familiar es verdadero
				if ($area != 'familiar' || ($area == 'familiar' && $is_familiar)) {
					foreach ($questions as $i => $question) {
						$args = [
							'area' => $question['area'],
							'index' => ++$index, // Incrementa $index antes de asignarlo
							'i' => $i,
							'question' => $question['question'],
							'answers' => $question['answers'],
							'size' => $total_length,
						];
						get_template_part('components/form', 'step', $args);
					}
				}
			}
			
		?>

		<fieldset id="email-section" class="m-email">
			<legend>Gracias por tu interés, hemos llegado al final del cuestionario. Por favor, ingresa los siguientes datos para que te enviemos tu reporte con los resultados.</legend>
			<input type="text" name="nombre" id="" placeholder="Nombre" required>
			<input type="tel" name="phone" id="" placeholder="Telefono" required>
			<input type="email" name="correo" placeholder="Tu correo" required>
			<button class="btn btn-submit" type="submit" name="enviar">Enviar</button>
    	</fieldset>
	
	</form>
	<?php endif; ?>

	<?php if (!empty($mensaje)) : ?>
    <div class="l-mensaje">
        <h3><?php echo $mensaje;?></h3>
		<button class="btn btn-return">Volver al formulario</button>
    </div>
	<?php
	include 'forResult.php';
	?>
	<?php endif; ?>
</div>



<?php get_footer() ?>