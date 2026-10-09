<x-layout>
<x-slot:title>Contact — Florin Tomozei</x-slot:title>
<x-slot:description>Get in touch with Florin Tomozei — Drupal developer available for new projects. Schedule a meeting or send a message.</x-slot:description>

<main class="py-24 px-6">
    <div class="max-w-5xl mx-auto">

        {{-- Header --}}
        <div class="text-center mb-16" data-reveal>
            <x-section-label>Get in touch</x-section-label>
            <h1 class="font-display text-5xl md:text-6xl text-text mt-3 leading-tight">Let's work together</h1>
            <p class="text-muted mt-4 max-w-md mx-auto">
                Available for new projects. Reach out directly, book a time, or connect on LinkedIn.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">

            {{-- Sidebar: quick actions --}}
            <div class="lg:col-span-2 flex flex-col gap-4" data-reveal data-reveal-delay="0.05">

                @if(config('portfolio.calendly_url'))
                <a href="{{ config('portfolio.calendly_url') }}"
                   target="_blank" rel="noopener noreferrer"
                   class="flex items-center gap-4 p-5 bg-accent/10 border border-accent/25 rounded-2xl hover:bg-accent/15 hover:border-accent/40 transition-all group">
                    <div class="flex-none w-10 h-10 rounded-xl bg-accent/20 flex items-center justify-center text-accent">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-text font-medium text-sm">Book a call</p>
                        <p class="text-muted text-xs mt-0.5">Pick a time that works for you</p>
                    </div>
                    <span class="ml-auto text-muted group-hover:text-accent transition-colors text-xs font-mono">↗</span>
                </a>
                @endif

                @if(config('portfolio.linkedin_url'))
                <a href="{{ config('portfolio.linkedin_url') }}"
                   target="_blank" rel="noopener noreferrer"
                   class="flex items-center gap-4 p-5 bg-surface border border-line rounded-2xl hover:border-accent/20 hover:bg-surface-2 transition-all group">
                    <div class="flex-none w-10 h-10 rounded-xl bg-surface-2 border border-line flex items-center justify-center text-muted group-hover:text-accent transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-text font-medium text-sm">Connect on LinkedIn</p>
                        <p class="text-muted text-xs mt-0.5">linkedin.com/in/florintomozei</p>
                    </div>
                    <span class="ml-auto text-muted group-hover:text-accent transition-colors text-xs font-mono">↗</span>
                </a>
                @endif

                <div class="p-5 bg-surface border border-line rounded-2xl">
                    <p class="font-mono text-xs text-muted tracking-wider uppercase mb-3">Response time</p>
                    <p class="text-text text-sm">Usually within 24–48 hours on business days.</p>
                </div>

            </div>

            {{-- Contact form --}}
            <div class="lg:col-span-3" data-reveal data-reveal-delay="0.1">

                @if(session('success'))
                <div class="p-4 mb-6 rounded-2xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm text-center">
                    {{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                <div class="p-4 mb-6 rounded-2xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
                    Please fix the errors below and try again.
                </div>
                @endif

                <form action="/contact" method="POST" id="contact-form"
                      class="bg-surface border border-line rounded-3xl p-8 space-y-6">
                    @csrf

                    {{-- Honeypot: bots fill this, humans don't see it --}}
                    <div class="absolute opacity-0 pointer-events-none" aria-hidden="true" tabindex="-1">
                        <label for="website">Leave this blank</label>
                        <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                    </div>

                    <input type="hidden" name="recaptcha_token" id="recaptcha_token">

                    <div>
                        <label for="contact-name" class="block font-mono text-xs text-muted tracking-wider uppercase mb-2">Name</label>
                        <input type="text" id="contact-name" name="name" value="{{ old('name') }}" required
                               autocomplete="name"
                               class="w-full bg-surface-2 border border-line rounded-xl px-4 py-3 text-text placeholder-muted/40 focus:outline-none focus:border-accent/50 focus:ring-1 focus:ring-accent/20 transition-colors text-sm"
                               placeholder="Your name">
                        @error('name')
                        <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="contact-email" class="block font-mono text-xs text-muted tracking-wider uppercase mb-2">Email</label>
                        <input type="email" id="contact-email" name="email" value="{{ old('email') }}" required
                               autocomplete="email"
                               class="w-full bg-surface-2 border border-line rounded-xl px-4 py-3 text-text placeholder-muted/40 focus:outline-none focus:border-accent/50 focus:ring-1 focus:ring-accent/20 transition-colors text-sm"
                               placeholder="you@example.com">
                        @error('email')
                        <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="contact-message" class="block font-mono text-xs text-muted tracking-wider uppercase mb-2">Message</label>
                        <textarea id="contact-message" name="message" required rows="6"
                                  class="w-full bg-surface-2 border border-line rounded-xl px-4 py-3 text-text placeholder-muted/40 focus:outline-none focus:border-accent/50 focus:ring-1 focus:ring-accent/20 transition-colors resize-none text-sm"
                                  placeholder="Tell me about your project…">{{ old('message') }}</textarea>
                        @error('message')
                        <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" id="contact-submit"
                            class="w-full py-3.5 bg-accent hover:bg-accent/90 text-white font-medium text-sm rounded-xl transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                        Send message
                    </button>

                    <p class="text-muted/40 text-xs text-center">
                        Protected by reCAPTCHA —
                        <a href="https://policies.google.com/privacy" target="_blank" class="underline hover:text-muted/60">Privacy</a> &amp;
                        <a href="https://policies.google.com/terms" target="_blank" class="underline hover:text-muted/60">Terms</a>
                    </p>
                </form>

                @if(config('portfolio.recaptcha_site_key'))
                <script src="https://www.google.com/recaptcha/api.js?render={{ config('portfolio.recaptcha_site_key') }}"></script>
                <script>
                    const form = document.getElementById('contact-form');
                    const tokenInput = document.getElementById('recaptcha_token');
                    const submitBtn = document.getElementById('contact-submit');

                    form.addEventListener('submit', function (e) {
                        e.preventDefault();
                        submitBtn.disabled = true;
                        grecaptcha.ready(function () {
                            grecaptcha.execute('{{ config('portfolio.recaptcha_site_key') }}', { action: 'contact' })
                                .then(function (token) {
                                    tokenInput.value = token;
                                    form.submit();
                                });
                        });
                    });
                </script>
                @endif

            </div>

        </div>

    </div>
</main>

</x-layout>
