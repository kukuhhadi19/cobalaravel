<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="{{ asset('/css/bootstrap-5.1.3-dist/css/bootstrap.css') }}">
    <script src="{{ asset('/css/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/jquery-3.6.0.min.js') }}"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function lihatpustaka() {
            $.ajax({
                type: "GET",
                url: "/tabel"
            }).done(function(data) {
                $('#tabel').html(data);
            });
        }

        function caripustaka() {
            var idbuku = document.getElementById("idbuku").value;
            $.ajax({
                type: "GET",
                url: "/cari/" + idbuku
            }).done(function(data) {
                $('#tabel').html(data);
                alert("Data ditemukan!");
            });
        }
    </script>
    <title>Document</title>
</head>

<body onload="lihatpustaka();">

    <h1 class="container-fluid p-5 bg-dark text-white" style="text-align:center">Perpustakaan Madani <h1>
            <div class="row">
                <h2 class="col-11">Welcome {{session()->get('username')}}</h2>
                <a href="/logout" class="col-1"><button type="button" class="btn btn-warning btn">Log Out</button></a>
            </div>
            <h3>Data Perpustakaan</h3>



            <br />
            <label for="idbuku">Masukkan id buku yang ingin dicari</label>
            <table>
                <tr>
                    <td><input type="text" id="idbuku" class="form-control form-control" style="width: 300px;"></td>
                    <td><button type="submit" id="cari" class="btn btn-success btn" style="width:100px;" onclick="caripustaka();">Search</button></td>
                    <td><button type="submit" id="lihat" class="btn btn-danger btn" style="width:125px;" onclick="lihatpustaka();">Lihat Semua</button></td>
                </tr>
            </table>
            <br />

            @if (session()->get('status')=='admin')
            <button type="button" id="isi" class="btn btn-info btn" data-bs-toggle="modal" data-bs-target="#ModalInsert">Pendaftaran Buku Baru</button>
            @endif

            <p></p>
            <div id="tabel">

            </div>

            <div class="modal" id="ModalInsert">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <form action="/tambah" method="POST" enctype="multipart/form-data" id="formdata">
                            {{ csrf_field() }}


                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Pendaftaran Buku Baru</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">

                                <table>
                                    <tr>
                                        <td>Id Buku :</td>
                                        <td><input type="text" id="idbuku" name="idbuku" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>Judul :</td>
                                        <td><input type="text" id="NamaBuku" name="NamaBuku" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Pengarang :</td>
                                        <td><input type="text" id="NamaPengarang" name="NamaPengarang" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>Qty :</td>
                                        <td><input type="number" id="qty" name="qty" min="1" max="100" class="form-control"></td>
                                    </tr>


                                    <tr>
                                        <td>Jenis Buku :</td>
                                        <td>
                                            <select name="Kategori" id="Kategori" style="width: 200px;" class="form-select form-select-lg">
                                                <option value="Keislaman">Keislaman</option>
                                                <option value="Fiksi">Fiksi</option>
                                                <option value="Saintek">Saintek</option>

                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Upload Cover</td>
                                        <td><input type="file" name="file"></td>
                                    </tr>


                                </table>


                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-danger" value="submit" id="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>


</body>


</html>