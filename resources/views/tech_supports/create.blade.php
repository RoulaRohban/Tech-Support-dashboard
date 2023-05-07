<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>APPA | Tech Support</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- include the BotDetect layout stylesheet -->
    <link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        .main-section{
            margin:0 auto;
            padding: 20px;
            margin-top: 100px;
            background-color: #fff;
            box-shadow: 0px 0px 20px #c1c1c1;
        }
        .fileinput-remove,
        .fileinput-upload{
            display: none;
        }
    </style>
</head>
<body class="container">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('customers.logout') }}" role="button">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin: 0 !important;">
        <!-- Main content -->
        <section class="content">
            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    {{ session()->get('message') }}
                </div>
        @endif
        <!-- Default box -->
            <div class="card">
                <div class="card card-lightblue">
                    <div class="card-header">
                        <h3 class="card-title">Tech Support Form</h3>
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="text-center">
                                <img class="center" style="width: 200px; border: 0px;"
                                     src="{{ asset('dist/img/appa.png') }}"
                                     alt="User profile picture">
                            </div>
                        </div>
                        <form action="{{ route('tech-supports.store') }}" method="POST" class="row g-3"
                              accept-charset="utf-8" enctype="multipart/form-data">
                            @csrf
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select name="category_id" id="category_id" class="form-control"
                                            aria-label="Default select example">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <span class="help-block">
                                        <strong style="color: red">{{ $errors->first('category_id') }}</strong></span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="title" class="form-label">Title</label>
                                    <input name="title" type="text" class="form-control" id="title"
                                           value="{{ old('title') }}">
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong style="color: red">{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" id="description"
                                              rows="3">{{ old('description') }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong style="color: red">{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! captcha_image_html('ContactCaptcha') !!}
                                </div>
                                <div class="form-group">
                                    <label for="CaptchaCode" class="form-label">Retype the characters from the
                                        picture</label>
                                    <input class="form-control" type="text" id="CaptchaCode" name="CaptchaCode">
                                    @if ($errors->has('CaptchaCode'))
                                        <span class="help-block">
                                        <strong style="color: red">{{ $errors->first('CaptchaCode') }}</strong></span>
                                    @endif
                                </div>

                                <div class="custom-file">
                                    <input id="ap_form_post_image1" type="file" name="images[]" multiple class="file" data-overwrite-initial="false">
                                    @if ($errors->has('images'))
                                        <span class="help-block">
                                        <strong style="color: red">{{ $errors->first('images') }}</strong></span>
                                    @endif
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <a href="javascript:void(0)" onclick="$('#ap_form_post_image1').click()"><i class="fa fa-plus"></i></a>--}}
{{--                                    <input type="file" id="ap_form_post_image1" name="images[]" style="display: none;" class="form-control" multiple>--}}
{{--                                </div>--}}
                                <br><br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>

<script>
    function FileListItems (files) {
        var b = new ClipboardEvent("").clipboardData || new DataTransfer()
        for (var i = 0, len = files.length; i<len; i++) b.items.add(files[i])
        return b.files
    }

    var queue = [] ;
    function previewImages() {
        let $preview = $('#preview').empty();
        queue.push(...this.files);
        let queuedFiles = new FileListItems(queue);
        $('#ap_form_post_image1').prop("files",queuedFiles);
        if (this.files) $.each(queuedFiles, readAndPreview);

        function readAndPreview(i, file) {

            if (!/\.(jpe?g|png|gif)$/i.test(file.name)){
                return alert(file.name +" is not an image");
            } // else...

            var reader = new FileReader();

            $(reader).on("load", function() {
                $preview.append($("<img />", {src:this.result, height:62}));
            });

            reader.readAsDataURL(file);


        }

    }


    $('#ap_form_post_image1').on("change", previewImages);

</script>


<script type="text/javascript">
    $("#ap_form_post_image1").fileinput({
        theme: 'fa',
        showRemove: true,
        allowedFileExtensions: ['jpg', 'png', 'gif'],
        overwriteInitial: false,
        maxFileSize:2000,
        maxFilesNum: 10,
        //showBrowse: false,
        browseOnZoneClick:true,
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
    });
</script>
</body>
</html>
