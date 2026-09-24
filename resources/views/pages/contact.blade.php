<x-layout>
<x-slot:title>Contact — Florin Tomozei</x-slot:title>

<main class="pb-32 pt-16 px-6">
    <div class="max-w-xl mx-auto">

        <div class="mb-12 text-center" data-animate>
            <h1 class="text-4xl md:text-6xl font-semibold tracking-tight mb-4 text-gradient">Get in touch</h1>
            <p class="text-gray-400 text-lg">Have a project in mind or just want to say hello? I'd love to hear from you.</p>
        </div>

        @if(session('success'))
        <div class="glass p-4 mb-6 text-green-400 text-sm text-center rounded-xl border border-green-500/20" data-animate>
            {{ session('success') }}
        </div>
        @endif

        <form action="/contact" method="POST" class="glass p-8 space-y-6" data-animate>
            @csrf
            <div>
                <label class="block text-sm text-gray-400 mb-2">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/50 transition-colors"
                    placeholder="Your name">
                @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm text-gray-400 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/50 transition-colors"
                    placeholder="your@email.com">
                @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm text-gray-400 mb-2">Message</label>
                <textarea name="message" required rows="5"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/50 transition-colors resize-none"
                    placeholder="Tell me about your project...">{{ old('message') }}</textarea>
                @error('message') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <button type="submit"
                class="w-full py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-xl font-medium transition-colors">
                Send Message
            </button>
        </form>

    </div>
</main>

</x-layout>
