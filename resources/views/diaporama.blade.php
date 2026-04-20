@extends('layouts.diaporama')

@section('content')
    <div class="flex h-svh flex-col">

        {{-- Top bar --}}
        <div class="flex-none border-b border-white/10 bg-black/90 px-4 py-3 text-center text-white">
            <p class="text-xs font-semibold uppercase tracking-widest text-white/40">Diaporama</p>
            @if ($submission)
                <p class="mt-0.5 font-semibold leading-tight">{{ $submission->name }}</p>
                @if ($submission->caption)
                    <p class="text-sm italic text-white/60">{{ $submission->caption }}</p>
                @endif
            @endif
        </div>

        {{-- Image area --}}
        <div
            id="photo-wrap"
            class="flex flex-1 items-center justify-center overflow-hidden touch-none select-none"
        >
            @if ($submission)
                <img
                    id="photo-img"
                    src="{{ $submission->getFirstMediaUrl('photo', 'display') }}"
                    alt="{{ $submission->caption ?? 'Photo de ' . $submission->name }}"
                    class="max-h-full max-w-full object-contain"
                    style="transform-origin: center center;"
                    draggable="false"
                />
            @else
                <div class="text-center">
                    <p class="text-lg text-white/40">Aucune photo disponible pour le moment.</p>
                    <a href="{{ route('diaporama.submit') }}" class="mt-6 inline-block rounded-full bg-white/10 px-6 py-2.5 text-sm font-semibold text-white hover:bg-white/20">
                        Soumettre la première photo
                    </a>
                </div>
            @endif
        </div>

        {{-- Bottom bar --}}
        <div class="flex-none border-t border-white/10 bg-black/90 px-4 py-3">
            @if ($submission)
                {{-- Votes + report row --}}
                <div class="flex items-center justify-center gap-3">
                    <form action="{{ route('diaporama.vote', $submission) }}" method="POST">
                        @csrf
                        <input type="hidden" name="vote" value="up" />
                        <button type="submit" class="flex items-center gap-1.5 rounded-full px-4 py-1.5 text-sm font-semibold transition {{ $userVote === 'up' ? 'bg-emerald-500 text-white' : 'bg-white/10 text-white hover:bg-white/20' }}">
                            <span>👍</span>
                            <span>{{ $submission->upvotes_count }}</span>
                        </button>
                    </form>

                    <form action="{{ route('diaporama.vote', $submission) }}" method="POST">
                        @csrf
                        <input type="hidden" name="vote" value="down" />
                        <button type="submit" class="flex items-center gap-1.5 rounded-full px-4 py-1.5 text-sm font-semibold transition {{ $userVote === 'down' ? 'bg-red-500 text-white' : 'bg-white/10 text-white hover:bg-white/20' }}">
                            <span>👎</span>
                            <span>{{ $submission->downvotes_count }}</span>
                        </button>
                    </form>

                    <span class="h-4 w-px bg-white/20"></span>

                    @if (session('reported'))
                        <span class="text-xs text-white/40">Signalement enregistré</span>
                    @else
                        <form action="{{ route('diaporama.report', $submission) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-xs text-white/30 underline hover:text-white/60 transition">
                                Signaler
                            </button>
                        </form>
                    @endif
                </div>

                {{-- Navigation row --}}
                <div class="mt-3 flex items-center justify-center gap-3">
                    <a href="{{ route('diaporama') }}" class="rounded-full bg-white/10 px-5 py-2 text-sm font-semibold text-white hover:bg-white/20 transition">
                        Nouvelle photo
                    </a>
                    <a href="{{ route('diaporama.submit') }}" class="rounded-full bg-white/10 px-5 py-2 text-sm font-semibold text-white hover:bg-white/20 transition">
                        Soumettre une photo
                    </a>
                </div>
            @else
                <div class="flex justify-center">
                    <a href="{{ route('diaporama') }}" class="rounded-full bg-white/10 px-5 py-2 text-sm font-semibold text-white hover:bg-white/20 transition">
                        Actualiser
                    </a>
                </div>
            @endif
        </div>

    </div>
@endsection

@section('bottom-scripts')
<script>
    (function () {
        const wrap = document.getElementById('photo-wrap');
        const img  = document.getElementById('photo-img');
        if (!wrap || !img) return;

        let scale = 1, lastScale = 1, startDist = 0, lastTap = 0;

        function applyScale(s) {
            scale = Math.min(Math.max(s, 1), 5);
            img.style.transform = scale === 1 ? '' : `scale(${scale})`;
        }

        wrap.addEventListener('touchstart', e => {
            if (e.touches.length === 2) {
                startDist = Math.hypot(
                    e.touches[0].clientX - e.touches[1].clientX,
                    e.touches[0].clientY - e.touches[1].clientY
                );
            }
        }, { passive: true });

        wrap.addEventListener('touchmove', e => {
            if (e.touches.length !== 2) return;
            e.preventDefault();
            const dist = Math.hypot(
                e.touches[0].clientX - e.touches[1].clientX,
                e.touches[0].clientY - e.touches[1].clientY
            );
            applyScale(lastScale * (dist / startDist));
        }, { passive: false });

        wrap.addEventListener('touchend', e => {
            lastScale = scale;
            // double-tap to reset
            const now = Date.now();
            if (now - lastTap < 300) {
                lastScale = 1;
                applyScale(1);
            }
            lastTap = now;
        });

        wrap.addEventListener('wheel', e => {
            e.preventDefault();
            applyScale(scale * (e.deltaY < 0 ? 1.1 : 0.9));
            lastScale = scale;
        }, { passive: false });
    })();
</script>
@endsection
