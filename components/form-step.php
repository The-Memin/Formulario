<?php
$index = $args['index'] ?? 0;
$size = $args['size'] ?? -1;
$question = $args['question'] ?? "pregunta #".$index;
$answers = $args['answers'] ?? [];
?>


<div class="form-step <?php echo $index == 0?'is-active':'' ?>">
    <label for="nombre"><?php echo esc_html($question); ?></label>
    <div class="checks">
        
        <?php foreach ($answers as $answer) : ?>
            <div class="check-answer">
                <input type="radio" id="answer_<?php echo esc_attr($answer['answer']); ?>" name="nombre_del_campo" value="<?php echo esc_attr($answer['answer']); ?>" 
                <?php checked($selected_answer, $answer['answer']); ?>>
                <label for="answer_<?php echo esc_attr($answer['answer']); ?>">
                    <?php echo esc_html($answer['answer']); ?>
                </label>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if($index == 0):?>
    <div class="btns">
        <button type="button" class="btn btn-next">Siguiente</button>
    </div>
    <?php endif;?>
    <?php if($index > 0 && $index < $size):?>
    <div class="btns">
        <button type="button" class="btn btn-prev">Atrás</button>
        <button type="button" class="btn btn-next">Siguiente</button>
    </div>
    <?php endif;?>
    <?php if($index == $size):?>
        <div class="btns">
            <button type="button" class="btn btn-prev">Atrás</button>
            <button type="submit" class="btn btn-submit">Enviar</button>
        </div>
    <?php endif;?>
</div>


