document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('[data-nav-toggle]');
    const panel = document.querySelector('[data-nav-panel]');

    if (!toggle || !panel) {
        return;
    }

    const setState = (open) => {
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        panel.classList.toggle('is-open', open);
        document.body.classList.toggle('nav-open', open);
    };

    toggle.addEventListener('click', () => {
        const next = toggle.getAttribute('aria-expanded') !== 'true';
        setState(next);
    });

    panel.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => setState(false));
    });
});
