@extends('layouts.app')
@section('title','Tech Support Information')
@section('styles')
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tech Support Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Tech Support Information</li>
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
                        <div class="card-tools">
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Post -->
                        <div class="post">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="{{ asset('/uploads/'. $support->images->first()->image_path) }}" alt="User Image">
                                <span class="username">
                          <a href="#">{{ $support->title }}</a>
                        </span>
                                <span class="description">Posted from {{ $support->created_at->diffForHumans() }}</span>
                            </div>
                            <!-- /.user-block -->
                                <!-- /.col -->
                                <div class="row-sm-6">
                                    @foreach($support->images as $image)
                                        <img class="img-fluid" src="{{ asset('/uploads/'. $image->image_path) }}" alt="Photo">
                                @endforeach
                                        <!-- /.col -->
                                </div>
                                    <!-- /.row -->
                                <!-- /.col -->
                            <!-- /.row -->
                           <br>
                            <div class="form-group">
                                <label for="title" class="form-label">Title</label>
                                <input name="title" type="text" class="form-control" id="title"
                                       value="{{ $support->title }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="category" class="form-label">Category</label>
                                <input name="category" type="text" class="form-control" id="category"
                                       value="{{ $support->category->name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="status" class="form-label">Status</label>
                                <input name="status" type="text" class="form-control" id="status"
                                       value="{{ $support->status }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" class="form-control" rows="4"
                                          name="description" readonly>{{ $support->description }}</textarea>
                            </div>

                            <div class="form-group">
                                    <label for="fixed_description" class="form-label">Fixed Description</label>
                                <textarea id="fixed_description" class="form-control" rows="4"
                                          name="fixed_description" readonly>{{ $support->fixed_description }}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{ route('tech-supports.index') }}" class="btn btn-secondary">Back</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.post -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
@endsection
