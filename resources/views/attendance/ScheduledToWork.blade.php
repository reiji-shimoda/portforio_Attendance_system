@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <nav class="create_nav">
            <div class="create_nav_items">
                    <p><a class="nav_first" href="{{ route('attendance.create') }}">ホーム</a></p>
                </div>

                <div class="create_nav_items">
                    <p><a>打刻履歴</a></p>
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
                    
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">出勤時間</th>
                        <th scope="col">退勤時間</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($times as $time)
                        @if( $user->employeeNumber === $time->employeeNumber )
                        <tr>
                        <td>{{ $time->begin }}</td>
                        <td>{{ $time->finish }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
