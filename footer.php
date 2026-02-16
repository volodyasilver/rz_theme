    <footer class="main-footer" id="contacts">
        <div class="container footer-grid">
            <div class="footer-col info">
                <h3><?php echo rz_t('Контакти', 'Contacts'); ?></h3>
                <div class="contact-item">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <p><?php echo get_option('rz_address_' . rz_get_lang(), rz_t('м. Запоріжжя, пр. Соборний, 176', '176 Sobornyi Ave, Zaporizhzhia')); ?></p>
                </div>
                <div class="contact-item">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l2.27-2.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    <p><?php echo get_option('rz_phone_1', '+380 93 447 07 07'); ?></p>
                </div>
                <div class="contact-item">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l2.27-2.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    <p><?php echo get_option('rz_phone_2', '+380 96 583 86 14'); ?></p>
                </div>
                <div class="contact-item">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    <p><?php echo get_option('rz_email', 'itogethergrow@gmail.com'); ?></p>
                </div>
            </div>
            <div class="footer-col schedule">
                <h3><?php echo rz_t('Графік роботи', 'Working Hours'); ?></h3>
                <p><?php echo rz_t('Пн - Пт: 08:00 - 20:00', 'Mon - Fri: 08:00 - 20:00'); ?></p>
                <p><?php echo rz_t('Сб - Нд: 09:00 - 18:00', 'Sat - Sun: 09:00 - 18:00'); ?></p>
            </div>
            <div class="footer-col social">
                <h3><?php echo rz_t('Ми у соцмережах', 'Social Media'); ?></h3>
                <div class="social-links">
                    <?php if ($inst = get_option('rz_social_instagram')) : ?>
                        <a href="<?php echo esc_url($inst); ?>" target="_blank">Instagram</a>
                    <?php endif; ?>
                    <?php if ($fb = get_option('rz_social_facebook')) : ?>
                        <a href="<?php echo esc_url($fb); ?>" target="_blank">Facebook</a>
                    <?php endif; ?>
                    <?php if ($tg = get_option('rz_social_telegram')) : ?>
                        <a href="<?php echo esc_url($tg); ?>" target="_blank">Telegram</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="footer-col booking">
                <?php rz_render_contact_form(); ?>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p>&copy; <?php echo date('Y'); ?> <?php echo rz_t('ТОВ «Разом зростаємо»', 'LLC "Together We Grow"'); ?>. <?php echo rz_t('Усі права захищені.', 'All rights reserved.'); ?></p>
                <p style="opacity: 0.4; font-size: 11px;">ЄДРПОУ: <?php echo get_option('rz_edrpou', '45812817'); ?></p>
            </div>
        </div>
    </footer>

    <button id="back-to-top" class="back-to-top" title="<?php echo rz_t('Вгору', 'To Top'); ?>">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg>
    </button>

    <?php wp_footer(); ?>
</body>
</html>
