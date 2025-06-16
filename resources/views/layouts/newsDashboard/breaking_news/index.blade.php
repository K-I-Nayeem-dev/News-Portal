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
                                    <li class="breadcrumb-item text-muted" aria-current="page">Breaking News Manage</li>
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
                <div class="col-lg col-lg-5 px-1">
                    <div class="card">
                        <h5 class="card-header text-white" style="background-color: #1B84FF">Create News</h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('breakingnews.store') }}">
                                @csrf
                                <div>

                                    <label for="BN" class="form-label">Make Headline</label>

                                    <textarea name="breaking_news" id="BN" rows="5" class="form-control" autocomplete="off" >{{ old('breaking_news') }}</textarea>

                                    @error('breaking_news')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>
                                <div class="mt-2">
                                    <label class="form-label" for="status">Status</label>
                                    <select class="form-select" name="status" id="status" autocomplete="off">
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Deactive</option>
                                    </select>

                                    @error('status')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>

                                <button style="background-color: #1B84FF" class="btn text-white mt-3">Create</button>

                            </form>
                        </div>
                    </div>

                    @if (session('Bn_added'))
                        <div class=" alert alert-success mt-3 ">{{ session('Bn_added') }}</div>
                    @endif

                </div>
                <div class="col-lg col-lg-7 px-1">
                    <div class="card">
                        <h5 class="card-header text-white d-flex justify-content-between" style="background-color: #1B84FF">
                            <span>All News</span>
                            <span>Total News : {{ $breaking_news->count() }}</span>
                        </h5>
                        <div class="card-body" style="height: 400px; overflow-y: auto; overflow-x: hidden;">
                            <table class="table table-striped table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">News</th>
                                        <th scope="col">Actions</th>
                                        <th scope="col">Created AT</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($breaking_news as $key => $breaking)
                                        <tr>
                                            <th class="text-center" scope="row">{{ ++$key }}</th>
                                            <td>{{ Str::limit($breaking->news, 35, '...') }}</td>
                                            <td class="d-flex  justify-content-around">
                                                <a class="btn btn-sm btn-primary" href="{{ route('breakingnews.edit', $breaking->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                                <form method="POST" action="{{ route('breakingnews.destroy', $breaking->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"><i style="color: white" class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </td>
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($breaking->created_at)->diffForHumans() }}</td>
                                            <td class="text-center">
                                                @if ($breaking->status == 1)
                                                    <p class="badge bg-success">Active</p>
                                                @else
                                                    <p class="badge bg-danger">Deactive</p>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No News Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if (session('news_update'))
                        <div class=" alert alert-success mt-3 ">{{ session('news_update') }}</div>
                    @endif
                    @if (session('news_deleted'))
                        <div class=" alert alert-danger mt-3 ">{{ session('news_deleted') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
