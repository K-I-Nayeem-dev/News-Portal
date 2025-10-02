@extends('layouts.newsIndex.newsMaster')
@section('content')
    <style>
        .polls-container {
            max-width: 1400px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #333;
            border-bottom: 3px solid #007bff;
            padding-bottom: 10px;
            display: inline-block;
            margin-bottom: 30px;
        }

        .polls-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            margin-top: 30px;
        }

        .poll-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .poll-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .poll-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .badge-success {
            background: #28a745;
            color: white;
        }

        .badge-danger {
            background: #dc3545;
            color: white;
        }

        .poll-image {
            margin-bottom: 15px;
        }

        .poll-image img {
            border-radius: 8px;
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .poll-question {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .poll-info {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .poll-info strong {
            color: #007bff;
        }

        .poll-expiry {
            font-size: 13px;
            color: #999;
            margin-bottom: 20px;
        }

        .poll-option {
            margin-bottom: 15px;
        }

        .poll-option label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
            cursor: pointer;
        }

        .poll-option-text {
            display: flex;
            align-items: center;
        }

        .poll-option input[type="radio"] {
            margin-right: 10px;
            cursor: pointer;
        }

        .poll-option span {
            font-size: 14px;
            color: #333;
        }

        .poll-percentage {
            font-size: 14px;
            font-weight: 600;
            color: #007bff;
        }

        .progress {
            height: 8px;
            background-color: #e9ecef;
            border-radius: 5px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background-color: #007bff;
            border-radius: 5px;
            transition: width 0.3s ease;
        }

        .progress-bar.bg-danger {
            background-color: #dc3545;
        }

        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            margin-top: 15px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background: #0056b3;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
            opacity: 0.6;
            cursor: not-allowed;
        }

        .poll-message {
            margin-top: 10px;
            font-size: 13px;
            text-align: center;
        }

        .poll-status-message {
            margin-top: 10px;
            font-size: 13px;
            text-align: center;
            font-weight: 600;
        }

        .success-message {
            color: #28a745;
        }

        .error-message {
            color: #dc3545;
        }

        .no-polls-message {
            grid-column: 1 / -1;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .polls-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
            }
        }

        @media (max-width: 768px) {
            .polls-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .poll-question {
                font-size: 16px;
            }

            .poll-image img {
                height: 150px;
            }
        }

        @media (max-width: 480px) {
            .polls-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .polls-container {
                padding: 0 15px;
            }

            .page-title {
                font-size: 24px;
            }

            .poll-image img {
                height: 200px;
            }
        }
    </style>

    <div class="polls-container">
        <div class="main--content">
            {{-- Page Header --}}
            <div>
                <h2 class="page-title">
                    {{ session('lang') === 'english' ? '📊 All Polls' : '📊 সকল জরিপ' }}
                </h2>
            </div>

            {{-- Polls List --}}
            <div class="polls-grid">
                @forelse($polls as $poll)
                    @php
                        $totalVotes = $poll->options->sum('votes_count');
                        $hasVoted = $poll->hasIpVoted(request()->ip());
                        $isExpired = $poll->isExpired();
                    @endphp

                    <div class="poll-card-wrapper">
                        <div class="poll-card">
                            {{-- Poll Status Badge --}}
                            @if ($isExpired)
                                <span class="poll-badge badge-danger">
                                    {{ session('lang') === 'english' ? 'Expired' : 'মেয়াদ শেষ' }}
                                </span>
                            @else
                                <span class="poll-badge badge-success">
                                    {{ session('lang') === 'english' ? 'Active' : 'সক্রিয়' }}
                                </span>
                            @endif

                            {{-- Poll Image --}}
                            @if ($poll->image)
                                <div class="poll-image">
                                    <img src="{{ asset($poll->image) }}" alt="Poll Image">
                                </div>
                            @endif

                            {{-- Poll Question --}}
                            <h4 class="poll-question">
                                {{ session('lang') === 'english' ? $poll->question_en : $poll->question_bn }}
                            </h4>

                            {{-- Total Votes --}}
                            <p class="poll-info">
                                {{ session('lang') === 'english' ? 'Total Votes:' : 'মোট ভোট:' }}
                                <strong>{{ $totalVotes }}</strong>
                            </p>

                            {{-- Expiry Date --}}
                            <p class="poll-expiry">
                                {{ session('lang') === 'english' ? 'Expires:' : 'মেয়াদ শেষ:' }}
                                {{ $poll->expires_at->format('d M Y, h:i A') }}
                            </p>

                            {{-- Poll Form --}}
                            @if (!$isExpired)
                                <form class="poll-form-{{ $poll->id }}" action="{{ route('polls.vote', $poll->id) }}"
                                    method="POST">
                                    @csrf
                                    <div class="poll-options">
                                        @foreach ($poll->options as $option)
                                            @php
                                                $percentage =
                                                    $totalVotes > 0
                                                        ? round(($option->votes_count / $totalVotes) * 100)
                                                        : 0;
                                            @endphp
                                            <div class="poll-option">
                                                <label>
                                                    <div class="poll-option-text">
                                                        <input type="radio" name="option_id" value="{{ $option->id }}"
                                                            {{ $hasVoted ? 'disabled' : '' }}>
                                                        <span>
                                                            {{ session('lang') === 'english' ? $option->option_text_en : $option->option_text_bn }}
                                                        </span>
                                                    </div>
                                                    <span class="poll-percentage">
                                                        {{ $percentage }}%
                                                    </span>
                                                </label>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: {{ $percentage }}%;">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    @if ($hasVoted)
                                        <button type="button" class="btn btn-secondary" disabled>
                                            {{ session('lang') === 'english' ? 'Already Voted' : 'ইতিমধ্যে ভোট দিয়েছেন' }}
                                        </button>
                                        <div class="poll-status-message success-message">
                                            {{ session('lang') === 'english' ? '✓ You have already voted' : '✓ আপনি ইতিমধ্যে ভোট দিয়েছেন' }}
                                        </div>
                                    @else
                                        <button type="submit" class="btn btn-primary vote-btn">
                                            {{ session('lang') === 'english' ? 'Vote Now' : 'ভোট দিন' }}
                                        </button>
                                    @endif

                                    <div class="poll-message poll-message-{{ $poll->id }}" style="display: none;">
                                    </div>
                                </form>
                            @else
                                {{-- Show Results Only for Expired Polls --}}
                                <div class="poll-options">
                                    @foreach ($poll->options as $option)
                                        @php
                                            $percentage =
                                                $totalVotes > 0 ? round(($option->votes_count / $totalVotes) * 100) : 0;
                                        @endphp
                                        <div class="poll-option">
                                            <div>
                                                <span>
                                                    {{ session('lang') === 'english' ? $option->option_text_en : $option->option_text_bn }}
                                                </span>
                                                <span class="poll-percentage"
                                                    style="font-size: 14px; font-weight: 600; color: #dc3545;">
                                                    {{ $percentage }}% ({{ $option->votes_count }}
                                                    {{ session('lang') === 'english' ? 'votes' : 'ভোট' }})
                                                </span>
                                            </div>
                                            <div class="progress"
                                                style="height: 8px; background-color: #e9ecef; border-radius: 5px;">
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                    style="width: {{ $percentage }}%; border-radius: 5px;"
                                                    aria-valuenow="{{ $percentage }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div
                                    style="margin-top: 15px; font-size: 13px; color: #dc3545; text-align: center; font-weight: 600;">
                                    {{ session('lang') === 'english' ? '⏰ This poll has ended' : '⏰ এই জরিপ শেষ হয়ে গেছে' }}
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="no-polls-message">
                        <div class="alert-info"
                            style="padding: 30px; border-radius: 10px; text-align: center; background: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb;">
                            <h4>{{ session('lang') === 'english' ? 'No polls available at the moment' : 'এই মুহূর্তে কোনো জরিপ উপলব্ধ নেই' }}
                            </h4>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- AJAX Script for Voting --}}
    <script>
        document.querySelectorAll('[class^="poll-form-"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const pollId = this.action.split('/').pop();
                const messageDiv = document.querySelector('.poll-message-' + pollId);
                const submitBtn = this.querySelector('.vote-btn');

                // Check if an option is selected
                const selectedOption = this.querySelector('input[name="option_id"]:checked');
                if (!selectedOption) {
                    messageDiv.style.display = 'block';
                    messageDiv.style.color = '#dc3545';
                    messageDiv.textContent =
                        '{{ session('lang') === 'english' ? 'Please select an option' : 'একটি অপশন নির্বাচন করুন' }}';
                    return;
                }

                // Disable submit button
                submitBtn.disabled = true;
                submitBtn.textContent =
                    '{{ session('lang') === 'english' ? 'Submitting...' : 'জমা হচ্ছে...' }}';

                fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        messageDiv.style.display = 'block';

                        if (data.success) {
                            messageDiv.style.color = '#28a745';
                            messageDiv.textContent = data.message;

                            // Reload the page after 1.5 seconds
                            setTimeout(() => {
                                window.location.reload();
                            }, 1500);
                        } else {
                            messageDiv.style.color = '#dc3545';
                            messageDiv.textContent = data.message ||
                                '{{ session('lang') === 'english' ? 'An error occurred' : 'একটি সমস্যা হয়েছে' }}';
                            submitBtn.disabled = false;
                            submitBtn.textContent =
                                '{{ session('lang') === 'english' ? 'Vote Now' : 'ভোট দিন' }}';
                        }
                    })
                    .catch(error => {
                        messageDiv.style.display = 'block';
                        messageDiv.style.color = '#dc3545';
                        messageDiv.textContent =
                            '{{ session('lang') === 'english' ? 'An error occurred. Please try again.' : 'একটি সমস্যা হয়েছে। আবার চেষ্টা করুন।' }}';
                        submitBtn.disabled = false;
                        submitBtn.textContent =
                            '{{ session('lang') === 'english' ? 'Vote Now' : 'ভোট দিন' }}';
                        console.error('Error:', error);
                    });
            });
        });
    </script>
@endsection
