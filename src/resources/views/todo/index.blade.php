@extends('common.layout')

@section('title')
一覧表示
@endsection

@section('main')
<a href="/todo/create">新規作成</a>
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
        @if(!empty($todos))
        @foreach($todos as $todo)
        <tr>
            <!-- $マーク -->
            <!-- "->"でattributeにアクセスできる -->
            <td>{{ $todo->title }}</td>
            <td>{{ $todo->content }}</td>
            <td>{{ $todo->created_at }}</td>
            <td>{{ $todo->updated_at }}</td>
            <td><a href="/todo/{{ $todo->id }}">更新</a></td>
            <td>
                <!-- methodはPOSTかGETのみ -->
                <form method="POST" action="/todo/{{ $todo->id }}">
                    @csrf()
                    <!-- csrfトークン -->
                    @method('DELETE')
                    <!-- deleteメソッドの場合これが必要 -->
                    <input type="submit" value="削除">
                </form>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
@endsection
