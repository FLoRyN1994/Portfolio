import Alpine from 'alpinejs';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

window.Alpine = Alpine;
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;

// Hero entrance animation (elements with data-hero)
function initHero() {
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

// Scroll-triggered fade-in for [data-animate]
function initScrollAnimations() {
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

// Floating orbs parallax
function initOrbs() {
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

// macOS dock magnification
function dock() {
    return {
        mouseX: null,

        handleMouseMove(e) {
            this.mouseX = e.clientX;
            this.$el.querySelectorAll('.dock-icon').forEach((icon) => {
                const rect = icon.getBoundingClientRect();
                const iconCenter = rect.left + rect.width / 2;
                const dist = Math.abs(this.mouseX - iconCenter);
                const maxDist = 80;
                const scale = dist < maxDist ? 1 + 0.5 * (1 - dist / maxDist) : 1;
                gsap.to(icon, { scale, duration: 0.2, ease: 'power2.out' });
            });
        },

        reset() {
            this.mouseX = null;
            this.$el.querySelectorAll('.dock-icon').forEach((icon) => {
                gsap.to(icon, { scale: 1, duration: 0.3, ease: 'power2.out' });
            });
        },
    };
}

window.dock = dock;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    initHero();
    initScrollAnimations();
    initOrbs();
});
