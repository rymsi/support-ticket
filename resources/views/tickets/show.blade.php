@extends('layouts.app')

@section('title', $ticket->title)

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    #{{ $ticket->ticket_id }} - {{ $ticket->title }}
                </div>

                <div class="panel-body">
                    @include('includes.flash')

                    <div class="ticket-info">
                        <p>{{ $ticket->message }}</p>
                        <p>Category: {{ $category->name }}</p>
                        <p>
                        @if ($ticket->status === 'Open')
                            Status: <span class="label label-success">{{ $ticket->status }}</span>
                        @else
                            Status: <span class="label label-danger">{{ $ticket->status }}</span>
                        @endif
                        </p>
                        <p>Created: {{ $ticket->created_at->diffForHumans() }}</p>
                    </div>

                    <hr>
                    <div class="comments">
                        @if (!$comments)
                            There are no comments.
                        @else
                            @foreach ($comments as $comment)
                                <div class="panel panel-default">
                                    <div class="panel panel-heading">
                                        {{ $comment->user->name }}
                                        <span class="pull-right">{{ $comment->created_at->format('Y-m-d') }}</span>
                                    </div>

                                    <div class="panel panel-body">
                                        {{ $comment->comment }}        
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="comment-form">
                        <form action="{{ url('comment') }}" method="POST" class="form">
                            {!! csrf_field() !!}

                            <input type="hidden" name="ticket_id" value="{{ $ticket->ticket_id }}">

                            <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                <textarea rows="10" id="comment" class="form-control" name="comment"></textarea>

                                @if ($errors->has('comment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection