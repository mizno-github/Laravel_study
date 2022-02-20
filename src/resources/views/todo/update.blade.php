@extends('common.layout')

@section('title')
更新
@endsection

@section('main')

<form method="POST" action="/todo/{{ $todo->id }}">
    @csrf()
    @method('PUT')
    <table>
        <thead>
            <tr>
                <th>title</th>
                <th>content</ht>
                <th>create</ht>
                <th>update</ht>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" name="title" value="{{ $todo->title }}"></td>
                <td><input type="text" name="content" value="{{ $todo->content }}"></td>
                <td>{{ $todo->created_at }}</td>
                <td>{{ $todo->updated_at }}</td>
                <td><input type="submit" value="送信"></td>
            </tr>
        </tbody>
    </table>
</form>
@endsection
