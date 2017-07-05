@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        You are logged in!
                    </div>
                </div>
                @include('vendor.comment.body', [
                    'data' => LFComment::getCommentsData($target_id),
                    'redirect_url' => '/post/'.$target_id
                ])
            </div>
        </div>
    </div>
@endsection
