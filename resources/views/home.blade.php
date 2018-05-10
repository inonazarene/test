@extends('layouts.app')

@section('style')
    <style type="text/css">
        ul > li {
            margin-top: 8%;
        }
    </style>
@section('content')
    <div class="container">
    @if(Auth::check())
        {{--<div class="row">--}}
                {{--<div class="col-md-12">--}}
                    {{--<div class="panel panel-default">--}}
                        {{--<div class="panel-heading"> Upload Photo</div>--}}

                        {{--<div class="panel-body">--}}
                            {{--@if (session('success'))--}}
                                {{--<div class="alert alert-success">--}}
                                    {{--{{ session('status') }}--}}
                                {{--</div>--}}
                            {{--@endif--}}

                            {{--<form action="{{route('photo.upload')}}" method="post" enctype="multipart/form-data" class="dropzone">--}}
                                {{--{{csrf_field()}}--}}
                                {{--<div class="fallback">--}}
                                    {{--<input name="file" type="file" multiple />--}}
                                {{--</div>--}}
                               {{--  <div class="form-group">--}}
                                    {{--<label for="">Image</label>--}}
                                    {{--<input type="file" name="file" class="form-control">--}}
                                {{--</div>--}}
                                {{--<button type="submit" class="btn  btn-success">Upload</button> --}}
                            {{--</form>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
        {{--</div>--}}
    @endif
        <section class="row">
            <div class="col-md-12">
               <section class="panel panel-default">
                   <ul class="list-unstyled" id="photo-list"></ul>
               </section>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script>

        $(function () {
            load_photo(0);
            var $win = $(window);

            $(window).on("scroll", function() {
                var scrollHeight = $(document).height();
                var scrollPosition = $(window).height() + $(window).scrollTop();
                if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
                    // when scroll to bottom of the page

                    console.log('asdasdsd');
                }
            });

            // $(window).scroll(function () {
            //     if ($(window).scrollTop() == 0)
            //         console.log('Scrolled to Page Top');
            //     else if ($(window).height() + $(window).scrollTop() == $(document).height()) {
            //         alert('Scrolled to Page Bottom');
            //     }
            // });
        });


        function load_photo(skip) {
            $('ul#photo-list').html('');
            $.ajax({
                url:'{{route('photo.show')}}',
                data: {skip: skip},
                dataType:'json',
                success:function (data) {

                        $.each(data, function (index, data) {
                            if (data != null) {
                                $('ul#photo-list').append(
                                    '<li style="display:inline-block" class="col-md-4"><img class="img-responsive img-thumbnail" src="' + '{{asset('storage')}}' + '/' + data.filename + '"></li>'
                                );
                            }
                        });

                }
            });
        }
    </script>
@endsection
