@extends('layouts.app')
@section('title','Edit Tech Support Information')
@section('styles')
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tech Support Information Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tech Support Information Edit</li>
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
                        <form method="POST" action="{{ route('tech-supports.update', $support->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="fixed_description">What Was the Problem?</label>
                                <textarea id="fixed_description" class="form-control" rows="4"
                                          name="fixed_description">{{ $support->fixed_description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" class="form-control custom-select" name="status">
                                    <option disabled>Select one</option>
                                    @if ($support->status === "fixed")
                                        <option value="fixed" selected>Fixed</option>
                                        <option value="pending">Pending</option>
                                    @elseif($support->status === "pending")
                                        <option value="fixed">Fixed</option>
                                        <option value="pending" selected>Pending</option>
                                    @endif
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{ route('tech-supports.index') }}" class="btn btn-secondary">Cancel</a>
                                    <input type="submit" value="Save Changes" class="btn btn-success float-right">
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

@section('scripts')
@endsection
