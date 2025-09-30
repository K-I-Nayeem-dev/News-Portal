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
                                    <li class="breadcrumb-item text-muted" aria-current="page">
                                        <a class="text-muted text-decoration-none" href="{{ route('polls.index') }}"">Polls
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">Edit</li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">{{ $poll->id }}</li>
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

            <div class="row justify-content-center">
                <div class="col-12 col-xl-10">

                    <!-- Edit Form -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-gradient bg-primary text-white py-3">
                            <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Poll Information</h5>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('polls.update', $poll->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <!-- Question Bangla -->
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-chat-square-text text-primary me-1"></i>Question (Bangla) *
                                        </label>
                                        <input type="text" name="question_bn"
                                            value="{{ old('question_bn', $poll->question_bn) }}" class="form-control"
                                            placeholder="আপনি কি মনে করেন..." required>
                                        @error('question_bn')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Question English -->
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-chat-square-text text-primary me-1"></i>Question (English) *
                                        </label>
                                        <input type="text" name="question_en"
                                            value="{{ old('question_en', $poll->question_en) }}" class="form-control"
                                            placeholder="Do you think..." required>
                                        @error('question_en')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Current Image Preview -->
                                    @if ($poll->image)
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label fw-semibold">
                                                <i class="bi bi-image text-primary me-1"></i>Current Image
                                            </label>
                                            <div class="card bg-light">
                                                <div class="card-body text-center p-3">
                                                    <img src="{{ asset($poll->image) }}" alt="Poll Image"
                                                        class="img-fluid rounded shadow-sm"
                                                        style="max-height: 200px; object-fit: cover;">
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Upload New Image -->
                                    <div class="col-md-{{ $poll->image ? '6' : '12' }} mb-4">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-cloud-upload text-primary me-1"></i>
                                            {{ $poll->image ? 'Upload New Image (Replace Current)' : 'Poll Image (Optional)' }}
                                        </label>
                                        <input type="file" name="image" accept="image/*" class="form-control">
                                        <small class="text-muted">Max size: 2MB. Formats: JPG, PNG, GIF</small>
                                        @error('image')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Expiry Date -->
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-calendar-event text-primary me-1"></i>
                                            Expiry Date & Time
                                        </label>

                                        <!-- ✅ Don't send expires_at unless user explicitly changes it -->
                                        <input type="datetime-local" id="expires_at_input"
                                            class="form-control form-control-lg"
                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}"
                                            placeholder="Click to set a new expiry date">

                                        <!-- Hidden field that only gets populated when user changes the date -->
                                        <input type="hidden" name="expires_at" id="expires_at_hidden">

                                        @error('expires_at')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror

                                        <!-- Current expiry date display -->
                                        <div class="mt-3 p-3 bg-gradient bg-opacity-10 rounded">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                                                        <i class="bi bi-calendar2-check text-primary fs-5"></i>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="fw-semibold text-dark mb-1">Current Expiry Date</div>
                                                    <div class="d-flex flex-wrap align-items-center gap-2">
                                                        <span
                                                            class="badge bg-primary bg-opacity-20 text-primary border border-primary border-opacity-25 px-3 py-2">
                                                            <i class="bi bi-clock me-1"></i>
                                                            {{ $poll->expires_at ? \Carbon\Carbon::parse($poll->expires_at)->format('M j, Y g:i A') : 'Not Configured' }}
                                                        </span>
                                                        <span class="text-muted small">
                                                            <i class="bi bi-arrow-return-left me-1"></i>
                                                            Leave blank to keep current expiry date
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>





                                <!-- Poll Options Section -->
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <label class="form-label fw-semibold mb-0">
                                            <i class="bi bi-list-check text-primary me-1"></i>Poll Options (Minimum 2)
                                        </label>
                                        <button type="button" id="addOption" class="btn btn-success btn-sm">
                                            <i class="bi bi-plus-circle me-1"></i>Add Option
                                        </button>
                                    </div>

                                    <input type="hidden" id="deletedOptions" name="deleted_options" value="[]">

                                    <div id="optionsContainer" class="row g-3">
                                        @foreach ($poll->options as $index => $option)
                                            <div class="col-md-6" data-option-id="{{ $option->id }}">
                                                <div class="card h-100 border-primary shadow-sm">
                                                    <div
                                                        class="card-header bg-light d-flex justify-content-between align-items-center">
                                                        <span class="fw-semibold">
                                                            <i class="bi bi-record-circle text-primary me-1"></i>Option
                                                            {{ $index + 1 }}
                                                        </span>
                                                        @if ($index >= 2)
                                                            <button type="button"
                                                                onclick="markForDeletion(this, {{ $option->id }})"
                                                                class="btn btn-sm btn-danger">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                    <div class="card-body">
                                                        <input type="hidden" name="options[{{ $index }}][id]"
                                                            value="{{ $option->id }}">

                                                        <div class="mb-3">
                                                            <label class="form-label small text-muted">Bangla *</label>
                                                            <input type="text"
                                                                name="options[{{ $index }}][text_bn]"
                                                                value="{{ old('options.' . $index . '.text_bn', $option->option_text_bn) }}"
                                                                class="form-control" placeholder="হ্যাঁ" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label small text-muted">English
                                                                *</label>
                                                            <input type="text"
                                                                name="options[{{ $index }}][text_en]"
                                                                value="{{ old('options.' . $index . '.text_en', $option->option_text_en) }}"
                                                                class="form-control" placeholder="Yes" required>
                                                        </div>

                                                        <div class="alert alert-info mb-0 py-2">
                                                            <i class="bi bi-bar-chart-fill me-1"></i>
                                                            <small><strong>Votes:</strong>
                                                                {{ $option->votes_count }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="d-flex flex-column justify-content-center flex-sm-row gap-2">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-check-circle me-2"></i>Update Poll
                                            </button>
                                            <a href="{{ route('polls.index') }}"class="btn btn-outline-secondary ">
                                                <i class="bi bi-x-circle me-2"></i>Back</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                let optionCount = {{ count($poll->options) }};
                let deletedOptions = [];

                // ✅ Only populate hidden expires_at field when user actually changes the date
                document.getElementById('expires_at_input').addEventListener('change', function() {
                    document.getElementById('expires_at_hidden').value = this.value;
                });

                function markForDeletion(button, optionId) {
                    if (confirm('Are you sure you want to delete this option? This action cannot be undone.')) {
                        deletedOptions.push(optionId);
                        document.getElementById('deletedOptions').value = JSON.stringify(deletedOptions);
                        button.closest('.col-md-6').remove();
                    }
                }

                document.getElementById('addOption').addEventListener('click', function() {
                    const container = document.getElementById('optionsContainer');
                    const newOption = document.createElement('div');
                    newOption.className = 'col-md-6';
                    newOption.innerHTML = `
            <div class="card h-100 border-success shadow-sm">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <span class="fw-semibold">
                        <i class="bi bi-record-circle text-success me-1"></i>Option ${optionCount + 1}
                    </span>
                    <button type="button" onclick="this.closest('.col-md-6').remove()"
                        class="btn btn-sm btn-danger">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label small text-muted">Bangla *</label>
                        <input type="text" name="options[${optionCount}][text_bn]"
                            class="form-control" placeholder="অপশন ${optionCount + 1}" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label small text-muted">English *</label>
                        <input type="text" name="options[${optionCount}][text_en]"
                            class="form-control" placeholder="Option ${optionCount + 1}" required>
                    </div>
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
