<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('comments.store', ['postId' => $post->id]) }}" method="POST">
        @csrf
        <textarea name="content" cols="30" rows="10"></textarea>
        <button type="submit">Yorum Ekle</button>
    </form>
</body>
</html>
