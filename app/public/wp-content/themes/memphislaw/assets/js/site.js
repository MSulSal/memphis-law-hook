document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('[data-nav-toggle]');
    const panel = document.querySelector('[data-nav-panel]');
    const themeToggle = document.querySelector('[data-theme-toggle]');
    const header = document.querySelector('.memphis-law-page .site-header');
    const mobileNavQuery = window.matchMedia('(max-width: 900px)');
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

    if (!toggle || !panel) {
        return;
    }

    const shouldUseMobileNavBehavior = () => mobileNavQuery.matches;

    const syncMobilePanelOffset = () => {
        if (!panel || !header || !shouldUseMobileNavBehavior()) {
            panel.style.removeProperty('top');
            return;
        }
        const headerBottom = Math.max(0, Math.round(header.getBoundingClientRect().bottom));
        panel.style.top = `${headerBottom}px`;
    };

    const setHeaderHidden = (hidden) => {
        if (!header) {
            return;
        }
        header.classList.toggle('is-hidden', hidden);
    };

    const syncHeaderOnScroll = () => {
        if (!shouldUseMobileNavBehavior()) {
            setHeaderHidden(false);
            lastScrollY = window.scrollY;
            isTicking = false;
            return;
        }

        const currentY = window.scrollY;
        const delta = currentY - lastScrollY;

        if (navOpen || currentY < 16 || delta < -2) {
            setHeaderHidden(false);
        } else if (delta > 4 && currentY > 80) {
            setHeaderHidden(true);
        }

        lastScrollY = currentY;
        isTicking = false;
    };

    const requestHeaderSync = () => {
        if (isTicking) {
            return;
        }

        isTicking = true;
        window.requestAnimationFrame(syncHeaderOnScroll);
    };

    const setState = (open) => {
        navOpen = open;
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        panel.classList.toggle('is-open', open);
        document.body.classList.toggle('nav-open', open);
        if (open) {
            setHeaderHidden(false);
        }
        syncMobilePanelOffset();
    };

    toggle.addEventListener('click', () => {
        const previousScrollY = window.scrollY;
        const next = toggle.getAttribute('aria-expanded') !== 'true';
        setState(next);
        window.requestAnimationFrame(() => {
            if (Math.abs(window.scrollY - previousScrollY) > 1) {
                window.scrollTo(0, previousScrollY);
            }
        });
    });

    panel.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => setState(false));
    });

    window.addEventListener('scroll', () => {
        requestHeaderSync();
        if (navOpen) {
            syncMobilePanelOffset();
        }
    }, { passive: true });

    window.addEventListener('resize', syncMobilePanelOffset);

    const onMobileChange = () => {
        setHeaderHidden(false);
        if (!shouldUseMobileNavBehavior()) {
            setState(false);
        }
        lastScrollY = window.scrollY;
        syncMobilePanelOffset();
    };

    if (typeof mobileNavQuery.addEventListener === 'function') {
        mobileNavQuery.addEventListener('change', onMobileChange);
    } else if (typeof mobileNavQuery.addListener === 'function') {
        mobileNavQuery.addListener(onMobileChange);
    }

    onMobileChange();
});
