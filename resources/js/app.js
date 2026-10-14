import Alpine from 'alpinejs';
import Collapse from '@alpinejs/collapse';
Alpine.plugin(Collapse);
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

// Interactive terminal widget
window.terminalWidget = function () {
    function esc(s) {
        return String(s)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');
    }
    const t = (text, cls = 'text-text') => ({ html: esc(text), cls });
    const h = (html, cls = 'text-text') => ({ html, cls });

    const CMDS = {
        help: () => [
            h('  <span class="text-warm">Available commands</span>'),
            t('  whoami       ·  About me',                'text-muted'),
            t('  skills       ·  Tech stack',              'text-muted'),
            t('  experience   ·  Work history',            'text-muted'),
            t('  contact      ·  Get in touch',            'text-muted'),
            t('  ls           ·  Portfolio sections',      'text-muted'),
            t('  clear        ·  Clear screen',            'text-muted'),
        ],
        whoami: () => [
            h('  <span class="text-warm font-semibold">Florin Tomozei</span><span class="text-muted"> · PHP / Drupal Developer</span>'),
            t(''),
            t('  9 years building large-scale Drupal platforms for agencies.'),
            t('  Acquia Certified · Bacau, Romania · Open to remote work.', 'text-muted'),
        ],
        skills: () => [
            h('  <span class="text-accent">→ CMS / Backend</span>'),
            t('  Drupal 8/9/10 · PHP 8+ · Symfony · Laravel · REST API'),
            t(''),
            h('  <span class="text-accent">→ Frontend</span>'),
            t('  React · TypeScript · JavaScript · Twig · SCSS'),
            t(''),
            h('  <span class="text-accent">→ DevOps & Tools</span>'),
            t('  Docker · AWS · Acquia Cloud · Git · Linux · TDD'),
        ],
        experience: () => [
            h('  <span class="text-warm">2018 – present</span>  Drupal Developer <span class="text-muted">@ REEA, Iași</span>'),
            t('                  Custom modules · Symfony arch · REST APIs · Docker', 'text-muted'),
            t(''),
            h('  <span class="text-warm">2024 – 2025</span>     PHP/Drupal Developer <span class="text-muted">@ Holycode</span>'),
            t('                  Platform stability · SSO integration · Enterprise arch', 'text-muted'),
            t(''),
            h('  <span class="text-warm">2017 – 2018</span>     PHP/Drupal Developer <span class="text-muted">@ Softescu</span>'),
            t('                  Drupal 7–8 · Custom modules · Theming', 'text-muted'),
        ],
        contact: () => [
            h('  <span class="text-muted">email   </span>  <a href="mailto:florintomozei23@gmail.com" class="text-accent hover:underline">florintomozei23@gmail.com</a>'),
            h('  <span class="text-muted">linkedin</span>  <a href="https://linkedin.com/in/florin-tomozei1994" target="_blank" class="text-accent hover:underline">linkedin.com/in/florin-tomozei1994</a>'),
            t('  location   Bacau, Romania', 'text-muted'),
        ],
        ls: () => [
            h('  <a href="#work" class="text-accent hover:underline">work/</a>       client platforms'),
            h('  <a href="#skills" class="text-accent hover:underline">skills/</a>     tech stack &amp; tools'),
            h('  <a href="#notes" class="text-accent hover:underline">notes/</a>      blog &amp; TIL'),
            h('  <a href="#contact" class="text-accent hover:underline">contact/</a>    reach out'),
        ],
    };

    const EASTER = {
        'sudo':             '  Permission denied.',
        'sudo rm -rf /':    '  Portfolio intact. 🛡️',
        'exit':             "  There's no escape — you're already home.",
        'quit':             "  There's no escape — you're already home.",
        'npm install':      '  npm: command not found. (Try PHP instead.)',
        'composer install': '  Composer is for the server, not your browser.',
        'vim':              "  :q! — you're not getting trapped here.",
        'git log':          '  Try `experience` instead.',
    };

    return {
        input: '',
        lines: [],
        cmdHistory: [],
        histIdx: -1,

        init() {
            this.push('PHP / Drupal Developer &nbsp;·&nbsp; <span class="text-accent">Florin Tomozei</span>', 'text-muted', true);
            this.push('Type <span class="text-accent">help</span> to explore, or just start typing.', 'text-muted', true);
            this.push('─'.repeat(42), 'text-line/40', false);
            this.$nextTick(() => this.$refs.termInput?.focus());
        },

        push(html, cls = 'text-text', raw = false) {
            this.lines.push({ html: raw ? html : esc(html), cls });
            this.$nextTick(() => {
                if (this.$refs.output) this.$refs.output.scrollTop = this.$refs.output.scrollHeight;
            });
        },

        run() {
            const raw = this.input.trim();
            const cmd = raw.toLowerCase();
            this.push('<span class="text-accent/50 select-none">❯</span> ' + esc(raw), 'text-text', true);
            if (raw) { this.cmdHistory.unshift(raw); if (this.cmdHistory.length > 50) this.cmdHistory.pop(); this.histIdx = -1; }
            this.input = '';
            if (!raw) return;

            if (cmd === 'clear') { this.lines = []; return; }

            if (EASTER[cmd]) {
                this.push(esc(EASTER[cmd]), 'text-warm/80');
                this.push('');
                return;
            }

            const handler = CMDS[cmd];
            if (handler) {
                handler().forEach(({ html, cls }) => this.lines.push({ html, cls }));
            } else {
                this.push(esc(`  bash: ${raw}: command not found`), 'text-red-400/70');
            }
            this.push('');
            this.$nextTick(() => {
                if (this.$refs.output) this.$refs.output.scrollTop = this.$refs.output.scrollHeight;
            });
        },

        nav(dir) {
            if (!this.cmdHistory.length) return;
            this.histIdx = Math.max(-1, Math.min(this.cmdHistory.length - 1, this.histIdx + dir));
            this.input = this.histIdx >= 0 ? this.cmdHistory[this.histIdx] : '';
        },
    };
};

window.chatWidget = function () {
    return {
        messages: [],
        input: '',
        loading: false,
        started: false,

        suggestions: [
            "What's your tech stack?",
            "Drupal experience?",
            "Available for hire?",
            "What kind of projects?",
        ],

        init() {
            this.$nextTick(() => this.$refs.chatInput?.focus());
        },

        async send(text) {
            const msg = (text ?? this.input).trim();
            if (!msg || this.loading) return;

            this.input = '';
            this.started = true;
            this.messages.push({ role: 'user', content: msg });
            this.loading = true;
            this.$nextTick(() => this.scroll());

            const history = this.messages.slice(-7, -1).map(m => ({
                role: m.role === 'user' ? 'user' : 'assistant',
                content: m.content,
            }));

            try {
                const res = await fetch('/api/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
                    },
                    body: JSON.stringify({ message: msg, history }),
                });
                const data = await res.json();
                this.messages.push({ role: 'ai', content: data.reply || data.error || 'Something went wrong.' });
            } catch (_) {
                this.messages.push({ role: 'ai', content: 'Could not reach the server. Please try again.' });
            }

            this.loading = false;
            this.$nextTick(() => this.scroll());
        },

        scroll() {
            if (this.$refs.chatBody) this.$refs.chatBody.scrollTop = this.$refs.chatBody.scrollHeight;
        },
    };
};

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

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    initHero();
    initReveal();
    initScrollAnimations();

    document.fonts.ready.then(() => {
        ScrollTrigger.refresh();
    });
});
