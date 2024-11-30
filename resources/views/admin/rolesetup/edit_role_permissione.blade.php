@extends('layouts.app')
@section('title')
    Edit Role In Permission
@endsection

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Role In Permission</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('index.pemission.store') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form class="forms-sample" method="POST" action="{{ route('role.pemission.update', $role->id) }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Roles Name</label>
                    <h6>{{ $role->name }}</h6>
                </div>
                <div class="form-check mb-2">
                    <input type="checkbox" class="form-check-input" id="checkDefaultmain">
                    <label class="form-check-label" for="checkDefaultmain">
                        Permission All
                    </label>
                </div>
                <hr>
                @foreach ($permission_group as $item)
                    <div class="row">
                        <div class="col-3">

                            @php
                                $permissions = App\Models\User::getpermissionByGroupName($item->group_name);
                            @endphp

                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="checkDefault"
                                    {{ App\models\User::RoleHasPermission($role, $permissions) ? 'checked' : '' }}>
                                <label class="form-check-label" for="checkDefault">
                                    {{ $item->group_name }}
                                </label>
                            </div>
                        </div>


                        <div class="col-9">
                            @foreach ($permissions as $per)
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" name="permission[]"
                                        id="checkDefault{{ $per->id }}" value="{{ $per->id }}"
                                        {{ $role->hasPermissionTo($per->name) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="checkDefault{{ $per->id }}">
                                        {{ $per->name }}
                                    </label>
                                </div>
                            @endforeach
                            <br>
                        </div>

                    </div>
                @endforeach


                <button type="submit" class="btn btn-primary me-2">Save Changes</button>

            </form>
        </div>

        <!-- /.card -->
    </section>

@section('cutomJs')
    <script type="text/javascript">
        $('#checkDefaultmain').click(function() {
            if ($(this).is(':checked')) {
                $('input[type=checkbox]').prop('checked', true);
            } else {
                $('input[type=checkbox]').prop('checked', false);
            }

        });
    @endsection

@endsection
