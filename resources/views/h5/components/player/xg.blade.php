<div id="meedu-player"></div>
<script>
    const XGPlayerConfig = {
        el: document.querySelector('#meedu-player'),
        width: window.innerWidth,
        height: 192,
        poster: "{{$gConfig['system']['player_thumb']}}",
        playbackRate: [0.5, 0.75, 1, 1.5, 2],
        defaultPlaybackRate: 1,
        url: "{!! $playUrls->first()['url'] !!}",
        // 'x5-video-player-type': 'h5',
        // 'x5-video-player-fullscreen': false,
        // 'x5-video-orientation': 'landscape',
        playsinline: false,
        airplay: true,
        useHls: true,
        closeVideoTouch: true,
        closeVideoClick: true,
        @if($gConfig['system']['player']['enabled_bullet_secret'] === 1)
        marquee: {
        value: '{{$user['mobile']}}'
        },
        @endif
    };
            @if($playUrls->first()['format'] === 'm3u8')
    const XGPlayer = new HlsJsPlayer(XGPlayerConfig);
            @else
    const XGPlayer = new Player(XGPlayerConfig);
    @endif

    @if($playUrls->count() > 1)
    XGPlayer.emit('resourceReady', @json($playUrls));
            @endif

    var PREV_SECONDS = 0;
    var recordHandle = function () {
        var s = parseInt(XGPlayer.currentTime);
        if (s > PREV_SECONDS) {
            PREV_SECONDS = s;
            $.post('{{route('ajax.video.watch.record', [$video['id']])}}', {
                _token: '{{csrf_token()}}',
                duration: s
            }, function (res) {
            }, 'json');
        }
    };
    setInterval('recordHandle()', 10000);
    XGPlayer.on('ended', function () {
        recordHandle();
        $('#meedu-player').hide();
        $('.watched-over').show();
    });
</script>