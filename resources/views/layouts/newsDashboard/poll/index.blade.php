@extends('layouts.newsDashboard.dashboardMaster')


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
                                    <li class="breadcrumb-item text-muted" aria-current="page">Polls</li>
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
                <!-- Header Section -->
                <div class="col-12 mb-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <!-- Left: Poll Count -->
                        <div class="d-flex align-items-center gap-3 bg-white p-3 rounded shadow-sm">
                            <span class="badge bg-gradient bg-primary fs-5 px-2 py-1">{{ $polls->count() }}</span>
                            <span class="text-muted fw-medium">Total Polls</span>
                        </div>

                        <!-- Right: Create Button -->
                        <button type="button" class="btn btn-primary shadow text-white" data-bs-toggle="modal"
                            data-bs-target="#createPollModal">
                            <i class="bi bi-plus-circle me-2"></i> Create New Poll
                        </button>
                    </div>
                </div>

                <!-- Success Message -->
                @if (session('success'))
                    <div class="col-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                @endif

                <!-- Table Section -->
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-primary">
                                        <tr>
                                            <th scope="col" class="px-4 py-3">ID</th>
                                            <th scope="col" class="px-4 py-3">Question (Bangla)</th>
                                            <th scope="col" class="px-4 py-3">Question (English)</th>
                                            <th scope="col" class="px-4 py-3">Created By</th>
                                            <th scope="col" class="px-4 py-3">Total Votes</th>
                                            <th scope="col" class="px-4 py-3">Expires At</th>
                                            <th scope="col" class="px-4 py-3">Status</th>
                                            <th scope="col" class="px-4 py-3">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($polls as $poll)
                                            <tr>
                                                <td class="px-4 py-3">{{ $poll->id }}</td>
                                                <td class="px-4 py-3">{{ Str::limit($poll->question_bn, 40) }}</td>
                                                <td class="px-4 py-3">{{ Str::limit($poll->question_en, 40) }}</td>
                                                <td class="px-4 py-3">
                                                    @if ($poll->creator)
                                                        <div class="small">
                                                            <div class="fw-semibold text-dark">{{ $poll->creator->name }}
                                                            </div>
                                                            <div class="text-muted">{{ $poll->creator->email }}</div>
                                                        </div>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td class="px-4 py-3">
                                                    <span class="badge bg-info text-dark">
                                                        {{ $poll->votes_count }} votes
                                                    </span>
                                                </td>
                                                <td class="px-4 py-3 text-muted small">
                                                    {{ $poll->expires_at->format('d M Y, h:i A') }}
                                                </td>
                                                <td class="px-4 py-3">
                                                    @if ($poll->isExpired())
                                                        <span class="badge bg-danger">Expired</span>
                                                    @else
                                                        <span class="badge bg-success">Active</span>
                                                    @endif
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('polls.show', $poll->id) }}" target="_blank"
                                                            class="btn btn-sm btn-outline-primary">
                                                            View
                                                        </a>
                                                        <a href="{{ route('polls.edit', $poll->id) }}"
                                                            class="btn btn-sm btn-outline-secondary">
                                                            Edit
                                                        </a>
                                                        <form action="{{ route('polls.destroy', $poll->id) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Are you sure you want to delete this poll?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-5">
                                                    <div class="text-muted">
                                                        <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                                        <p class="mb-0">No polls found. Create your first poll!</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    @if (method_exists($polls, 'hasPages') && $polls->hasPages())
                        <div class="mt-4">
                            {{ $polls->links() }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Create Poll Modal -->
            <div class="modal fade" id="createPollModal" tabindex="-1" aria-labelledby="createPollModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable" style="max-height: 90vh;">
                    <div class="modal-content" style="max-height: 90vh;">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="createPollModalLabel">
                                <i class="bi bi-plus-circle me-2"></i>Create New Poll
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('polls.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body" style="max-height: calc(90vh - 130px); overflow-y: auto;">

                                {{-- Question Bangla --}}
                                <div class="mb-3">
                                    <label for="question_bn" class="form-label fw-semibold">Question (Bangla) *</label>
                                    <input type="text" class="form-control" id="question_bn" name="question_bn"
                                        value="{{ old('question_bn') }}"
                                        placeholder="আপনি কি মনে করেন যেহেতু ফোনে ঢাকা পাঠানোর খরচ কমানো উচিত?" required>
                                    @error('question_bn')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Question English --}}
                                <div class="mb-3">
                                    <label for="question_en" class="form-label fw-semibold">Question (English) *</label>
                                    <input type="text" class="form-control" id="question_en" name="question_en"
                                        value="{{ old('question_en') }}"
                                        placeholder="Do you think the cost of sending to Dhaka should be reduced?"
                                        required>
                                    @error('question_en')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Poll Image --}}
                                <div class="mb-3">
                                    <label for="poll_image" class="form-label fw-semibold">Poll Image (Optional)</label>
                                    <input type="file" class="form-control" id="poll_image" name="image"
                                        accept="image/*">
                                    @error('image')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Expiry Date --}}
                                <div class="mb-3">
                                    <label for="expires_at" class="form-label fw-semibold">Expiry Date & Time *</label>
                                    <input type="datetime-local" class="form-control" id="expires_at" name="expires_at"
                                        value="{{ old('expires_at') }}" required>
                                    @error('expires_at')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Poll Options --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold d-block mb-3">Poll Options (Minimum 2)</label>
                                    <div id="optionsContainer">

                                        {{-- Option 1 --}}
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h6 class="card-title mb-3">Option 1</h6>
                                                <div class="mb-2">
                                                    <label class="form-label small">Option 1 (Bangla) *</label>
                                                    <input type="text" name="options[0][text_bn]" class="form-control"
                                                        placeholder="হ্যাঁ" required>
                                                    @error('options.0.text_bn')
                                                        <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label class="form-label small">Option 1 (English) *</label>
                                                    <input type="text" name="options[0][text_en]" class="form-control"
                                                        placeholder="Yes" required>
                                                    @error('options.0.text_en')
                                                        <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Option 2 --}}
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h6 class="card-title mb-3">Option 2</h6>
                                                <div class="mb-2">
                                                    <label class="form-label small">Option 2 (Bangla) *</label>
                                                    <input type="text" name="options[1][text_bn]" class="form-control"
                                                        placeholder="না" required>
                                                    @error('options.1.text_bn')
                                                        <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label class="form-label small">Option 2 (English) *</label>
                                                    <input type="text" name="options[1][text_en]" class="form-control"
                                                        placeholder="No" required>
                                                    @error('options.1.text_en')
                                                        <p class="text-danger mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <button type="button" id="addOption" class="btn btn-success btn-sm">
                                        <i class="bi bi-plus-circle me-1"></i> Add More Option
                                    </button>

                                    {{-- Show error for whole options array --}}
                                    @error('options')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-2"></i>Create Poll
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <script>
                let optionCount = 2;
                document.getElementById('addOption').addEventListener('click', function() {
                    const container = document.getElementById('optionsContainer');
                    const newOption = document.createElement('div');
                    newOption.className = 'card mb-3';
                    newOption.innerHTML = `
            <div class="card-body position-relative">
                <button type="button" onclick="this.closest('.card').remove()"
                        class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2">
                    <i class="bi bi-x-lg"></i>
                </button>
                <h6 class="card-title mb-3">Option ${optionCount + 1}</h6>
                <div class="mb-2">
                    <label class="form-label small">Option ${optionCount + 1} (Bangla) *</label>
                    <input type="text" name="options[${optionCount}][text_bn]"
                           class="form-control" placeholder="অপশন ${optionCount + 1}" required>
                </div>
                <div>
                    <label class="form-label small">Option ${optionCount + 1} (English) *</label>
                    <input type="text" name="options[${optionCount}][text_en]"
                           class="form-control" placeholder="Option ${optionCount + 1}" required>
                </div>
            </div>
        `;
                    container.appendChild(newOption);
                    optionCount++;
                });
            </script>
        </div>
    </div>
@endsection
