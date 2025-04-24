<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>

<body>
    <table border="1" class="table table-hover">
        <tr>
            <th>idbuku</th>
            <th>NamaBuku</th>
            <th>NamaPengarang</th>
            <th>Kategori</th>
            <th>Qty</th>
            <th>Cover</th>
            @if (session()->get('status')=='admin')
            <th>Action</th>
            @endif
        </tr>
        @foreach($books as $b)
        <tr>
            <td>{{ $b->idbuku}}</td>
            <td>{{ $b->NamaBuku}}</td>
            <td>{{ $b->NamaPengarang}}</td>
            <td>{{ $b->Kategori}}</td>
            <td>{{ $b->qty}}</td>
            <td><img src="{{ Storage::url($b->Image)}}" width="150" height="200" alt=""></td>
            <td>
                @if (session()->get('status')=='admin')
            <td><a href="/show/{{$b->idbuku}}"><button type="button" class="btn btn-success btn">Edit</button></a></td>
            <td><a href="/hapus/{{$b->idbuku}}"><button type="button" class="btn btn-danger btn">Hapus</button></a>
                @endif
            </td>
            </td>
        </tr>
        @endforeach
    </table>
</body>

</html>