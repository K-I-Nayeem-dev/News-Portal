@extends('layouts.newsIndex.newsMaster')

<style>
    .archive-dropdowns {
        display: flex;
        gap: 12px;
        margin: 30px 0;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        position: relative;
    }

    .archive-dropdowns::before {
        content: "📅";
        font-size: 20px;
        margin-right: 8px;
    }

    .archive-dropdowns select {
        padding: 12px 16px;
        font-size: 16px;
        border-radius: 10px;
        border: 2px solid #e1e5e9;
        cursor: pointer;
        min-width: 140px;
        transition: all 0.3s ease;
        background: linear-gradient(to bottom, #fff, #f8f9fa);
        font-weight: 500;
        color: #2d3748;
        appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 16px;
        padding-right: 40px;
    }

    .archive-dropdowns select:hover {
        border-color: #3b82f6;
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.15);
    }

    .archive-dropdowns select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        background: #fff;
    }

    .archive-dropdowns select:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    @media (max-width: 768px) {
        .archive-dropdowns {
            flex-direction: column;
            gap: 15px;
            padding: 15px;
        }

        .archive-dropdowns select {
            width: 100%;
            max-width: 250px;
        }
    }

    @media (max-width: 480px) {
        .archive-dropdowns {
            padding: 12px;
        }

        .archive-dropdowns select {
            font-size: 14px;
            padding: 10px 14px;
            padding-right: 35px;
        }
    }
</style>

@section('content')
    <div class="container">

        {{-- Archive Selector --}}
        <form id="archiveForm" method="GET" style="display:flex; justify-content:center;">
            <div class="archive-dropdowns">
                <select id="yearSelect"></select>
                <select id="monthSelect"></select>
                <select id="daySelect"></select>
            </div>
        </form>

        {{-- Archive Header --}}
        <div class="search-header" style="margin-bottom: 30px; border-bottom: 2px solid #e0e0e0; padding-bottom: 15px;">
            <h2 style="font-size: 28px; font-weight: 600; color: #333; margin-bottom: 10px;">
                @if (session()->get('lang') == 'english')
                    News from {{ \Carbon\Carbon::parse($date)->format('d M Y') }}
                @else
                    {{ \Carbon\Carbon::parse($date)->format('d M Y') }} তারিখের সংবাদ
                @endif
            </h2>
            <p style="color: #666; font-size: 16px;">
                @if (session()->get('lang') == 'english')
                    Found {{ $news->total() }} results
                @else
                    {{ $news->total() }} টি সংবাদ পাওয়া গেছে
                @endif
            </p>
        </div>

        {{-- News List --}}
        @if ($news->count() > 0)
            <ul class="news-list" style="list-style: none; padding: 0; margin: 30px 0 0 0;">
                @foreach ($news as $item)
                    <li class="news-item"
                        style="display: flex; margin-bottom: 30px; padding: 20px; border-bottom: 1px solid #e5e5e5; border-radius: 8px;">
                        {{-- Image --}}
                        <div class="news-image"
                            style="flex-shrink: 0; width: 280px; height: 180px; overflow: hidden; border-radius: 8px; margin-right: 25px;">
                            <a
                                href="{{ route('showFull.news', ['category' => $item->newsCategory->slug ?? 'news', 'subcategory' => $item->newsSubCategory->slug ?? '', 'id' => $item->id]) }}">
                                @php
                                    $img =
                                        $item->thumbnail && !Str::contains($item->thumbnail, 'placeholder')
                                            ? $item->thumbnail
                                            : asset('uploads/default_images/deafult_thumbnail.jpg');
                                @endphp
                                <img src="{{ asset($img) }}"
                                    alt="{{ session()->get('lang') == 'english' ? $item->title_en : $item->title_bn }}"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            </a>
                        </div>

                        {{-- Content --}}
                        <div class="news-content" style="flex:1; display:flex; flex-direction:column;">
                            <a href="{{ route('showFull.news', ['category' => $item->newsCategory->slug ?? 'news', 'subcategory' => $item->newsSubCategory->slug ?? '', 'id' => $item->id]) }}"
                                class="news-content-link">
                                <h3
                                    style="margin:0 0 10px 0; font-size:22px; font-weight:600; line-height:1.4; color:#222;">
                                    {{ session()->get('lang') == 'english' ? $item->title_en : $item->title_bn }}
                                </h3>
                                <p style="margin:0 0 15px 0; color:#666; font-size:15px; line-height:1.6;">
                                    {{ session()->get('lang') == 'english' ? Str::limit(strip_tags($item->details_en ?? ''), 180) : Str::limit(strip_tags($item->details_bn ?? ''), 180) }}
                                </p>
                                <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
                                    @if ($item->newsCategory)
                                        <span
                                            style="background:#3498db;color:white;padding:4px 12px;border-radius:15px;font-size:13px;font-weight:500;">
                                            {{ session()->get('lang') == 'english' ? $item->newsCategory->category_en : $item->newsCategory->category_bn }}
                                        </span>
                                    @endif
                                    @if ($item->newsSubCategory)
                                        <span
                                            style="background:#95a5a6;color:white;padding:4px 12px;border-radius:15px;font-size:13px;font-weight:500;">
                                            {{ session()->get('lang') == 'english' ? $item->newsSubCategory->sub_cate_en : $item->newsSubCategory->sub_cate_bn }}
                                        </span>
                                    @endif
                                    <span style="color:#999;font-size:14px;"><i class="fa fa-clock-o"
                                            style="margin-right:5px;"></i>{{ $item->created_at->format('d M Y') }}</span>
                                </div>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div style="display:flex; justify-content:center; margin-top:40px;">
                {{ $news->appends(request()->query())->links() }}
            </div>
        @else
            <div
                style="background:#fff3cd; border-left:4px solid #ffc107; padding:20px 25px; border-radius:6px; margin-top:30px;">
                <h4 style="margin:0 0 10px 0; color:#856404; font-size:20px;">
                    @if (session()->get('lang') == 'english')
                        No news found for this date
                    @else
                        এই তারিখে কোন সংবাদ পাওয়া যায়নি
                    @endif
                </h4>
            </div>
        @endif

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const yearSelect = document.getElementById('yearSelect');
            const monthSelect = document.getElementById('monthSelect');
            const daySelect = document.getElementById('daySelect');
            const form = document.getElementById('archiveForm');

            const today = new Date();
            const currentYear = today.getFullYear();
            const currentMonth = today.getMonth();
            const currentDay = today.getDate();
            const isEnglish = '{{ session()->get('lang') }}' === 'english';

            function toBanglaDigits(number) {
                const bnDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
                return number.toString().split('').map(d => bnDigits[d] ?? d).join('');
            }

            // Year
            for (let y = currentYear; y >= currentYear - 5; y--) {
                let opt = document.createElement('option');
                opt.value = y;
                opt.textContent = isEnglish ? y : toBanglaDigits(y);
                yearSelect.appendChild(opt);
            }
            yearSelect.value = currentYear;

            // Month
            const monthsEn = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                'October', 'November', 'December'
            ];
            const monthsBn = ['জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট',
                'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'
            ];
            const months = isEnglish ? monthsEn : monthsBn;
            months.forEach((m, i) => {
                let opt = document.createElement('option');
                opt.value = i;
                opt.textContent = m;
                monthSelect.appendChild(opt);
            });
            monthSelect.value = currentMonth;

            function renderDays() {
                daySelect.innerHTML = '';
                const year = parseInt(yearSelect.value);
                const month = parseInt(monthSelect.value);
                const lastDay = new Date(year, month + 1, 0).getDate();
                for (let d = 1; d <= lastDay; d++) {
                    let opt = document.createElement('option');
                    opt.value = d;
                    opt.textContent = isEnglish ? d : toBanglaDigits(d);
                    if (year === currentYear && month === currentMonth && d > currentDay) {
                        opt.disabled = true;
                    }
                    daySelect.appendChild(opt);
                }
                daySelect.value = 1;
            }
            renderDays();

            daySelect.addEventListener('change', function() {
                const y = yearSelect.value;
                const m = parseInt(monthSelect.value) + 1;
                const d = daySelect.value;
                form.action =
                `/news/archive/${y}-${String(m).padStart(2,'0')}-${String(d).padStart(2,'0')}`;
                form.submit();
            });

            yearSelect.addEventListener('change', renderDays);
            monthSelect.addEventListener('change', renderDays);
        });
    </script>
@endsection
