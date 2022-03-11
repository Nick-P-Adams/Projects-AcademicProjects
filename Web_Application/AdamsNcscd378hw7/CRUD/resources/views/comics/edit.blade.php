@extends('comics.layout')
@section('content')
    <span style="font-family:Impact">
        <div class="hero hero-sm bg-primary" align="center">
            <h1>Updated Comic</h1>
        </div>

    @if ($errors->any())
        <div class="alert alert-danger" align="center">
            <strong>Error! </strong>Input invalid<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    </span>

    <span style="font-family:helvetica">
        <form action="{{route('comics.update',$comic->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row" align="center">
                <div style="width:25%;">
                    <div class="form-group">
                        <Strong class="form-label" align="left">Comic Title:</Strong>
                        <input class="form-input" type="text" name="title" value="{{$comic->title}}" placeholder="Comic Title">
                    </div>
                </div>
                <div style="width:25%;">
                    <div class="form-group">
                        <Strong class="form-label" align="left">Volume Title:</Strong>
                        <input class="form-input" type="text" name="volume" value="{{$comic->volume}}" placeholder="Volume Title">
                    </div>
                </div>
                <div style="width:25%;">
                    <div class="form-group">
                        <Strong class="form-label" align="left">Volume ID:</Strong>
                        <input class="form-input" type="number" name="volume_id" value="{{$comic->volume_id}}" placeholder="Volume ID">
                    </div>
                </div>
                <div style="width:25%;">
                    <div class="form-group">
                        <Strong class="form-label" align="left">Issue Number:</Strong>
                        <input class="form-input" type="number" name="issue_num" value="{{$comic->issue_num}}" placeholder="Issue Number">
                    </div>
                </div>
                <div style="width:25%;">
                    <div class="form-group">
                        <Strong class="form-label" align="left">Published Date:</Strong>
                        <input class="form-input" type="date" name="pub_date" min="1837-01-01" value="{{$comic->pub_date}}" placeholder="Published Date">
                    </div>
                </div>
                <div style="width:25%;">
                    <div class="form-group">
                        <Strong class="form-label" align="left">Condition:</Strong>
                        <select class="form-select" name="condition" value="{{$comic->condition}}" placeholder="Choose condition">
                            <option>MT</option>
                            <option>NM</option>
                            <option>VF</option>
                            <option>FN</option>
                            <option>VG</option>
                            <option>GD</option>
                            <option>FA</option>
                            <option>PO</option>
                        </select>
                    </div>
                </div>
                <div style="width:25%;">
                    <div class="form-group">
                        <Strong class="form-label" align="left">Writer's Name:</Strong>
                        <input class="form-input" type="text" name="writer_name" value="{{$comic->writer_name}}" placeholder="Writer's Name">
                    </div>
                </div>
                <div style="width:25%;">
                    <div class="form-group">
                        <Strong class="form-label" align="left">Artist's Name:</Strong>
                        <input class="form-input" type="text" name="artist_name" value="{{$comic->artist_name}}" placeholder="Artist's Name">
                    </div>
                </div>
                <div class="form-group" style="width:25%;">
                    <Strong class="form-label" align="left">Description</Strong>
                    <textarea class="form-input" name="description" placeholder="This is a description..." rows="4">{{$comic->description}}</textarea>
                </div>
                <div style="width:25%;">
                    <div class="form-group">
                        <Strong class="form-label" align="left">Image URL:</Strong>
                        <input class="form-input" type="URL" name="image_URL" value="{{$comic->image_URL}}" placeholder="Paste URL to image you would like to use. (Include http:// or https://)">
                    </div>
                </div>
                <div align="center" style="padding-bottom:10px; padding-top:10px;">
                    <a class="btn btn-primary" href="{{route('comics.index')}}">Back</a>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
        </div>
        </form>
    </span>
@endsection

