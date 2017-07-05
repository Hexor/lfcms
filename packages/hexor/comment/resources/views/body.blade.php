@section('asset_links')

    <!-- Assest from package hexor/comment Start-->
    <link rel="stylesheet" property="stylesheet" href="/vendor/comment/css/style.css">
    <!-- Assest from package hexor/comment End-->

@append


<div class="panel panel-default">
    <div class="panel-heading">Comments</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-8 col-md-offset">
                @foreach($data['comments'] as $comment)
                    <div class="comment">
                        <div class="author-info">
                            <div class="author-name">
                                <h4>{{$comment->user_name}}</h4>
                                {{$comment->created_at}}
                            </div>
                        </div>
                        <div class="comment-content">
                            {{$comment->content}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div id="comment-form">
            {{ Form::open(['route' => ['comments.store', $data['target_id']],
            'method'
             =>
            'POST'])}}
            {{ Form::hidden('redirect_url', $redirect_url) }}

            <div class="row">
                <div class="col-md-6">
                    {{ Form::label('name', "Name:")}}
                    {{ Form::text('name', null, ['class' => 'form-control'])}}
                </div>

                <div class="col-md-12">
                    {{ Form::label('comment', "Comment:")}}
                    {{ Form::textarea('content', null, [
                        'class' => 'form-control',
                        'rows' => '5'
                    ])}}

                    {{ Form::submit('Add Comment', [
                        'class' => 'btn-success btn btn-block',
                        'style' => 'margin-top: 15px'
                    ])}}

                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>