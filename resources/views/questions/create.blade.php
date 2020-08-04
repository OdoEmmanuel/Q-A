@extends('layouts.app')
{{-- str_plural and str_limit --}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2> Ask Question</h2>
                        <div class="ml-auto">
                        <a href="{{ route('questions.index') }}" class="btn btn-secondary">All Questions</a>
                        </div>
                    </div>
                </div>

                   <div class="card-body">
                   <form action="{{ route('questions.store')}}" method="POST">
                        @include('questions._form', ['buttonText' => "Ask this Question"])
                    </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
