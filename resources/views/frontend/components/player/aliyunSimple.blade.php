<link rel="stylesheet" href="https://g.alicdn.com/de/prismplayer/2.8.7/skins/default/aliplayer-min.css"/>
<div id="xiaoteng-player"></div>
<script src="https://g.alicdn.com/de/prismplayer/2.8.7/aliplayer-min.js"></script>
<script type="text/javascript" charset="utf-8" src="{{asset('/js/aliplayercomponents-1.0.3.min.js')}}"></script>
<script>
    new Aliplayer({
        "id": "xiaoteng-player",
        "source": "{!! $video['url'] !!}",
        "width": "1200px",
        "height": "675px",
        "autoplay": false,
        "isLive": false,
        "rePlay": false,
        "playsinline": true,
        "cover": "{{$gConfig['system']['player_thumb']}}",
        "preload": false,
        "autoPlayDelay": 2,
        "autoPlayDelayDisplayText": '正在加载中...',
        "loadDataTimeout": "",
        "controlBarVisibility": "hover",
        "useH5Prism": true,
        components: [
                @if((int)$gConfig['system']['player']['enabled_bullet_secret'] === 1)
            {
                name: 'BulletScreenComponent',
                type: AliPlayerComponent.BulletScreenComponent,
                args: ['{{$user ? sprintf('会员%s', $user['mobile']) : config('app.name')}}', {
                    fontSize: '16px',
                    color: '#000000'
                }, 'random']
            }
            @endif
        ]
    },function(player){
    });
</script>