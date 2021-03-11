<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Beirutiyat') }}</title>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        const user_id = "{{$user->id}}"
        const recipient_id = "{{$recipient->id}}";
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('63aa90b10447964de3ad', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(message) {
            var m =JSON.stringify(message).split('"')
            var d = new moment(m[25]);
            if(m[9] ==  user_id){
                $( ".messages" ).append( '<div class="row text-end mt-2"><div class="col-12"><div class="message sent float-end"><p>'+m[17]+' </p></div><time>'+d.format('LT')+'</time> </div></div>' );
            }
            else if(m[9] ==  recipient_id ){
                $( ".messages" ).append( '<div class="row text-start mt-2"><div class="col-12"><div class="message received"><p>'+m[17]+'</p> </div><time>'+d.format('LT')+'</time></div></div>' );
            }
        });
    </script>
    <!-- Scripts -->
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        nav h5{
            display: block;
            margin: auto;
        }
        nav .rounded-image{
            border-radius: 50%;
            box-shadow: 0 0 1px 1px #E1E5E8;
        }
        nav .fa-less-than{
            vertical-align: bottom;
            color: #979B9E;
        }
        nav .fa-circle{
            font-size: .8rem;
            right: 1.35rem;
            position: absolute;
            color:#52AE57;
            -webkit-text-stroke-width: 2px;
            -webkit-text-stroke-color: #E1E5E8;
        }


        .messages-container{
            width: -webkit-fill-available;
            box-sizing: content-box;
            position: absolute;
            bottom: 50px;

        }
        .messages-container > div{
            overflow: scroll;
            height: 90vh;
            max-height: calc(100vh - 105px) !important;
        }
        .messages-container .rounded-top{
            border-radius: 2em 2em 0 0 !important;
        }

        .message{
            display: inline-block;
            padding: 7px;
            color: black;
            width:fit-content;
            min-width: 25%;
            max-width: 45%;
        }
        .message.received{
            background:#F4C242;
            border-radius: 0 2rem 2rem 2rem;
        }
        .message.sent{
            background:#F1F2F3;
            border-radius: 2rem 0 2rem 2rem;
        }
        time{
            font-size: 12px;
        }
        .input-message-container{
            height: 50px;
            border: 1px solid grey;
            border-radius: 1.8rem 1.8rem 0 0;
        }
        #input-message{
            height: 50px;
            padding: 5px;
            border: none;
            width: 100%;
            border-radius: 1.8rem 1.8rem 0 0;
        }
        #msg_send_btn{
            width: 40px;
            height: 40px;
            border: none;
            background: transparent;
            position: absolute;
            right: 2rem;
            top: 8px;
        }
        #msg_send_btn .fa-arrow-circle-right{
            font-size: 30px;
            color:#53B156;
        }
    </style>
</head>
<body>

<div class="nav-scroller bg-light">
    <nav class="nav nav-underline" aria-label="Navigation">
        <a class="nav-link " href="{{url()->previous() }}"><i class="fas fa-less-than"></i></a>
        <h5> {{$recipient->name}} </h5>
        <a class="nav-link" href="#">
            <img class="rounded-image me-2" width="42" height="42" src="{{asset("/images/a.jpg")}}" alt=""/>
            <i class="fas fa-circle"></i>
        </a>
    </nav>
</div>

<main>
    <div class="messages-container">
        <div class="mt-3 p-3 bg-body rounded-top shadow-sm messages">

{{--            <div class="row text-start mt-2">--}}
{{--                <div class="col-12">--}}
{{--                    <div class="message received">--}}
{{--                        <p>text </p>--}}
{{--                    </div>--}}
{{--                    <time>08:59</time>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="row text-end mt-2">--}}
{{--                <div class="col-12">--}}
{{--                    <div class="message sent float-end">--}}
{{--                        <p>text </p>--}}
{{--                    </div>--}}
{{--                    <time>08:59</time>--}}
{{--                </div>--}}
{{--            </div>--}}


        </div>
    </div>
</main>

<div class="fixed-bottom input-message-container">
    <form id="sendForm">
        <input type="text" id="input-message" name="input-message" class="write_msg" placeholder="Type your message here"/>
        <button id="msg_send_btn" type="submit"><i class="fas fa-arrow-circle-right"></i></button>
    </form>
</div>

<script>
    var dt;
    @foreach($chat as $c)
        dt = new moment("{{$c->created_at}}"+"-00:00")
        @if($c->from == $user->id)
            $( ".messages" ).append( '<div class="row text-end mt-2"><div class="col-12"><div class="message sent float-end"><p>{{$c->text}}</p></div><time>'+dt.format('LT')+'</time> </div></div>' );
        @else
            $( ".messages" ).append( '<div class="row text-start mt-2"><div class="col-12"><div class="message received"><p>{{$c->text}}</p></div><time>'+dt.format('LT')+'</time> </div></div>' );
        @endif
    @endforeach
</script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#msg_send_btn").click(function(e){

        e.preventDefault();

        var recipient = "{{$recipient->id}}";
        var text = $("#input-message").val();
        $("#input-message").val("")
        $.ajax({
            type:'POST',
            url:"{{ route('chat.send') }}",
            data:{recipient:recipient, text:text},
            success:function(data){
                console.log(data.success);
            }
        });

    });
</script>

<script src="https://kit.fontawesome.com/c4c221ed03.js" crossorigin="anonymous" defer></script>
</body>
</html>
