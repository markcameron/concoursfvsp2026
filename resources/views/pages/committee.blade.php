@extends('layouts.front')

@section('content')

    <div class="bg-theme-light-blue py-10 lg:py-14">
        <h1 class="section-title text-center">{{ $page->title }}</h1>
    </div>

    @foreach ($page->content as $block)
        @includeIf('blocks.' . $block['type'], ['block' => (object) $block['data']])
    @endforeach

@endsection
