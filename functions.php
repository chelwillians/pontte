<?php
// HABILITAR THUMBNAIL
add_theme_support('post-thumbnails');

// Ocultar editor 
function hide_editor()
{
    // Get the Post ID.
    if (isset($_GET['post']))
        $post_id = $_GET['post'];
    else if (isset($_POST['post_ID']))
        $post_id = $_POST['post_ID'];

    if (!isset($post_id) || empty($post_id))
        return;

    // Get the name of the Page Template file.
    $template_file = get_post_meta($post_id, '_wp_page_template', true);

    if ($template_file == 'index.php') { // edit the template name
        remove_post_type_support('page', 'editor');
    }
}
add_action('admin_init', 'hide_editor');

// Menus
function get_menu_items($menu_name)
{
    $menu = get_nav_menu_locations();
    $menu_id = $menu[$menu_name];
    return wp_get_nav_menu_items($menu_id);
}

function menu_header()
{
    register_nav_menu('menu_header', __('Menu Header'));
}
add_action('init', 'menu_header');


// Functions CMB2
function prefix_sanitize_text_callback($value, $field_args, $field)
{
    $value = strip_tags($value, '<p><a><br><br/><strong><b><span>');

    return $value;
}

function prefix_sanitize_iframe($value, $field_args, $field)
{
    $value = strip_tags($value, '<iframe>');

    return $value;
}

function get_field($key, $page_id = 0)
{
    $id = $page_id !== 0 ? $page_id : get_the_ID();
    return get_post_meta($id, $key, true);
}

function the_field($key, $page_id = 0)
{
    echo get_field($key, $page_id);
}

function get_alt($key)
{
    return get_post_meta($key, '_wp_attachment_image_alt', TRUE);
}

function cmb2_get_term_options($field)
{
    $args = $field->args('get_terms_args');
    $args = is_array($args) ? $args : array();

    $args = wp_parse_args($args, array('taxonomy' => 'category'));

    $taxonomy = $args['taxonomy'];

    $terms = (array) cmb2_utils()->wp_at_least('4.5.0')
        ? get_terms($args)
        : get_terms($taxonomy, $args);

    // Initate an empty array
    $term_options = array();
    if (!empty($terms)) {
        foreach ($terms as $term) {
            $term_options[$term->term_id] = $term->name;
        }
    }

    return $term_options;
}

// Options page
function opt_page_register_theme_options_metabox()
{
    $cmb_options = new_cmb2_box(array(
        'id'           => 'opt_page_theme_options_page',
        'title'        => 'Definições Gerais',
        'object_types' => array('options-page'),
        'option_key'   => 'opt_page_theme_options',
        'icon_url'     => 'dashicons-edit-large',
        'display_cb'   => 'opt_page_theme_options_page_output', // Override the options-page form output (CMB2_Hookup::options_page_output()).
    ));

    $cmb_options->add_field(array(
        'id'   => 'cmb2_title_general',
        'name' => 'Geral',
        'type' => 'title',
    ));

    $cmb_options->add_field(array(
        'id'      => 'logo',
        'name'    => 'Logo',
        'desc'    => 'Resolução recomendada de 108x33',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar arquivo'
        ),
        'query_args' => array(
            'type' => array(
                'image/png',
                'image/svg',
            ),
        ),
        'preview_size' => 'large',
    ));

    $cmb_options->add_field(array(
        'name' => 'Redes sociais',
        'type' => 'title',
        'id' => 'redes_sociais'
    ));

    $cmb_options->add_field(array(
        'name' => 'Instagram',
        'id' => 'instagram',
        'type' => 'text_url',
    ));

    $cmb_options->add_field(array(
        'name' => 'Whatsapp',
        'id' => 'whatsapp',
        'type' => 'text_url',
    ));

    $cmb_options->add_field(array(
        'name' => 'Linkedin',
        'id' => 'linkedin',
        'type' => 'text_url',
    ));

    $cmb_options->add_field(array(
        'name' => 'Facebook',
        'id' => 'facebook',
        'type' => 'text_url',
    ));

    $cmb_options->add_field(array(
        'name' => 'Footer',
        'type' => 'title',
        'id' => 'footer'
    ));

    $cmb_options->add_field(array(
        'name' => 'Texto Footer',
        'id' => 'texto_footer',
        'type' => 'textarea',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));
}
add_action('cmb2_admin_init', 'opt_page_register_theme_options_metabox');

// Fields
function cmb2_home_metaboxes()
{
    $cmb_banner = new_cmb2_box(array(
        'id'            => 'cmb2_banners',
        'title'         => __('Banner', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'index.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_banner->add_field(array(
        'id'      => 'imagem_desktop',
        'name'    => 'Imagem desktop',
        'desc'    => 'Resolução recomendada de 606x648',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar imagem'
        ),
        'query_args' => array(
            'type' => array(
                'image/png',
                'image/jpg',
                'image/jpeg',
                'image/svg',
            ),
        ),
        'preview_size' => 'medium',
    ));

    $cmb_banner->add_field(array(
        'id'      => 'imagem_mobile',
        'name'    => 'Imagem mobile',
        'desc'    => 'Resolução recomendada de 366x485',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar imagem'
        ),
        'query_args' => array(
            'type' => array(
                'image/png',
                'image/jpg',
                'image/jpeg',
                'image/svg',
            ),
        ),
        'preview_size' => 'medium',
    ));

    $cmb_banner->add_field(array(
        'id'      => 'titulo',
        'name'    => 'Título',
        'desc'    => 'Use o seguinte formato: <strong class="purple">Crédito</strong> para <br>criar o <strong>seu futuro</strong>',
        'type'    => 'text',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));
    
    $cmb_banner->add_field(array(
        'id'      => 'descricao',
        'name'    => 'Descrição',
        'type'    => 'textarea',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));

    $cmb_banner->add_field(array(
        'id'      => 'texto_botao',
        'name'    => 'Texto do botão',
        'type'    => 'text',
    ));

    $cmb_banner->add_field(array(
        'id'      => 'link_botao',
        'name'    => 'Link do botão',
        'type'    => 'text',
    ));

    $cmb_sobre = new_cmb2_box(array(
        'id'            => 'cmb2_sobre',
        'title'         => __('Sobre', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'index.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_sobre->add_field(array(
        'id'   => 'exibir_sobre',
        'name' => 'Exibir seção',
        'type' => 'checkbox',
    ));

    $cmb_sobre->add_field(array(
        'id'   => 'titulo_sobre',
        'name' => 'Título',
        'type' => 'text',
    ));

    $cmb_sobre->add_field(array(
        'id'      => 'descricao_sobre',
        'name'    => 'Descrição',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));

    $cmb_sobre->add_field(array(
        'id' => 'iframe_sobre',
        'name' => 'Iframe vídeo',
        'type' => 'textarea',
        'sanitization_cb' => 'prefix_sanitize_iframe'
    ));

    $cmb_divisor = new_cmb2_box(array(
        'id'            => 'cmb2_divisor',
        'title'         => __('Divisor', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'index.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_divisor->add_field(array(
        'id'   => 'exibir_divisor',
        'name' => 'Exibir seção',
        'type' => 'checkbox',
    ));

    $cmb_divisor->add_field(array(
        'id'   => 'titulo_divisor',
        'name' => 'Título',
        'type' => 'text',
    ));

    $cmb_clinica = new_cmb2_box(array(
        'id'            => 'cmb2_clinica',
        'title'         => __('Clínica', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'index.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_clinica->add_field(array(
        'id'   => 'exibir_clinica',
        'name' => 'Exibir seção',
        'type' => 'checkbox',
    ));

    $cmb_clinica->add_field(array(
        'id'   => 'titulo_clinica',
        'name' => 'Título',
        'type' => 'text',
    ));

    $cmb_clinica->add_field(array(
        'id'      => 'descricao_clinica',
        'name'    => 'Descrição',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));

    $cmb_clinica->add_field(array(
        'id'      => 'imagem_clinica',
        'name'    => 'Imagem',
        'desc'    => 'Resolução recomendada de 500x320',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar imagem'
        ),
        'query_args' => array(
            'type' => array(
                'image/png',
                'image/jpg',
                'image/jpeg',
                'image/svg',
            ),
        ),
        'preview_size' => 'medium',
    ));

    $cmb_procedimentos = new_cmb2_box(array(
        'id'            => 'cmb2_procedimentos',
        'title'         => __('Procedimentos', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'index.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_procedimentos->add_field(array(
        'id'   => 'exibir_procedimentos',
        'name' => 'Exibir seção',
        'type' => 'checkbox',
    ));

    $cmb_procedimentos->add_field(array(
        'id'   => 'titulo_procedimentos',
        'name' => 'Título seção',
        'type' => 'text',
    ));

    $cmb_procedimentos->add_field(array(
        'id'      => 'descricao_procedimentos',
        'name'    => 'Descrição',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));

    $procedimentos = $cmb_procedimentos->add_field(array(
        'id'          => 'procedimentos',
        'type'        => 'group',
        'description' => __('Procedimentos', 'cmb2'),
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'       => __('Procedimento {#}', 'cmb2'), // since version 1.1.4, {#} gets replaced by row number
            'add_button'        => __('Adicionar Procedimento', 'cmb2'),
            'remove_button'     => __('Remover', 'cmb2'),
            'sortable'          => true,
            'limit'         => 4,
            'closed'         => true, // true to have the groups closed by default
            // 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
        ),
    ));

    $cmb_procedimentos->add_group_field($procedimentos, array(
        'id'      => 'imagem_procedimento',
        'name'    => 'Imagem',
        'desc'    => 'Resolução recomendada de 300x400',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar imagem'
        ),
        'query_args' => array(
            'type' => array(
                'image/png',
                'image/jpg',
                'image/jpeg',
                'image/svg',
            ),
        ),
        'preview_size' => 'medium',
    ));

    $cmb_procedimentos->add_group_field($procedimentos, array(
        'id'      => 'nome_procedimento',
        'name'    => 'Nome',
        'type'    => 'text',
    ));

    $cmb_procedimentos->add_group_field($procedimentos, array(
        'id'      => 'descricao_procedimento',
        'name'    => 'Descrição',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));

    $cmb_tecnologias = new_cmb2_box(array(
        'id'            => 'cmb2_tecnologias',
        'title'         => __('Tecnologias', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'index.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_tecnologias->add_field(array(
        'id'   => 'exibir_tecnologias',
        'name' => 'Exibir seção',
        'type' => 'checkbox',
    ));

    $cmb_tecnologias->add_field(array(
        'id'   => 'titulo_tecnologias',
        'name' => 'Título seção',
        'type' => 'text',
    ));

    $cmb_tecnologias->add_field(array(
        'id'      => 'descricao_tecnologias',
        'name'    => 'Descrição',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));

    $tecnologias = $cmb_tecnologias->add_field(array(
        'id'          => 'tecnologias',
        'type'        => 'group',
        'description' => __('Tecnologias', 'cmb2'),
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'       => __('Tecnologia {#}', 'cmb2'), // since version 1.1.4, {#} gets replaced by row number
            'add_button'        => __('Adicionar Tecnologia', 'cmb2'),
            'remove_button'     => __('Remover', 'cmb2'),
            'sortable'          => true,
            'limit'         => 4,
            'closed'         => true, // true to have the groups closed by default
            // 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
        ),
    ));

    $cmb_tecnologias->add_group_field($tecnologias, array(
        'id'      => 'imagem_tecnologia',
        'name'    => 'Imagem',
        'desc'    => 'Resolução recomendada de 610x360',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar imagem'
        ),
        'query_args' => array(
            'type' => array(
                'image/png',
                'image/jpg',
                'image/jpeg',
                'image/svg',
            ),
        ),
        'preview_size' => 'medium',
    ));

    $cmb_tecnologias->add_group_field($tecnologias, array(
        'id'      => 'nome_tecnologia',
        'name'    => 'Nome',
        'type'    => 'text',
    ));

    $cmb_tecnologias->add_group_field($tecnologias, array(
        'id'      => 'descricao_tecnologia',
        'name'    => 'Descrição',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));

    $cmb_contato = new_cmb2_box(array(
        'id'            => 'cmb2_contato',
        'title'         => __('Contato', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'index.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_contato->add_field(array(
        'id'   => 'exibir_contato',
        'name' => 'Exibir seção',
        'type' => 'checkbox',
    ));

    $cmb_contato->add_field(array(
        'id'   => 'pre_titulo_contato',
        'name' => 'Pré título seção',
        'type' => 'text',
    ));

    $cmb_contato->add_field(array(
        'id'   => 'titulo_contato',
        'name' => 'Título seção',
        'type' => 'text',
    ));

    $cmb_contato->add_field(array(
        'id'      => 'descricao_contato',
        'name'    => 'Descrição',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));

    $cmb_contato->add_field(array(
        'id'   => 'endereco_contato',
        'name' => 'Endereço',
        'type' => 'text',
    ));

    $cmb_contato->add_field(array(
        'id'   => 'link_endereco_contato',
        'name' => 'Link endereço',
        'type' => 'text',
    ));

    $telefones = $cmb_contato->add_field(array(
        'id'          => 'telefones',
        'type'        => 'group',
        'description' => __('Telefones', 'cmb2'),
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'       => __('Telefone {#}', 'cmb2'), // since version 1.1.4, {#} gets replaced by row number
            'add_button'        => __('Adicionar Telefone', 'cmb2'),
            'remove_button'     => __('Remover', 'cmb2'),
            'sortable'          => true,
            'limit'         => 4,
            'closed'         => true, // true to have the groups closed by default
            // 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
        ),
    ));

    $cmb_contato->add_group_field($telefones, array(
        'id'      => 'escrita_telefone',
        'name'    => 'Telefone escrito',
        'type'    => 'text',
        'desc'    => 'Whatsapp: (11) 90000-0000',        
    ));

    $cmb_contato->add_group_field($telefones, array(
        'id'      => 'link_telefone',
        'name'    => 'Link do número',
        'type'    => 'text',
        'desc'    => 'tel:+5511900000000 || https://wa.me/5511900000000',        
    ));

    $cmb_contato->add_field(array(
        'id'   => 'shortcode_contato',
        'name' => 'Shortcode do formulário',
        'type' => 'text',
    ));

}
add_action('cmb2_admin_init', 'cmb2_home_metaboxes');
