@extends('layouts.app')
@section('title','Edit Category Information')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Category Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Category Information</li>
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
                        <form id="editUser" method="POST" action="{{ route('categories.update', $category->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="col">
                                <div class="form-group">
                                    <label for="name" class="form-label">Name</label>
                                    <input name="name" type="text" class="form-control" id="name"
                                           value="{{ $category->name }}">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                        <strong style="color: red">{{ $errors->first('name') }}</strong>
                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="disabled">Disabled</label>
                                    <select id="disabled" class="form-control custom-select" name="disabled">
                                        @if ($category->disabled === 0)
                                            <option value="0" selected>Enabled</option>
                                            <option value="1">Disabled</option>
                                        @elseif($category->disabled === 1)
                                            <option value="1" selected>Disabled</option>
                                            <option value="0">Enabled</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" id="description"
                                              rows="3">{{ $category->description }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong style="color: red">{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
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
