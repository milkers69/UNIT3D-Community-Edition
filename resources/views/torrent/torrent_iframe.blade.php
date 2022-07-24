<!DOCTYPE html>
<html lang="{{ auth()->user()->locale }}">
<head>
    @include('partials.head')
</head>
<body>
<main>
    <article>
        <div id="torrent-page">
            <div class="meta-wrapper box container" id="meta-info">
                {{-- Movie Meta Block --}}
                @if ($torrent->category->movie_meta)
                    @include('torrent.partials.movie_meta')
                @endif

                {{-- TV Meta Block --}}
                @if ($torrent->category->tv_meta)
                    @include('torrent.partials.tv_meta')
                @endif

                {{-- Game Meta Block --}}
                @if ($torrent->category->game_meta)
                    @include('torrent.partials.game_meta')
                @endif

                {{-- No Meta Block --}}
                @if ($torrent->category->no_meta)
                    @include('torrent.partials.no_meta')
                @endif

                <div style="padding: 10px; position: relative;">
                    <div class="vibrant-overlay"></div>
                    <div class="button-overlay"></div>
                </div>
                <h1 class="text-center" style="font-size: 22px; margin: 12px 0 0 0;">
                    {{ $torrent->name }}
                </h1>
                <div class="torrent-buttons">
                    @include('torrent.partials.buttons')
                </div>
            </div>

            <div class="meta-general box container">
                {{-- General Info Block --}}
                @include('torrent.partials.general')
                {{-- Tools Block --}}
                @if (auth()->user()->group->is_modo || auth()->user()->id === $uploader->id || auth()->user()->group->is_internal)
                    @include('torrent.partials.tools')
                @endif
                {{-- Audits Block --}}
                @if (auth()->user()->group->is_modo)
                    @include('torrent.partials.audits')
                    @include('torrent.partials.downloads')
                @endif
                {{-- MediaInfo Block --}}
                @if ($torrent->mediainfo !== null)
                    @include('torrent.partials.mediainfo')
                @endif
                {{-- BDInfo Block --}}
                @if ($torrent->bdinfo !== null)
                    @include('torrent.partials.bdinfo')
                @endif
                {{-- Description Block --}}
                @include('torrent.partials.description')
                {{-- Subtitles Block --}}
                @if($torrent->category->movie_meta || $torrent->category->tv_meta)
                    @include('torrent.partials.subtitles')
                @endif
            </div>
            {{-- Modals Block --}}
            @include('torrent.torrent_modals', ['user' => $user, 'torrent' => $torrent])
        </div>
    </article>
</main>
@if (isset($trailer))
    <script nonce="{{ HDVinnie\SecureHeaders\SecureHeaders::nonce() }}">
        $('.show-trailer').each(function () {
            $(this).off('click')
            $(this).on('click', function (e) {
                e.preventDefault()
                Swal.fire({
                    showConfirmButton: false,
                    showCloseButton: true,
                    background: 'rgb(35,35,35)',
                    width: 970,
                    html: '<iframe width="930" height="523" src="{{ $trailer }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>',
                    title: '<i style="color: #a5a5a5;">Trailer</i>',
                    text: ''
                })
            })
        })
    </script>
@endif

<script src="{{ mix('js/app.js') }}" crossorigin="anonymous"></script>
<script src="{{ mix('js/unit3d.js') }}" crossorigin="anonymous"></script>
<script src="{{ mix('js/alpine.js') }}" crossorigin="anonymous" defer></script>
<script src="{{ mix('js/virtual-select.js') }}" crossorigin="anonymous"></script>

<script nonce="{{ HDVinnie\SecureHeaders\SecureHeaders::nonce('script') }}">
    window.addEventListener('success', event => {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        })

        Toast.fire({
            icon: 'success',
            title: event.detail.message
        })
    })
</script>

<script nonce="{{ HDVinnie\SecureHeaders\SecureHeaders::nonce('script') }}">
    window.addEventListener('error', event => {
        Swal.fire({
            title: '<strong style=" color: rgb(17,17,17);">Error</strong>',
            icon: 'error',
            html: event.detail.message,
            showCloseButton: true,
        })
    })
</script>

@livewireScripts(['nonce' => HDVinnie\SecureHeaders\SecureHeaders::nonce()])

<script nonce="{{ HDVinnie\SecureHeaders\SecureHeaders::nonce('script') }}">
    Livewire.on('paginationChanged', () => {
        window.scrollTo({
            top: 15,
            left: 15,
            behaviour: 'smooth'
        })
    })
</script>
</body>
</html>