@extends('layouts.master')

@section('content')
    <div class="main-content mt-5">
        <div class="card">
            <div class="card-header">
                Show Posts
                <a href="{{ route('post.create') }}" class="btn btn-success">Create</a>
                <a href="#" class="btn btn-warning">Trashed</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered border-dark table-striped">
                    <tbody class="table-group-divider">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
