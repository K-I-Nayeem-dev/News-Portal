@extends('layouts.newsDashboard.dashboard')

@section('dashboard')
    <div class="body-wrapper">
        <div class="container-fluid">
            <!-- -------------------------------------------------------------- -->
            <!-- Breadcrumb -->
            <!-- -------------------------------------------------------------- -->
            <div class="font-weight-medium shadow-none position-relative overflow-hidden mb-7">
                <div class="card-body px-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-medium  mb-0">Dashboard</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">All News</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- -------------------------------------------------------------- -->
            <!-- Breadcrumb End -->
            <!-- -------------------------------------------------------------- -->
            <!-- Row -->
            <div class="row">
                <div class="col-lg">
                    <div class="card">
                        <h5 class="card-header text-white d-flex justify-content-between" style="background-color: #1B84FF">
                            <span>News Lists</span>
                            <span>Total News: {{ $news->count() }}</span>
                        </h5>
                        <div class="card-body">
                            @if (session('news_delete'))
                                <div class="alert alert-danger mt-3 text-center">{{ session('news_delete') }}</div>
                            @endif
                            <table class="table table-striped-columns table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Posted BY</th>
                                        <th scope="col">Thumbnail</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Action</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($news as $key => $new)
                                        <tr>
                                            <a href="{{ route('news.show', $new->id) }}">
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $new->newsUser->name }} {!! Auth::id() == $new->newsUser->id ? '<sup><code style="font-size: 12px">*</code></sup>' : '' !!}</td>
                                                <td class="text-center"><img src="{{ $new->thumbnail }}" width="120" height="80" alt=""></td>
                                                <td>{{ $new->title }}</td>
                                                <td>{{ $new->newsCategory->category_name }}</td>
                                                <td class="d-flex justify-content-between align-items-center">
                                                    <a class="btn btn-sm btn-success rounded" href="{{ route('news.show', $new->id) }}"><i class="fa-solid fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-primary rounded" href="{{ route('news.edit', $new->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    <form method="POST" action="{{ route('news.destroy', $new->id) }}" onsubmit="return confirm('Are you sure you want to delete this?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger rounded"><i style="color: white" class="fa-solid fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </a>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No News found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
