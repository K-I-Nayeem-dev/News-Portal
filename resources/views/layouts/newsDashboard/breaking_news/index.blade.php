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
                <div class="col-lg col-lg-4 px-1">
                    <div class="card">
                        <h5 class="card-header text-white" style="background-color: #1B84FF">Create News</h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('breaking_news.store') }}">
                                @csrf
                                <div>

                                    <label for="BNE" class="form-label">Make English Headline</label>

                                    <textarea name="news_en" id="BNE" rows="5" class="form-control" autocomplete="off">{{ old('news_en') }}</textarea>

                                    @error('news_en')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>
                                <div class="mt-3">

                                    <label for="BNB" class="form-label">Make Bangla Headline</label>

                                    <textarea name="news_bn" id="BNB" rows="5" class="form-control" autocomplete="off">{{ old('news_bn') }}</textarea>

                                    @error('news_bn')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror

                                </div>

                                <div class="mt-2">

                                    <label for="url" class="form-label">News Url</label>

                                    <input name="url" value="{{ old('url') }}" id="url" type="text"
                                        class="form-control" autocomplete="off" />

                                    @error('url')
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
                <div class="col-lg col-lg-8 px-1">
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
                                        <th scope="col">News English</th>
                                        <th scope="col">News Bangla</th>
                                        <th scope="col">Actions</th>
                                        <th scope="col">URL</th>
                                        <th width='120px' scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($breaking_news as $key => $breaking)
                                        <tr>
                                            <th class="text-center" scope="row">{{ ++$key }}</th>
                                            <td>{{ Str::limit($breaking->news_en, 35, '...') }}</td>
                                            <td>{{ Str::limit($breaking->news_bn, 35, '...') }}</td>
                                            <td >
                                                <div class="d-flex justify-content-around align-items-center">
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('breaking_news.edit', $breaking->id) }}"><i
                                                            class="fa-solid fa-pen-to-square"></i></a>
                                                    <form method="POST"
                                                        action="{{ route('breaking_news.destroy', $breaking->id) }}"
                                                        onsubmit="return confirm('Are you sure you want to delete?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"><i
                                                                style="color: white" class="fa-solid fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td class="text-center">{{ $breaking->url ? '✅' : '❌' }}</td>
                                            <td width='120px'>
                                                <form method="POST"
                                                    action="{{ route('breaking_news.update', $breaking->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <select style="font-size: 12px" class="form-select" name="status"
                                                        id="status" autocomplete="off" onchange="this.form.submit()">
                                                        <option value="">Select Status</option>
                                                        <option value="1"
                                                            {{ $breaking->status == 1 ? 'selected' : '' }}>Active</option>
                                                        <option value="0"
                                                            {{ $breaking->status == 0 ? 'selected' : '' }}>Deactive
                                                        </option>
                                                    </select>
                                                </form>
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
