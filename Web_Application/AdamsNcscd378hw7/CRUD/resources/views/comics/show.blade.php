@extends('comics.layout')
@section('content')
<div class="card hero hero-sm bg-primary" align="center">
    <span style="font-family:impact">
    <div class="card-header">
        <div class="card-title h5">{{$comic->title}}</div>
        <div class="card-subtitle text-gray">{{$comic->volume}}</div>
    </div>
    </span>

    <div class="card-image">
        <img src="{{$comic->image_URL}}" class="img-responsive" width="600" height="800">
    </div>
    <span style="font-family:helvetica">
    <div class="card-body">
        <div class="form-group">
            <Strong>Comic Title</Strong>
            <br>{{$comic->title}}
        </div>
        <div class="form-group">
            <Strong>Volume</Strong>
            <br>{{$comic->volume}}
        </div>
        <div class="form-group">
            <Strong>Volume ID</Strong>
            <br>{{$comic->volume_id}}
        </div>
        <div class="form-group">
            <Strong>Issue Number</Strong>
            <br>{{$comic->issue_num}}
        </div>
        <div class="form-group">
            <Strong>Published</Strong>
            <br>{{$comic->pub_date}}
        </div>
        <div class="form-group">
            <Strong>Condition</Strong>
            <br>{{$comic->condition}}
        </div>
        <div class="form-group">
            <Strong>Writers Name</Strong>
            <br>{{$comic->writer_name}}
        </div>
        <div class="form-group">
            <Strong>Artists Name</Strong>
            <br>{{$comic->artist_name}}
        </div>
        <div class="form-group" style="width:50%;">
            <Strong>Description</Strong>
            <br>{{$comic->description}}
        </div>
    </div>

    <div class="card-footer">
        <div>
            <form action="{{route('comics.destroy',$comic->id)}}" method="POST">
                <a class="btn" href="{{route('comics.index')}}">Back</a>
                <a class="btn" href="{{route('comics.edit',$comic->id)}}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Do you really want to delete the comic?')" class="btn btn-error">Delete</button>
            </form>
        </div>
    </div>
    </span>
</div>
@endsection
