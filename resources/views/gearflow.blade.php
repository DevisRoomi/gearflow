@extends('layouts.app')

@section('content')
    <main class="space-y-6">
        @include('partials.stats')
        @include('partials.catalog')
        @include('partials.loans')
    </main>
@endsection

