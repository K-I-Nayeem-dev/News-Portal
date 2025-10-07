{{-- Location Filter Component --}}
<div class="country-filter-container">
    <form action="{{ route('location.search') }}" method="GET" id="location-search-form">
        {{-- Preserve all existing query parameters --}}
        @foreach (request()->except(['division_id', 'dist_id', 'sub_dist_id']) as $key => $value)
            @if (is_array($value))
                @foreach ($value as $item)
                    <input type="hidden" name="{{ $key }}[]" value="{{ $item }}">
                @endforeach
            @else
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endif
        @endforeach

        <div class="country-filter-row">
            <div class="country-filter-inputs">
                <div class="country-filter-col">
                    <select name="division_id" id="division_id" required>
                        <option value="">
                            {{ session()->get('lang') == 'english' ? 'Select Division' : 'বিভাগ নির্বাচন করুন' }}
                        </option>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}"
                                {{ request('division_id') == $division->id ? 'selected' : '' }}>
                                {{ session()->get('lang') == 'english' ? $division->division_en : $division->division_bn }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="country-filter-col">
                    <select name="dist_id" id="dist_id" {{ request('division_id') ? '' : 'disabled' }} required>
                        <option value="">
                            {{ session()->get('lang') == 'english' ? 'Select District' : 'জেলা নির্বাচন করুন' }}
                        </option>
                    </select>
                </div>
                <div class="country-filter-col">
                    <select name="sub_dist_id" id="sub_dist_id" {{ request('dist_id') ? '' : 'disabled' }}>
                        <option value="">
                            {{ session()->get('lang') == 'english' ? 'Subdistrict (Optional)' : 'উপজেলা (ঐচ্ছিক)' }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="country-filter-button-col">
                <button class="country-filter-button" type="submit">
                    {{ session()->get('lang') == 'english' ? 'Search News' : 'সংবাদ খুঁজুন' }}
                </button>
            </div>
        </div>
    </form>
</div>


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('location-search-form');
            const divisionSelect = document.getElementById('division_id');
            const districtSelect = document.getElementById('dist_id');
            const subdistrictSelect = document.getElementById('sub_dist_id');
            const submitButton = form.querySelector('button[type="submit"]');
            const currentLang = '{{ session()->get('lang') }}' || 'english';

            // Load previously selected values
            const selectedDivisionId = '{{ request('division_id') }}';
            const selectedDistrictId = '{{ request('dist_id') }}';
            const selectedSubdistrictId = '{{ request('sub_dist_id') }}';

            // Load districts on page load if division is selected
            if (selectedDivisionId) {
                loadDistricts(selectedDivisionId, selectedDistrictId);
            }

            function loadDistricts(divisionId, selectDistrictId = null) {
                districtSelect.innerHTML =
                    `<option value="">${currentLang === 'english' ? 'Loading...' : 'লোড হচ্ছে...'}</option>`;
                districtSelect.disabled = true;
                subdistrictSelect.disabled = true;

                fetch('/get/dist/' + divisionId)
                    .then(response => response.json())
                    .then(data => {
                        districtSelect.innerHTML =
                            `<option value="">${currentLang === 'english' ? 'Select District' : 'জেলা নির্বাচন করুন'}</option>`;

                        if (data && data.length > 0) {
                            data.forEach(district => {
                                const districtName = currentLang === 'english' ? district.district_en :
                                    district.district_bn;
                                const option = document.createElement('option');
                                option.value = district.id;
                                option.textContent = districtName;
                                if (selectDistrictId && district.id == selectDistrictId) {
                                    option.selected = true;
                                }
                                districtSelect.appendChild(option);
                            });
                            districtSelect.disabled = false;

                            // Load subdistricts if district was previously selected
                            if (selectDistrictId) {
                                loadSubdistricts(selectDistrictId, selectedSubdistrictId);
                            } else {
                                subdistrictSelect.disabled = false;
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error loading districts:', error);
                        districtSelect.innerHTML =
                            `<option value="">${currentLang === 'english' ? 'Select District' : 'জেলা নির্বাচন করুন'}</option>`;
                        districtSelect.disabled = false;
                        alert(currentLang === 'english' ? 'Error loading districts' :
                            'জেলা লোড করতে সমস্যা হয়েছে');
                    });
            }

            function loadSubdistricts(districtId, selectSubdistrictId = null) {
                subdistrictSelect.innerHTML =
                    `<option value="">${currentLang === 'english' ? 'Loading...' : 'লোড হচ্ছে...'}</option>`;
                subdistrictSelect.disabled = true;

                fetch('/get/subdist/' + districtId)
                    .then(response => response.json())
                    .then(data => {
                        subdistrictSelect.innerHTML =
                            `<option value="">${currentLang === 'english' ? 'Subdistrict (Optional)' : 'উপজেলা (ঐচ্ছিক)'}</option>`;

                        if (data && data.length > 0) {
                            data.forEach(subdistrict => {
                                const subdistrictName = currentLang === 'english' ? subdistrict
                                    .sub_district_en : subdistrict.sub_district_bn;
                                const option = document.createElement('option');
                                option.value = subdistrict.id;
                                option.textContent = subdistrictName;
                                if (selectSubdistrictId && subdistrict.id == selectSubdistrictId) {
                                    option.selected = true;
                                }
                                subdistrictSelect.appendChild(option);
                            });
                        }
                        subdistrictSelect.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error loading subdistricts:', error);
                        subdistrictSelect.innerHTML =
                            `<option value="">${currentLang === 'english' ? 'Subdistrict (Optional)' : 'উপজেলা (ঐচ্ছিক)'}</option>`;
                        subdistrictSelect.disabled = false;
                        alert(currentLang === 'english' ? 'Error loading subdistricts' :
                            'উপজেলা লোড করতে সমস্যা হয়েছে');
                    });
            }

            // Division change event
            divisionSelect.addEventListener('change', function() {
                const divisionId = this.value;

                // Reset district and subdistrict
                districtSelect.innerHTML =
                    `<option value="">${currentLang === 'english' ? 'Select District' : 'জেলা নির্বাচন করুন'}</option>`;
                districtSelect.disabled = true;

                subdistrictSelect.innerHTML =
                    `<option value="">${currentLang === 'english' ? 'Subdistrict (Optional)' : 'উপজেলা (ঐচ্ছিক)'}</option>`;
                subdistrictSelect.disabled = true;

                if (divisionId) {
                    loadDistricts(divisionId);
                } else {
                    districtSelect.disabled = false;
                    subdistrictSelect.disabled = false;
                }
            });

            // District change event
            districtSelect.addEventListener('change', function() {
                const districtId = this.value;

                // Reset subdistrict
                subdistrictSelect.innerHTML =
                    `<option value="">${currentLang === 'english' ? 'Subdistrict (Optional)' : 'উপজেলা (ঐচ্ছিক)'}</option>`;
                subdistrictSelect.disabled = true;

                if (districtId) {
                    loadSubdistricts(districtId);
                } else {
                    subdistrictSelect.disabled = false;
                }
            });

            // Form submission validation
            form.addEventListener('submit', function(e) {
                if (!divisionSelect.value || !districtSelect.value) {
                    e.preventDefault();
                    alert(currentLang === 'english' ?
                        'Please select both Division and District' :
                        'অনুগ্রহ করে বিভাগ এবং জেলা উভয়ই নির্বাচন করুন'
                    );
                }
            });
        });
    </script>
@endpush

<style>
    .country-filter-container {
        margin: 20px 0;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .country-filter-row {
        display: flex;
        gap: 15px;
        align-items: end;
        flex-wrap: wrap;
    }

    .country-filter-inputs {
        display: flex;
        gap: 15px;
        flex: 1;
        flex-wrap: wrap;
    }

    .country-filter-col {
        flex: 1;
        min-width: 200px;
    }

    .country-filter-col select {
        width: 100%;
        padding: 10px 14px;
        font-size: 15px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        background-color: white;
        cursor: pointer;
        transition: border-color 0.2s;
    }

    .country-filter-col select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .country-filter-col select:disabled {
        background-color: #f3f4f6;
        cursor: not-allowed;
        opacity: 0.6;
    }

    .country-filter-button-col {
        display: flex;
        align-items: end;
    }

    .country-filter-button {
        padding: 10px 24px;
        font-size: 16px;
        font-weight: 500;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        background-color: #3b82f6;
        color: white;
        white-space: nowrap;
    }

    .country-filter-button:hover:not(:disabled) {
        background-color: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3);
    }

    .country-filter-button:active:not(:disabled) {
        transform: translateY(0);
    }

    .country-filter-button:disabled {
        background-color: #d1d5db;
        color: #9ca3af;
        cursor: not-allowed;
        opacity: 0.6;
    }

    @media (max-width: 768px) {
        .country-filter-row {
            flex-direction: column;
        }

        .country-filter-inputs {
            width: 100%;
        }

        .country-filter-button-col {
            width: 100%;
        }

        .country-filter-button {
            width: 100%;
        }
    }
</style>
