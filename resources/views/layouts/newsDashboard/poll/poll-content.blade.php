<div class="poll-details">
    <!-- Poll Image (if exists) -->
    @if ($poll->image)
        <div class="mb-3">
            <img src="{{ asset($poll->image) }}" class="img-fluid rounded" alt="Poll Image"
                style="width: 100%; height: auto; max-height: 400px; object-fit: contain;">
        </div>
    @endif

    <!-- Poll Question Card -->
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body p-3">
            <h5 class="card-title mb-2">{{ $poll->getQuestion() }}</h5>

            <div class="d-flex flex-wrap gap-2 text-muted" style="font-size: 0.85rem;">
                <span>
                    <i class="bi bi-person"></i> {{ $poll->creator->name ?? 'Unknown' }}
                </span>
                <span>
                    <i class="bi bi-calendar"></i> {{ $poll->created_at->format('M d, Y') }}
                </span>
                @if ($poll->isExpired())
                    <span class="badge bg-danger">Expired</span>
                @elseif($poll->is_active)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-secondary">Inactive</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Options Section -->
    <h6 class="fw-bold mb-2"><i class="bi bi-list-check"></i> Options</h6>

    @forelse($poll->options as $option)
        @php
            $totalVotes = $poll->getTotalVotes();
            $optionVotes = $option->votes_count ?? 0;
            $percentage = $totalVotes > 0 ? ($optionVotes / $totalVotes) * 100 : 0;
        @endphp

        <div class="card mb-2 border shadow-sm">
            <div class="card-body p-2">
                <div class="d-flex align-items-center mb-2">
                    @if ($option->image)
                        <img src="{{ asset($option->image) }}" alt="Option" class="rounded me-2"
                            style="width: 40px; height: 40px; object-fit: cover;">
                    @endif

                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <span style="font-size: 0.95rem;">{{ $option->getOptionText() }}</span>
                            <span class="badge bg-primary" style="font-size: 0.75rem;">
                                {{ $optionVotes }} votes
                            </span>
                        </div>
                    </div>
                </div>

                @if ($totalVotes > 0)
                    <div class="progress" style="height: 18px;">
                        <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%;"
                            aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                            <small>{{ number_format($percentage, 1) }}%</small>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="alert alert-info py-2 mb-2">
            <small><i class="bi bi-info-circle"></i> No options available</small>
        </div>
    @endforelse

    <!-- Summary Footer -->
    <div class="card border-0 bg-light mt-3">
        <div class="card-body p-2">
            <div class="row text-center">
                <div class="col-6">
                    <h6 class="text-primary mb-0">{{ $poll->getTotalVotes() }}</h6>
                    <small class="text-muted" style="font-size: 0.75rem;">Total Votes</small>
                </div>
                <div class="col-6">
                    <h6 class="text-success mb-0">{{ $poll->options->count() }}</h6>
                    <small class="text-muted" style="font-size: 0.75rem;">Options</small>
                </div>
            </div>
        </div>
    </div>
</div>
