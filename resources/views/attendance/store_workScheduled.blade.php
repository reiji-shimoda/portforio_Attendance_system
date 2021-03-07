@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ようこそ{{ Auth::user()->name }}さん</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                        
                        <p>勤務予定を作成しました</p>

                        <p><a href="{{route('attendance.workScheduled')}}">勤務変更画面に戻る</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
