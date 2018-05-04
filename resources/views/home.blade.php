@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"> Upload Photo</div>

                <div class="panel-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                        <form action="{{route('upload')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="">Image</label>
                                <input type="file" name="file" class="form-control">
                            </div>
                            <button type="submit" class="btn  btn-success">Upload</button>

                        </form>

                </div>
            </div>
        </div>
        <div class="col-md-8"></div>
    </div>
</div>
@endsection
