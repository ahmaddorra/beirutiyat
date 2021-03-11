@extends('layouts.app2')
@push('css')
   <style>
       .like p, .match p{
           white-space: nowrap;
           overflow: hidden;
           text-overflow: ellipsis;

       }
       .like img, .match img{
           display: block;
           margin: auto;
       }
   </style>
@endpush
@section('content')
    <div class="matches-cont container-fluid mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h6 class="matches-header">Matches</h6> <div class="number">1</div>
            </div>
        </div>
        <div class="matches my-3">
            @foreach($likes as $like)
                <div class="like">
                    <img class="rounded-image" width="50" height="50" src="{{asset("/images/a.jpg")}}" alt=""/>
                    <p>{{$like->name}}</p>
                    <i class="fas fa-heart"></i>
                </div>
            @endforeach

            @foreach($matches as $match)
            <a href="{{route("chat",$match->id)}}">
                <div class="match">
                    <img class="rounded-image" width="50" height="50" src="{{asset("/images/a.jpg")}}" alt=""/>
                    <p>{{$match->name}}</p>
                    <i class="fas fa-circle"></i>
                </div>
            </a>
           @endforeach


        </div>
    </div>


    <div class="messages-container">
        <div class="mt-3 p-3 bg-body rounded-top shadow-sm">
            <div class="messages-header text-center">
                <h6 class="pb-2 mb-0">Messages</h6> <div class="number">1</div>
            </div>
            @foreach($chat as $c)
                <a href="{{route("chat",$c[0]->id)}}">
                    <div class="d-flex text-muted pt-3 message">
                        <img class="rounded-image me-2" width="42" height="42" src="{{asset("/images/a.jpg")}}" alt=""/>
                        <i class="fas fa-circle"></i>
                        <div class="pb-3 mb-0 small lh-sm w-100">
                            <div class="d-flex justify-content-between">
                                <strong class="text-gray-dark">{{$c[0]->name}}</strong>
                            </div>
                            <span class="d-block">{{$c[1]->text}}</span>
                        </div>
                    </div>
                </a>
            @endforeach



        </div>
    </div>
@endsection
