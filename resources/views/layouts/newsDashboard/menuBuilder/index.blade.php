{{-- resources/views/admin/menu/index.blade.php --}}
@extends('layouts.newsDashboard.dashboardMaster')

@section('dashboard')
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            padding: 20px;
        }

        .menu-builder {
            max-width: 900px;
            margin: 0 auto;
        }

        .main-card {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            margin-bottom: 1.25rem;
        }

        .card-header-custom {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            background: linear-gradient(to right, #f9fafb, #f3f4f6);
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }

        .card-body-custom {
            padding: 1.5rem;
        }

        .category-item {
            background: linear-gradient(135deg, #eef2ff, #e0e7ff);
            border-radius: 0.5rem;
            border: 1px solid #c7d2fe;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .category-item:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .category-header {
            display: flex;
            align-items: center;
            padding: 1rem;
            background-color: #c7d2fe;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }

        .drag-handle {
            margin-right: 0.75rem;
            color: #4f46e5;
            cursor: grab;
            font-size: 1.2rem;
            user-select: none;
        }

        .drag-handle:hover {
            color: #3730a3;
        }

        .toggle-btn {
            background: none;
            border: none;
            margin-right: 0.75rem;
            padding: 0;
            color: #4338ca;
        }

        .toggle-btn:hover {
            color: #312e81;
        }

        .toggle-icon {
            width: 1rem;
            height: 1rem;
            transition: transform 0.2s;
        }

        .toggle-btn.collapsed .toggle-icon {
            transform: rotate(-90deg);
        }

        .category-title {
            font-weight: 600;
            color: #1f2937;
            flex: 1;
        }

        .order-badge {
            font-size: 0.75rem;
            font-weight: 700;
            background-color: #4f46e5;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
        }

        .subcategories-container {
            display: block;
        }

        .subcategories-list {
            padding: 0.75rem;
            min-height: 50px;
            border: 2px dashed #d1d5db;
            border-radius: 0.375rem;
        }

        .subcategory-item {
            background-color: white;
            border-radius: 0.25rem;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            margin-bottom: 0.5rem;
        }

        .subcategory-item:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            background-color: #eef2ff;
        }

        .subcategory-item:last-child {
            margin-bottom: 0;
        }

        .subcategory-content {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            border-radius: 0.375rem;
        }

        .subcategory-drag-handle {
            margin-right: 0.75rem;
            color: #9ca3af;
            cursor: grab;
            font-size: 1.2rem;
            user-select: none;
        }

        .subcategory-drag-handle:hover {
            color: #4b5563;
        }

        .subcategory-title {
            color: #374151;
            flex: 1;
        }

        .suborder-badge {
            font-size: 0.75rem;
            font-weight: 500;
            background-color: #e5e7eb;
            color: #4b5563;
            padding: 0.125rem 0.5rem;
            border-radius: 9999px;
        }

        .save-btn {
            background: linear-gradient(to right, #4f46e5, #9333ea);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .save-btn:hover {
            background: linear-gradient(to right, #4338ca, #7e22ce);
            transform: translateY(-1px);
            box-shadow: 0 6px 10px -1px rgba(0, 0, 0, 0.15);
        }

        .dragging {
            opacity: 0.6;
        }

        .drop-zone {
            border: 2px dashed #6366f1;
            background-color: #eef2ff;
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
                                    <li class="breadcrumb-item text-muted" aria-current="page">Menu Builder</li>
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
            <div class="menu-builder">
                <div class="main-card">
                    <!-- Header -->
                    <div class="card-header-custom">
                        <h2 class="h5 mb-1 fw-semibold text-dark">📰 News Menu Management</h2>
                        <p class="mb-0 small text-muted">Drag and drop to reorder categories and subcategories</p>
                    </div>

                    <div class="card-body-custom">
                        <!-- Categories -->
                        <div id="menu-container">
                            @foreach ($categories as $category)
                                <div class="category-item" data-category-id="{{ $category->id }}"
                                    data-order="{{ $category->order }}">
                                    <div class="category-header">
                                        <div class="drag-handle">⠿</div>
                                        <button class="toggle-btn collapsed" data-bs-toggle="collapse"
                                            data-bs-target="#subcategories-{{ $category->id }}">
                                            <svg class="toggle-icon" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        <span class="category-title">{{ $category->category_en . ' | ' . $category->category_bn }}</span>
                                        <span class="order-badge">#{{ $category->order }}</span>
                                    </div>

                                    <div class="subcategories-container collapse @if ($loop->first) show @endif"
                                        id="subcategories-{{ $category->id }}">
                                        <div class="subcategories-list">
                                            @forelse ($category->subCategories as $subCategory)
                                                <div class="subcategory-item" data-subcategory-id="{{ $subCategory->id }}"
                                                    data-category-id="{{ $category->id }}"
                                                    data-order="{{ $subCategory->order }}">
                                                    <div class="subcategory-content">
                                                        <div class="subcategory-drag-handle">⠿</div>
                                                        <span
                                                            class="subcategory-title">{{ $subCategory->sub_cate_en . ' | ' . $subCategory->sub_cate_bn }}</span>
                                                        <span class="suborder-badge">{{ $subCategory->order }}</span>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="text-center text-muted fst-italic py-2">No subcategories
                                                    available
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="text-start mt-4">
                            <button id="save-order" class="save-btn">💾 Save Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let hasChanges = false;

            // Categories sortable
            new Sortable(document.getElementById('menu-container'), {
                handle: '.drag-handle',
                animation: 200,
                ghostClass: 'dragging',
                onEnd: updateCategoryOrders
            });

            // Subcategories sortable
            document.querySelectorAll('.subcategories-list').forEach(subList => {
                new Sortable(subList, {
                    group: 'subcategories',
                    handle: '.subcategory-drag-handle',
                    animation: 200,
                    ghostClass: 'dragging',
                    onEnd: updateSubcategoryOrders
                });
            });

            function updateCategoryOrders() {
                document.querySelectorAll('.category-item').forEach((cat, i) => {
                    cat.setAttribute('data-order', i + 1);
                    const orderSpan = cat.querySelector('.order-badge');
                    orderSpan.textContent = '#' + (i + 1);
                });
                hasChanges = true;
            }

            function updateSubcategoryOrders() {
                document.querySelectorAll('.subcategories-list').forEach(subList => {
                    subList.querySelectorAll('.subcategory-item').forEach((sub, i) => {
                        sub.setAttribute('data-order', i + 1);
                        sub.querySelector('.suborder-badge').textContent = i + 1;
                    });
                });
                hasChanges = true;
            }

            document.getElementById('save-order').addEventListener('click', function() {
                if (!hasChanges) return alert('⚠️ No changes to save!');

                const data = [];
                document.querySelectorAll('.category-item').forEach((cat, i) => {
                    const categoryData = {
                        id: parseInt(cat.dataset.categoryId),
                        order: i + 1,
                        subcategories: []
                    };
                    cat.querySelectorAll('.subcategory-item').forEach((sub, j) => {
                        categoryData.subcategories.push({
                            id: parseInt(sub.dataset.subcategoryId),
                            order: j + 1,
                            category_id: parseInt(cat.dataset.categoryId)
                        });
                    });
                    data.push(categoryData);
                });

                fetch('{{ route('admin.menu.reorder-all') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            data
                        })
                    }).then(r => r.json())
                    .then(res => {
                        hasChanges = false;
                        alert(res.success ? '✅ Order saved!' : '❌ Failed to save order');
                    }).catch(() => alert('❌ Server error!'));
            });
        });
    </script>
@endsection
