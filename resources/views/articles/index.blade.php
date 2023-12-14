@extends("layouts.app")

@section("content")
<div class="container" style="max-width: 600px">
    {{ $articles->links() }}

    @if(session("info"))
        <div class="alert alert-info">
            {{ session("info") }}
        </div>
    @endif

    @foreach ($articles as $article)
        <div class="card mb-3">
            <div class="card-body">
                <h3 class="card-title h4">{{ $article->title }}</h3>
                <small class="text-muted">
                    <span class="text-success">
                        {{ $article->user->name }}
                    </span>
                    <b>Category:</b>
                    <span class="text-success">
                        {{ $article->category->name ?? 'Unknown'}}
                    </span>,

                    <b>Comments:</b>
                    <span class="text-success">
                        {{ count($article->comments) }}
                    </span>,

                    {{ $article->created_at->diffForHumans() }}
                </small>
                <div class="mb-2">
                    {{ $article->body }}
                </div>
                <a href="{{ url("/articles/detail/$article->id")}}">
                    view detail
                </a>
            </div>
        </div>
    @endforeach
</div>
@endsection
