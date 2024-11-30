@extends('layouts.app')
@section('title')
    Create Product
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Product</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('product.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="{{ route('product.store') }}" method="POST">
            @csrf
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <!-- Product Details Card -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <!-- Title -->
                                    <div class="col-md-12 mb-3">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="Title">
                                    </div>
                                    <!-- Slug -->
                                    <div class="col-md-12 mb-3">
                                        <label for="slug">Slug</label>
                                        <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug">
                                    </div>
                                    <!-- Description -->
                                    <div class="col-md-12 mb-3">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" cols="105" rows="4" class="summernote" placeholder="Description"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Media Upload Card -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Media</h2>
                                <div id="image" class="dropzone dz-clickable">
                                    <div  class="dz-message needsclick">Drop files here or click to upload.</div>
                                </div>
                            </div>
                        </div>

                        <!-- Pricing Card -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Pricing</h2>
                                <div class="row">
                                    <!-- Price -->
                                    <div class="col-md-12 mb-3">
                                        <label for="price">Price</label>
                                        <input type="text" name="price" id="price" class="form-control" placeholder="Price">
                                    </div>
                                    <!-- Compare Price -->
                                    <div class="col-md-12 mb-3">
                                        <label for="compare_price">Compare at Price</label>
                                        <input type="text" name="compare_price" id="compare_price" class="form-control" placeholder="Compare Price">
                                        <p class="text-muted mt-3">
                                            To show a reduced price, move the product’s original price into Compare at price. Enter a lower value into Price.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Inventory Card -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Inventory</h2>
                                <div class="row">
                                    <!-- SKU -->
                                    <div class="col-md-6 mb-3">
                                        <label for="sku">SKU</label>
                                        <input type="text" name="sku" id="sku" class="form-control" placeholder="sku">
                                    </div>
                                    <!-- Barcode -->
                                    <div class="col-md-6 mb-3">
                                        <label for="barcode">Barcode</label>
                                        <input type="text" name="barcode" id="barcode" class="form-control" placeholder="Barcode">
                                    </div>
                                    <!-- Track Quantity -->
                                    <div class="col-md-12 mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="track_qty" name="track_qty" value="1" checked>
                                            <label for="track_qty" class="custom-control-label">Track Quantity</label>
                                        </div>
                                    </div>
                                    <!-- Quantity -->
                                    <div class="col-md-12 mb-3">
                                        <input type="number" min="0" name="qty" id="qty" class="form-control" placeholder="Qty">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar (Product Status, Category, Brand, Featured) -->
                    <div class="col-md-4">
                        <!-- Product Status Card -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Product status</h2>
                                <div class="mb-3">
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Block</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Category Selection Card -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Product category</h2>
                                <div class="mb-3">
                                    <label for="category">Category</label>
                                    <select name="category_id" id="category" class="form-control" onchange="loadSubCategories()">
                                        <option disabled selected value="">Select a Category</option>
                                        @foreach ($category as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="sub_category">Sub category</label>
                                    <select name="sub_category_id" id="sub_category" class="form-control">
                                        <option disabled selected value="">Select a Category First</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Brand Selection Card -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Product brand</h2>
                                <div class="mb-3">
                                    <select name="brand_id" id="brand_id" class="form-control">
                                        <option disabled selected value="">Select a Brand</option>
                                        @foreach ($brand as $bran)
                                            <option value="{{ $bran->id }}">{{ $bran->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Product Card -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Featured product</h2>
                                <div class="mb-3">
                                    <select name="is_featured" id="is_featured" class="form-control">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit and Cancel Buttons -->
                <div class="pb-5 pt-3">
                    <button class="btn btn-primary">Create</button>
                    <a href="{{ route('product.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </div>
        </form>
    </section>

    <script>
        function loadSubCategories() {
            const categoryId = document.getElementById('category').value;
            const subCategoryDropdown = document.getElementById('sub_category');

            subCategoryDropdown.innerHTML = '<option disabled selected value="">Select a Sub Category</option>';

            if (categoryId) {
                fetch(`{{ route('get-sub-categories', '') }}/${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(sub => {
                            const option = document.createElement('option');
                            option.value = sub.id;
                            option.textContent = sub.name;
                            subCategoryDropdown.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching sub-categories:', error));
            }
        }
    </script>
@endsection
