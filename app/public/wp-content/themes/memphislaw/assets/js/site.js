document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const header = document.querySelector('.site-header');
    const toggle = document.querySelector('[data-nav-toggle]');
    const panel = document.querySelector('[data-nav-panel]');
    const themeToggle = document.querySelector('[data-theme-toggle]');
    const mobileQuery = window.matchMedia('(max-width: 1366px)');
    const root = document.documentElement;
    let navOpen = false;
    let lastScrollY = window.scrollY;
    let isTicking = false;

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

    if (!toggle || !panel || !header) {
        return;
    }

    const setState = (open) => {
        navOpen = open;
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        panel.classList.toggle('is-open', open);
        body.classList.toggle('nav-open', open);
        panel.style.removeProperty('top');
        panel.style.removeProperty('max-height');
        if (open) {
            header.classList.remove('is-hidden');
            lastScrollY = window.scrollY;
            return;
        }

        header.classList.remove('is-hidden');
    };

    const updateHeaderVisibility = () => {
        if (!mobileQuery.matches) {
            header.classList.remove('is-hidden');
            lastScrollY = window.scrollY;
            isTicking = false;
            return;
        }

        const currentY = window.scrollY;
        const delta = currentY - lastScrollY;

        if (navOpen) {
            header.classList.remove('is-hidden');
            lastScrollY = currentY;
            isTicking = false;
            return;
        }

        if (currentY < 8 || delta < -2) {
            header.classList.remove('is-hidden');
        } else if (delta > 4 && currentY > 72) {
            header.classList.add('is-hidden');
        }

        lastScrollY = currentY;
        isTicking = false;
    };

    const requestHeaderUpdate = () => {
        if (isTicking) {
            return;
        }

        isTicking = true;
        window.requestAnimationFrame(updateHeaderVisibility);
    };

    toggle.addEventListener('click', () => {
        const next = toggle.getAttribute('aria-expanded') !== 'true';
        header.classList.remove('is-hidden');
        setState(next);
    });

    panel.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => setState(false));
    });

    const onViewportChange = () => {
        setState(false);
        header.classList.remove('is-hidden');
        lastScrollY = window.scrollY;
        panel.style.removeProperty('top');
        panel.style.removeProperty('max-height');
    };

    window.addEventListener('scroll', requestHeaderUpdate, { passive: true });
    window.addEventListener('resize', onViewportChange, { passive: true });
    window.addEventListener('orientationchange', onViewportChange);

    if (typeof mobileQuery.addEventListener === 'function') {
        mobileQuery.addEventListener('change', onViewportChange);
    } else if (typeof mobileQuery.addListener === 'function') {
        mobileQuery.addListener(onViewportChange);
    }

    onViewportChange();
});
