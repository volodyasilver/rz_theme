<?php get_header(); ?>

<main>
    <?php 
    rz_render_hero();
    rz_render_services();
    rz_render_about();
    rz_render_pricing();
    ?>
</main>

<div id="service-modal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <div id="modal-body"></div>
    </div>
</div>

<style>
/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 2000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.6);
    backdrop-filter: blur(8px);
    opacity: 0;
    transition: opacity 0.4s ease;
}
.modal.active {
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 1;
}
.modal-content {
    background: var(--bg-card);
    padding: 40px;
    border-radius: var(--radius-lg);
    max-width: 800px;
    width: 90%;
    max-height: 80vh;
    overflow-y: auto;
    position: relative;
    box-shadow: var(--shadow-lg);
    transform: translateY(30px);
    transition: transform 0.4s ease;
}
.modal.active .modal-content {
    transform: translateY(0);
}
.close-modal {
    position: absolute;
    right: 25px;
    top: 20px;
    font-size: 30px;
    cursor: pointer;
    color: var(--text-muted);
}
.modal-details h2 { margin-bottom: 25px; color: var(--primary-color); }
.modal-details h4 { margin: 30px 0 15px; color: var(--text-dark); border-bottom: 2px solid var(--secondary-color); display: inline-block; }
.modal-details p { margin-bottom: 15px; }

/* Modal Prices */
.modal-price-list {
    margin: 15px 0;
    padding: 0;
    list-style: none;
    background: var(--bg-accent);
    padding: 20px;
    border-radius: var(--radius-md);
}
.modal-price-list li {
    padding: 10px 0;
    border-bottom: 1px solid rgba(0,0,0,0.05);
    display: flex;
    justify-content: space-between;
}
.modal-price-list li:last-child {
    border-bottom: none;
}
.modal-price-list li strong {
    color: var(--primary-color);
}

</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('service-modal');
    const modalBody = document.getElementById('modal-body');
    const closeBtn = document.querySelector('.close-modal');

    document.querySelectorAll('.read-more').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const card = btn.closest('.service-card');
            const title = card.querySelector('h3').innerText;
            const details = card.querySelector('.service-details-hidden').innerHTML;
            
            modalBody.innerHTML = `<div class="modal-details"><h2>${title}</h2>${details}</div>`;
            modal.classList.add('active');
            modal.style.display = 'flex';
        });
    });

    closeBtn.onclick = () => {
        modal.classList.remove('active');
        setTimeout(() => modal.style.display = 'none', 400);
    };

    window.onclick = (event) => {
        if (event.target == modal) {
            modal.classList.remove('active');
            setTimeout(() => modal.style.display = 'none', 400);
        }
    };
});
</script>

<?php get_footer(); ?>
