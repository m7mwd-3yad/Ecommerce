@extends('layouts.app')
@section('title')
    Edit Product
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Product</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('product.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <form action="{{ route('product.update', $product->id) }}" method="POST">
            @csrf
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <!-- Product Details Card -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $product->title) }}" placeholder="Title">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="slug">Slug</label>
                                        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $product->slug) }}" placeholder="Slug">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" cols="105" rows="4" class="summernote" placeholder="Description">{{ old('description', $product->description) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pricing Card -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Pricing</h2>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="price">Price</label>
                                        <input type="text" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}" placeholder="Price">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="compare_price">Compare at Price</label>
                                        <input type="text" name="compare_price" id="compare_price" class="form-control" value="{{ old('compare_price', $product->compare_price) }}" placeholder="Compare Price">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Inventory Card -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Inventory</h2>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="sku">SKU</label>
                                        <input type="text" name="sku" id="sku" class="form-control" value="{{ old('sku', $product->sku) }}" placeholder="SKU">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="barcode">Barcode</label>
                                        <input type="text" name="barcode" id="barcode" class="form-control" value="{{ old('barcode', $product->barcode) }}" placeholder="Barcode">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <input type="checkbox" id="track_qty" name="track_qty" value="1" {{ old('track_qty', $product->track_qty) ? 'checked' : '' }}>
                                        <label for="track_qty">Track Quantity</label>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <input type="number" min="0" name="qty" id="qty" class="form-control" value="{{ old('qty', $product->qty) }}" placeholder="Qty">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Product status</h2>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Block</option>
                                </select>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Product category</h2>
                                <select name="category_id" id="category" class="form-control">
                                    <option disabled selected value="">Select a Category</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Product brand</h2>
                                <select name="brand_id" id="brand_id" class="form-control">
                                    <option disabled selected value="">Select a Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{ route('product.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </div>
        </form>
    </section>
@endsection
