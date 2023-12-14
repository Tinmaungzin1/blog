@extends("layouts.app")

@section("content")
<div class="container" style="max-width:600px">

    @if($errors->any())
        <div class="alert alert-warning">
            @foreach ($errors->all() as $err)
                {{ $err }}
            @endforeach
        </div>
    @endif

    <form method="post">
        @csrf
        <input type="text" class="form-control mb-2" placeholder="Title" name="title">
        <textarea name="body" class="form-control mb-2" placeholder="Body"></textarea>
        <select name="category_id" class="form-select mb-3">
            $@foreach ($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name}}
                </option>

            @endforeach
        </select>
        <button class="btn btn-primary">Add Article</button>
    </form>
</div>
@endsection
