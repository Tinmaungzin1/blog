@extends("layouts.app")

@section("content")
    <div class="container" style="max-width: 600px">

        @if(session("info"))
            <div class="alert alert-info">
                {{ session("info") }}
            </div>
         @endif

         @if($errors->any())
         <div class="alert alert-warning">
            @foreach ($errors->all() as $err)
             {{ $err }}
             @endforeach
         </div>
         @endif

        <div class="card mb-3 border-primary">
            <div class="card-body">
                <h3 class="card-title">{{ $article->title }}</h3>
                    <small class="text-muted">
                        <span class="text-success">
                            {{ $article->user->name }}
                        </span>,

                        <b>Category:</b>
                        <span class="text-success">
                            {{ $article->category->name ?? 'unknown' }}
                        </span>,
                        {{ $article->created_at->diffForHumans() }}
                    </small>
                <div class="mb-3" style="font-size: 1.2em">
                    {{ $article->body }}
                </div>
                @auth
                    @can('delete-article', $article)
                        <a class="btn btn-sm btn-danger"`
                            href="{{ url("/articles/delete/$article->id") }}">
                             Delete
                        </a>
                        <a class="btn btn-sm btn-secondary"`
                            href="{{ url("/articles/edit/$article->id") }}">
                             Edit
                        </a>
                    @endcan
                @endauth
            </div>
        </div>

        @auth
        <ul class="list-group mt-4">
            <li class="list-group-item active">
                comments ({{ count($article->comments) }})
            </li>

            @foreach ($article->comments as $comment)
                <li class="list-group-item">
                    <span class="text-success">
                        {{ $comment->user->name }}
                    </span>,
                        @can('delete-comment', $comment)
                            <a href="{{ url("/comments/delete/$comment->id") }}"
                            class="btn-close float-end"></a>
                        @endcan
                    {{ $comment->content }}
                </li>
            @endforeach
        </ul>
        @endauth

        @auth
        <form action="{{ url("/comments/add") }}" method="post">
            @csrf
            <input type="hidden" name="article_id" value="{{ $article->id }}">
            <textarea name="content" placeholder="New Content" class="form-control my-2"></textarea>
            <button class="btn btn-secondary">Add comment</button>
        </form>
        @endauth
    </div>
@endsection

