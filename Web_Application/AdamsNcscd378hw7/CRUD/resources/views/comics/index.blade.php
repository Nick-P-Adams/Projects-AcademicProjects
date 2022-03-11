@extends('comics.layout')
@section('content')
        <center>
            <span style="font-family:Impact"><div class="hero hero-sm bg-primary">
                <h1>Comics Index</h1>
            </div>
                <div style="font-family:helvetica">
                    <a class="btn btn-primary btn-lg btn-success" href="{{route('comics.create')}}">New Comic</a>
                </div><br>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <span>{{ $message }}</span>
                    </div>
                @endif
            </span>

            <span style="font-family:helvetica">
            <table class="table table-striped table-hover">
                <thead>
                    <tr ALIGN="CENTER">
                        <th>@sortablelink('title', 'Title')</th>
                        <th>@sortablelink('volume', 'Volume')</th>
                        <th>@sortablelink('volume_id', 'Volume ID')</th>
                        <th>@sortablelink('issue_num', 'Issue Number')</th>
                        <th>@sortablelink('pub_date', 'Publish Date')</th>
                        <th>@sortablelink('condition', 'Condition')</th>
                        <th>@sortablelink('writer_name', 'Writer')</th>
                        <th>@sortablelink('artist_name', 'Artist')</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                @foreach ($comics as $comic)
                <tbody>
                    <tr ALIGN="CENTER">
                        <td>{{$comic->title}}</td>
                        <td>{{$comic->volume}}</td>
                        <td>{{$comic->volume_id}}</td>
                        <td>{{$comic->issue_num}}</td>
                        <td>{{$comic->pub_date}}</td>
                        <td>{{$comic->condition}}</td>
                        <td>{{$comic->writer_name}}</td>
                        <td>{{$comic->artist_name}}</td>
                        <td><div class="btn-group btn-group-block"><form action="{{route('comics.destroy',$comic->id)}}" method="POST">
                            <a class="btn btn-primary" href="{{route('comics.show',$comic->id)}}">Show</a>
                            <a class="btn btn-primary" href="{{route('comics.edit',$comic->id)}}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Do you really want to delete the comic?')" class="btn btn-error">Delete</button>
                            </form></div>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
            <div  style="width:25%;">
                {!! $comics->appends(Request::except('page'))->render('vendor.pagination.default') !!}
            </div>
            </span>
        </center>
@endsection
