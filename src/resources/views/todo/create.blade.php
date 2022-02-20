@extends('common.layout')

@section('title')
新規作成
@endsection

@section('main')

<form method="POST" action="/todo/create">
    @csrf()
    <table>
        <thead>
            <tr>
                <th>title</th>
                <th>content</ht>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" name="title"></td>
                <td><input type="text" name="content"></td>
                <td><input type="submit" value="送信"></td>
            </tr>
        </tbody>
    </table>
</form>
@endsection
