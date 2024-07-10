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

    if ($template_file == 'index.php' || $template_file == 'seja-um-parceiro.php' || $template_file == 'contato.php') { // edit the template name
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

function menu_footer()
{
    register_nav_menu('menu_footer', __('Menu footer'));
}
add_action('init', 'menu_footer');

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
        'id'      => 'float_card_1',
        'name'    => 'Card flutuante 1',
        // 'desc'    => 'Resolução recomendada de 366x485',
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
        'id'      => 'float_card_2',
        'name'    => 'Card flutuante 2',
        // 'desc'    => 'Resolução recomendada de 366x485',
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

    $cmb_about->add_field(array(
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

    $cmb_about->add_field(array(
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

    // Seção Mídia
    $cmb_midia = new_cmb2_box(array(
        'id'            => 'cmb2_midia',
        'title'         => __('Seção - Na Mídia', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'index.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_midia->add_field(array(
        'id'   => 'exibir_midia',
        'name' => 'Exibir seção',
        'type' => 'checkbox',
    ));

    $cmb_midia->add_field(array(
        'id'   => 'titulo_midia',
        'name' => 'Título',
        'type' => 'text',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));

    $materias = $cmb_midia->add_field(array(
        'id'          => 'midia_list',
        'type'        => 'group',
        'description' => __('Materia', 'cmb2'),
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

    $cmb_midia->add_group_field($materias, array(
        'id'      => 'logo',
        'name'    => 'Logo',
        'desc'    => 'Resolução recomendada de 100x34',
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

    $cmb_midia->add_group_field($materias, array(
        'id'      => 'mes',
        'name'    => 'Mês',
        'type'    => 'text',
        'desc'    => 'Exemplo: JAN, FEV, MAR, ABR...',
    ));

    $cmb_midia->add_group_field($materias, array(
        'id'      => 'ano',
        'name'    => 'Ano',
        'type'    => 'text',
    ));

    $cmb_midia->add_group_field($materias, array(
        'id'      => 'materia',
        'name'    => 'Matéria',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));

    $cmb_midia->add_group_field($materias, array(
        'id'      => 'link',
        'name'    => 'Link',
        'type'    => 'text',
    ));
}
add_action('cmb2_admin_init', 'cmb2_home_metaboxes');

// Seja um parceiro
function cmb2_seja_parceiro_metaboxes()
{
    // Banner
    $cmb_banner = new_cmb2_box(array(
        'id'            => 'cmb2_banners_seja_um_parceiro',
        'title'         => __('Banner', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'seja-um-parceiro.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

    $cmb_banner->add_field(array(
        'id'      => 'imagem_desktop',
        'name'    => 'Imagem desktop',
        'desc'    => 'Resolução recomendada de 1464x1412',
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

    // O Futuro
    $cmb_the_future = new_cmb2_box(array(
        'id'            => 'cmb2_o_futuro',
        'title'         => __('Seção - O futuro', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'seja-um-parceiro.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));
    $cmb_the_future->add_field(array(
        'id'   => 'exibir_o_futuro',
        'name' => 'Exibir seção',
        'type' => 'checkbox',
    ));
    $cmb_the_future->add_field(array(
        'id'      => 'titulo_o_futuro',
        'name'    => 'Título',
        'desc'    => 'Use a tag strong para destacar o texto',
        'type'    => 'text',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));
    $list = $cmb_the_future->add_field(array(
        'id'          => 'lista_o_futuro',
        'type'        => 'group',
        'description' => __('Item', 'cmb2'),
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
    $cmb_the_future->add_group_field($list, array(
        'id'      => 'titulo',
        'name'    => 'Título',
        'type'    => 'text',
    ));
    $cmb_the_future->add_group_field($list, array(
        'id'      => 'descricao',
        'name'    => 'Descrição',
        'type'    => 'textarea',
    ));

    // beneficios
    $cmb_benefits = new_cmb2_box(array(
        'id'            => 'cmb2_beneficios',
        'title'         => __('Seção - Benefícios', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'seja-um-parceiro.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));
    $cmb_benefits->add_field(array(
        'id'   => 'exibir_beneficios',
        'name' => 'Exibir seção',
        'type' => 'checkbox',
    ));
    $cmb_benefits->add_field(array(
        'id'      => 'titulo_beneficios',
        'name'    => 'Título',
        'desc'    => 'Use a tag strong para destacar o texto',
        'type'    => 'text',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));
    $cmb_benefits->add_field(array(
        'id'      => 'descricao_beneficios',
        'name'    => 'Descrição',
        'type'    => 'textarea',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));
    $cmb_benefits->add_field(array(
        'id'      => 'texto_botao_beneficios',
        'name'    => 'Texto botão',
        'type'    => 'text',
    ));
    $cmb_benefits->add_field(array(
        'id'      => 'link_botao_beneficios',
        'name'    => 'Link botão',
        'type'    => 'text',
    ));
    $cmb_benefits->add_field(array(
        'id'      => 'conteudo_flutuante_beneficios',
        'name'    => 'Conteúdo flutuante',
        'type'    => 'textarea',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));

    $list_benefits = $cmb_benefits->add_field(array(
        'id'          => 'lista_beneficios',
        'type'        => 'group',
        'description' => __('Item', 'cmb2'),
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
    $cmb_benefits->add_group_field($list_benefits, array(
        'id'      => 'texto_um',
        'name'    => 'Texto 1',
        'type'    => 'text',
    ));
    $cmb_benefits->add_group_field($list_benefits, array(
        'id'      => 'texto_dois',
        'name'    => 'Texto 2',
        'type'    => 'text',
    ));

    $cmb_benefits->add_group_field($list_benefits, array(
        'id'      => 'icone',
        'name'    => 'Ícone',
        'desc'    => 'Resolução recomendada de 32x32',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar imagem'
        ),
        'preview_size' => 'medium',
    ));

    // Etapas
    $cmb_steps = new_cmb2_box(array(
        'id'            => 'cmb2_etapas',
        'title'         => __('Seção - Etapas', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'seja-um-parceiro.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));
    $cmb_steps->add_field(array(
        'id'   => 'exibir_etapas',
        'name' => 'Exibir seção',
        'type' => 'checkbox',
    ));
    $cmb_steps->add_field(array(
        'id'      => 'titulo_etapas',
        'name'    => 'Título',
        'desc'    => 'Use a tag strong para destacar o texto',
        'type'    => 'text',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));

    $cmb_steps->add_field(array(
        'id'      => 'link_etapas',
        'name'    => 'Link botão',
        'type'    => 'text',
    ));

    $cmb_steps->add_field(array(
        'id'      => 'texto_botao_etapas',
        'name'    => 'Texto botão',
        'type'    => 'text',
    ));

    $cards_steps = $cmb_steps->add_field(array(
        'id'          => 'cards_list_etapas',
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

    $cmb_steps->add_group_field($cards_steps, array(
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

    $cmb_steps->add_group_field($cards_steps, array(
        'id'   => 'titulo',
        'name' => 'Título',
        'type' => 'text',
    ));

    $cmb_steps->add_group_field($cards_steps, array(
        'id'      => 'descricao',
        'name'    => 'Descrição',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));

    // Depoimentos
    $cmb_testimonials = new_cmb2_box(array(
        'id'            => 'cmb2_depoimentos',
        'title'         => __('Seção - Depoimentos', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'seja-um-parceiro.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));
    $cmb_testimonials->add_field(array(
        'id'   => 'exibir_depoimentos',
        'name' => 'Exibir seção',
        'type' => 'checkbox',
    ));
    $cmb_testimonials->add_field(array(
        'id'      => 'pretitulo_depoimentos',
        'name'    => 'Pre título',
        'type'    => 'text',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));
    $cmb_testimonials->add_field(array(
        'id'      => 'titulo_depoimentos',
        'name'    => 'Título',
        'desc'    => 'Use a tag strong para destacar o texto',
        'type'    => 'text',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));

    $depoimentos = $cmb_testimonials->add_field(array(
        'id'          => 'lista_depoimentos',
        'type'        => 'group',
        'description' => __('Depoimentos', 'cmb2'),
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'       => __('Depoimento {#}', 'cmb2'), // since version 1.1.4, {#} gets replaced by row number
            'add_button'        => __('Adicionar depoimento', 'cmb2'),
            'remove_button'     => __('Remover', 'cmb2'),
            'sortable'          => true,
            'limit'         => 4,
            'closed'         => true, // true to have the groups closed by default
            // 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
        ),
    ));

    $cmb_testimonials->add_group_field($depoimentos, array(
        'id'      => 'texto',
        'name'    => 'Texto',
        'type'    => 'textarea',
    ));

    $cmb_testimonials->add_group_field($depoimentos, array(
        'id'      => 'autor',
        'name'    => 'Autor',
        'type'    => 'text',
    ));

    // Timeline
    $cmb_timeline = new_cmb2_box(array(
        'id'            => 'cmb2_timeline',
        'title'         => __('Seção - Timeline', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'seja-um-parceiro.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));
    $cmb_timeline->add_field(array(
        'id'   => 'exibir_timeline',
        'name' => 'Exibir seção',
        'type' => 'checkbox',
    ));
    $cmb_timeline->add_field(array(
        'id'      => 'titulo_timeline',
        'name'    => 'Título',
        'type'    => 'text',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));
    $cmb_timeline->add_field(array(
        'id'      => 'descricao_timeline',
        'name'    => 'Descrição',
        'type'    => 'textarea',
    ));

    $cmb_timeline->add_field(array(
        'id'      => 'imagem_timeline',
        'name'    => 'Imagem',
        'desc'    => 'Resolução recomendada de 1216x1014',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar imagem'
        ),
        'preview_size' => 'medium',
    ));

    $timeline = $cmb_timeline->add_field(array(
        'id'          => 'lista_timeline',
        'type'        => 'group',
        'description' => __('Lista', 'cmb2'),
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'       => __('Lista {#}', 'cmb2'), // since version 1.1.4, {#} gets replaced by row number
            'add_button'        => __('Adicionar item', 'cmb2'),
            'remove_button'     => __('Remover', 'cmb2'),
            'sortable'          => true,
            'closed'         => true, // true to have the groups closed by default
            // 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
        ),
    ));

    $cmb_timeline->add_group_field($timeline, array(
        'id'      => 'ano',
        'name'    => 'Ano',
        'type'    => 'text',
    ));

    $cmb_timeline->add_group_field($timeline, array(
        'id'      => 'descricao',
        'name'    => 'Descrição',
        'type'    => 'textarea',
    ));

    // Parceiros
    $cmb_partners = new_cmb2_box(array(
        'id'            => 'cmb2_parceiros',
        'title'         => __('Seção - Parceiros', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'seja-um-parceiro.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));
    $cmb_partners->add_field(array(
        'id'   => 'exibir_parceiros',
        'name' => 'Exibir seção',
        'type' => 'checkbox',
    ));
    $cmb_partners->add_field(array(
        'id'      => 'titulo_parceiros',
        'name'    => 'Título',
        'type'    => 'text',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));
    $logos = $cmb_partners->add_field(array(
        'id'          => 'lista_parceiros',
        'type'        => 'group',
        'description' => __('Lista', 'cmb2'),
        // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'       => __('Item {#}', 'cmb2'), // since version 1.1.4, {#} gets replaced by row number
            'add_button'        => __('Adicionar item', 'cmb2'),
            'remove_button'     => __('Remover', 'cmb2'),
            'sortable'          => true,
            'closed'         => true, // true to have the groups closed by default
            // 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
        ),
    ));

    $cmb_partners->add_group_field($logos, array(
        'id'      => 'logo',
        'name'    => 'Imagem',
        'desc'    => 'Resolução recomendada de 124x40',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar imagem'
        ),
        'preview_size' => 'medium',
    ));

    // Preço
    $cmb_price = new_cmb2_box(array(
        'id'            => 'cmb2_preco',
        'title'         => __('Seção - Preço', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'seja-um-parceiro.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));
    $cmb_price->add_field(array(
        'id'   => 'exibir_preco',
        'name' => 'Exibir seção',
        'type' => 'checkbox',
    ));
    $cmb_price->add_field(array(
        'id'      => 'titulo_preco',
        'name'    => 'Título',
        'type'    => 'text',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));
    $cmb_price->add_field(array(
        'id'      => 'descricao_preco',
        'name'    => 'Descrição',
        'type'    => 'textarea',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));
    $cmb_price->add_field(array(
        'id'      => 'link_botao_preco',
        'name'    => 'Link botão',
        'type'    => 'text',
    ));
    $cmb_price->add_field(array(
        'id'      => 'texto_botao_preco',
        'name'    => 'Texto botão',
        'type'    => 'text',
    ));
    $cmb_price->add_field(array(
        'id'      => 'titulo_2_preco',
        'name'    => 'Título do preço',
        'type'    => 'text',
    ));
    $cmb_price->add_field(array(
        'id'      => 'imagem_preco',
        'name'    => 'Imagem do preço',
        'desc'    => 'Resolução recomendada de 443x120',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Adicionar imagem'
        ),
        'preview_size' => 'medium',
    ));
    $cmb_price->add_field(array(
        'id'      => 'descricao_2_preco',
        'name'    => 'Descrição do preço',
        'type'    => 'text',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));
}
add_action('cmb2_admin_init', 'cmb2_seja_parceiro_metaboxes');

// Contato
function cmb2_contato_metaboxes()
{
    $cmb_contact = new_cmb2_box(array(
        'id'            => 'cmb2_contato',
        'title'         => __('Seção - Contato', 'cmb2'),
        'object_types'  => array('page'),
        'show_on' => array('key' => 'page-template', 'value' => 'contato.php'),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));
    // $cmb_contact->add_field(array(
    //     'id'   => 'exibir_contato',
    //     'name' => 'Exibir seção',
    //     'type' => 'checkbox',
    // ));
    $cmb_contact->add_field(array(
        'id'      => 'titulo_contato',
        'name'    => 'Título',
        'type'    => 'text',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));
    $cmb_contact->add_field(array(
        'id'      => 'descricao_contato',
        'name'    => 'Descrição',
        'type'    => 'text',
        'sanitization_cb' => 'prefix_sanitize_text_callback'
    ));
    $cmb_contact->add_field(array(
        'id'   => 'whatsapp_contato',
        'name' => 'Whatsapp',
        'type' => 'title',
    ));
    $cmb_contact->add_field( array(
        'id'   => 'whatsapp_titulo_contato',
        'name' => 'Whatsapp - Título',
        'type' => 'text',
    ) );
    $cmb_contact->add_field(array(
        'id'      => 'whatsapp_conteudo_contato',
        'name'    => 'Whatsapp - conteúdo',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));
    $cmb_contact->add_field(array(
        'id'   => 'email_contato',
        'name' => 'E-mail',
        'type' => 'title',
    ));
    $cmb_contact->add_field( array(
        'id'   => 'email_titulo_contato',
        'name' => 'E-mail - Título',
        'type' => 'text',
    ) );
    $cmb_contact->add_field(array(
        'id'      => 'email_conteudo_contato',
        'name'    => 'E-mail - conteúdo',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));
    $cmb_contact->add_field(array(
        'id'   => 'telefonar_contato',
        'name' => 'Telefonar',
        'type' => 'title',
    ));
    $cmb_contact->add_field( array(
        'id'   => 'telefonar_titulo_contato',
        'name' => 'Telefonar - Título',
        'type' => 'text',
    ) );
    $cmb_contact->add_field(array(
        'id'      => 'telefonar_conteudo_contato',
        'name'    => 'Telefonar - conteúdo',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));
    $cmb_contact->add_field(array(
        'id'   => 'trabalhe_contato',
        'name' => 'Trabalhe com a gente',
        'type' => 'title',
    ));
    $cmb_contact->add_field( array(
        'id'   => 'trabalhe_titulo_contato',
        'name' => 'Trabalhe com a gente - Título',
        'type' => 'text',
    ) );
    $cmb_contact->add_field(array(
        'id'      => 'trabalhe_conteudo_contato',
        'name'    => 'Trabalhe com a gente - conteúdo',
        'type'    => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'media_buttons' => false,
        ),
    ));
}
add_action('cmb2_admin_init', 'cmb2_contato_metaboxes');
