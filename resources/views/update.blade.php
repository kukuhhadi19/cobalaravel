<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="{{ asset('/css/bootstrap-5.1.3-dist/css/bootstrap.css') }}"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <div class="row">
        <h2 class="col-11">Welcome {{session()->get('username')}}</h2>
        <a href="/logout" class="col-1"><button type="button" class="btn btn-warning btn">Log Out</button></a>
    </div>

    <form action="/edit" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <table>
            <tr>
                @foreach($books as $a)
                <td>Id Buku :{{$a->idbuku}} </td>
                <td><input type="hidden" name="idbuku" value="{{$a->idbuku}}"></td>

            </tr>
            <tr>
                <td>Judul :</td>
                <td><input type="text" id="NamaBuku" name="NamaBuku" class="form-control" value="{{$a->NamaBuku}}"></td>
            </tr>
            <tr>
                <td>Nama Pengarang :</td>
                <td><input type="text" id="NamaPengarang" name="NamaPengarang" class="form-control" value="{{$a->NamaPengarang}}"></td>
            </tr>
            <tr>
                <td>Qty :</td>
                <td><input type="number" id="qty" name="qty" min="1" max="100" class="form-control" value="{{$a->qty}}"></td>
            </tr>


            <tr>
                <td>Jenis Buku :</td>
                <td>
                    <select name=" Kategori" id="Kategori" style="width: 200px;" class="form-select form-select-lg" value="{{$a->Kategori}}">
                        <option value="Keislaman">Keislaman</option>
                        <option value="Fiksi">Fiksi</option>
                        <option value="Saintek">Saintek</option>

                    </select>
                </td>
            </tr>


        </table>

        <image src="{{ Storage::url($a->Image) }} " width="150" height="200">

            </br>


            <input type="submit" class="btn btn-danger" value="Edit">

    </form>
    @endforeach
</body>

</html>