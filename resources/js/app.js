import Alpine from 'alpinejs';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

window.Alpine = Alpine;
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;

function prefersReducedMotion() {
    return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
}

// Floating pill nav – active section tracking via IntersectionObserver
function pillNav(isHomePage) {
    return {
        activeSection: isHomePage ? 'hero' : '',
        mobileOpen: false,

        init() {
            if (!isHomePage) return;

            const sections = document.querySelectorAll('[data-section]');
            if (!sections.length) return;

            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            this.activeSection = entry.target.dataset.section;
                        }
                    });
                },
                { rootMargin: '-20% 0px -60% 0px' }
            );

            sections.forEach(el => observer.observe(el));
        },
    };
}

window.pillNav = pillNav;

// Hero entrance animation
function initHero() {
    if (prefersReducedMotion()) return;

    const els = document.querySelectorAll('[data-hero]');
    if (!els.length) return;

    gsap.fromTo(els,
        { opacity: 0, y: 24 },
        {
            opacity: 1,
            y: 0,
            duration: 0.8,
            ease: 'power3.out',
            stagger: 0.12,
            delay: 0.1,
        }
    );
}

// data-reveal: scroll-triggered fade + slide, with optional data-reveal-delay="0.2"
function initReveal() {
    if (prefersReducedMotion()) return;

    gsap.utils.toArray('[data-reveal]').forEach((el) => {
        const delay = parseFloat(el.dataset.revealDelay ?? 0);

        gsap.fromTo(el,
            { opacity: 0, y: 28 },
            {
                opacity: 1,
                y: 0,
                duration: 0.7,
                ease: 'power2.out',
                delay,
                scrollTrigger: {
                    trigger: el,
                    start: 'top 88%',
                    once: true,
                },
            }
        );
    });
}

// data-animate: legacy scroll-triggered animation (kept for existing pages)
function initScrollAnimations() {
    if (prefersReducedMotion()) return;

    gsap.utils.toArray('[data-animate]').forEach((el) => {
        gsap.fromTo(el,
            { opacity: 0, y: 28 },
            {
                opacity: 1,
                y: 0,
                duration: 0.65,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: el,
                    start: 'top 90%',
                },
            }
        );
    });
}

// Floating orb parallax
function initOrbs() {
    if (prefersReducedMotion()) return;

    gsap.utils.toArray('[data-orb]').forEach((orb, i) => {
        gsap.to(orb, {
            y: i % 2 === 0 ? -40 : 40,
            duration: 4 + i,
            repeat: -1,
            yoyo: true,
            ease: 'sine.inOut',
        });
    });
}

// Journey timeline: scrubs a progress line and reveals nodes
function initJourney() {
    if (prefersReducedMotion()) return;

    const section = document.querySelector('[data-journey]');
    if (!section) return;

    const line = section.querySelector('[data-journey-line]');
    const nodes = section.querySelectorAll('[data-journey-node]');

    if (line) {
        gsap.fromTo(line,
            { scaleX: 0 },
            {
                scaleX: 1,
                ease: 'none',
                transformOrigin: 'left center',
                scrollTrigger: {
                    trigger: section,
                    start: 'top 65%',
                    end: 'center 45%',
                    scrub: 1.2,
                },
            }
        );
    }

    nodes.forEach((node, i) => {
        gsap.fromTo(node,
            { opacity: 0, y: 14 },
            {
                opacity: 1,
                y: 0,
                duration: 0.5,
                ease: 'power2.out',
                delay: i * 0.08,
                scrollTrigger: {
                    trigger: node,
                    start: 'top 85%',
                    once: true,
                },
            }
        );
    });
}

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    initHero();
    initReveal();
    initScrollAnimations();
    initOrbs();
    initJourney();
});
