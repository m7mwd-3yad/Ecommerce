@extends('layouts.app')
@section('title')
    List Orders
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('order.create') }}" class="btn btn-primary">New Order</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <form action="" method="get">
                    <div class="card-header">
                        <div class="card-title">
                            <button id="resetButton" onclick="window.location.href='{{ route('order.index') }}'"
                                class="btn btn-default btn-sm">Reset</button>
                        </div>
                        <script>
                            document.getElementById('resetButton').addEventListener('click', function(event) {
                                event.preventDefault();
                                window.location.href = '{{ route('order.index') }}';
                            });
                        </script>
                    </div>
                    <div class="card-header">
                        <div class="card-tools">
                            <div class="input-group" style="width: 250px;">
                                <input type="text" value="{{ Request::get('keyword') }}" name="keyword"
                                    class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width="60">Order#</th>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Amount</th>
                                <th>Date Purchased</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>
                                        @if ($order->status === 'Pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif ($order->status === 'Delivered')
                                            <span class="badge badge-success">Delivered</span>
                                        @elseif ($order->status === 'Cancelled')
                                            <span class="badge badge-danger">Cancelled</span>
                                        @endif
                                    </td>
                                    <td>${{ number_format($order->amount, 2) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($order->date_purchased)->format('d M, Y') }}</td>
                                    <td>
                                        <a href="{{ route('order.edit', $order->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('order.destroy', $order->id) }}" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this order?');">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <ul class="pagination pagination m-0 float-right">
                        <li class="page-item"><a class="page-link" href="#">«</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">»</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
