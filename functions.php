<?php

//add actions
/////////////
add_action( 'wp_enqueue_scripts', 'wpt_theme_styles' );//add to the header the related styles files
add_action( 'wp_enqueue_scripts', 'wpt_theme_js' );//add to the very bottom of the html the related code files
add_action( 'after_setup_theme', 'woocommerce_support' );//add woocommerce support
add_action( 'template_redirect', 'remove_woocommerce_styles_scripts', 999 );// remove all scripts from none woocommerce pages
add_action( 'wp_head', 'gtm',20 );//add gtm tag

//add Filters
//////////////
add_filter( 'woocommerce_checkout_fields' , 'custom_remove_woo_checkout_fields' );//remove fields from checkout

//add Functions
///////////////
function wpt_theme_styles() {// get the necesary files for the style of the theme

	//wp_enqueue_style( 'googlefont2_css', 'https://fonts.googleapis.com/css?family=Itim&text=Woof%26',20 );
  wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css', 'all' );
	
  /* Remove woocommerce styles from non Woocomemrce pages
  if ( function_exists( 'is_woocommerce' ) ) {
      if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
         wp_dequeue_style( 'wc-gateway-ppec-frontend-cart' );
       }
     }
     */
}


function wpt_theme_js() {// get the necesary code files for the theme to work 
	wp_enqueue_script('gsap', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js', array('jquery'), null, true);
  wp_enqueue_script('ScrollTrigger', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js', array('jquery'), null, true);
	wp_enqueue_script( 'main_js', get_template_directory_uri() . '/assets/code/general/code.js', array('jquery'), '', true );
	/* load custom code on page based on template name
  if(is_page()){ //Check if we are viewing a page
    global $wp_query;
   
          //Check which template is assigned to current page we are looking at
    $template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );
    if($template_name == 'page-templates/page-FoodDrDr.php'){
             //If page is draggable
       wp_enqueue_script('draggable', 'https://cdn.jsdelivr.net/npm/interactjs@1.3.4/dist/interact.min.js','', true);   
    }
  }*/
}
function woocommerce_support() {// add support
    add_theme_support( 'woocommerce' );
    //add_theme_support( 'menus' );
    //add_theme_support( 'post-thumbnails' );
}

function gtm(){ //add google tag mannager?>
      <!-- Google Tag Manager -->
      <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
      new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','GTM-5MPFZLK');</script>
      <!-- End Google Tag Manager -->  
<?php }

/************************************************************
*********************WOOCOMMERCE*****************************
********help functions to start any soowommerce store*******
***********************************************************/

function remove_woocommerce_styles_scripts() {// remove all scripts from none woocommerce pages
    if ( function_exists( 'is_woocommerce' ) ) {
        if (  ! is_cart() && ! is_checkout() ) {
            remove_action('wp_enqueue_scripts', [WC_Frontend_Scripts::class, 'load_scripts']);
            remove_action('wp_print_scripts', [WC_Frontend_Scripts::class, 'localize_printed_scripts'], 5);
            remove_action('wp_print_footer_scripts', [WC_Frontend_Scripts::class, 'localize_printed_scripts'], 5);
        }
    }
}
function custom_remove_woo_checkout_fields( $fields ) {//remove fields from checkout
   if ( function_exists( 'is_woocommerce' ) ) {
      // remove billing fields
      //unset($fields['billing']['billing_first_name']);
      unset($fields['billing']['billing_last_name']);
      unset($fields['billing']['billing_company']);
      //unset($fields['billing']['billing_address_1']);
      //unset($fields['billing']['billing_address_2']);
      //unset($fields['billing']['billing_city']);
      //unset($fields['billing']['billing_postcode']);
      //unset($fields['billing']['billing_country']);
      //unset($fields['billing']['billing_state']);
      unset($fields['billing']['billing_phone']);
      //unset($fields['billing']['billing_email']);
      
      
      // remove order comment fields
      unset($fields['order']['order_comments']);
      
      return $fields;
  }
}


if( function_exists('acf_add_options_page') ) {

  // Página principal de Opciones del Tema
  $parent = acf_add_options_page(array(
      'page_title'    => 'Info General',
      'menu_title'    => 'Info General',
      'menu_slug'     => 'info-general-settings',
      'capability'    => 'edit_posts',
      'redirect'      => false
  ));

  // Subpágina General
  acf_add_options_sub_page(array(
    'page_title'    => 'Cuestionario General',
    'menu_title'    => 'Cuestionario General',
    'parent_slug'   => $parent['menu_slug'],
  ));

  acf_add_options_sub_page(array(
    'page_title'    => 'Tabla de resultados',
    'menu_title'    => 'Tabla de resultados',
    'parent_slug'   => $parent['menu_slug'],
  ));

}

function cargar_info_ajax() {
  // Verifica si la petición tiene un parámetro
  if (isset($_POST['archivo'])) {
      $archivo = sanitize_text_field($_POST['archivo']);
      $ruta = get_template_directory() . "/data/{$archivo}.json"; // Ruta de tu archivo en la carpeta "data"

      if (file_exists($ruta)) {
          $contenido = file_get_contents($ruta);
          echo $contenido; // Devuelve el contenido JSON
      } else {
          echo json_encode(["error" => "Archivo no encontrado"]);
      }
  }
  wp_die(); // Cierra la petición AJAX de WordPress
}

// Hooks para permitir llamadas AJAX autenticadas y no autenticadas
add_action('wp_ajax_cargar_info', 'cargar_info_ajax');
add_action('wp_ajax_nopriv_cargar_info', 'cargar_info_ajax');

function my_enqueue_scripts() {
  wp_enqueue_script('code', get_template_directory_uri() . '/assets/code/general/code.js', ['jquery'], null, true);
  wp_localize_script('code', 'ajax_var', ['url' => admin_url('admin-ajax.php')]);
}
add_action('wp_enqueue_scripts', 'my_enqueue_scripts');

function agregar_metabox_formulario() {
  add_meta_box(
      'detalles_formulario',
      'Detalles del Formulario',
      'mostrar_metabox_formulario',
      'cuestionarios', // Nombre del CPT donde aparecerá
      'normal',
      'high'
  );
}
add_action('add_meta_boxes', 'agregar_metabox_formulario');

function mostrar_metabox_formulario($post) {
  $nombre = get_post_meta($post->ID, 'nombre', true);
  $email = get_post_meta($post->ID, 'email', true);
  $telefono = get_post_meta($post->ID, 'telefono', true);

  echo '<p><strong>Nombre:</strong> ' . esc_html($nombre) . '</p>';
  echo '<p><strong>Email:</strong> ' . esc_html($email) . '</p>';
  echo '<p><strong>Teléfono:</strong> ' . esc_html($telefono) . '</p>';
}

function agregar_metabox_pdf() {
  add_meta_box(
      'pdf_formulario',
      'Archivo PDF del Formulario',
      'mostrar_metabox_pdf',
      'cuestionarios',
      'normal',
      'high'
  );
}
add_action('add_meta_boxes', 'agregar_metabox_pdf');

function mostrar_metabox_pdf($post) {
  $pdf_url = get_post_meta($post->ID, 'archivo_pdf', true);

  if ($pdf_url) {
      echo '<p><a href="' . esc_url($pdf_url) . '" target="_blank">📄 Descargar PDF</a></p>';
  } else {
      echo '<p>No hay PDF disponible.</p>';
  }
}

?>