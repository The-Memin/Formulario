<?php
/*
Displays single posts
*/
require 'data/form-questions.php';
?>
<?php get_header() ?>

	<div class="form-container">
        <form class="form-container__form" id="multiStepForm">
            <?php
			$size_questions = count($questions);
			foreach($questions as $index => $question){
				$args = array(
					'index' => $index,
					'size' => $size_questions-1, 
					'question' => $question['question'],
                    'answers' => $question['answers']
				);
				get_template_part('components/form', 'step', $args);
			}
			?>
        </form>
    </div>


<?php get_footer() ?>