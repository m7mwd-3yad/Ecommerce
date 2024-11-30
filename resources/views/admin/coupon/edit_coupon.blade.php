@extends('layouts.app')

@section('title')
    Edit Coupon
@endsection

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Coupon</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('coupon.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('coupon.update', $coupon->id) }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Code -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="code">Code</label>
                                    <input type="text" name="code" id="code"
                                        class="form-control @error('code') is-invalid @enderror"
                                        value="{{ old('code', $coupon->code) }}" placeholder="Code">
                                    @error('code')
                                        <span>
                                            <small class="text-danger">{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Name -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $coupon->name) }}" placeholder="Name">
                                    @error('name')
                                        <span>
                                            <small class="text-danger">{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Max Uses -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="max_uses">Max Uses</label>
                                    <input type="number" name="max_uses" id="max_uses"
                                        class="form-control @error('max_uses') is-invalid @enderror"
                                        value="{{ old('max_uses', $coupon->max_uses) }}" placeholder="Max Uses">
                                    @error('max_uses')
                                        <span>
                                            <small class="text-danger">{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Max Uses per User -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="max_uses_user">Max Uses User</label>
                                    <input type="number" name="max_uses_user" id="max_uses_user"
                                        class="form-control @error('max_uses_user') is-invalid @enderror"
                                        value="{{ old('max_uses_user', $coupon->max_uses_user) }}"
                                        placeholder="Max Uses User">
                                    @error('max_uses_user')
                                        <span>
                                            <small class="text-danger">{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Type -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="type">Type</label>
                                    <select name="type" id="type" class="form-control">
                                        <option disabled>Select Type</option>
                                        <option value="Percent"
                                            {{ old('type', $coupon->type) == 'Percent' ? 'selected' : '' }}>Percent
                                        </option>
                                        <option value="Fixed"
                                            {{ old('type', $coupon->type) == 'Fixed' ? 'selected' : '' }}>Fixed</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Discount Amount -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="discount_amount">Discount Amount</label>
                                    <input type="number" name="discount_amount" id="discount_amount"
                                        class="form-control @error('discount_amount') is-invalid @enderror"
                                        value="{{ old('discount_amount', $coupon->discount_amount) }}"
                                        placeholder="Discount Amount">
                                    @error('discount_amount')
                                        <span>
                                            <small class="text-danger">{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Min Amount -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="min_amount">Min Amount</label>
                                    <input type="number" name="min_amount" id="min_amount"
                                        class="form-control @error('min_amount') is-invalid @enderror"
                                        value="{{ old('min_amount', $coupon->min_amount) }}" placeholder="Min Amount">
                                    @error('min_amount')
                                        <span>
                                            <small class="text-danger">{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Status -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option disabled>Select Status</option>
                                        <option value="1"
                                            {{ old('status', $coupon->status) == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0"
                                            {{ old('status', $coupon->status) == '0' ? 'selected' : '' }}>Block</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Starts At -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="starts_at">Starts At</label>
                                    <input type="datetime-local" name="starts_at" id="starts_at"
                                        class="form-control @error('starts_at') is-invalid @enderror"
                                        value="{{ old('starts_at', $coupon->starts_at ? \Carbon\Carbon::parse($coupon->starts_at)->format('Y-m-d\TH:i') : '') }}"
                                        placeholder="Starts At">
                                    @error('starts_at')
                                        <span>
                                            <small class="text-danger">{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Expires At -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="expiers_at">Expires At</label>
                                    <input type="datetime-local" name="expiers_at" id="expiers_at"
                                        class="form-control @error('expiers_at') is-invalid @enderror"
                                        value="{{ old('expiers_at', $coupon->expiers_at ? \Carbon\Carbon::parse($coupon->expiers_at)->format('Y-m-d\TH:i') : '') }}"
                                        placeholder="Expires At">
                                    @error('expiers_at')
                                        <span>
                                            <small class="text-danger">{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" cols="30" rows="4"
                                        class="form-control @error('description') is-invalid @enderror" placeholder="Description">{{ old('description', $coupon->description) }}</textarea>
                                    @error('description')
                                        <span>
                                            <small class="text-danger">{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('coupon.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
    </section>
@endsection
