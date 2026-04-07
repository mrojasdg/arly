document.addEventListener('DOMContentLoaded', () => {
    // Mobile Menu Toggle
    const navToggle = document.getElementById('nav-toggle');
    const navMenu = document.getElementById('nav-menu');
    const navLinks = document.querySelectorAll('.nav-link');

    if (navToggle && navMenu) {
        navToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            navToggle.classList.toggle('active');
            document.body.classList.toggle('menu-open');

            // Toggle icon between menu and x
            const isMenuOpen = navMenu.classList.contains('active');
            const icon = navToggle.querySelector('i');

            if (isMenuOpen) {
                icon.setAttribute('data-lucide', 'x');
            } else {
                icon.setAttribute('data-lucide', 'menu');
            }
            // Refresh icons
            lucide.createIcons();
        });
    }

    // Close mobile menu when a link is clicked
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (navMenu.classList.contains('active')) {
                navMenu.classList.remove('active');
                navToggle.classList.remove('active');
                document.body.classList.remove('menu-open');
                const icon = navToggle.querySelector('i');
                icon.setAttribute('data-lucide', 'menu');
                lucide.createIcons();
            }
        });
    });

    // Navbar Scroll Effect
    const navbar = document.querySelector('.navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.style.boxShadow = '0 4px 6px -1px rgba(0, 0, 0, 0.1)';
        } else {
            navbar.style.boxShadow = 'none';
        }
    });

    // Simple Scroll Animation Trigger (Intersection Observer)
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Elements to animate
    document.querySelectorAll('.card, .section-title, .hero-content').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
        observer.observe(el);
    });

    // Add CSS class for animation via JS
    const style = document.createElement('style');
    style.innerHTML = `
        .animate-in {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
    `;
    document.head.appendChild(style);

    // Active Link Highlighting & Scroll Spying
    const updateActiveLink = () => {
        const currentPath = window.location.pathname;
        const hash = window.location.hash;

        let activePage = '';
        if (currentPath.includes('nosotros.html')) activePage = 'nosotros.html';
        else if (currentPath.includes('distribuidores.html')) activePage = 'distribuidores.html';
        else if (currentPath.includes('productos.html')) activePage = 'productos.html';
        else if (currentPath.includes('contacto.html')) activePage = 'contacto.html';
        else activePage = 'index.html';

        navLinks.forEach(link => {
            link.classList.remove('active');
            const href = link.getAttribute('href');

            if (href === activePage) {
                link.classList.add('active');
            }

            // Special case for Productos anchor
            if (activePage === 'index.html' && hash === '#productos' && href === '#productos') {
                navLinks.forEach(l => l.classList.remove('active'));
                link.classList.add('active');
            }
        });
    };

    const isIndex = window.location.pathname.endsWith('index.html') || window.location.pathname === '/' || window.location.pathname.endsWith('/');
    if (isIndex) {
        const sections = document.querySelectorAll('section[id]');
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                if (window.scrollY >= (sectionTop - 150)) {
                    current = section.getAttribute('id');
                }
            });

            if (current) {
                navLinks.forEach(link => {
                    const href = link.getAttribute('href');
                    if (href && href.includes(current)) {
                        navLinks.forEach(l => l.classList.remove('active'));
                        link.classList.add('active');
                    }
                });
            } else {
                navLinks.forEach(link => {
                    if (link.getAttribute('href') === 'index.html') {
                        navLinks.forEach(l => l.classList.remove('active'));
                        link.classList.add('active');
                    }
                });
            }
        });
    }

    updateActiveLink();

    // Form Submissions Wrapper
    const setupAjaxForm = (formId, statusId) => {
        const form = document.getElementById(formId);
        const status = document.getElementById(statusId);

        if (form && status) {
            form.addEventListener('submit', async (e) => {
                e.preventDefault();

                status.textContent = 'Procesando...';
                status.className = 'form-message';
                status.style.display = 'block';

                // Simular envío procesado
                setTimeout(() => {
                    status.textContent = '¡Mensaje enviado con éxito!';
                    status.className = 'form-message success';
                    form.reset();
                    if (formId === 'newsletter-form') {
                        setTimeout(() => { status.style.display = 'none'; }, 5000);
                    }
                }, 1000);
            });
        }
    };

    // Setup all forms
    setupAjaxForm('b2b-form', 'form-status');
    setupAjaxForm('newsletter-form', 'newsletter-status');
    setupAjaxForm('general-contact-form', 'contact-status');
});

