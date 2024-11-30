@extends('layouts.app')
@section('title')
    Edit Order
@endsection

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Order</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('order.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('order.update', $order->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Customer Name -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="customer_name" class="form-label">Customer Name</label>
                                    <input type="text" readonly value="{{ $order->customer_name }}" name="customer_name" id="customer_name"
                                        class="form-control @error('customer_name') is-invalid @enderror" placeholder="Customer Name">
                                    @error('customer_name')
                                        <span>
                                            <small class="text-danger">{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" readonly value="{{ $order->email }}" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                                    @error('email')
                                        <span>
                                            <small class="text-danger">{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" readonly value="{{ $order->phone }}" name="phone" id="phone"
                                        class="form-control @error('phone') is-invalid @enderror" placeholder="Phone">
                                    @error('phone')
                                        <span>
                                            <small class="text-danger">{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Amount -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="number" readonly step="0.01" value="{{ $order->amount }}" name="amount" id="amount"
                                        class="form-control @error('amount') is-invalid @enderror" placeholder="Amount">
                                    @error('amount')
                                        <span>
                                            <small class="text-danger">{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Date Purchased -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date_purchased" class="form-label">Date Purchased</label>
                                    <input type="date" readonly value="{{ $order->date_purchased }}" name="date_purchased" id="date_purchased"
                                        class="form-control @error('date_purchased') is-invalid @enderror">
                                    @error('date_purchased')
                                        <span>
                                            <small class="text-danger">{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="pt-3 pb-5">
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('order.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
    </section>
@endsection
