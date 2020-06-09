<div id="meedu-player"></div>
<script>
    const XGPlayerConfig = {
        el: document.querySelector('#meedu-player'),
        width: 1200,
        height: 675,
        poster: "{{$gConfig['system']['player_thumb']}}",
        playsinline: true,
        playbackRate: [0.5, 0.75, 1, 1.5, 2],
        defaultPlaybackRate: 1,
        pip: true,
        cssFullscreen: true,
        url: "{!! $playUrls->first()['url'] !!}",
        keyShortcut: 'on',
        definitionActive: 'click',
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
        $('.need-login').show();
    });
</script>