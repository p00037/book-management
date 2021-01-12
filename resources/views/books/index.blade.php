@extends('layout')

@section('content')

<div class="container mt-2">
    <form action="{{ url('/')}}" method="GET">
        @csrf
        <lable class="mb-2">ジャンル：</lable>
        <select class="mb-2" name="category_id">
            <option value="">すべて</option>
            @foreach ($categories as $category)
            @if ($category->id == $category_id)
            <option value="{{$category->id}}" selected="selected">{{$category->name}}</option>
            @else
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endif
            @endforeach
        </select>
        <div class="mb-2">
            <button type="submit" class="btn btn-primary">検索</button>
        </div>
    </form>

    @foreach ($books as $book)
    <div class="card mb-1">
        <div class="card-header pt-2 pb-2">
        <a href="{{ $book->url }}" target="_blank" rel="noopener noreferrer">{{ $book->title }}</a>
            @if ($book->borrower != '')
            （{!! nl2br(e($book->borrower)) !!}）
            @endif
        </div>
        <div class="card-body pt-1 pb-1">
            <p class="card-text">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ui-checks-grid inline" viewBox="0 0 16 16">
                    <path d="M2 10h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1zm9-9h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-3a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zm0 9a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-3zm0-10a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2h-3zM2 9a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H2zm7 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-3a2 2 0 0 1-2-2v-3zM0 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5.354.854a.5.5 0 1 0-.708-.708L3 3.793l-.646-.647a.5.5 0 1 0-.708.708l1 1a.5.5 0 0 0 .708 0l2-2z" />
                </svg>
                {!! nl2br(e($book->category->name)) !!}
                @if ($book->author != '')
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill inline" viewBox="0 0 16 16">
                    <path d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                </svg>
                {!! nl2br(e($book->author)) !!}
                @endif
            </p>
        </div>
    </div>
    @endforeach

    <div class="d-flex justify-content-center">
        {{ $books->appends(request()->input())->links() }}
    </div>

</div>

@endsection