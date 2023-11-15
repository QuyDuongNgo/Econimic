@extends('layouts.master')

@section('content')
    <div class="main-content mt-5">
        <div class="card">
            <div class="card-header">
                Trashed Posts
                <a href="{{ route('post.create') }}" class="btn btn-success">Create</a>
                <a href="#" class="btn btn-warning">Trashed</a>
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
                                    {{-- <a href="{{ route('post.show', $post->id) }}" class="btn btn-sm btn-warning">Show</a> --}}
                                    <div class="d-flex">
                                        <a href="{{ route('post.restore', $post->id) }}"
                                            class="btn btn-sm btn-primary">Restore</a>

                                        <form action="{{ route('post.force_delete', $post->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger mt-1"
                                                style="font-size: 11.5px">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
