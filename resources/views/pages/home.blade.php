<x-layout>
<x-slot:title>Florin Tomozei — Drupal Developer</x-slot:title>
<x-slot:description>Drupal developer for ambitious digital platforms, with the PHP range to solve the harder problems around them. Acquia-certified, full-stack, based in Romania.</x-slot:description>

<main>

{{-- ═══════════════════════════════════════════════════════
     HERO
═══════════════════════════════════════════════════════ --}}
<section id="hero" data-section="hero"
    class="relative min-h-[calc(100vh-4rem)] flex items-center px-6 py-20 overflow-hidden">

    <x-hero-bg />

    <div class="relative z-10 w-full max-w-6xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

            {{-- Headline column --}}
            <div class="lg:col-span-7 space-y-8">

                <div data-hero>
                    <x-section-label>Available for new projects</x-section-label>
                </div>

                <h1 class="font-display text-[2.75rem] md:text-6xl lg:text-[4.25rem] leading-[1.06] text-text" data-hero>
                    Drupal developer<br>
                    for <em class="text-warm">ambitious</em><br>
                    digital platforms.
                </h1>

                <p class="text-muted text-lg leading-relaxed max-w-lg" data-hero>
                    Acquia-certified, full-stack, and at home with the harder PHP problems
                    that come with large-scale Drupal platforms. Nine years shipping stable
                    systems for agencies — from custom modules to enterprise integrations.
                </p>

                @php $meetingHref = config('portfolio.calendly_url') ?: '/contact'; @endphp
                <div class="flex flex-wrap items-center gap-4" data-hero>
                    <x-button-primary href="#work">See selected work</x-button-primary>
                    @if(config('portfolio.calendly_url'))
                        <x-button-ghost href="{{ $meetingHref }}" target="_blank" rel="noopener noreferrer">Schedule a meeting</x-button-ghost>
                    @else
                        <x-button-ghost href="{{ $meetingHref }}">Schedule a meeting</x-button-ghost>
                    @endif
                </div>
            </div>

            {{-- AI chat widget --}}
            <div class="lg:col-span-5" data-hero>
                <div x-data="chatWidget()"
                     class="bg-surface-2 border border-line rounded-2xl overflow-hidden shadow-xl shadow-bg/50 flex flex-col h-[340px]">

                    {{-- Title bar --}}
                    <div class="flex items-center gap-1.5 px-4 py-2.5 border-b border-line bg-surface shrink-0">
                        <span class="w-2.5 h-2.5 rounded-full bg-red-500/50"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-yellow-400/50"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-green-500/50"></span>
                        <span class="ml-2 font-mono text-xs text-muted tracking-wide">ask me anything</span>
                        <span class="ml-auto flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-400/80 animate-pulse"></span>
                            <span class="font-mono text-[10px] text-muted/40 hidden sm:block">AI online</span>
                        </span>
                    </div>

                    {{-- Chat body --}}
                    <div x-ref="chatBody"
                         class="flex-1 overflow-y-auto px-4 py-3"
                         style="scrollbar-width: thin; scrollbar-color: var(--color-line) transparent;">

                        {{-- Suggestions (empty state) --}}
                        <div x-show="!started" x-transition class="flex flex-col items-center justify-center h-full gap-3">
                            <p class="font-mono text-[11px] text-muted/50 tracking-wide">Ask me about Florin →</p>
                            <div class="flex flex-wrap gap-2 justify-center">
                                <template x-for="s in suggestions" :key="s">
                                    <button @click="send(s)"
                                            class="text-[11px] px-3 py-1.5 rounded-full border border-line bg-surface text-muted hover:text-text hover:border-accent/40 transition-colors duration-150 cursor-pointer">
                                        <span x-text="s"></span>
                                    </button>
                                </template>
                            </div>
                        </div>

                        {{-- Messages --}}
                        <div x-show="started" class="flex flex-col gap-2.5">
                            <template x-for="(msg, i) in messages" :key="i">
                                <div :class="msg.role === 'user' ? 'flex justify-end' : 'flex justify-start'">
                                    <div :class="msg.role === 'user'
                                            ? 'bg-accent text-white text-xs px-3 py-2 rounded-2xl rounded-tr-sm max-w-[78%] leading-relaxed'
                                            : 'bg-surface text-text text-xs px-3 py-2 rounded-2xl rounded-tl-sm max-w-[82%] border border-line/50 leading-relaxed'"
                                         x-text="msg.content">
                                    </div>
                                </div>
                            </template>

                            {{-- Typing indicator --}}
                            <div x-show="loading" class="flex justify-start">
                                <div class="bg-surface border border-line/50 px-4 py-2.5 rounded-2xl rounded-tl-sm flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-muted/50 animate-bounce" style="animation-delay:0ms"></span>
                                    <span class="w-1.5 h-1.5 rounded-full bg-muted/50 animate-bounce" style="animation-delay:160ms"></span>
                                    <span class="w-1.5 h-1.5 rounded-full bg-muted/50 animate-bounce" style="animation-delay:320ms"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Input bar --}}
                    <div class="border-t border-line bg-surface shrink-0 flex items-center gap-2 px-3 py-2">
                        <input x-ref="chatInput"
                               x-model="input"
                               @keydown.enter.prevent="send()"
                               type="text"
                               placeholder="Type a question…"
                               :disabled="loading"
                               autocomplete="off"
                               spellcheck="false"
                               class="flex-1 bg-transparent text-text text-xs placeholder:text-muted/40 outline-none min-w-0 py-1"
                               aria-label="Chat input">
                        <button @click="send()"
                                :disabled="loading || !input.trim()"
                                class="shrink-0 w-7 h-7 rounded-full bg-accent flex items-center justify-center disabled:opacity-30 transition-opacity hover:bg-accent/90 cursor-pointer">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.269 20.876L5.999 12zm0 0h7.5"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll nudge --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-muted/50" data-hero>
        <span class="font-mono text-[0.65rem] tracking-[0.2em] uppercase">scroll</span>
        <div class="bounce-slow w-px h-8 bg-gradient-to-b from-muted/40 to-transparent"></div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     PROOF STRIP
═══════════════════════════════════════════════════════ --}}
<section class="border-y border-line/50 py-16">
    <div class="max-w-5xl mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-4">

            {{-- 9+ years --}}
            <div class="flex flex-col items-center text-center gap-2" data-reveal>
                <span class="font-display text-5xl font-medium text-text leading-none">9<span class="text-accent">+</span></span>
                <span class="text-muted text-sm">years of experience</span>
            </div>

            {{-- Acquia certified --}}
            <div class="flex flex-col items-center text-center gap-2" data-reveal data-reveal-delay="0.08">
                <img src="{{ asset('badge.png') }}" alt="Acquia Certified Drupal 10 Developer" class="w-16 h-16 object-contain" loading="lazy">
                <span class="text-muted text-sm">Acquia certified</span>
            </div>

            {{-- 5 agencies --}}
            <div class="flex flex-col items-center text-center gap-2" data-reveal data-reveal-delay="0.16">
                <span class="font-display text-5xl font-medium text-text leading-none">4</span>
                <span class="text-muted text-sm">agencies worked with</span>
            </div>

            {{-- 6 platforms --}}
            <div class="flex flex-col items-center text-center gap-2" data-reveal data-reveal-delay="0.24">
                <span class="font-display text-5xl font-medium text-text leading-none">6</span>
                <span class="text-muted text-sm">client platforms</span>
            </div>

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     AGENCY JOURNEY
═══════════════════════════════════════════════════════ --}}
@if($agencies->count())
<section id="journey" class="py-16">
    <div class="max-w-5xl mx-auto px-6 mb-10 text-center" data-reveal>
        <x-section-label>My path</x-section-label>
        <h2 class="font-display text-4xl md:text-5xl text-text mt-3 leading-tight">Agency Journey</h2>
    </div>

    <div class="flex flex-wrap justify-center gap-4 max-w-2xl mx-auto px-6" data-reveal data-reveal-delay="0.08">
        @foreach($agencies as $agency)
        <a href="{{ $agency->url }}"
           target="_blank"
           rel="noopener noreferrer"
           aria-label="{{ $agency->name }}"
           class="flex items-center justify-center h-[50px] px-4 rounded-xl bg-surface border border-line hover:border-accent/30 hover:bg-surface-2 transition-all duration-200">
            @if($agency->logo_path)
                <img src="{{ asset($agency->logo_path) }}" alt="{{ $agency->name }}" class="h-[32px] w-auto max-w-[140px] object-contain" loading="lazy">
            @else
                <span class="font-mono text-xs text-muted">{{ $agency->name }}</span>
            @endif
        </a>
        @endforeach
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════
     WORK — Client platforms
═══════════════════════════════════════════════════════ --}}
<section id="work" data-section="work" class="py-24 px-6">
    <div class="max-w-6xl mx-auto">

        <div class="flex items-end justify-between mb-14" data-reveal>
            <div>
                <x-section-label>Selected work</x-section-label>
                <h2 class="font-display text-4xl md:text-5xl text-text mt-3 leading-tight">Client platforms</h2>
            </div>
            <a href="/projects" class="text-sm text-muted hover:text-text transition-colors hidden sm:block">
                All projects →
            </a>
        </div>

        @if($platforms->count())
        @php $pCount = $platforms->count(); @endphp
        <div
            x-data="{
                cur: 0,
                n: {{ $pCount }},
                isDragging: false,
                didDrag: false,
                dragStartX: 0,
                dragDelta: 0,
                get max() { return this.n - 1; },
                get shift() {
                    const c = this.$refs.track && this.$refs.track.firstElementChild;
                    const clip = this.$refs.clip;
                    if (!c || !clip) return 0;
                    const cw = c.offsetWidth + 24;
                    const maxS = Math.max(0, this.n * cw - 24 - clip.clientWidth);
                    const base = Math.min(this.cur * cw, maxS);
                    return Math.max(0, base - (this.isDragging ? this.dragDelta : 0));
                },
                paused: false,
                _autoTimer: null,
                prev() { this.cur = this.cur === 0 ? this.max : this.cur - 1; this.resetAuto(); },
                next() { this.cur = this.cur >= this.max ? 0 : this.cur + 1; },
                go(i)  { this.cur = Math.max(0, Math.min(i, this.max)); this.resetAuto(); },
                startAuto() {
                    clearInterval(this._autoTimer);
                    this._autoTimer = setInterval(() => { if (!this.paused && !this.isDragging) this.next(); }, 4000);
                },
                stopAuto()  { clearInterval(this._autoTimer); },
                resetAuto() { this.stopAuto(); this.startAuto(); },
                startDrag(e) {
                    if (e.pointerType === 'mouse' && e.button !== 0) return;
                    this.isDragging = true; this.didDrag = false;
                    this.dragStartX = e.clientX; this.dragDelta = 0;
                    this.$refs.track.setPointerCapture(e.pointerId);
                },
                moveDrag(e) {
                    if (!this.isDragging) return;
                    this.dragDelta = e.clientX - this.dragStartX;
                    if (Math.abs(this.dragDelta) > 5) this.didDrag = true;
                },
                endDrag(e) {
                    if (!this.isDragging) return;
                    const dx = this.dragDelta;
                    this.isDragging = false; this.dragDelta = 0;
                    this.$refs.track.releasePointerCapture(e.pointerId);
                    if (Math.abs(dx) > 50) { dx < 0 ? this.next() : this.prev(); }
                    this.resetAuto();
                }
            }"
            x-init="$nextTick(() => {
                let wheelTimer, acc = 0;
                $refs.clip.addEventListener('wheel', (e) => {
                    if (Math.abs(e.deltaX) < 5) return;
                    e.preventDefault();
                    acc += e.deltaX;
                    clearTimeout(wheelTimer);
                    wheelTimer = setTimeout(() => {
                        if (acc > 60) { $data.next(); $data.resetAuto(); }
                        else if (acc < -60) { $data.prev(); $data.resetAuto(); }
                        acc = 0;
                    }, 80);
                }, { passive: false });
                $data.startAuto();
            })"
            @mouseenter="paused = true"
            @mouseleave="paused = false"
            @resize.window.debounce="cur = 0"
            @visibilitychange.window="document.hidden ? stopAuto() : startAuto()">

            {{-- Overflow clip --}}
            <div x-ref="clip" class="overflow-hidden py-4">
                <div
                    x-ref="track"
                    class="flex gap-6 ease-out will-change-transform select-none"
                    :class="isDragging ? 'transition-none cursor-grabbing' : 'transition-transform duration-500 cursor-grab'"
                    :style="{ transform: 'translateX(-' + shift + 'px)' }"
                    @pointerdown="startDrag($event)"
                    @pointermove="moveDrag($event)"
                    @pointerup="endDrag($event)"
                    @pointercancel="endDrag($event)"
                    @click.capture="if (didDrag) { $event.preventDefault(); didDrag = false; }">

                    @foreach($platforms as $project)
                    <div class="relative group bg-surface border border-line rounded-3xl overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:border-accent/20 hover:shadow-2xl hover:shadow-bg/50 shrink-0 w-full md:w-[calc(50%-12px)]">

                        {{-- Browser frame --}}
                        @php
                            $isLogo = $project->thumbnail && str_contains($project->thumbnail, '-logo.');
                            $invertLogo = $isLogo && $project->slug === 'isf';
                        @endphp
                        <x-browser-frame url="{{ $project->url }}">
                            @if($project->thumbnail && $isLogo)
                            {{-- Logo: centered on a subtle branded background --}}
                            <div class="absolute inset-0 flex items-center justify-center bg-surface-2">
                                <div class="absolute inset-0 bg-gradient-to-br from-accent/5 via-transparent to-warm/5"></div>
                                <img
                                    src="{{ $project->thumbnail }}"
                                    alt="{{ $project->title }} logo"
                                    class="relative max-h-14 max-w-[55%] object-contain transition-transform duration-500 group-hover:scale-110 @if($invertLogo) brightness-0 invert @endif"
                                    loading="lazy"
                                    draggable="false">
                            </div>
                            @elseif($project->thumbnail)
                            {{-- Screenshot: cover + subtle parallax on hover --}}
                            <img
                                src="{{ $project->thumbnail }}"
                                alt="{{ $project->title }} website"
                                class="w-full h-full object-cover object-top transition-transform duration-700 ease-out group-hover:scale-105 group-hover:-translate-y-2"
                                loading="lazy"
                                draggable="false">
                            @else
                            <div class="absolute inset-0 flex items-center justify-center select-none">
                                <div class="absolute inset-0 bg-gradient-to-br from-accent/8 to-warm/5"></div>
                                <span class="relative font-mono text-xs text-muted/50">{{ parse_url($project->url, PHP_URL_HOST) }}</span>
                            </div>
                            @endif
                        </x-browser-frame>

                        {{-- Card body --}}
                        <div class="p-6">
                            <div class="flex items-start justify-between gap-3 mb-3">
                                <div>
                                    <h3 class="text-text font-semibold text-lg leading-snug">{{ $project->title }}</h3>
                                    <p class="text-muted text-sm mt-0.5">{{ $project->role }}</p>
                                </div>
                                @if($project->url)
                                <a href="{{ $project->url }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="flex-none font-mono text-xs text-muted hover:text-accent transition-colors mt-0.5 z-10 relative"
                                   aria-label="Visit {{ $project->title }} website">
                                    Visit site ↗
                                </a>
                                @endif
                            </div>

                            @if($project->agency)
                            <p class="font-mono text-xs text-muted mb-3">via {{ $project->agency->name }}</p>
                            @endif

                            <p class="text-muted text-sm leading-relaxed mb-4">{{ $project->summary }}</p>

                            @if($project->tech_stack)
                            <div class="flex flex-wrap gap-2">
                                @foreach(array_slice((array) $project->tech_stack, 0, 5) as $tech)
                                <x-chip>{{ $tech }}</x-chip>
                                @endforeach
                            </div>
                            @endif
                        </div>

                        {{-- Full-card link --}}
                        <a href="/projects/{{ $project->slug }}"
                           class="absolute inset-0 z-0 rounded-3xl outline-none focus-visible:ring-2 focus-visible:ring-accent/60"
                           aria-label="View {{ $project->title }} case study"></a>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Controls bar --}}
            <div class="flex items-center justify-between mt-8">

                {{-- Prev button --}}
                <button
                    @click="prev()"
                    class="group flex items-center gap-2 px-5 py-2.5 rounded-full bg-surface border border-line text-sm font-medium text-muted transition-all duration-200 hover:border-accent/40 hover:text-accent hover:bg-surface-2 hover:-translate-x-0.5"
                    aria-label="Previous platform">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    <span>Prev</span>
                </button>

                {{-- Dots + counter --}}
                <div class="flex flex-col items-center gap-2.5">
                    <div class="flex items-center gap-1.5">
                        <template x-for="i in (max + 1)" :key="i">
                            <button
                                @click="go(i - 1)"
                                :class="cur === (i - 1)
                                    ? 'bg-accent w-6'
                                    : 'bg-line/50 w-1.5 hover:bg-muted/50'"
                                class="h-1.5 rounded-full transition-all duration-300"
                                :aria-label="'Go to slide ' + i">
                            </button>
                        </template>
                    </div>
                    <span
                        class="font-mono text-[0.65rem] text-muted/40 tabular-nums tracking-wider"
                        x-text="(cur + 1) + ' / ' + n">
                    </span>
                </div>

                {{-- Next button --}}
                <button
                    @click="next()"
                    class="group flex items-center gap-2 px-5 py-2.5 rounded-full bg-surface border border-line text-sm font-medium text-muted transition-all duration-200 hover:border-accent/40 hover:text-accent hover:bg-surface-2 hover:translate-x-0.5"
                    aria-label="Next platform">
                    <span>Next</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>

            </div>
        </div>
        @endif

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════
     SKILLS — Bento grid
═══════════════════════════════════════════════════════ --}}
<section id="skills" data-section="skills" class="py-24 px-6">
    <div class="max-w-6xl mx-auto">

        <div class="mb-14" data-reveal>
            <x-section-label>What I bring</x-section-label>
            <h2 class="font-display text-4xl md:text-5xl text-text mt-3 leading-tight">Skills &amp; tools</h2>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 auto-rows-auto">
            @foreach($skills as $skill)
            @php
                $colClass = match((int)$skill->col_span) {
                    2 => 'col-span-2',
                    3 => 'col-span-2 lg:col-span-3',
                    4 => 'col-span-2 lg:col-span-4',
                    default => 'col-span-2 sm:col-span-1',
                };
                $borderClass = match($skill->variant) {
                    'accent' => 'border-accent/30 bg-accent/5',
                    'warm'   => 'border-warm/30 bg-warm/5',
                    default  => 'border-line bg-surface',
                };
                $labelClass = match($skill->variant) {
                    'accent' => 'text-accent',
                    'warm'   => 'text-warm',
                    default  => 'text-muted',
                };
            @endphp
            <div class="{{ $colClass }} rounded-3xl border {{ $borderClass }} p-6 flex flex-col gap-4"
                 data-reveal data-reveal-delay="{{ $loop->index * 0.07 }}">
                <h3 class="font-semibold text-text text-base">{{ $skill->name }}</h3>

                @if($skill->description)
                    <p class="text-muted text-sm leading-relaxed flex-1">{{ $skill->description }}</p>
                @endif

                @if(count($skill->items ?? []))
                <div class="flex flex-wrap gap-2 mt-auto">
                    @foreach($skill->items as $item)
                        @if($skill->variant === 'accent')
                            <x-chip>{{ $item }}</x-chip>
                        @elseif($skill->variant === 'warm')
                            <span class="font-mono text-xs px-2 py-1 rounded-md bg-warm/10 border border-warm/20 text-warm">{{ $item }}</span>
                        @else
                            <span class="font-mono text-xs px-2 py-1 rounded-md bg-surface-2 border border-line text-muted">{{ $item }}</span>
                        @endif
                    @endforeach
                </div>
                @endif
            </div>
            @endforeach
        </div>

    </div>
</section>


{{-- ═══════════════════════════════════════════════════════
     NOTES — Featured post + TIL rows
═══════════════════════════════════════════════════════ --}}
@if($featured_post || $til_posts->count())
<section id="notes" data-section="notes" class="py-24 px-6">
    <div class="max-w-6xl mx-auto">

        <div class="flex items-end justify-between mb-14" data-reveal>
            <div>
                <x-section-label>Writing</x-section-label>
                <h2 class="font-display text-4xl md:text-5xl text-text mt-3 leading-tight">Notes &amp; snippets</h2>
            </div>
            <div class="hidden sm:flex items-center gap-4">
                <a href="/blog" class="text-sm text-muted hover:text-text transition-colors">All posts →</a>
                <a href="/til"  class="text-sm text-muted hover:text-text transition-colors">All TIL →</a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Featured article --}}
            @if($featured_post)
            <div class="lg:col-span-2" data-reveal>
                <a href="/blog/{{ $featured_post->slug }}"
                   class="group block h-full bg-surface border border-line rounded-3xl overflow-hidden hover:-translate-y-1 hover:border-accent/20 hover:shadow-2xl hover:shadow-bg/50 transition-all duration-300">

                    @if($featured_post->cover_image)
                    <div class="aspect-video overflow-hidden">
                        <img src="{{ Storage::url($featured_post->cover_image) }}"
                             alt="{{ $featured_post->title }}"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                             loading="lazy">
                    </div>
                    @endif

                    <div class="p-8">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="font-mono text-xs px-2 py-1 rounded-md bg-accent/10 border border-accent/20 text-accent">Featured</span>
                            @if($featured_post->published_at)
                            <span class="font-mono text-xs text-muted">{{ $featured_post->published_at->format('M j, Y') }}</span>
                            @endif
                        </div>
                        <h3 class="font-display text-2xl text-text leading-snug mb-3 group-hover:text-accent transition-colors">
                            {{ $featured_post->title }}
                        </h3>
                        @if($featured_post->excerpt)
                        <p class="text-muted text-sm leading-relaxed">{{ $featured_post->excerpt }}</p>
                        @endif
                    </div>
                </a>
            </div>
            @endif

            {{-- TIL rows --}}
            @if($til_posts->count())
            <div class="flex flex-col gap-4" data-reveal data-reveal-delay="0.1">
                <div class="flex items-center justify-between mb-2">
                    <x-section-label>Today I learned</x-section-label>
                    <a href="/til" class="font-mono text-xs text-muted hover:text-accent transition-colors">All →</a>
                </div>

                @foreach($til_posts as $til)
                <a href="/til#{{ $til->slug }}"
                   class="group flex flex-col gap-2 bg-surface border border-line rounded-2xl p-5 hover:-translate-y-0.5 hover:border-accent/20 transition-all duration-200">
                    <div class="flex items-center justify-between gap-2">
                        <h4 class="text-text text-sm font-medium leading-snug group-hover:text-accent transition-colors">{{ $til->title }}</h4>
                        @if($til->published_at)
                        <span class="font-mono text-xs text-muted/60 flex-none">{{ $til->published_at->format('M j') }}</span>
                        @endif
                    </div>
                    @if(count($til->tags ?? []))
                    <div class="flex flex-wrap gap-1.5">
                        @foreach(array_slice((array) $til->tags, 0, 3) as $tag)
                        <span class="font-mono text-[0.65rem] px-1.5 py-0.5 rounded bg-surface-2 border border-line text-muted">{{ $tag }}</span>
                        @endforeach
                    </div>
                    @endif
                </a>
                @endforeach
            </div>
            @endif

        </div>

    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════
     CONTACT — Section on home page
═══════════════════════════════════════════════════════ --}}
<section id="contact" data-section="contact" class="py-24 px-6">
    <div class="max-w-4xl mx-auto">

        <div class="text-center mb-14" data-reveal>
            <x-section-label>Get in touch</x-section-label>
            <h2 class="font-display text-4xl md:text-5xl text-text mt-3 leading-tight">Let's work together</h2>
            <p class="text-muted mt-4 max-w-lg mx-auto">
                Have a project in mind or want to explore a collaboration? Reach out directly or find a time that works.
            </p>
        </div>

        {{-- Quick-action links --}}
        <div class="flex flex-wrap justify-center gap-4 mb-16" data-reveal data-reveal-delay="0.1">
            @if(config('portfolio.calendly_url'))
            <a href="{{ config('portfolio.calendly_url') }}"
               target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center gap-2.5 px-6 py-3 rounded-full bg-accent text-white font-medium text-sm hover:bg-accent/90 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5"/>
                </svg>
                Schedule a meeting
            </a>
            @endif

            @if(config('portfolio.linkedin_url'))
            <a href="{{ config('portfolio.linkedin_url') }}"
               target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center gap-2.5 px-6 py-3 rounded-full bg-surface border border-line text-text font-medium text-sm hover:border-accent/30 hover:bg-surface-2 transition-colors">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                </svg>
                Connect on LinkedIn
            </a>
            @endif

            <a href="/contact"
               class="inline-flex items-center gap-2.5 px-6 py-3 rounded-full bg-surface border border-line text-text font-medium text-sm hover:border-accent/30 hover:bg-surface-2 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                </svg>
                Send a message
            </a>
        </div>

    </div>
</section>

</main>

</x-layout>
