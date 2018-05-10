@extends('layouts.app')

@section('style')
    <style type="text/css">
        ul > li {
            margin-top: 8%;
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

                        <div class="panel-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{route('photo.upload')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{--<div class="fallback">--}}
                                    {{--<input name="file" type="file" multiple/>--}}
                                {{--</div>--}}
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <input type="file" name="file" class="form-control">
                                </div>
                                <button type="submit" class="btn  btn-success">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <ul class="list-unstyled" id="photo-list"></ul>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script !src="">

        $(function () {
            var skip = 0;
            load_photo(skip);
            // setInterval(function(){  load_photo(skip); }, 3000);


            $(window).scroll(function () {
                if ($(window).scrollTop() == $(document).height() - $(window).height()) {

                    load_photo(skip += 2);
                }
            });
        });

        function load_photo(skip) {
            $.ajax({
                url: '{{route('photo.show')}}',
                data: {skip: skip, _token: '{{csrf_token()}}'},
                dataType: 'json',
                success: function (data) {
                    $.each(data, function (index, data) {
                        if (data != null) {
                            $('ul#photo-list').append('<li style="display:inline-block" class="col-md-4"><img class="img-responsive img-thumbnail" src="' + '{{asset('storage')}}' + '/' + data.filename + '"></li>');
                        }
                    });
                }

            });
        }


    </script>
@endsection