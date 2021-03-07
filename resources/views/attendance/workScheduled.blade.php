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
                    <p><a href="{{route('attendance.ScheduledToWork')}}">打刻履歴</a></p>
                </div>

                <div class="create_nav_items">
                    <p><a href="{{route('attendance.workInquiryAuth')}}">勤務予定照会</a></p>
                </div>

                @if( Auth::user()->master === 'on' )
                <div class="create_nav_items">
                    <p><a>勤務予定変更</a></p>
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
                        <th scope="col">社員名</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                        <td><a href="{{route('attendance.workInquiry', ['employeeNumber' => $user->employeeNumber]) }}">{{ $user->name }}</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>

                    <div>
                        <p>月別勤務予定データベース作成</p>
                        <form method="POST" action="{{ route('attendance.scheduledCreate') }}">
                            @csrf
                            
                            <div class="form-group row">
                                <label for="days" class="col-md-4 col-form-label text-md-right">{{ __('月') }}</label>

                                <div class="col-md-6">
                                    <input id="days" type="text" class="form-control @error('days') is-invalid @enderror" name="days" value="{{ old('days') }}" required autocomplete="days" autofocus>

                                    @error('days')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                </div>

                                <div class="form-group row">
                                <label for="workTime" class="col-md-4 col-form-label text-md-right">{{ __('勤務時間帯') }}</label>

                                <div class="col-md-6">
                                    <input id="workTime" type="text" class="form-control @error('workTime') is-invalid @enderror" name="workTime" value="{{ old('workTime') }}" required autocomplete="workTime" autofocus>

                                    @error('workTime')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                </div>

                                <div class="form-group row">
                                <label for="workTime" class="col-md-4 col-form-label text-md-right">{{ __('社員番号') }}</label>

                                <div class="col-md-6">
                                    <input id="employeeNumber" type="text" class="form-control @error('employeeNumber') is-invalid @enderror" name="employeeNumber" value="{{ old('employeeNumber') }}" required autocomplete="employeeNumber" autofocus>

                                    @error('employeeNumber')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                </div>

                                <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('登録') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
