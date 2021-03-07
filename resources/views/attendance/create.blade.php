@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <nav class="create_nav">

                <div class="create_nav_items">
                    <p class="nav_first"><a>ホーム</a></p>
                </div>

                <div class="create_nav_items">
                    <p><a href="{{route('attendance.ScheduledToWork')}}">打刻履歴</a></p>
                </div>

                <div class="create_nav_items">
                    <p><a href="{{route('attendance.workInquiryAuth')}}">勤務予定照会</a></p>
                </div>

                @if( Auth::user()->master === 'on' )
                <div class="create_nav_items">
                    <p><a href="{{ route('attendance.workScheduled') }}">勤務予定変更</a></p>
                </div>

                <div class="create_nav_items">
                    <p><a href="{{ route('register') }}">ユーザー登録</a></p>
                </div>
                @endif

            </nav>

            <div class="card">
                <div class="card-header">ようこそ{{ Auth::user()->name }}さん</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{route('attendance.begin')}}">
                        @csrf
                        <p><button type="submit" class="create_btn begin_btn">出勤</button></p>
                    </form>

                    
                    <form  method="POST" action="{{route('attendance.finish')}}">
                        @csrf
                        <p><button type="submit" class="create_btn finish_btn">退勤</button></p>
                    </form>

                    @if( Auth::user()->master === 'on' )
                    <p>管理者画面</p>
                    @endif
                    <div class="error_log">
                    {{session('error')}}
                    </div>
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
