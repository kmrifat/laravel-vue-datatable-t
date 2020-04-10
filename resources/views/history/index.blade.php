@extends('layouts.app')

@section('content')
    <div class="container-fluid app-body">
        <div class="row">
            <div class="col-md-12">

                <div id="app">
                    <historyapp></historyapp>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script src="{{ asset('js/history.js') }}"></script>
@endsection
