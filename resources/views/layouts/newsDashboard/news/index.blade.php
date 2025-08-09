@extends('layouts.newsDashboard.dashboard')

@section('dashboard')
    <style>
        .hover-btn {
            color: black;
            transition: color 0.3s ease;
        }
    </style>
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
                        <h5 class="card-header text-white d-flex justify-content-between align-items-center"
                            style="background-color: #1B84FF">
                            <span>News Lists</span>
                            <span>Total News: {{ $news->count() }}<a href="{{ route('dashboard_news.create') }}"
                                    class="btn rounded ms-2 bg-success text-white hover-btn">Create News</a></span>
                        </h5>
                        <div class="card-body">
                            @if (session('news_delete'))
                                <div class="alert alert-danger mt-3 text-center">{{ session('news_delete') }}</div>
                            @endif
                            @if (session('status_update'))
                                <div class=" alert alert-success mt-3 text-center">{{ session('status_update') }}</div>
                            @endif
                            <table class="table table-striped-columns table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Posted BY</th>
                                        <th scope="col">Thumbnail</th>
                                        <th scope="col">Actions</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($news as $key => $new)
                                        <tr>
                                            <a href="{{ route('dashboard_news.show', $new->id) }}">
                                                <td>{{ $new->id }}</td>
                                                <td>{{ $new->newsUser->name }} {!! Auth::id() == $new->newsUser->id ? '<sup><code style="font-size: 12px">*</code></sup>' : '' !!}</td>
                                                <td class="text-center"><img src="{{ $new->thumbnail }}" width="120"
                                                        height="80" alt=""></td>
                                                <td>
                                                    <div class="d-flex justify-content-around align-items-center">
                                                        <a class="btn btn-sm btn-success rounded"
                                                            href="{{ route('dashboard_news.show', $new->id) }}"><i
                                                                class="fa-solid fa-eye"></i></a>
                                                        <a class="btn btn-sm btn-primary rounded"
                                                            href="{{ route('dashboard_news.edit', $new->id) }}"><i
                                                                class="fa-solid fa-pen-to-square"></i></a>
                                                        <form method="POST" action="{{ route('dashboard_news.destroy', $new->id) }}"
                                                            onsubmit="return confirm('Are you sure you want to delete this?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger rounded"><i
                                                                    style="color: white"
                                                                    class="fa-solid fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td>
                                                    <form method="POST" action="{{ route('dashboard_news.update', $new->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <select class="form-select" name="status" id="status"
                                                            autocomplete="off" onchange="this.form.submit()">
                                                            <option value="">Select Status</option>
                                                            <option value="1" class="bg-success"
                                                                {{ $new->status == 1 ? 'selected' : '' }}>Active</option>
                                                            <option value="0" class="bg-danger"
                                                                {{ $new->status == 0 ? 'selected' : '' }}>Deactive</option>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td>
                                                    <p>{{ $new->created_at->diffForHumans() }}</p>
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
                <!-- Pagination links -->
                <div class="d-flex justify-content-start">
                    {{ $news->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
