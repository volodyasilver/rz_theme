<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header class="main-header">
        <div class="container header-content">
            <div class="logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="ТОВ Разом зростаємо" class="site-logo">
                </a>
            </div>
            
            <nav class="main-nav" id="mobile-menu">
                <ul class="nav-list">
                    <li><a href="#services"><?php echo rz_t('Послуги', 'Services'); ?></a></li>
                    <li><a href="#about"><?php echo rz_t('Про нас', 'About Us'); ?></a></li>
                    <li><a href="#prices"><?php echo rz_t('Ціни', 'Prices'); ?></a></li>
                    <li><a href="#contacts"><?php echo rz_t('Контакти', 'Contacts'); ?></a></li>
                </ul>
                <div class="mobile-only-controls">
                    <a href="#contacts" class="btn"><?php echo rz_t('Записатися', 'Book'); ?></a>
                </div>
            </nav>

            <div class="header-controls">
                <button id="theme-toggle" class="control-btn" title="Toggle Theme">
                    <svg class="sun" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
                </button>
                <?php if (get_option('rz_disable_en') !== '1') : ?>
                <div class="lang-switcher">
                    <a href="?lang=uk" class="lang-link <?php echo rz_get_lang() === 'uk' ? 'active' : ''; ?>">UA</a>
                    <a href="?lang=en" class="lang-link <?php echo rz_get_lang() === 'en' ? 'active' : ''; ?>">EN</a>
                </div>
                <?php endif; ?>
                <button class="menu-toggle" aria-label="Toggle Menu" id="menu-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <a href="#contacts" class="btn btn-sm desktop-only"><?php echo rz_t('Записатися', 'Book'); ?></a>
            </div>
        </div>
    </header>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('menu-toggle');
        const menu = document.getElementById('mobile-menu');
        
        toggle.addEventListener('click', function() {
            toggle.classList.toggle('active');
            menu.classList.toggle('active');
            document.body.classList.toggle('menu-open');
        });

        // Close menu on link click
        const links = menu.querySelectorAll('a');
        links.forEach(link => {
            link.addEventListener('click', () => {
                toggle.classList.remove('active');
                menu.classList.remove('active');
                document.body.classList.remove('menu-open');
            });
        });
    });
    </script>
</body>
</html>
