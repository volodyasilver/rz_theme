<?php
/**
 * RZ Rehab Theme functions and definitions
 */

// Simple Translation System
function rz_t($uk, $en) {
    $lang = isset($_GET['lang']) && $_GET['lang'] === 'en' ? 'en' : 'uk';
    return $lang === 'en' ? $en : $uk;
}

function rz_get_lang() {
    return isset($_GET['lang']) && $_GET['lang'] === 'en' ? 'en' : 'uk';
}

function rz_rehab_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'rz-rehab' ),
    ) );
}
add_action( 'after_setup_theme', 'rz_rehab_setup' );

/**
 * Custom Post Types
 */
function rz_rehab_cpts() {
    register_post_type('rz_service', array(
        'labels' => array(
            'name' => 'Послуги',
            'singular_name' => 'Послуга',
            'add_new' => 'Додати послугу',
            'add_new_item' => 'Додати нову послугу',
            'edit_item' => 'Редагувати послугу',
        ),
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-heart',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
    ));

    register_post_type('rz_subscription', array(
        'labels' => array(
            'name' => 'Абонементи',
            'singular_name' => 'Абонемент',
            'add_new' => 'Додати абонемент',
            'add_new_item' => 'Додати новий абонемент',
            'edit_item' => 'Редагувати абонемент',
        ),
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-tickets-alt',
        'supports' => array('title'),
    ));
}
add_action('init', 'rz_rehab_cpts');

/**
 * Metaboxes for Service translations
 */
function rz_rehab_add_meta_boxes() {
    add_meta_box('rz_service_en', 'Переклад (ENG)', function($post) {
        $title_en = get_post_meta($post->ID, '_rz_title_en', true);
        $desc_en = get_post_meta($post->ID, '_rz_desc_en', true);
        $how_en = get_post_meta($post->ID, '_rz_how_it_works_en', true);
        $results_en = get_post_meta($post->ID, '_rz_results_en', true);
        $ind_en = get_post_meta($post->ID, '_rz_indications_en', true);
        $contra_en = get_post_meta($post->ID, '_rz_contraindications_en', true);
        ?>
        <p><label>Заголовок (EN):</label><br><input type="text" name="rz_title_en" value="<?php echo esc_attr($title_en); ?>" class="large-text"></p>
        <p><label>Опис (EN):</label><br><textarea name="rz_desc_en" class="large-text" rows="3"><?php echo esc_textarea($desc_en); ?></textarea></p>
        <p><label>How it works (EN):</label><br><textarea name="rz_how_it_works_en" class="large-text" rows="3"><?php echo esc_textarea($how_en); ?></textarea></p>
        <p><label>Expected results (EN):</label><br><textarea name="rz_results_en" class="large-text" rows="3"><?php echo esc_textarea($results_en); ?></textarea></p>
        <p><label>Indications (EN):</label><br><textarea name="rz_indications_en" class="large-text" rows="3"><?php echo esc_textarea($ind_en); ?></textarea></p>
        <p><label>Contraindications (EN):</label><br><textarea name="rz_contraindications_en" class="large-text" rows="2"><?php echo esc_textarea($contra_en); ?></textarea></p>
        <hr>
        <p><label>Duration (EN) (e.g., 45 min):</label><br><input type="text" name="rz_duration_en" value="<?php echo esc_attr(get_post_meta($post->ID, '_rz_duration_en', true)); ?>" class="regular-text"></p>
        <p><label>Price: Single (EN) (e.g., 900 UAH):</label><br><input type="text" name="rz_price_en" value="<?php echo esc_attr(get_post_meta($post->ID, '_rz_price_en', true)); ?>" class="regular-text"></p>
        <p><label>Price: Consultation (EN):</label><br><input type="text" name="rz_price_consultation_en" value="<?php echo esc_attr(get_post_meta($post->ID, '_rz_price_consultation_en', true)); ?>" class="regular-text"></p>
        <p><label>Price: 5 Sessions (EN):</label><br><input type="text" name="rz_price_5_en" value="<?php echo esc_attr(get_post_meta($post->ID, '_rz_price_5_en', true)); ?>" class="regular-text"></p>
        <p><label>Price: 10 Sessions (EN):</label><br><input type="text" name="rz_price_10_en" value="<?php echo esc_attr(get_post_meta($post->ID, '_rz_price_10_en', true)); ?>" class="regular-text"></p>
        <?php
    }, 'rz_service', 'normal', 'high');

    add_meta_box('rz_service_details', 'Деталі послуги (UKR)', function($post) {
        $how_it_works = get_post_meta($post->ID, '_rz_how_it_works', true);
        $results = get_post_meta($post->ID, '_rz_results', true);
        $indications = get_post_meta($post->ID, '_rz_indications', true);
        $contraindications = get_post_meta($post->ID, '_rz_contraindications', true);
        ?>
        <p><label>Як працює:</label><br><textarea name="rz_how_it_works" class="large-text" rows="5"><?php echo esc_textarea($how_it_works); ?></textarea></p>
        <p><label>Очікувані результати:</label><br><textarea name="rz_results" class="large-text" rows="5"><?php echo esc_textarea($results); ?></textarea></p>
        <p><label>Показання:</label><br><textarea name="rz_indications" class="large-text" rows="5"><?php echo esc_textarea($indications); ?></textarea></p>
        <p><label>Протипоказання:</label><br><textarea name="rz_contraindications" class="large-text" rows="3"><?php echo esc_textarea($contraindications); ?></textarea></p>
        <hr>
        <p><label>Тривалість (напр. 45 хв):</label><br><input type="text" name="rz_duration" value="<?php echo esc_attr(get_post_meta($post->ID, '_rz_duration', true)); ?>" class="regular-text"></p>
        <p><label>Вартість заняття (напр. 900 грн):</label><br><input type="text" name="rz_price" value="<?php echo esc_attr(get_post_meta($post->ID, '_rz_price', true)); ?>" class="regular-text"></p>
        <p><label>Вартість консультації:</label><br><input type="text" name="rz_price_consultation" value="<?php echo esc_attr(get_post_meta($post->ID, '_rz_price_consultation', true)); ?>" class="regular-text"></p>
        <p><label>Абонемент 5 занять:</label><br><input type="text" name="rz_price_5" value="<?php echo esc_attr(get_post_meta($post->ID, '_rz_price_5', true)); ?>" class="regular-text"></p>
        <p><label>Абонемент 10 занять:</label><br><input type="text" name="rz_price_10" value="<?php echo esc_attr(get_post_meta($post->ID, '_rz_price_10', true)); ?>" class="regular-text"></p>
        <?php
    }, 'rz_service', 'normal', 'high');

    add_meta_box('rz_subscription_details', 'Деталі абонемента', function($post) {
        $price = get_post_meta($post->ID, '_rz_sub_price', true);
        $price_en = get_post_meta($post->ID, '_rz_sub_price_en', true);
        $duration = get_post_meta($post->ID, '_rz_sub_duration', true);
        $duration_en = get_post_meta($post->ID, '_rz_sub_duration_en', true);
        $features = get_post_meta($post->ID, '_rz_sub_features', true);
        $features_en = get_post_meta($post->ID, '_rz_sub_features_en', true);
        ?>
        <p><label>Ціна (UA):</label><br><input type="text" name="rz_sub_price" value="<?php echo esc_attr($price); ?>" class="regular-text"></p>
        <p><label>Ціна (EN):</label><br><input type="text" name="rz_sub_price_en" value="<?php echo esc_attr($price_en); ?>" class="regular-text"></p>
        <p><label>Тривалість/К-сть занять (UA):</label><br><input type="text" name="rz_sub_duration" value="<?php echo esc_attr($duration); ?>" class="regular-text"></p>
        <p><label>Duration/Sessions (EN):</label><br><input type="text" name="rz_sub_duration_en" value="<?php echo esc_attr($duration_en); ?>" class="regular-text"></p>
        <p><label>Особливості (по одній на рядок, UA):</label><br><textarea name="rz_sub_features" class="large-text" rows="5"><?php echo esc_textarea($features); ?></textarea></p>
        <p><label>Features (one per line, EN):</label><br><textarea name="rz_sub_features_en" class="large-text" rows="5"><?php echo esc_textarea($features_en); ?></textarea></p>
        <?php
    }, 'rz_subscription', 'normal', 'high');
}
add_action('add_meta_boxes', 'rz_rehab_add_meta_boxes');

function rz_rehab_save_meta_boxes($post_id) {
    $fields = [
        'rz_title_en', 'rz_desc_en', 
        'rz_how_it_works_en', 'rz_results_en', 'rz_indications_en', 'rz_contraindications_en',
        'rz_duration_en', 'rz_price_en', 'rz_price_consultation_en', 'rz_price_5_en', 'rz_price_10_en',
        'rz_how_it_works', 'rz_results', 'rz_indications', 'rz_contraindications',
        'rz_duration', 'rz_price', 'rz_price_consultation', 'rz_price_5', 'rz_price_10',
        'rz_sub_price', 'rz_sub_price_en', 'rz_sub_duration', 'rz_sub_duration_en', 'rz_sub_features', 'rz_sub_features_en'
    ];
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, wp_kses_post($_POST[$field]));
        }
    }
}
add_action('save_post', 'rz_rehab_save_meta_boxes');

/**
 * Customizer Settings
 */
function rz_rehab_customize_register( $wp_customize ) {
    // Hero Section
    $wp_customize->add_section( 'rz_hero_section' , array(
        'title'      => 'Головний екран (Hero)',
        'priority'   => 30,
    ) );

    $hero_fields = [
        'rz_hero_title_uk' => 'Заголовок (UKR)',
        'rz_hero_title_en' => 'Заголовок (ENG)',
        'rz_hero_desc_uk' => 'Опис (UKR)',
        'rz_hero_desc_en' => 'Опис (ENG)',
    ];

    foreach ($hero_fields as $id => $label) {
        $wp_customize->add_setting( $id, array('default' => '', 'type' => 'option') );
        $wp_customize->add_control( $id, array(
            'label'    => $label,
            'section'  => 'rz_hero_section',
            'type'     => strpos($id, 'desc') !== false || strpos($id, 'title') !== false ? 'textarea' : 'text',
        ) );
    }

    // About Section
    $wp_customize->add_section( 'rz_about_section' , array(
        'title'      => 'Про нас (About)',
        'priority'   => 35,
    ) );

    $about_fields = [
        'rz_about_lead_uk' => 'Лід-текст (UKR)',
        'rz_about_lead_en' => 'Лід-текст (ENG)',
        'rz_about_text_uk' => 'Основний текст (UKR)',
        'rz_about_text_en' => 'Основний текст (ENG)',
    ];

    foreach ($about_fields as $id => $label) {
        $wp_customize->add_setting( $id, array('default' => '', 'type' => 'option') );
        $wp_customize->add_control( $id, array(
            'label'    => $label,
            'section'  => 'rz_about_section',
            'type'     => strpos($id, 'text') !== false ? 'textarea' : 'text',
        ) );
    }

    // Services Section Settings
    $wp_customize->add_section( 'rz_services_section' , array(
        'title'      => 'Наші послуги (Services Section)',
        'priority'   => 32,
    ) );

    $services_fields = [
        'rz_services_title_uk' => 'Заголовок секції (UKR)',
        'rz_services_title_en' => 'Заголовок секції (ENG)',
        'rz_services_desc_uk' => 'Підзаголовок/Опис (UKR)',
        'rz_services_desc_en' => 'Підзаголовок/Опис (ENG)',
    ];

    foreach ($services_fields as $id => $label) {
        $wp_customize->add_setting( $id, array('default' => '', 'type' => 'option') );
        $wp_customize->add_control( $id, array(
            'label'    => $label,
            'section'  => 'rz_services_section',
            'type'     => strpos($id, 'desc') !== false ? 'textarea' : 'text',
        ) );
    }

    // Social Media Section
    $wp_customize->add_section( 'rz_social_section' , array(
        'title'      => 'Соціальні мережі',
        'priority'   => 40,
    ) );

    $social_links = [
        'rz_social_instagram' => 'Instagram URL',
        'rz_social_facebook' => 'Facebook URL',
        'rz_social_telegram' => 'Telegram URL',
        'rz_social_youtube' => 'YouTube URL',
        'rz_social_tiktok' => 'TikTok URL',
    ];

    foreach ($social_links as $id => $label) {
        $wp_customize->add_setting( $id, array('default' => '', 'type' => 'option') );
        $wp_customize->add_control( $id, array(
            'label'    => $label,
            'section'  => 'rz_social_section',
            'type'     => 'url',
        ) );
    }

    // Contact Info Section
    $wp_customize->add_section( 'rz_contact_section' , array(
        'title'      => 'Контактна інформація',
        'priority'   => 45,
    ) );

    $contact_fields = [
        'rz_phone_1' => 'Телефон 1',
        'rz_phone_2' => 'Телефон 2',
        'rz_email' => 'Email',
        'rz_address_uk' => 'Адреса (УКР)',
        'rz_address_en' => 'Адреса (ENG)',
        'rz_edrpou' => 'ЄДРПОУ',
    ];

    foreach ($contact_fields as $id => $label) {
        $wp_customize->add_setting( $id, array('default' => '', 'type' => 'option') );
        $wp_customize->add_control( $id, array(
            'label'    => $label,
            'section'  => 'rz_contact_section',
            'type'     => 'text',
        ) );
    }
}
add_action( 'customize_register', 'rz_rehab_customize_register' );

/**
 * Custom Settings for Site Data
 */
function rz_rehab_settings_init() {
    // Register settings
    register_setting('general', 'rz_phone_1');
    register_setting('general', 'rz_phone_2');
    register_setting('general', 'rz_email');
    register_setting('general', 'rz_address_uk');
    register_setting('general', 'rz_address_en');
    register_setting('general', 'rz_edrpou');
    register_setting('general', 'rz_inbox_email');
    register_setting('general', 'rz_tg_token');
    register_setting('general', 'rz_tg_chat_id');
    register_setting('general', 'rz_maintenance_mode');
    register_setting('general', 'rz_maintenance_password');
    
    // Hero Settings
    register_setting('general', 'rz_hero_title_uk');
    register_setting('general', 'rz_hero_title_en');
    register_setting('general', 'rz_hero_desc_uk');
    register_setting('general', 'rz_hero_desc_en');

    // About Settings
    register_setting('general', 'rz_about_lead_uk');
    register_setting('general', 'rz_about_lead_en');
    register_setting('general', 'rz_about_text_uk');
    register_setting('general', 'rz_about_text_en');

    // Add fields
    add_settings_section('rz_rehab_section', 'Налаштування RZ Rehab', null, 'general');

    // Hero Fields
    add_settings_field('rz_hero_title_uk', 'Hero Заголовок (УКР)', function() {
        echo '<textarea name="rz_hero_title_uk" class="large-text" rows="2">' . esc_textarea(get_option('rz_hero_title_uk')) . '</textarea>';
    }, 'general', 'rz_rehab_section');
    add_settings_field('rz_hero_title_en', 'Hero Заголовок (ENG)', function() {
        echo '<textarea name="rz_hero_title_en" class="large-text" rows="2">' . esc_textarea(get_option('rz_hero_title_en')) . '</textarea>';
    }, 'general', 'rz_rehab_section');
    add_settings_field('rz_hero_desc_uk', 'Hero Опис (УКР)', function() {
        echo '<textarea name="rz_hero_desc_uk" class="large-text" rows="3">' . esc_textarea(get_option('rz_hero_desc_uk')) . '</textarea>';
    }, 'general', 'rz_rehab_section');
    add_settings_field('rz_hero_desc_en', 'Hero Опис (ENG)', function() {
        echo '<textarea name="rz_hero_desc_en" class="large-text" rows="3">' . esc_textarea(get_option('rz_hero_desc_en')) . '</textarea>';
    }, 'general', 'rz_rehab_section');

    // About Fields
    add_settings_field('rz_about_lead_uk', 'Про нас: Лід (УКР)', function() {
        echo '<input type="text" name="rz_about_lead_uk" value="' . esc_attr(get_option('rz_about_lead_uk')) . '" class="regular-text">';
    }, 'general', 'rz_rehab_section');
    add_settings_field('rz_about_lead_en', 'Про нас: Лід (ENG)', function() {
        echo '<input type="text" name="rz_about_lead_en" value="' . esc_attr(get_option('rz_about_lead_en')) . '" class="regular-text">';
    }, 'general', 'rz_rehab_section');
    add_settings_field('rz_about_text_uk', 'Про нас: Текст (УКР)', function() {
        echo '<textarea name="rz_about_text_uk" class="large-text" rows="5">' . esc_textarea(get_option('rz_about_text_uk')) . '</textarea>';
    }, 'general', 'rz_rehab_section');
    add_settings_field('rz_about_text_en', 'Про нас: Текст (ENG)', function() {
        echo '<textarea name="rz_about_text_en" class="large-text" rows="5">' . esc_textarea(get_option('rz_about_text_en')) . '</textarea>';
    }, 'general', 'rz_rehab_section');

    // Contact Fields
    add_settings_field('rz_phone_1', 'Телефон 1', function() {
        echo '<input type="text" name="rz_phone_1" value="' . esc_attr(get_option('rz_phone_1')) . '" class="regular-text">';
    }, 'general', 'rz_rehab_section');

    add_settings_field('rz_phone_2', 'Телефон 2', function() {
        echo '<input type="text" name="rz_phone_2" value="' . esc_attr(get_option('rz_phone_2')) . '" class="regular-text">';
    }, 'general', 'rz_rehab_section');

    add_settings_field('rz_email', 'Email', function() {
        echo '<input type="email" name="rz_email" value="' . esc_attr(get_option('rz_email')) . '" class="regular-text">';
    }, 'general', 'rz_rehab_section');

    add_settings_field('rz_address_uk', 'Адреса (УКР)', function() {
        echo '<input type="text" name="rz_address_uk" value="' . esc_attr(get_option('rz_address_uk')) . '" class="regular-text">';
    }, 'general', 'rz_rehab_section');

    add_settings_field('rz_address_en', 'Адреса (ENG)', function() {
        echo '<input type="text" name="rz_address_en" value="' . esc_attr(get_option('rz_address_en')) . '" class="regular-text">';
    }, 'general', 'rz_rehab_section');

    add_settings_field('rz_edrpou', 'ЄДРПОУ', function() {
        echo '<input type="text" name="rz_edrpou" value="' . esc_attr(get_option('rz_edrpou')) . '" class="regular-text">';
    }, 'general', 'rz_rehab_section');

    add_settings_field('rz_inbox_email', 'Email для заявок', function() {
        $val = get_option('rz_inbox_email');
        if (empty($val)) $val = get_option('admin_email');
        echo '<input type="email" name="rz_inbox_email" value="' . esc_attr($val) . '" class="regular-text">';
        echo '<p class="description">Сюди будуть приходити повідомлення з форми запису.</p>';
    }, 'general', 'rz_rehab_section');

    add_settings_field('rz_tg_token', 'Telegram Bot Token', function() {
        echo '<input type="password" name="rz_tg_token" value="' . esc_attr(get_option('rz_tg_token')) . '" class="regular-text">';
        echo '<p class="description">Токен вашого бота від @BotFather.</p>';
    }, 'general', 'rz_rehab_section');

    add_settings_field('rz_tg_chat_id', 'Telegram Chat ID', function() {
        echo '<input type="text" name="rz_tg_chat_id" value="' . esc_attr(get_option('rz_tg_chat_id')) . '" class="regular-text">';
        echo '<p class="description">ID чату або групи (отримайте через @userinfobot або аналогічні).</p>';
    }, 'general', 'rz_rehab_section');

    add_settings_field('rz_maintenance_mode', 'Режим заглушки (Coming Soon)', function() {
        $checked = get_option('rz_maintenance_mode') ? 'checked' : '';
        echo '<label><input type="checkbox" name="rz_maintenance_mode" value="1" ' . $checked . '> Увімкнути заглушку для всіх, крім адміністраторів</label>';
    }, 'general', 'rz_rehab_section');

    add_settings_field('rz_maintenance_password', 'Пароль доступу до заглушки', function() {
        echo '<input type="text" name="rz_maintenance_password" value="' . esc_attr(get_option('rz_maintenance_password')) . '" class="regular-text">';
        echo '<p class="description">Пароль, який дозволить побачити сайт без входу в адмінку.</p>';
    }, 'general', 'rz_rehab_section');

    // Social Media Settings
    register_setting('general', 'rz_social_instagram');
    register_setting('general', 'rz_social_facebook');
    register_setting('general', 'rz_social_telegram');
    register_setting('general', 'rz_social_youtube');
    register_setting('general', 'rz_social_tiktok');

    add_settings_field('rz_social_instagram', 'Instagram URL', function() {
        echo '<input type="url" name="rz_social_instagram" value="' . esc_attr(get_option('rz_social_instagram')) . '" class="regular-text">';
    }, 'general', 'rz_rehab_section');

    add_settings_field('rz_social_facebook', 'Facebook URL', function() {
        echo '<input type="url" name="rz_social_facebook" value="' . esc_attr(get_option('rz_social_facebook')) . '" class="regular-text">';
    }, 'general', 'rz_rehab_section');

    add_settings_field('rz_social_telegram', 'Telegram URL', function() {
        echo '<input type="url" name="rz_social_telegram" value="' . esc_attr(get_option('rz_social_telegram')) . '" class="regular-text">';
    }, 'general', 'rz_rehab_section');

    add_settings_field('rz_social_youtube', 'YouTube URL', function() {
        echo '<input type="url" name="rz_social_youtube" value="' . esc_attr(get_option('rz_social_youtube')) . '" class="regular-text">';
    }, 'general', 'rz_rehab_section');

    add_settings_field('rz_social_tiktok', 'TikTok URL', function() {
        echo '<input type="url" name="rz_social_tiktok" value="' . esc_attr(get_option('rz_social_tiktok')) . '" class="regular-text">';
    }, 'general', 'rz_rehab_section');
}
add_action('admin_init', 'rz_rehab_settings_init');

function rz_rehab_scripts() {
    $version = time(); // Dynamic version to bust cache during transfer
    wp_enqueue_style( 'rz-rehab-style', get_stylesheet_uri(), array(), $version );
    wp_enqueue_script( 'rz-rehab-scripts', get_template_directory_uri() . '/js/main.js', array(), $version, true );
}
add_action( 'wp_enqueue_scripts', 'rz_rehab_scripts' );

/**
 * Theme Sections Functions
 */

function rz_render_hero() {
    $title = get_option('rz_hero_title_' . rz_get_lang(), rz_t('Відновлення, що дарує майбутнє', 'Restoration that gives a future'));
    $desc = get_option('rz_hero_desc_' . rz_get_lang(), rz_t('Ми поєднуємо медичну реабілітацію, психологічну підтримку та корекційно-розвивальні методики.', 'We combine medical rehabilitation, psychological support, and correctional-developmental methods.'));
    ?>
    <section class="hero">
        <div class="container">
            <div class="hero-logo-large animate-up">
                <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="RZ Rehab Logo">
            </div>
            <div class="hero-grid">
                <div class="hero-content animate-up">
                    <h1><?php echo $title; ?></h1>
                <p><?php echo $desc; ?></p>
                <div class="hero-btns">
                    <a href="#services" class="btn"><?php echo rz_t('Наші послуги', 'Our Services'); ?></a>
                    <a href="#contacts" class="btn btn-secondary"><?php echo rz_t('Контакти', 'Contacts'); ?></a>
                </div>
            </div>
            <div class="hero-visual animate-up delay-1">
                <img src="<?php echo get_template_directory_uri(); ?>/images/social_adaptation_group.png" alt="Відновлення та розвиток" class="hero-img">
            </div>
        </div>
    </section>
    <?php
}

function rz_render_services() {
    $section_title = get_option('rz_services_title_' . rz_get_lang(), rz_t('Наші послуги', 'Our Services'));
    $section_desc = get_option('rz_services_desc_' . rz_get_lang(), '');
    
    $args = array(
        'post_type' => 'rz_service',
        'posts_per_page' => -1,
        'order' => 'ASC'
    );
    $query = new WP_Query($args);
    ?>
    <section id="services" class="services">
        <div class="container">
            <div class="section-header">
                <h2><?php echo $section_title; ?></h2>
                <?php if ($section_desc) : ?>
                    <p class="section-subtitle"><?php echo $section_desc; ?></p>
                <?php endif; ?>
                <div class="accent-line"></div>
            </div>
            <div class="services-grid">
                <?php 
                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post(); 
                        $id = get_the_ID();
                        $is_en = (rz_get_lang() === 'en');
                        
                        $title_en = get_post_meta($id, '_rz_title_en', true);
                        $desc_en = get_post_meta($id, '_rz_desc_en', true);
                        
                        $how_it_works = $is_en ? get_post_meta($id, '_rz_how_it_works_en', true) : get_post_meta($id, '_rz_how_it_works', true);
                        if ($is_en && empty($how_it_works)) $how_it_works = get_post_meta($id, '_rz_how_it_works', true);
                        
                        $results = $is_en ? get_post_meta($id, '_rz_results_en', true) : get_post_meta($id, '_rz_results', true);
                        if ($is_en && empty($results)) $results = get_post_meta($id, '_rz_results', true);
                        
                        $indications = $is_en ? get_post_meta($id, '_rz_indications_en', true) : get_post_meta($id, '_rz_indications', true);
                        if ($is_en && empty($indications)) $indications = get_post_meta($id, '_rz_indications', true);
                        
                        $contra = $is_en ? get_post_meta($id, '_rz_contraindications_en', true) : get_post_meta($id, '_rz_contraindications', true);
                        if ($is_en && empty($contra)) $contra = get_post_meta($id, '_rz_contraindications', true);

                        $img_file = get_post_meta($id, '_rz_image', true);

                        $title = rz_get_lang() === 'en' && !empty($title_en) ? $title_en : get_the_title();
                        $desc = rz_get_lang() === 'en' && !empty($desc_en) ? $desc_en : get_the_excerpt();
                        ?>
                        <div class="service-card animate-up">
                            <div class="service-image">
                                <?php if (has_post_thumbnail()) : the_post_thumbnail('large'); 
                                      elseif (!empty($img_file)) : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo esc_attr($img_file); ?>" alt="<?php echo esc_attr($title); ?>">
                                <?php else : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/physical_therapy.png" alt="">
                                <?php endif; ?>
                            </div>
                            <div class="service-content">
                                <h3><?php echo $title; ?></h3>
                                <p><?php echo $desc; ?></p>
                                <a href="#" class="read-more"><?php echo rz_t('Детальніше', 'Learn More'); ?> <span>&rarr;</span></a>
                                
                                <div class="service-details-hidden" style="display: none;">
                                    <?php if ($how_it_works) : ?>
                                        <h4><?php echo rz_t('Як працює', 'How it works'); ?></h4>
                                        <p><?php echo nl2br(esc_html($how_it_works)); ?></p>
                                    <?php endif; ?>
                                    
                                    <?php if ($results) : ?>
                                        <h4><?php echo rz_t('Очікувані результати', 'Expected results'); ?></h4>
                                        <p><?php echo nl2br(esc_html($results)); ?></p>
                                    <?php endif; ?>
                                    
                                    <?php if ($indications) : ?>
                                        <h4><?php echo rz_t('Показання', 'Indications'); ?></h4>
                                        <p><?php echo nl2br(esc_html($indications)); ?></p>
                                    <?php endif; ?>
                                    
                                    <?php if ($contra) : ?>
                                        <h4><?php echo rz_t('Протипоказання', 'Contraindications'); ?></h4>
                                        <p><?php echo nl2br(esc_html($contra)); ?></p>
                                    <?php endif; ?>

                                    <div class="service-modal-prices">
                                        <h4><?php echo rz_t('Вартість', 'Pricing'); ?></h4>
                                        <ul class="modal-price-list">
                                            <?php 
                                            $p_cons = $is_en ? get_post_meta($id, '_rz_price_consultation_en', true) : get_post_meta($id, '_rz_price_consultation', true);
                                            $p_sess = $is_en ? get_post_meta($id, '_rz_price_en', true) : get_post_meta($id, '_rz_price', true);
                                            $p_5 = $is_en ? get_post_meta($id, '_rz_price_5_en', true) : get_post_meta($id, '_rz_price_5', true);
                                            $p_10 = $is_en ? get_post_meta($id, '_rz_price_10_en', true) : get_post_meta($id, '_rz_price_10', true);
                                            
                                            if ($p_cons) echo '<li><strong>' . rz_t('Консультація', 'Consultation') . ':</strong> ' . esc_html($p_cons) . '</li>';
                                            if ($p_sess) echo '<li><strong>' . rz_t('Разове заняття', 'Single Session') . ':</strong> ' . esc_html($p_sess) . '</li>';
                                            if ($p_5) echo '<li><strong>' . rz_t('Абонемент 5 занять', '5-Session Pack') . ':</strong> ' . esc_html($p_5) . '</li>';
                                            if ($p_10) echo '<li><strong>' . rz_t('Абонемент 10 занять', '10-Session Pack') . ':</strong> ' . esc_html($p_10) . '</li>';
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php 
                    endwhile;
                    wp_reset_postdata();
                else: 
                    echo '<p style="text-align:center;">' . rz_t('Будь ласка, додайте послуги в адмін-панелі.', 'Please add services in the admin panel.') . '</p>';
                endif; 
                ?>
            </div>
        </div>
    </section>
    <?php
}

function rz_render_about() {
    $lead = get_option('rz_about_lead_' . rz_get_lang(), rz_t('Ваша впевненість та радість життя — наша головна мета.', 'Your confidence and joy of life is our main goal.'));
    $text = get_option('rz_about_text_' . rz_get_lang(), rz_t('Ми поєднуємо медичну реабілітацію, психологічну підтримку та корекційно-розвивальні методики, щоб люди повертали рух, мовлення, впевненість і радість життя. У нас працюють досвідчені фахівці, а кожна програма — індивідуальна, м’яка та ефективна.', 'We combine medical rehabilitation, psychological support and correctional-developmental methods so that people return to movement, speech, confidence and joy of life. We have experienced specialists, and each program is individual, soft and effective.'));
    ?>
    <section id="about" class="about bg-accent">
        <div class="container">
            <div class="about-flex">
                <div class="about-text animate-up">
                    <div class="section-header" style="text-align: left;">
                        <h2><?php echo rz_t('Про нас', 'About Us'); ?></h2>
                        <div class="accent-line" style="margin: 0;"></div>
                    </div>
                    <p class="lead"><?php echo $lead; ?></p>
                    <p><?php echo nl2br($text); ?></p>
                    
                    <div class="strengths">
                        <div class="strength-item">
                            <h4><?php echo rz_t('Наші сильні сторони', 'Our Strengths'); ?></h4>
                            <ul>
                                <li><?php echo rz_t('Міжнародна сертифікація фахівців (Бобат, Войта-терапія)', 'International specialist certification (Bobath, Vojta)'); ?></li>
                                <li><?php echo rz_t('Дитячий ігровий простір для занять', 'Children\'s play space for sessions'); ?></li>
                                <li><?php echo rz_t('Індивідуальні програми для будь-якого віку', 'Individual programs for all ages'); ?></li>
                            </ul>
                        </div>
                        <div class="strength-item">
                            <h4><?php echo rz_t('Наш підхід', 'Our Approach'); ?></h4>
                            <p><?php echo rz_t('Ми віримо, що реабілітація має бути не лише ефективною, а й цікавою для дітей та комфортною для дорослих.', 'We believe that rehabilitation should be not only effective but also interesting for children and comfortable for adults.'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="about-reviews animate-up">
                    <h3><?php echo rz_t('Відгуки клієнтів', 'Reviews'); ?></h3>
                    <div class="review-card">
                        <p><?php echo rz_t('"Дуже вдячна за допомогу! Поставили на ноги за два місяці після складної операції."', '"Very grateful for the help! Recovered in two months after a complex surgery."'); ?></p>
                        <cite>— <?php echo rz_t('Олена М.', 'Olena M.'); ?></cite>
                    </div>
                    <div class="review-card">
                        <p><?php echo rz_t('"Мій син із задоволенням ходить на заняття з сенсорної інтеграції. Результат помітно вже за місяць!"', '"My son enjoys sensory integration sessions. The result is visible in a month!"'); ?></p>
                        <cite>— <?php echo rz_t('Тетяна К.', 'Tetiana K.'); ?></cite>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}

function rz_render_pricing() {
    $is_en = (rz_get_lang() === 'en');
    
    // Services Query
    $args_services = array(
        'post_type' => 'rz_service',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'meta_query' => array(array('key' => '_rz_price', 'value' => '', 'compare' => '!='))
    );
    $query_services = new WP_Query($args_services);

    // Subscriptions Query
    $args_subs = array(
        'post_type' => 'rz_subscription',
        'posts_per_page' => -1,
        'order' => 'ASC'
    );
    $query_subs = new WP_Query($args_subs);
    ?>
    <section id="prices" class="prices">
        <div class="container">
            <div class="section-header">
                <h2><?php echo rz_t('Ціни', 'Prices'); ?></h2>
                <div class="accent-line"></div>
            </div>

            <!-- Single Services Table -->
            <div class="price-table-wrapper animate-up">
                <h3><?php echo rz_t('Разові заняття', 'Single Sessions'); ?></h3>
                <table class="price-table">
                    <thead>
                        <tr>
                            <th><?php echo rz_t('Послуга', 'Service'); ?></th>
                            <th><?php echo rz_t('Тривалість', 'Duration'); ?></th>
                            <th><?php echo rz_t('Консультація', 'Consultation'); ?></th>
                            <th><?php echo rz_t('Заняття', 'Session'); ?></th>
                            <th><?php echo rz_t('5 занять', '5 Sessions'); ?></th>
                            <th><?php echo rz_t('10 занять', '10 Sessions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if ($query_services->have_posts()) :
                            while ($query_services->have_posts()) : $query_services->the_post(); 
                                $id = get_the_ID();
                                $title_en = get_post_meta($id, '_rz_title_en', true);
                                $title = ($is_en && !empty($title_en)) ? $title_en : get_the_title();
                                $duration = $is_en ? get_post_meta($id, '_rz_duration_en', true) : get_post_meta($id, '_rz_duration', true);
                                if ($is_en && empty($duration)) $duration = get_post_meta($id, '_rz_duration', true);
                                $price = $is_en ? get_post_meta($id, '_rz_price_en', true) : get_post_meta($id, '_rz_price', true);
                                if ($is_en && empty($price)) $price = get_post_meta($id, '_rz_price', true);
                                ?>
                                <tr>
                                    <td data-label="<?php echo rz_t('Послуга', 'Service'); ?>"><?php echo esc_html($title); ?></td>
                                    <td data-label="<?php echo rz_t('Тривалість', 'Duration'); ?>"><?php echo esc_html($duration); ?></td>
                                    <td data-label="<?php echo rz_t('Консультація', 'Consultation'); ?>"><?php echo esc_html($is_en ? get_post_meta($id, '_rz_price_consultation_en', true) : get_post_meta($id, '_rz_price_consultation', true)); ?></td>
                                    <td data-label="<?php echo rz_t('Заняття', 'Session'); ?>"><?php echo esc_html($price); ?></td>
                                    <td data-label="<?php echo rz_t('5 занять', '5 Sessions'); ?>"><?php echo esc_html($is_en ? get_post_meta($id, '_rz_price_5_en', true) : get_post_meta($id, '_rz_price_5', true)); ?></td>
                                    <td data-label="<?php echo rz_t('10 занять', '10 Sessions'); ?>"><?php echo esc_html($is_en ? get_post_meta($id, '_rz_price_10_en', true) : get_post_meta($id, '_rz_price_10', true)); ?></td>
                                </tr>
                            <?php 
                            endwhile;
                            wp_reset_postdata();
                        endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Subscriptions Grid -->
            <?php if ($query_subs->have_posts()) : ?>
            <div class="subscriptions-section mt-5 animate-up">
                <h3 class="text-center mb-4"><?php echo rz_t('Вигідні абонементи', 'Special Subscriptions'); ?></h3>
                <div class="subscriptions-grid">
                    <?php 
                    while ($query_subs->have_posts()) : $query_subs->the_post(); 
                        $id = get_the_ID();
                        $price = $is_en ? get_post_meta($id, '_rz_sub_price_en', true) : get_post_meta($id, '_rz_sub_price', true);
                        if ($is_en && empty($price)) $price = get_post_meta($id, '_rz_sub_price', true);
                        
                        $duration = $is_en ? get_post_meta($id, '_rz_sub_duration_en', true) : get_post_meta($id, '_rz_sub_duration', true);
                        if ($is_en && empty($duration)) $duration = get_post_meta($id, '_rz_sub_duration', true);
                        
                        $features_raw = $is_en ? get_post_meta($id, '_rz_sub_features_en', true) : get_post_meta($id, '_rz_sub_features', true);
                        if ($is_en && empty($features_raw)) $features_raw = get_post_meta($id, '_rz_sub_features', true);
                        $features = array_filter(explode("\n", str_replace("\r", "", $features_raw)));
                        ?>
                        <div class="sub-card">
                            <div class="sub-header">
                                <h4><?php the_title(); ?></h4>
                                <div class="sub-price"><?php echo esc_html($price); ?></div>
                                <div class="sub-duration"><?php echo esc_html($duration); ?></div>
                            </div>
                            <ul class="sub-features">
                                <?php foreach ($features as $feature) : ?>
                                    <li><span class="check">✓</span> <?php echo esc_html(trim($feature)); ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <a href="#contacts" class="btn btn-sm btn-outline"><?php echo rz_t('Замовити', 'Order Now'); ?></a>
                        </div>
                    <?php 
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>
    <?php
}

/**
 * Service Seeder for initial content
 */
function rz_rehab_seed_content() {
    if (get_option('rz_content_seeded_v2_1')) return;

    // Cleanup previous services to ensure strict list match
    $existing_posts = get_posts(['post_type' => 'rz_service', 'numberposts' => -1]); 
    foreach ($existing_posts as $p) wp_delete_post($p->ID, true);

    // Seed Front Page Settings (Previous text retained as fallback, handled by v2 update function for About)
    
    $services = [
        [
            'title' => 'SOUNDSORY',
            'title_en' => 'SOUNDSORY',
            'desc' => 'Інноваційна гарнітура, що поєднує мультисенсорні методики для розвитку рухових, когнітивних та мовних навичок.',
            'desc_en' => 'An innovative headset combining multi-sensory techniques for developing motor, cognitive, and language skills.',
            'how' => 'Ритм, музика, система повітряної та кісткової провідності.',
            'how_en' => 'Rhythm, music, air and bone conduction system.',
            'results' => 'Покращення концентрації, нейромоторна зрілість, інтеграція рефлексів.',
            'results_en' => 'Improved concentration, neuromotor maturity, reflex integration.',
            'indications' => 'ЗМР, ЗПМР, СДУГ, Алалія, Дислексія, Дискалькулія.',
            'indications_en' => 'Speech delay, psychomotor delay, ADHD, Alalia, Dyslexia, Dyscalculia.',
            'contra' => 'Відсутні.',
            'contra_en' => 'None.',
            'duration' => '30 хв',
            'duration_en' => '30 min',
            'price' => 'По запиту',
            'price_en' => 'On request',
            'img' => 'soundsory_therapy.png'
        ],
        [
            'title' => 'Мозочкова стимуляція',
            'title_en' => 'Cerebellar Stimulation',
            'desc' => 'Комплекс вправ на активацію функцій мозочка та базальних гангліїв.',
            'desc_en' => 'A set of exercises to activate cerebellar functions and basal ganglia.',
            'how' => 'Балансувальні дошки, інтерактивні платформи, вправи Більгоу.',
            'how_en' => 'Balancing boards, interactive platforms, Belgau exercises.',
            'results' => 'Розвиток міжпівкульових зв’язків, стабілізація вестибулярної системи, покращення координації.',
            'results_en' => 'Development of interhemispheric connections, vestibular stabilization, improved coordination.',
            'indications' => 'СДУГ, порушення координації, дислексія, РАС, ДЦП.',
            'indications_en' => 'ADHD, coordination disorders, dyslexia, ASD, CP.',
            'contra' => 'Відсутні.',
            'contra_en' => 'None.',
            'duration' => '45 хв',
            'duration_en' => '45 min',
            'price' => '850 грн',
            'price_en' => '850 UAH',
            'img' => 'cerebellar_stimulation.png'
        ],
        [
            'title' => 'Краніосакральна терапія (КСТ)',
            'title_en' => 'Craniosacral Therapy (CST)',
            'desc' => 'М’яка мануальна терапія для гармонізації фізичного та емоційного стану.',
            'desc_en' => 'Gentle manual therapy to harmonize physical and emotional state.',
            'how' => 'Активація внутрішніх ресурсів організму, делікатний вплив.',
            'how_en' => 'Activation of body resources, delicate influence.',
            'results' => 'Відчуття легкості, нормалізація нервової системи, покращення емоційного фону.',
            'results_en' => 'Feeling of lightness, nervous system normalization, improved emotional background.',
            'indications' => 'Стрес, депресія, хронічна втома, психосоматика.',
            'indications_en' => 'Stress, depression, chronic fatigue, psychosomatics.',
            'contra' => 'Онкологія, аневризма, гострі тромбози.',
            'contra_en' => 'Oncology, aneurysm, acute thrombosis.',
            'duration' => '45 хв',
            'duration_en' => '45 min',
            'price' => '1200 грн',
            'price_en' => '1200 UAH',
            'img' => 'craniosacral_therapy.png'
        ],
        [
            'title' => 'Ерготерапія',
            'title_en' => 'Ergotherapy',
            'desc' => 'Відновлення навичок для самостійності та активного соціального життя.',
            'desc_en' => 'Restoring skills for independence and active social life.',
            'how' => 'Тренування дрібної моторики, адаптивні техніки, реальні життєві сценарії.',
            'how_en' => 'Fine motor training, adaptive techniques, real-life scenarios.',
            'results' => 'Самостійність у побуті, покращення моторики, соціальна інтеграція.',
            'results_en' => 'Independence in daily life, improved motor skills, social integration.',
            'indications' => 'Затримка розвитку, РАС, інсульти, травми.',
            'indications_en' => 'Developmental delay, ASD, strokes, injuries.',
            'contra' => 'Відсутні.',
            'contra_en' => 'None.',
            'duration' => '60 хв',
            'duration_en' => '60 min',
            'price' => '1100 грн',
            'price_en' => '1100 UAH',
            'img' => 'ergotherapy_european_child.png'
        ],
        [
            'title' => 'Лікувальний масаж',
            'title_en' => 'Medical Massage',
            'desc' => 'Комплексне лікування для нормалізації тонусу та опорно-рухового апарату.',
            'desc_en' => 'Comprehensive treatment for normalizing tone and musculoskeletal system.',
            'how' => 'Лікувальний, рефлекторний, післяопераційний масаж.',
            'how_en' => 'Therapeutic, reflexology, post-operative massage.',
            'results' => 'Зниження болю, розслаблення м’язів, покращення кровообігу.',
            'results_en' => 'Pain reduction, muscle relaxation, improved circulation.',
            'indications' => 'ДЦП, сколіоз, остеохондроз, травми.',
            'indications_en' => 'CP, scoliosis, osteochondrosis, injuries.',
            'contra' => 'Гострі стани, шкірні захворювання.',
            'contra_en' => 'Acute conditions, skin diseases.',
            'duration' => '45 хв',
            'duration_en' => '45 min',
            'price' => '800 грн',
            'price_en' => '800 UAH',
            'img' => 'medical_massage_child.png'
        ],
        [
            'title' => 'Логопед-дефектолог',
            'title_en' => 'Speech Therapist',
            'desc' => 'Діагностика та корекція мовлення та когнітивних навичок.',
            'desc_en' => 'Diagnosis and correction of speech and cognitive skills.',
            'how' => 'Логопедичні масажі (Z-Vibe), постановка звуків, тейпування.',
            'how_en' => 'Logopedic massages (Z-Vibe), sound placement, taping.',
            'results' => 'Чіткість мовлення, розширення словникового запасу.',
            'results_en' => 'Speech clarity, vocabulary expansion.',
            'indications' => 'ЗПР, РАС, СДУГ, інсульти, дислексія.',
            'indications_en' => 'Developmental delay, ASD, ADHD, strokes, dyslexia.',
            'contra' => 'Відсутні.',
            'contra_en' => 'None.',
            'duration' => '45 хв',
            'duration_en' => '45 min',
            'price' => '900 грн',
            'price_en' => '900 UAH',
            'img' => 'speech_therapy_session.png'
        ],
        [
            'title' => 'Арт-терапія',
            'title_en' => 'Art Therapy',
            'desc' => 'Творчість як інструмент вираження емоцій та саморегуляції.',
            'desc_en' => 'Creativity as a tool for emotional expression and self-regulation.',
            'how' => 'Малювання, ліплення, казкотерапія.',
            'how_en' => 'Drawing, modeling, fairy tale therapy.',
            'results' => 'Зниження тривожності, підвищення самооцінки.',
            'results_en' => 'Reduced anxiety, increased self-esteem.',
            'indications' => 'Емоційні труднощі, стрес, РАС.',
            'indications_en' => 'Emotional difficulties, stress, ASD.',
            'contra' => 'Відсутні.',
            'contra_en' => 'None.',
            'duration' => '60 хв',
            'duration_en' => '60 min',
            'price' => '850 грн',
            'price_en' => '850 UAH',
            'img' => 'art_therapy_child.png'
        ],
        [
            'title' => 'Пісочна терапія',
            'title_en' => 'Sand Therapy',
            'desc' => 'Сенсорна та арт-терапія через гру з піском.',
            'desc_en' => 'Sensory and art therapy through sand play.',
            'how' => 'Сюжетні ігри в пісочниці.',
            'how_en' => 'Story games in the sandbox.',
            'results' => 'Емоційна стабілізація, розвиток моторики та уяви.',
            'results_en' => 'Emotional stabilization, motor skills and imagination development.',
            'indications' => 'Тривожність, затримка мовлення, РАС.',
            'indications_en' => 'Anxiety, speech delay, ASD.',
            'contra' => 'Відсутні.',
            'contra_en' => 'None.',
            'duration' => '45 хв',
            'duration_en' => '45 min',
            'price' => '800 грн',
            'price_en' => '800 UAH',
            'img' => 'sand_therapy_session.png'
        ],
        [
            'title' => 'Сенсорна інтеграція',
            'title_en' => 'Sensory Integration',
            'desc' => 'Гармонізація сенсорних систем та навичок саморегуляції.',
            'desc_en' => 'Harmonizing sensory systems and self-regulation skills.',
            'how' => 'Сенсорні кімнати, балансири, тактильні матеріали.',
            'how_en' => 'Sensory rooms, balancers, tactile materials.',
            'results' => 'Зниження гіперчутливості, покращення уваги.',
            'results_en' => 'Reduced hypersensitivity, improved attention.',
            'indications' => 'ДЦП, РАС, СДУГ, гіперактивність.',
            'indications_en' => 'CP, ASD, ADHD, hyperactivity.',
            'contra' => 'Відсутні.',
            'contra_en' => 'None.',
            'duration' => '45 хв',
            'duration_en' => '45 min',
            'price' => '950 грн',
            'price_en' => '950 UAH',
            'img' => 'sensory_integration_european.png'
        ],
        [
            'title' => 'Соціальна адаптація',
            'title_en' => 'Social Adaptation',
            'desc' => 'Навички взаємодії в соціумі та засвоєння норм.',
            'desc_en' => 'Social interaction skills and learning norms.',
            'how' => 'Групові заняття, рольові ігри.',
            'how_en' => 'Group sessions, role-playing games.',
            'results' => 'Інтеграція в соціум, впевненість у спілкуванні.',
            'results_en' => 'Social integration, communication confidence.',
            'indications' => 'Труднощі спілкування, РАС, ізоляція.',
            'indications_en' => 'Communication difficulties, ASD, isolation.',
            'contra' => 'Відсутні.',
            'contra_en' => 'None.',
            'duration' => '60 хв',
            'duration_en' => '60 min',
            'price' => '800 грн',
            'price_en' => '800 UAH',
            'img' => 'social_adaptation_group.png'
        ],
        [
            'title' => 'Нейропсихологічна корекція',
            'title_en' => 'Neuropsychological Correction',
            'desc' => 'Розвиток мозкових функцій: пам’ять, увага, самоконтроль.',
            'desc_en' => 'Development of brain functions: memory, attention, self-control.',
            'how' => 'Рухові та когнітивні вправи, "мозкова гімнастика".',
            'how_en' => 'Physical and cognitive exercises, "brain gymnastics".',
            'results' => 'Покращення концентрації, пам’яті, навчальних навичок.',
            'results_en' => 'Improved concentration, memory, learning skills.',
            'indications' => 'ЗПР, СДУГ, труднощі навчання, наслідки травм.',
            'indications_en' => 'Developmental delay, ADHD, learning difficulties, injury consequences.',
            'contra' => 'Відсутні.',
            'contra_en' => 'None.',
            'duration' => '45 хв',
            'duration_en' => '45 min',
            'price' => '950 грн',
            'price_en' => '950 UAH',
            'img' => 'neuropsychology_european_child_session.png'
        ],
        [
            'title' => 'Медична реабілітація',
            'title_en' => 'Medical Rehabilitation',
            'desc' => 'Відновлення після інсультів, інфарктів та операцій.',
            'desc_en' => 'Recovery after strokes, heart attacks, and operations.',
            'how' => 'Фізіотерапія, кінезіотерапія, комплексний підхід.',
            'how_en' => 'Physiotherapy, kinesiotherapy, comprehensive approach.',
            'results' => 'Відновлення рухів, мовлення, серцево-судинної стабільності.',
            'results_en' => 'Restoration of movement, speech, cardiovascular stability.',
            'indications' => 'Інсульти, інфаркти, ортопедичні втручання.',
            'indications_en' => 'Strokes, heart attacks, orthopedic interventions.',
            'contra' => 'Гострі стани.',
            'contra_en' => 'Acute conditions.',
            'duration' => '60 хв',
            'duration_en' => '60 min',
            'price' => '1200 грн',
            'price_en' => '1200 UAH',
            'img' => 'physical_therapy.png'
        ],
        [
            'title' => 'Функціональна реабілітація',
            'title_en' => 'Functional Rehabilitation',
            'desc' => 'Відновлення втрачених функцій після травм, опіків чи хвороб.',
            'desc_en' => 'Restoration of lost functions after injuries, burns, or illnesses.',
            'how' => 'Рання нейрореабілітація, мануальна терапія, ЛФК.',
            'how_en' => 'Early neurorehabilitation, manual therapy, physical therapy.',
            'results' => 'Відновлення незалежності, зменшення болю.',
            'results_en' => 'Restoration of independence, pain reduction.',
            'indications' => 'ЧМТ, опіки, дорсопатії, парези.',
            'indications_en' => 'TBI, burns, dorsopathies, paresis.',
            'contra' => 'Гострі запальні процеси.',
            'contra_en' => 'Acute inflammatory processes.',
            'duration' => '60 хв',
            'duration_en' => '60 min',
            'price' => '1000 грн',
            'price_en' => '1000 UAH',
            'img' => 'functional_rehab.png'
        ],
        [
            'title' => 'Нейросенсорна реабілітація',
            'title_en' => 'Neurosensory Rehabilitation',
            'desc' => 'Спеціалізована допомога при мінно-вибухових та акубаротравмах.',
            'desc_en' => 'Specialized help for blast and barotraumas.',
            'how' => 'Вестибулярна реабілітація, протезування, аудіотерапія.',
            'how_en' => 'Vestibular rehabilitation, prosthetics, audio therapy.',
            'results' => 'Відновлення рівноваги, слуху, фізичної активності.',
            'results_en' => 'Restoration of balance, hearing, physical activity.',
            'indications' => 'Мінно-вибухові травми, акубаротравми.',
            'indications_en' => 'Blast injuries, acubarotraumas.',
            'contra' => 'Гострі стани.',
            'contra_en' => 'Acute conditions.',
            'duration' => '60 хв',
            'duration_en' => '60 min',
            'price' => '1000 грн',
            'price_en' => '1000 UAH',
            'img' => 'trauma_neuro_rehab.png'
        ],
        [
            'title' => 'Психосоматична реабілітація',
            'title_en' => 'Psychosomatic Rehabilitation',
            'desc' => 'Комплексний підхід: тіло, психіка, емоції.',
            'desc_en' => 'Comprehensive approach: body, psyche, emotions.',
            'how' => 'Психотерапія, фізична активність, дієтотерапія.',
            'how_en' => 'Psychotherapy, physical activity, diet therapy.',
            'results' => 'Стабілізація емоційного стану, повернення мотивації.',
            'results_en' => 'Emotional stabilization, return of motivation.',
            'indications' => 'Депресія, ДЦП, серцево-судинні хвороби.',
            'indications_en' => 'Depression, CP, cardiovascular diseases.',
            'contra' => 'Гострі психічні розлади.',
            'contra_en' => 'Acute mental disorders.',
            'duration' => '60 хв',
            'duration_en' => '60 min',
            'price' => '1100 грн',
            'price_en' => '1100 UAH',
            'img' => 'psychosomatic_rehab.png'
        ],
        [
            'title' => 'FORBRAIN',
            'title_en' => 'FORBRAIN',
            'desc' => 'Тренування мозку та мовлення за допомогою власного голосу.',
            'desc_en' => 'Brain and speech training using your own voice.',
            'how' => 'Кісткова провідність, слухова стимуляція.',
            'how_en' => 'Bone conduction, auditory stimulation.',
            'results' => 'Покращення дикції, пам’яті та уваги.',
            'results_en' => 'Improved diction, memory, and attention.',
            'indications' => 'ЗМР, дислексія, проблеми з пам’яттю, професійний голос.',
            'indications_en' => 'Speech delay, dyslexia, memory problems, professional voice.',
            'contra' => 'Відсутні.',
            'contra_en' => 'None.',
            'duration' => '30 хв',
            'duration_en' => '30 min',
            'price' => 'По запиту',
            'price_en' => 'On request',
            'img' => 'forbrain_headset.png'
        ],
        [
            'title' => 'Психолог',
            'title_en' => 'Psychologist',
            'desc' => 'Допомога у подоланні стресу, криз та проблем розвитку.',
            'desc_en' => 'Help in overcoming stress, crises, and developmental problems.',
            'how' => 'Бесіди, арт-терапія, КПТ, ігрові методики.',
            'how_en' => 'Conversations, art therapy, CBT, game methods.',
            'results' => 'Зниження тривожності, адаптація, гармонізація стосунків.',
            'results_en' => 'Reduced anxiety, adaptation, relationship harmonization.',
            'indications' => 'Стрес, кризи, поведінкові проблеми, труднощі навчання.',
            'indications_en' => 'Stress, crises, behavioral problems, learning difficulties.',
            'contra' => 'Гострі стани, що потребують психіатра.',
            'contra_en' => 'Acute conditions requiring a psychiatrist.',
            'duration' => '50 хв',
            'duration_en' => '50 min',
            'price' => '1000 грн',
            'price_en' => '1000 UAH',
            'img' => 'psychologist_session.png'
        ]
    ];

    foreach ($services as $s) {
        $post_id = wp_insert_post([
            'post_title' => $s['title'],
            'post_content' => $s['desc'],
            'post_status' => 'publish',
            'post_type' => 'rz_service'
        ]);

        if ($post_id) {
            update_post_meta($post_id, '_rz_image', $s['img']);
            
            update_post_meta($post_id, '_rz_title_en', $s['title_en']);
            update_post_meta($post_id, '_rz_desc_en', $s['desc_en']);
            
            update_post_meta($post_id, '_rz_how_it_works', $s['how']);
            update_post_meta($post_id, '_rz_how_it_works_en', $s['how_en']);
            
            update_post_meta($post_id, '_rz_results', $s['results']);
            update_post_meta($post_id, '_rz_results_en', $s['results_en']);
            
            update_post_meta($post_id, '_rz_indications', $s['indications']);
            update_post_meta($post_id, '_rz_indications_en', $s['indications_en']);
            
            update_post_meta($post_id, '_rz_contraindications', $s['contra']);
            update_post_meta($post_id, '_rz_contraindications_en', $s['contra_en']);
            
            update_post_meta($post_id, '_rz_duration', $s['duration']);
            update_post_meta($post_id, '_rz_duration_en', $s['duration_en']);
            
            update_post_meta($post_id, '_rz_price', $s['price']);
            update_post_meta($post_id, '_rz_price_en', $s['price_en']);

            if (isset($s['consultation'])) update_post_meta($post_id, '_rz_price_consultation', $s['consultation']);
            if (isset($s['consultation_en'])) update_post_meta($post_id, '_rz_price_consultation_en', $s['consultation_en']);
            if (isset($s['price_5'])) update_post_meta($post_id, '_rz_price_5', $s['price_5']);
            if (isset($s['price_5_en'])) update_post_meta($post_id, '_rz_price_5_en', $s['price_5_en']);
            if (isset($s['price_10'])) update_post_meta($post_id, '_rz_price_10', $s['price_10']);
            if (isset($s['price_10_en'])) update_post_meta($post_id, '_rz_price_10_en', $s['price_10_en']);
        }
    }
    
    // Subscriptions
    $subs = [
        [
            'title' => 'Інтенсив (10 днів)',
            'title_en' => 'Intensive (10 days)',
            'price' => '15 000 грн',
            'price_en' => '15 000 UAH',
            'dur' => '10 днів / 40 занять',
            'dur_en' => '10 days / 40 sessions',
            'feats' => "Консультація мультидисциплінарної команди\n4 заняття в день\nІндивідуальний графік\nСупровід куратора",
            'feats_en' => "Multidisciplinary team consultation\n4 sessions per day\nIndividual schedule\nCurator support"
        ],
        [
            'title' => 'Розвиток (Місяць)',
            'title_en' => 'Development (Month)',
            'price' => '8 500 грн',
            'price_en' => '8 500 UAH',
            'dur' => '12 занять',
            'dur_en' => '12 sessions',
            'feats' => "Гнучкий графік\nМожливість перенесення занять\nЗнижка 10% на додаткові послуги\nЩотижневий звіт",
            'feats_en' => "Flexible schedule\nPossibility to reschedule sessions\n10% discount on additional services\nWeekly report"
        ],
        [
            'title' => 'Старт (Діагностика)',
            'title_en' => 'Start (Diagnostics)',
            'price' => '2 500 грн',
            'price_en' => '2 500 UAH',
            'dur' => '1 день / 3 фахівці',
            'dur_en' => '1 day / 3 specialists',
            'feats' => "Огляд лікаря ФРМ\nДіагностика психолога\nКонсультація логопеда\nСкладання плану реабілітації",
            'feats_en' => "Examination by PRM doctor\nPsychologist diagnostics\nSpeech therapist consultation\nRehabilitation plan creation"
        ]
    ];

    $existing_subs = get_posts(['post_type' => 'rz_subscription', 'numberposts' => -1]);
    foreach ($existing_subs as $s) wp_delete_post($s->ID, true);

    foreach ($subs as $s) {
        $sub_id = wp_insert_post([
            'post_title' => $s['title'],
            'post_status' => 'publish',
            'post_type' => 'rz_subscription'
        ]);
        if ($sub_id) {
            update_post_meta($sub_id, '_rz_sub_price', $s['price']);
            update_post_meta($sub_id, '_rz_sub_price_en', $s['price_en']);
            update_post_meta($sub_id, '_rz_sub_duration', $s['dur']);
            update_post_meta($sub_id, '_rz_sub_duration_en', $s['dur_en']);
            update_post_meta($sub_id, '_rz_sub_features', $s['feats']);
            update_post_meta($sub_id, '_rz_sub_features_en', $s['feats_en']);
        }
    }
}
function rz_render_contact_form() {
    ?>
    <style>
    .booking-form-wrapper {
        background: rgba(255, 255, 255, 0.05);
        padding: 30px;
        border-radius: var(--radius-lg);
        border: 1px solid var(--glass-border);
    }
    .booking-form-wrapper h3 { font-size: 1.5rem; margin-bottom: 10px; color: var(--white); }
    .form-intro { font-size: 0.9rem; color: rgba(255, 255, 255, 0.7); margin-bottom: 25px; }
    .modern-form .form-group { margin-bottom: 15px; }
    .modern-form input, .modern-form select {
        width: 100%; padding: 14px 18px; background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.1); border-radius: var(--radius-md);
        color: var(--white); font-family: inherit; font-size: 1rem; transition: var(--transition);
    }
    .modern-form input::placeholder { color: rgba(255, 255, 255, 0.5); }
    .modern-form input:focus, .modern-form select:focus {
        outline: none; background: rgba(255, 255, 255, 0.15); border-color: var(--primary-color);
    }
    .modern-form select option { background: #15242D; color: #fff; }
    .form-message { margin-top: 15px; padding: 12px; border-radius: var(--radius-md); font-size: 0.9rem; display: none; }
    .form-message.info { display: block; background: rgba(255, 255, 255, 0.1); color: var(--white); }
    .form-message.success { display: block; background: rgba(76, 175, 80, 0.2); color: #81c784; border: 1px solid rgba(76, 175, 80, 0.3); }
    .form-message.error { display: block; background: rgba(244, 67, 54, 0.2); color: #e57373; border: 1px solid rgba(244, 67, 54, 0.3); }
    .btn-full { width: 100%; }
    
    /* Grid Adjustment */
    .footer-grid { display: grid; grid-template-columns: 1.2fr 1fr 1fr 1.5fr; gap: 40px; }
    @media (max-width: 1200px) { .footer-grid { grid-template-columns: 1fr 1fr; } }
    @media (max-width: 768px) { .footer-grid { grid-template-columns: 1fr; } }
    </style>
    <div class="booking-form-wrapper animate-up">
        <h3><?php echo rz_t('Записатися на прийом', 'Book an Appointment'); ?></h3>
        <p class="form-intro"><?php echo rz_t('Залиште контакти, і ми зв’яжемося з вами під час робочого дня.', 'Leave your contacts, and we will get back to you during the working day.'); ?></p>
        
        <form id="rz-contact-form" class="modern-form">
            <div class="form-group">
                <input type="text" name="user_name" placeholder="<?php echo rz_t('Ваше ім’я', 'Your Name'); ?>" required>
            </div>
            <div class="form-group">
                <input type="tel" name="user_phone" placeholder="<?php echo rz_t('Номер телефону', 'Phone Number'); ?>" required>
            </div>
            <div class="form-group">
                <select name="service_type">
                    <option value="none"><?php echo rz_t('Оберіть послугу (необов’язково)', 'Choose a service (optional)'); ?></option>
                    <?php 
                    $services = get_posts(['post_type' => 'rz_service', 'numberposts' => -1]);
                    foreach ($services as $s) {
                        echo '<option value="'.esc_attr($s->post_title).'">'.esc_html($s->post_title).'</option>';
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-full"><?php echo rz_t('Відправити заявку', 'Send Request'); ?></button>
            <div id="form-response" class="form-message"></div>
        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('rz-contact-form');
        const responseDiv = document.getElementById('form-response');

        if (form) {
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                responseDiv.innerHTML = '<?php echo rz_t('Відправка...', 'Sending...'); ?>';
                responseDiv.className = 'form-message info';

                const formData = new FormData(form);
                formData.append('action', 'rz_handle_contact_form');

                try {
                    const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                        method: 'POST',
                        body: formData
                    });
                    const result = await response.json();

                    if (result.success) {
                        responseDiv.innerHTML = result.data;
                        responseDiv.className = 'form-message success';
                        form.reset();
                    } else {
                        responseDiv.innerHTML = result.data;
                        responseDiv.className = 'form-message error';
                    }
                } catch (error) {
                    responseDiv.innerHTML = '<?php echo rz_t('Помилка відправки. Спробуйте пізніше або зателефонуйте нам.', 'Sending error. Please try later or call us.'); ?>';
                    responseDiv.className = 'form-message error';
                }
            });
        }
    });
    </script>
    <?php
}

// AJAX Handler for Contact Form
function rz_handle_contact_form() {
    $name = sanitize_text_field($_POST['user_name']);
    $phone = sanitize_text_field($_POST['user_phone']);
    $service = sanitize_text_field($_POST['service_type']);

    if (empty($name) || empty($phone)) {
        wp_send_json_error(rz_t('Будь ласка, заповніть усі обов’язкові поля.', 'Please fill in all required fields.'));
    }

    $to = get_option('rz_inbox_email');
    if (empty($to)) $to = get_option('admin_email');
    
    $subject = 'Нова заявка на запис: ' . $name;
    $body = "Отримано нову заявку з сайту:\n\n";
    $body .= "Ім'я: $name\n";
    $body .= "Телефон: $phone\n";
    if ($service && $service !== 'none') {
        $body .= "Послуга: $service\n";
    }
    
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    
    wp_mail($to, $subject, $body, $headers);

    // Telegram Notification
    $tg_token = get_option('rz_tg_token');
    $tg_chat_id = get_option('rz_tg_chat_id');

    if (!empty($tg_token) && !empty($tg_chat_id)) {
        $tg_message = "🔔 *Нова заявка з сайту RZ Rehab*\n\n";
        $tg_message .= "👤 *Ім'я:* " . $name . "\n";
        $tg_message .= "📞 *Телефон:* `" . $phone . "`\n";
        if ($service && $service !== 'none') {
            $tg_message .= "🏥 *Послуга:* " . $service . "\n";
        }

        $api_url = "https://api.telegram.org/bot{$tg_token}/sendMessage";
        wp_remote_post($api_url, [
            'body' => [
                'chat_id' => $tg_chat_id,
                'text'    => $tg_message,
                'parse_mode' => 'Markdown'
            ]
        ]);
    }

    wp_send_json_success(rz_t('Дякуємо! Ваша заявка прийнята. Ми зателефонуємо вам найближчим часом.', 'Thank you! Your request has been received. We will call you back shortly.'));
}
add_action('wp_ajax_rz_handle_contact_form', 'rz_handle_contact_form');
add_action('wp_ajax_nopriv_rz_handle_contact_form', 'rz_handle_contact_form');

/**
 * Maintenance Mode / Coming Soon Splash
 */
function rz_maintenance_splash() {
    $mode = get_option('rz_maintenance_mode');
    if (!$mode || current_user_can('manage_options')) return;

    $pass = get_option('rz_maintenance_password');
    $cookie_name = 'rz_maintenance_bypass';

    // Handle Password Submit
    if (isset($_POST['rz_splash_pass'])) {
        if (!empty($pass) && $_POST['rz_splash_pass'] === $pass) {
            setcookie($cookie_name, md5($pass), time() + (86400 * 30), "/"); // 30 days
            wp_redirect(get_pagenum_link());
            exit;
        }
    }

    // Check Bypass Cookie
    if (!empty($pass) && isset($_COOKIE[$cookie_name]) && $_COOKIE[$cookie_name] === md5($pass)) {
        return;
    }

    $logo = get_template_directory_uri() . '/images/logo.png';
    $title = rz_t('Сайт на технічному обслуговуванні', 'Website Under Maintenance');
    $desc = rz_t('Ми готуємо для вас дещо особливе. Сайт буде доступний вже зовсім скоро!', 'We are preparing something special for you. The site will be available very soon!');
    $phone = get_option('rz_phone_1', '+380 93 447 07 07');
    ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title; ?></title>
        <?php wp_head(); ?>
        <style>
            body {
                margin: 0; padding: 0; height: 100vh; display: flex; align-items: center; justify-content: center;
                background: radial-gradient(circle at top right, #E0F2F1, #F9FAFB);
                font-family: 'Outfit', sans-serif; text-align: center; color: #374151; overflow: hidden;
            }
            .splash-container {
                max-width: 600px; padding: 40px; background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(20px); border-radius: 30px; border: 1px solid rgba(38, 166, 154, 0.1);
                box-shadow: 0 20px 50px rgba(38, 166, 154, 0.1); animation: splashFadeUp 1s cubic-bezier(0.4, 0, 0.2, 1);
            }
            @keyframes splashFadeUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
            .splash-logo { height: 100px; margin-bottom: 40px; }
            h1 { font-size: 2.5rem; margin-bottom: 20px; color: #26A69A; }
            p { font-size: 1.1rem; line-height: 1.7; margin-bottom: 40px; color: #6B7280; }
            .pass-form { margin: 30px 0; }
            .pass-form input { 
                padding: 10px 15px; border-radius: 10px; border: 1px solid #ddd; 
                background: rgba(255,255,255,0.5); width: 150px; text-align: center;
            }
            .pass-form button {
                padding: 10px 20px; border-radius: 10px; border: none;
                background: #26A69A; color: #fff; cursor: pointer; font-weight: 600;
            }
            .splash-footer { 
                padding-top: 30px; border-top: 1px solid rgba(38, 166, 154, 0.1); font-size: 0.95rem;
            }
            .phone-link { color: #26A69A; font-weight: 700; text-decoration: none; }
        </style>
    </head>
    <body>
        <div class="splash-container">
            <img src="<?php echo $logo; ?>" alt="RZ Rehab" class="splash-logo">
            <h1><?php echo $title; ?></h1>
            <p><?php echo $desc; ?></p>
            
            <form method="post" class="pass-form">
                <input type="password" name="rz_splash_pass" placeholder="<?php echo rz_t('Пароль', 'Password'); ?>">
                <button type="submit">OK</button>
            </form>

            <div class="splash-footer">
                <?php echo rz_t('Ми на зв’язку:', 'Contact us:'); ?> <a href="tel:<?php echo $phone; ?>" class="phone-link"><?php echo $phone; ?></a>
            </div>
        </div>
        <?php wp_footer(); ?>
    </body>
    </html>
    <?php
    die();
}
add_action('template_redirect', 'rz_maintenance_splash');

/**
 * Update About Content from User Request
 */
function rz_update_about_content_v2() {
    if (get_option('rz_about_content_updated_v2')) return;

    $lead_uk = 'ТОВ «Разом зростаємо» — це простір реабілітації та розвитку для дітей і дорослих, де в центрі уваги — людина, її потреби та комфорт.';
    $lead_en = 'LLC "Together We Grow" is a space for rehabilitation and development for children and adults, where the focus is on the person, their needs, and comfort.';

    $text_uk = "Ми віримо, що шлях до гармонійного життя— це не тільки про фізичний стан, а й про внутрішній ресурс, емоційну стабільність та відчуття підтримки.\n\n" .
               "Ми поєднуємо медичну реабілітацію, психологічну допомогу та корекційно-розвивальні заняття, щоб допомагати комплексно. Наш підхід спрямований на відновлення руху, мовлення, когнітивних функцій та впевненості у собі.\n\n" .
               "У нашому центрі працює команда досвідчених спеціалістів: психологи, нейропсихологи, логопеди-дефектологи, фахівці з фізичної реабілітації та сенсорної інтеграції. Ми працюємо разом, щоб створити індивідуальну програму для кожної людини, адже кожна історія — унікальна.\n\n" .
               "Ми обираємо м’які, безпечні та екологічні методи роботи, щоб процес відновлення був комфортним і зрозумілим. Для нас важливо не тільки досягати результату, а й підтримувати людину на кожному етапі її шляху.\n\n" .
               "Ми створюємо простір, де хочеться довіряти, розвиватися і рухатися вперед. Ми повертаємо радість життя, віру у власні сили та надію на майбутнє.";

    $text_en = "We believe that the path to a harmonious life is not only about physical condition but also about internal resources, emotional stability, and a sense of support.\n\n" .
               "We combine medical rehabilitation, psychological support, and correctional-developmental sessions to aid comprehensively. Our approach is aimed at restoring movement, speech, cognitive functions, and self-confidence.\n\n" .
               "Our center employs a team of experienced specialists: psychologists, neuropsychologists, speech therapists-defectologists, specialists in physical rehabilitation and sensory integration. We work together to create an individual program for each person, because every story is unique.\n\n" .
               "We choose gentle, safe, and ecological methods of work so that the recovery process is comfortable and understandable. It is important for us not only to achieve results but also to support the person at every stage of their journey.\n\n" .
               "We create a space where you want to trust, develop, and move forward. We bring back the joy of life, faith in one's own strength, and hope for the future.";

    update_option('rz_about_lead_uk', $lead_uk);
    update_option('rz_about_lead_en', $lead_en);
    update_option('rz_about_text_uk', $text_uk);
    update_option('rz_about_text_en', $text_en);
    
    update_option('rz_about_content_updated_v2', true);
}
add_action('init', 'rz_update_about_content_v2');
