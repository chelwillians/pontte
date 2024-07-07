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
    // Banner
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

    // Divisor
    $cmb_divider = new_cmb2_box(array(
        'id'            => 'cmb2_divisor',
        'title'         => __('Divisor com cards', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'index.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_divider->add_field(array(
        'id'   => 'exibir_divisor',
        'name' => 'Exibir seção',
        'type' => 'checkbox',
    ));

    $cmb_divider->add_field(array(
        'id'   => 'titulo_divisor',
        'name' => 'Título',
        'type' => 'text',
        'desc'    => 'Use o seguinte formato: <strong class="purple">Crédito</strong> para <br>criar o <strong>seu futuro</strong>',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));

    $cmb_divider->add_field(array(
        'id'      => 'descricao_divisor',
        'name'    => 'Descrição',
        'type'    => 'textarea',
    ));

    $cmb_divider->add_field(array(
        'id'      => 'texto_botao_divisor',
        'name'    => 'Texto do botão',
        'type'    => 'text',
    ));

    $cmb_divider->add_field(array(
        'id'      => 'link_botao_divisor',
        'name'    => 'Link do botão',
        'type'    => 'text',
    ));

    $cards = $cmb_divider->add_field(array(
        'id'          => 'cards_list',
        'type'        => 'group',
        'description' => __('Cards', 'cmb2'),
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'       => __('Card {#}', 'cmb2'), // since version 1.1.4, {#} gets replaced by row number
            'add_button'        => __('Adicionar card', 'cmb2'),
            'remove_button'     => __('Remover', 'cmb2'),
            'sortable'          => true,
            'limit'         => 4,
            'closed'         => true, // true to have the groups closed by default
            // 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
        ),
    ));

    $cmb_divider->add_group_field($cards, array(
        'id'      => 'icon_card',
        'name'    => 'Ícone do card',
        'desc'    => 'Resolução recomendada de 32x32',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar imagem'
        ),
        // 'query_args' => array(
        //     'type' => array(
        //         'image/png',
        //         'image/jpg',
        //         'image/jpeg',
        //         'image/svg',
        //     ),
        // ),
        'preview_size' => 'medium',
    ));

    $cmb_divider->add_group_field($cards, array(
        'id'   => 'texto_um',
        'name' => 'Texto 1',
        'type' => 'text',
    ));

    $cmb_divider->add_group_field($cards, array(
        'id'   => 'texto_dois',
        'name' => 'Texto 2',
        'type' => 'text',
    ));

    // Sobre
    $cmb_about = new_cmb2_box(array(
        'id'            => 'cmb2_sobre',
        'title'         => __('Sobre', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'index.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_about->add_field(array(
        'id'   => 'exibir_sobre',
        'name' => 'Exibir seção',
        'type' => 'checkbox',
    ));

    $cmb_about->add_group_field($cards, array(
        'id'      => 'imagem_desk_sobre',
        'name'    => 'Imagem desktop',
        'desc'    => 'Resolução recomendada de 1312x1360',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar imagem'
        ),
        // 'query_args' => array(
        //     'type' => array(
        //         'image/png',
        //         'image/jpg',
        //         'image/jpeg',
        //         'image/svg',
        //     ),
        // ),
        'preview_size' => 'medium',
    ));

    $cmb_about->add_group_field($cards, array(
        'id'      => 'imagem_mobile_sobre',
        'name'    => 'Imagem mobile',
        'desc'    => 'Resolução recomendada de 430x362',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar imagem'
        ),
        // 'query_args' => array(
        //     'type' => array(
        //         'image/png',
        //         'image/jpg',
        //         'image/jpeg',
        //         'image/svg',
        //     ),
        // ),
        'preview_size' => 'medium',
    ));

    $cmb_about->add_field(array(
        'id'   => 'pretitulo_sobre',
        'name' => 'Pré Título',
        'type' => 'text',
    ));

    $cmb_about->add_field(array(
        'id'   => 'titulo_sobre',
        'name' => 'Título',
        'type' => 'text',
        'desc'    => 'Use o a tag strong para deixar em bold',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));

    $cmb_about->add_field(array(
        'id'      => 'descricao_sobre',
        'name'    => 'Descrição',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));

    $cmb_about->add_field(array(
        'id'   => 'titulo_2_sobre',
        'name' => 'Título',
        'type' => 'text',
        'desc'    => 'Título do bloco flutuante azul',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));

    $cmb_about->add_field(array(
        'id'   => 'link_sobre',
        'name' => 'Link do botão',
        'type' => 'text',
        'desc'    => 'Link do botão do bloco azul',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));

    $cmb_about->add_field(array(
        'id'   => 'texto_botao_sobre',
        'name' => 'Texto do botão',
        'type' => 'text',
        'desc'    => 'Texto do botão do bloco azul',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));

    // Seção para você
    $cmb_for_you = new_cmb2_box(array(
        'id'            => 'cmb2_para_voce',
        'title'         => __('Seção - Para você', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'index.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_for_you->add_field(array(
        'id'   => 'exibir_para_voce',
        'name' => 'Exibir seção',
        'type' => 'checkbox',
    ));

    $cmb_for_you->add_field(array(
        'id'   => 'pretitulo_para_voce',
        'name' => 'Pré Título',
        'type' => 'text',
    ));

    $cmb_for_you->add_field(array(
        'id'   => 'titulo_para_voce',
        'name' => 'Título',
        'type' => 'text',
        'desc'    => 'Use o a tag strong para deixar em bold',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));

    $cards_for_you = $cmb_for_you->add_field(array(
        'id'          => 'cards_list_para_voce',
        'type'        => 'group',
        'description' => __('Cards', 'cmb2'),
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'       => __('Card {#}', 'cmb2'), // since version 1.1.4, {#} gets replaced by row number
            'add_button'        => __('Adicionar card', 'cmb2'),
            'remove_button'     => __('Remover', 'cmb2'),
            'sortable'          => true,
            'limit'         => 4,
            'closed'         => true, // true to have the groups closed by default
            // 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
        ),
    ));

    $cmb_for_you->add_group_field($cards_for_you, array(
        'id'      => 'icon_card',
        'name'    => 'Ícone do card',
        'desc'    => 'Resolução recomendada de 40x40',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar imagem'
        ),
        // 'query_args' => array(
        //     'type' => array(
        //         'image/png',
        //         'image/jpg',
        //         'image/jpeg',
        //         'image/svg',
        //     ),
        // ),
        'preview_size' => 'medium',
    ));

    $cmb_for_you->add_group_field($cards_for_you, array(
        'id'   => 'titulo',
        'name' => 'Título',
        'type' => 'text',
    ));

    $cmb_for_you->add_group_field($cards_for_you, array(
        'id'      => 'descricao',
        'name'    => 'Descrição',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));

    // Seção Home Equity
    $cmb_home_equity = new_cmb2_box(array(
        'id'            => 'cmb2_home_equity',
        'title'         => __('Seção - Home Equity', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'index.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_home_equity->add_field(array(
        'id'   => 'exibir_home_equity',
        'name' => 'Exibir seção',
        'type' => 'checkbox',
    ));

    $cmb_home_equity->add_field(array(
        'id'   => 'pretitulo_home_equity',
        'name' => 'Pré Título',
        'type' => 'text',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));

    $cmb_home_equity->add_field(array(
        'id'   => 'titulo_home_equity',
        'name' => 'Título',
        'type' => 'text',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));

    $cmb_home_equity->add_field(array(
        'id'      => 'descricao_home_equity',
        'name'    => 'Descrição',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));

    $cmb_home_equity->add_field(array(
        'id'   => 'texto_botao_home_equity',
        'name' => 'Texto do botão',
        'type' => 'text',
    ));

    $cmb_home_equity->add_field(array(
        'id'   => 'link_botao_home_equity',
        'name' => 'Link do botão',
        'type' => 'text',
    ));

    $cmb_home_equity->add_field(array(
        'id'      => 'imagem_desk_home_equity',
        'name'    => 'Imagem desktop',
        'desc'    => 'Resolução recomendada de 700x586',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar imagem'
        ),
        // 'query_args' => array(
        //     'type' => array(
        //         'image/png',
        //         'image/jpg',
        //         'image/jpeg',
        //         'image/svg',
        //     ),
        // ),
        'preview_size' => 'medium',
    ));

    $cmb_home_equity->add_field(array(
        'id'      => 'imagem_mobile_home_equity',
        'name'    => 'Imagem mobile',
        'desc'    => 'Resolução recomendada de 716x970',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar imagem'
        ),
        // 'query_args' => array(
        //     'type' => array(
        //         'image/png',
        //         'image/jpg',
        //         'image/jpeg',
        //         'image/svg',
        //     ),
        // ),
        'preview_size' => 'medium',
    ));

    // Seção FAQ
    $cmb_faq = new_cmb2_box(array(
        'id'            => 'cmb2_faq',
        'title'         => __('Seção - FAQ', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'index.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_faq->add_field(array(
        'id'   => 'exibir_faq',
        'name' => 'Exibir seção',
        'type' => 'checkbox',
    ));

    $cmb_faq->add_field(array(
        'id'   => 'pretitulo_faq',
        'name' => 'Pré Título',
        'type' => 'text',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));

    $cmb_faq->add_field(array(
        'id'   => 'titulo_faq',
        'name' => 'Título',
        'type' => 'text',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));

    $perguntas = $cmb_faq->add_field(array(
        'id'          => 'faq_list',
        'type'        => 'group',
        'description' => __('Perguntas', 'cmb2'),
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'       => __('Item {#}', 'cmb2'), // since version 1.1.4, {#} gets replaced by row number
            'add_button'        => __('Adicionar item', 'cmb2'),
            'remove_button'     => __('Remover', 'cmb2'),
            'sortable'          => true,
            'limit'         => 4,
            'closed'         => true, // true to have the groups closed by default
            // 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
        ),
    ));

    $cmb_faq->add_group_field($perguntas, array(
        'id'   => 'pergunta',
        'name' => 'Pergunta',
        'type' => 'text',
    ));

    $cmb_faq->add_group_field($perguntas, array(
        'id'      => 'resposta',
        'name'    => 'Resposta',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));
}
add_action('cmb2_admin_init', 'cmb2_home_metaboxes');
