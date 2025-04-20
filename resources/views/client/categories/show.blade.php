<!-- resources/views/client/categories/show.blade.php -->
@extends('client.layout')

@section('content')
<div class="container">
    <h2>{{ $category->name }}</h2>
    <p>{{ $category->description }}</p>
    
    <div class="levels-container">
        @foreach($category->contents->groupBy('level') as $level => $contents)
        <div class="level-section">
            <h3>Niveau {{ $level }}</h3>
            
            <div class="contents-list">
                @foreach($contents as $content)
                <a href="{{ route('client.content.show', $content->id) }}" class="content-card">
                    <h4>{{ $content->title }}</h4>
                    <p>{{ Str::limit($content->description, 100) }}</p>
                </a>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection