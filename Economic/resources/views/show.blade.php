@extends('layouts.master')

@section('content')
    <div class="main-content mt-5">
        <div class="card">
            <div class="card-header d-flex">
                <div class="col-md-6" style="margin-top: 6px">
                    Show Posts
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    @can('create_post')
                        <a href="{{ route('post.create') }}" class="btn btn-success mx-1">Create</a>
                    @endcan
                    @can('delete_post')
                        <a href="{{ route('post.trashed') }}" class="btn btn-warning mx-1">Trashed</a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered border-dark table-striped">
                    <tbody class="table-group-divider">
                        {{-- @foreach ($posts as $post) --}}
                        <tr>
                            <td>ID</td>
                            <td>{{ $post->id }}</td>
                        </tr>
                            <tr>
                                <td>Title</td>
                                <td>{{ $post->title }}</td>
                            </tr>
                            <tr>
                                <td>Image</td>
                                <td>
                                    <img src="{{ asset($post->image) }}" alt="husky" width="500">
                                </td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>{{ $post->description }}</td>
                            </tr>
                            <tr>
                                <td>Category Name</td>
                                <td>{{ $post->category->name }}</td>
                            </tr>
                            <tr>
                                <td>Created at</td>
                                <td>{{ $post->created_at->format('d-m-Y') }}</td>
                            </tr>
                                {{-- <td>
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
                                </td> --}}
                            </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
