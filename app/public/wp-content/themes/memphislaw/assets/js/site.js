document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('[data-nav-toggle]');
    const panel = document.querySelector('[data-nav-panel]');
    const themeToggle = document.querySelector('[data-theme-toggle]');
    const root = document.documentElement;

    const applyTheme = (theme) => {
        root.dataset.theme = theme;
        if (themeToggle) {
            themeToggle.setAttribute('aria-pressed', theme === 'light' ? 'true' : 'false');
        }
        try {
            localStorage.setItem('memphislaw-theme', theme);
        } catch (error) {
            return;
        }
    };

    if (themeToggle) {
        const initialTheme = root.dataset.theme === 'light' ? 'light' : 'dark';
        themeToggle.setAttribute('aria-pressed', initialTheme === 'light' ? 'true' : 'false');
        themeToggle.addEventListener('click', () => {
            applyTheme(root.dataset.theme === 'light' ? 'dark' : 'light');
        });
    }

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
