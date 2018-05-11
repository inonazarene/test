@extends('layouts.app')

@section('style')
    <style type="text/css">
        ul > li {
            margin-top: 5%;
        }
        button{
            margin-left: 2%;
        }
    </style>
@endsection

@section('content')
    <section class="container">
        @if(Auth::check())
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> Upload Photo</div>

                        <div class="panel-body" id="upload-body">
                            <form id="image-upload" action="{{route('photo.upload')}}" method="post" enctype="multipart/form-data" class="dropzone">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{--<label for="">Image</label>--}}
                                    {{--<input type="file" name="file[]" class="form-control" multiple>--}}
                                    {{--<button type="submit" class="btn  btn-success">Upload</button>--}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <section class="panel pane-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Photo Gallery</h4>
                    </div>
                    <div class="panel-body">
                        <ul class="list-unstyled" id="photo-list"></ul>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection

@section('script')
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone-amd-module.min.js"></script>--}}
    <script>

        $(function () {

            Dropzone.autoDiscover = false;
            var skip = 0;
            load_photo(skip);
            tag();

            var dropzone = $('form#image-upload').dropzone({
                url: $('form#image-upload').attr('action'),
                method: $('form#image-upload').attr('method'),
                maxFilesize: 2, // MB
                acceptedFiles: 'image/*',
            });

            dropzone.on('complete', function (file) {
                dropzone.removeAllFiles();
                load_photo(skip);
            });

            dropzone.on('success', function (file, message) {
                $('div.alert').fadeIn();
                $('div#upload-body').append('<div class="alert alert-success"><h1>' + message.success + '<h1/><div/>');
            });

            setTimeout(function () {
                $('div.alert').fadeOut();
            }, 3000);

            $(window).scroll(function () {
                if ($(window).scrollTop() == $(document).height() - $(window).height()) {
                // if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {

                    load_photo(skip += 10);
                }
            });
        });

        function tag() {

            $(document).on('click', 'li.img', function () {

            });
        }

        function load_photo(skip) {
            $.ajax({
                url: '{{route('photo.show')}}',
                data: {skip: skip},
                dataType: 'json',

                success: function (data) {

                    $.each(data, function (index, data) {

                        if (data != null) {
                            var file = '{{asset('storage/')}}' + data.filename;

                            var html = '<li class="col-xs-12 col-sm-6 col-md-4 img style="display: inline-block">';
                            html += '<div class="thumbnail">';
                            html += '<img class="img-responsive img-thumbnail" src="' + file + '">';
                            html += '<div class="caption">';
                            html += '<form class="form-inline" method="post" action="{{route('tag.store')}}">';
                            html += '{{csrf_field()}}';
                            html += '<input type="hidden" name="photo_id" value="'+data.photo_id+'">';
                            html += '<div class="form-group">';
                            html += '<input class="form-control" name="tag" autocomplete="off" placeholder="enter tags" data-role="tagsinput">';
                            html += '</div>';
                            html += '<button type="submit" class="btn btn-success btn-sm"> submit</button>';
                            html += '</form>';
                            html += '<p style="margin-top: 2%;">';

                            html += '<span class="glyphicon glyphicon-tags"></span> tags :';
                            $.each(data.tags, function (index, tag) {
                                html += '<span class="badge" style="margin-right: 2%">'+tag.tag+'</span>';
                            });
                            html += '</p>';
                            html += '</div>';
                            html += '</div>';
                            html += '</li>';

                            $('ul#photo-list').append(html);
                        }
                    });
                }

            });
        }


    </script>
@endsection