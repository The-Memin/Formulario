<?php
/**
 * Template Name: inicio
 *
 */
?>

<?php get_header() ?>


<div class="m-container-inicio">
    <a href="<?php echo home_url(); ?>?url-back=<?php echo urlencode(get_permalink()); ?>" class="btn btn--yellow">Ir al formulario</a>
</div>


<?php get_footer() ?>