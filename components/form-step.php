<?php
$index = $args['index'] ?? 0;
$size = $args['size'] ?? -1;
$question = $args['question'] ?? "pregunta #".$index;
$answers = $args['answers'] ?? [];
$area = $args['area'] ?? "n/a";
$i = $args['i'] ?? 0;
$slug = $args['slug'] ?? '';
?>

<div class="m-form-step <?php echo $index==1?'is-active':'' ?>">
    <h3 class="m-area-title"><?php echo $area;?></h3>
    <fieldset>
        
    
        <legend class="m-question-title"><?php echo $index.".- ".$question ?></legend>
        
        <div class="m-answers">
            <?php foreach ($answers as $answer) : ?>
                <label>
                    <input class="js-answer" type="radio" name="response-<?php echo $i."-".$slug;?>" value="<?php echo esc_attr($answer['question_weight']); ?>"> 
                    <?php echo esc_html($answer['answer']); ?>
                </label>
            <?php endforeach; ?>
        </div>
    </fieldset>
    <div class="m-btns">
        <?php if ($index > 1):?>
        <button type="button" class="btn btn-prev">Anterior</button>
        <?php endif?>
        <?php if ($index < $size):?>
        <button type="button" class="btn btn-next">Siguiente</button>
        <?php elseif($index == $size):?>
        <button type="button" id="btn-finally" class="btn btn-finally">Finalizar</button>
        <?php endif;?>
    </div>
</div>