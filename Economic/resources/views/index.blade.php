@extends('layouts.master')

@section('content')
    <div class="main-content mt-5">
        <div class="card">
            <div class="card-header d-flex">
                <div class="col-md-6" style="margin-top:6px;">
                    All Posts
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    @can('create', App\Models\Post::class)
                        <a href="{{ route('post.create') }}" class="btn btn-success mx-1">Create</a>
                    @endcan
                    @can('delete')
                        <a href="{{ route('post.trashed') }}" class="btn btn-warning mx-1">Trashed</a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered border-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" width="10%">Title</th>
                            <th scope="col" width="20%">Image</th>
                            <th scope="col" width="30%">Description</th>
                            <th scope="col" width="10%">Category</th>
                            <th scope="col" width="10%">Publish Date</th>
                            <th scope="col" width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($posts as $post)
                            <tr>
                                <th scope="row">{{ $post->id }}</th>
                                <td>{{ $post->title }}</td>
                                <td>
                                    <img src="{{ asset($post->image) }}" alt="husky" width="80">
                                </td>
                                <td>{{ $post->description }}</td>
                                <td>{{ $post->category->name }}</td>
                                <td>{{ $post->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('post.show', $post->id) }}" class="btn btn-sm btn-warning">Show</a>
                                        @can('edit_post')
                                            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-sm btn-primary mx-2">Edit</a>
                                        @endcan
                                        @can('delete_post')
                                        <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger mt-1" style="font-size: 11.5px">
                                                Delete
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
