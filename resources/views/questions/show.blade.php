@extends('layouts.app')
{{-- str_plural and str_limit --}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h1>{{ $question->title }}</h1>
                                <div class="ml-auto">
                                <a href="{{ route('questions.index') }}" class="btn btn-secondary">All Questions</a>
                                </div>
                            </div>
                    </div>
                <hr>
                   <div class="media">
                       <div class="d-flex flex-column vote-controls">
                       <a title="This question is useful"
                       class="vote-up{{ Auth::guest() ? 'off' : '' }}"
                       onclick="event.preventDefault(); document.getElementById('up-vote-question-{{ $question->id }}').submit()">
                              <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <form id="up-vote-question-{{ $question->id }}" action="/questions/{{$question->id}}/vote"  method="POST" style="display:none;">
                                @csrf
                                <input type="hidden" name="vote" value="1 ">
                            </form>
                        <span class="votes-count">{{ $question->votes_count }}</span>
                        <a title="This question is not useful" class="vote-down {{  Auth::guest() ? 'off' : '' }}"
                        onclick="event.preventDefault(); document.getElementById('down-vote-question-{{ $question->id }}').submit()"
                        >
                                <i class="fas fa-caret-down fa-3x"></i>

                            </a>
                            <form id="down-vote-question-{{ $question->id }}" action="/questions/{{$question->id}}/vote"  method="POST" style="display:none;">
                                @csrf
                                <input type="hidden" name="vote" value="-1 ">
                            </form>
                            <a title="Click to mark ad favourite question (Click again to undo)"
                        class="favorite mt-2 {{ Auth::guest() ? 'off' :  (!$question->is_favourited ? 'favorited' : '')  }}"
                        onclick="event.preventDefault(); document.getElementById('favourite-question-{{ $question->id }}').submit()"
                        >
                                <i class="fas fa-star fa-2x"></i>
                                <span class="favorite_count">{{ $question->favourites->count() }}</span>
                            </a>
                            <form id="favourite-question-{{ $question->id }}" action="/questions/{{$question->id}}/favourites"  method="POST" style="display:none;">
                                @csrf
                                @if ($question->is_favourited)
                                    @method('DELETE')
                                @endif
                            </form>
                       </div>
                        <div class="media-body">
                            {!! $question->body_html  !!}
                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    @include('shared._author', [
                                        'model' => $question,
                                        'label' => 'asked'
                                    ])
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
    @include('answers._index', [
        'answers' => $question->answers,
        'answersCount' => $question->answers_count,
    ])
      @include('answers._create')
</div>

@endsection
