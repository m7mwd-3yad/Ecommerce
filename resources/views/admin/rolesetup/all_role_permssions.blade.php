@extends('layouts.app')
@section('title')
    List Roles Permission
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Roles Permssiones</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('role.permission.create') }}" class="btn btn-primary">New Role In Permission</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="card">
                <form action="" method="get">
                    <div class="card-header">
                        <div class="card-title">
                            <button id="resetButton" onclick="window.location.href='{{ route('role.index') }}'"
                                class="btn btn-default btn-sm">Reset</button>

                        </div>
                        <script>
                            document.getElementById('resetButton').addEventListener('click', function(event) {
                                event.preventDefault();
                                window.location.href = '{{ route('role.index') }}';
                            });
                        </script>
                    </div>
                    <div class="card-header">
                        <div class="card-tools">
                            <div class="input-group input-group" style="width: 250px;">
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
                                <th>Sl</th>
                                <th>Roles Name</th>
                                <th>Permission</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($role as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @foreach ($item->permissions as $permission)
                                            <span class="badge bg-danger">{{ $permission->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-danger"
                                            href="{{ route('role.pemission.edit', $item->id) }}">Edit</a>
                                        <a class="btn btn-sm btn-info" id="delete"
                                            href="{{ route('role.pemission.destroy', $item->id) }}">Delete</a>
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
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection
