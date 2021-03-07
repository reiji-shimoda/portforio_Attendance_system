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
                        
                        <p>出勤処理が完了しました</p>

                        <p><a href="{{route('attendance.create')}}">ホーム画面に戻る</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
