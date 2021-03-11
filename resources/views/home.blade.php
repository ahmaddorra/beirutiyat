@extends('layouts.app2')

@section('content')
    <div class="row">
        @foreach($users as $user)
            <div class="col-lg-4">
                <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="{{asset("/images/a.jpg")}}" />
                <h2>{{$user->name}}</h2>
                <p>Bio</p>
                <form  method="post" action="{{route('match.like', $user->id)}}">
                    @csrf
                    <p><button type="submit" class="btn btn-secondary">like</button></p>
                </form>
                <form  method="post" action="{{route('match.dislike', $user->id)}}">
                    @csrf
                    <p><button type="submit" class="btn btn-secondary">dislike</button></p>
                </form>
            </div><!-- /.col-lg-4 -->
        @endforeach
    </div>
@endsection
