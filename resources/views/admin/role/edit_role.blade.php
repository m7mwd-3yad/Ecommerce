@extends('layouts.app')
@section('title')
    Edit Role
@endsection

@section('content')

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Role</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('role.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('role.update',$role->id) }}"  method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Role Name</label>
                                    <input type="text" name="name" id="name" value="{{ $role->name }}"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Role Name">
                                    @error('name')
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
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="brands.html" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>

        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection
