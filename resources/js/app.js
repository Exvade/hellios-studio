const toggle = document.querySelector('[data-menu-toggle]');
const menu = document.querySelector('[data-menu]');

toggle?.addEventListener('click', () => {
    const isOpen = toggle.getAttribute('aria-expanded') === 'true';

    toggle.setAttribute('aria-expanded', String(! isOpen));
    menu?.classList.toggle('hidden', isOpen);
});

const landingToggle = document.querySelector('[data-landing-toggle]');
const landingMenu = document.querySelector('[data-landing-menu]');

if (landingToggle && landingMenu) {
    const closeLandingMenu = () => {
        landingToggle.setAttribute('aria-expanded', 'false');
        landingMenu.classList.remove('is-open');
    };

    landingToggle.addEventListener('click', () => {
        const isOpen = landingToggle.getAttribute('aria-expanded') === 'true';
        landingToggle.setAttribute('aria-expanded', String(!isOpen));
        landingMenu.classList.toggle('is-open', !isOpen);
    });

    landingMenu.addEventListener('click', (event) => {
        if (event.target.closest('a')) closeLandingMenu();
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && landingToggle.getAttribute('aria-expanded') === 'true') {
            closeLandingMenu();
            landingToggle.focus();
        }
    });

    document.addEventListener('click', (event) => {
        if (!landingMenu.contains(event.target) && !landingToggle.contains(event.target)) {
            closeLandingMenu();
        }
    });

    window.matchMedia('(min-width: 768px)').addEventListener('change', closeLandingMenu);
}

const studioToggle = document.querySelector('[data-studio-toggle]');
const studioDrawer = document.querySelector('[data-studio-drawer]');

if (studioToggle && studioDrawer) {
    const closeStudioDrawer = () => {
        studioToggle.setAttribute('aria-expanded', 'false');
        studioDrawer.classList.remove('is-open');
    };

    studioToggle.addEventListener('click', () => {
        const isOpen = studioToggle.getAttribute('aria-expanded') === 'true';

        studioToggle.setAttribute('aria-expanded', String(!isOpen));
        studioDrawer.classList.toggle('is-open', !isOpen);
    });

    studioDrawer.addEventListener('click', (event) => {
        if (event.target.closest('a, button')) closeStudioDrawer();
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && studioToggle.getAttribute('aria-expanded') === 'true') {
            closeStudioDrawer();
            studioToggle.focus();
        }
    });

    document.addEventListener('click', (event) => {
        if (!studioDrawer.contains(event.target) && !studioToggle.contains(event.target)) {
            closeStudioDrawer();
        }
    });

    window.matchMedia('(min-width: 1024px)').addEventListener('change', closeStudioDrawer);
}

const hero = document.querySelector('.landing-hero');
const heroWheels = document.querySelectorAll('[data-hero-parallax]');
const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

if (hero && heroWheels.length && !reducedMotion.matches) {
    let animationFrame;

    const updateHeroParallax = () => {
        animationFrame = undefined;

        const heroBounds = hero.getBoundingClientRect();
        const viewportCenter = window.innerHeight / 2;
        const heroCenter = heroBounds.top + (heroBounds.height / 2);
        const progress = Math.max(-1, Math.min(1, (heroCenter - viewportCenter) / viewportCenter));

        heroWheels.forEach((wheel) => {
            const direction = wheel.dataset.heroParallax === 'back' ? 16 : -24;
            wheel.style.setProperty(`--hero-parallax-${wheel.dataset.heroParallax}-y`, `${progress * direction}px`);
        });
    };

    const requestParallaxUpdate = () => {
        if (! animationFrame) {
            animationFrame = window.requestAnimationFrame(updateHeroParallax);
        }
    };

    window.addEventListener('scroll', requestParallaxUpdate, { passive: true });
    window.addEventListener('resize', requestParallaxUpdate);
    requestParallaxUpdate();
}

let catalogRequest;

const loadCatalogCategory = async (url, updateHistory = true) => {
    const currentBody = document.querySelector('[data-catalog-body]');

    if (! currentBody) {
        window.location.assign(url);

        return;
    }

    catalogRequest?.abort();
    const request = new AbortController();
    catalogRequest = request;
    currentBody.dataset.catalogLoading = 'true';
    currentBody.setAttribute('aria-busy', 'true');

    try {
        const response = await window.fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            signal: request.signal,
        });

        if (! response.ok) {
            throw new Error('Unable to load the catalogue category.');
        }

        const page = new DOMParser().parseFromString(await response.text(), 'text/html');
        const nextBody = page.querySelector('[data-catalog-body]');

        if (! nextBody) {
            throw new Error('Catalogue content was not found.');
        }

        currentBody.innerHTML = nextBody.innerHTML;

        if (updateHistory) {
            window.history.pushState({}, '', url);
        }
    } catch (error) {
        if (error.name !== 'AbortError') {
            window.location.assign(url);
        }
    } finally {
        if (catalogRequest === request) {
            currentBody.dataset.catalogLoading = 'false';
            currentBody.removeAttribute('aria-busy');
        }
    }
};

document.addEventListener('click', (event) => {
    const categoryLink = event.target.closest('[data-catalog-filters] a');

    if (! categoryLink || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
        return;
    }

    const url = new URL(categoryLink.href, window.location.href);

    if (url.origin !== window.location.origin) {
        return;
    }

    event.preventDefault();
    loadCatalogCategory(url.toString());
});

window.addEventListener('popstate', () => {
    if (document.querySelector('[data-catalog-body]')) {
        loadCatalogCategory(window.location.href, false);
    }
});
