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
                    
                    <div>
                        {{$workScheduled->id}}
                        <p>勤務変更編集画面</p>
                        <form method="POST" action="{{route('attendance.scheduledUpdate', ['id' => $workScheduled->id])}}">
                            @csrf
                            
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
                            
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('更新する') }}
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
