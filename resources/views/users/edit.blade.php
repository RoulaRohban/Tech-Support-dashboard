@extends('layouts.app')
@section('title','Edit User Information')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit User Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit User Information</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Information</h3>
                    </div>
                    <div class="card-body">
                        <form id="editUser" method="POST" action="{{ route('users.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text fa fa-user"></span>
                                </div>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Username">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong style="color:red">{{ $errors->first('name') }}</strong></span>
                                @endif
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ $user->email }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong style="color:red">{{ $errors->first('email') }}</strong></span>
                                @endif
                            </div>
{{--                            <div class="input-group mb-3">--}}
{{--                                <select id="type" class="form-control custom-select" name="type">--}}
{{--                                    <option value="">Select Type</option>--}}
{{--                                    @if ($user->type === 'admin')--}}
{{--                                        <option value="admin" selected>Admin</option>--}}
{{--                                        <option value="super_admin">Super Admin</option>--}}
{{--                                    @elseif($user->type === 'super_admin')--}}
{{--                                        <option value="super_admin" selected>Super Admin</option>--}}
{{--                                        <option value="admin">Admin</option>--}}
{{--                                    @endif--}}
{{--                                </select>--}}
{{--                                @if ($errors->has('type'))--}}
{{--                                    <span class="help-block">--}}
{{--                                        <strong style="color:red">{{ $errors->first('type') }}</strong></span>--}}
{{--                                @endif--}}
{{--                            </div>--}}
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{ route('users.index')  }}" class="btn btn-secondary">Cancel</a>
                                    <input type="submit" class="btn btn-success float-right">
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
