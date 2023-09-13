<?php
namespace view;

use database\model\Movie;
use database\model\Genre;
use database\model\Actor;
use mysql_xdevapi\Exception;

require_once("./database/model/Movie.php");
require_once("./database/model/Genre.php");
require_once("./database/model/Actor.php");

$movie = new Movie();
$genre = new Genre();
$actor = new Actor();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST != null) {
    try {
        $idMovie = $movie->addItem($_POST['title'], $_POST['releasedate'], $_POST['rating'], $_POST['synopsis'], $_POST['serial']);
        $movie->addActor($idMovie, $_POST['listOfActor'], $_POST['listOfRole']);
        $movie->addGenre($idMovie, $_POST['listOfGenre']);
    } catch (Exception $_e) {
        echo $_e->getMessage();
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="styles/css/main.css">
    <title>Home</title>
</head>
<body>
<div class="container">
    <table class="table-list">
        <thead>
        <tr>
            <th>Judul</th>
            <th>Tanggal Rilis</th>
            <th>Rating</th>
            <th>Sinopsis</th>
            <th>Serial</th>
            <th>Genre</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Test</td>
            <td>Test</td>
            <td>Test</td>
            <td>Test</td>
            <td>Test</td>
            <td>Test</td>
        </tr>
        </tbody>
    </table>
</div>
<div class="container">
    <div class=" form-width form-frame">
        <h3 class="form-title">Add Data</h3>
        <form method="post" action="index.php" id="movie_form">
            <table>
                <tr>
                    <td>
                        <label>Enter Title</label>
                        <input class="form-input" name="title" type="text">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Genre</label>
                        <?php foreach ($genre->getAll() as $item) {
                            echo "<input type=\"checkbox\" name=\"listOfGenre[]\" value=" . $item['id'] . ">" . $item['name'] . "</br>";
                        } ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Actor</label>
                        <select name="actor" id="actor">
                            <?php foreach ($actor->getAll() as $item) {
                                echo "<option value=" . $item['id'] . ">" . $item['name'] . "</option>";
                            } ?>
                        </select>
                    </td>
                    <td style="width: 35%">
                        <label>Role</label>
                        <select name="role" id="role">
                            <option value="utama">Utama</option>
                            <option value="pembantu">Pembantu</option>
                            <option value="cameo">Cameo</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button id="btn_add_actor" inputmode="" class="button-submit">
                            Add actor
                        </button>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table>
                            <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="selectedActor">

                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Enter Rating</label>
                        <select name="rating" id="rating">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Is it Serial ?</label>
                        <select name="serial" id="serial">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Enter Release Date</label>
                        <input class="form-input form-input-content" name="releasedate" type="date">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Enter Synopsis</label>
                        <textarea rows="4" cols="50" name="synopsis" class="form-input form-input-longtext"></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center">
                        <input type="submit" class="button-submit" id="btn_submit" value="Submit">
                    </td>
                </tr>
            </table>
        </form>
    </div>

</div>
</body>
<script>
    $("#btn_add_actor").click(function (e) {
        e.preventDefault();
        console.log("clicked")
        const nama = $("#actor").find(":selected").text();
        const idNama = $("#actor").find(":selected").val();
        const role = $("#role").find(":selected").text();
        const idRole = $("#role").find(":selected").text();
        $("#selectedActor").append(
            "<tr>" +
            "<td>" + nama + "</td>" +
            "<td>" + role + "</td>" +
            "<input type='hidden' name='listOfActor[]' value='" + idNama + "'>" +
            "<input type='hidden' name='listOfRole[]' value='" + idRole + "'>" +
            "<td><button class=\"btn_delete\">delete</button></td>" +
            "</tr>"
        );
    });

    $(document).on("click", '.btn_delete', function () {
        console.log("clicked")
        $(this).closest('tr').remove();
    });

    $(document).on("click", '#btn_submit', function (e) {
        e.preventDefault();
        console.log('clicked');
        const actionurl = "index.php";
        var data = $("#movie_form").serialize();
        console.log(data);
        //do your own request and handle the results
        $.ajax({
            url: actionurl,
            type: 'post',
            dataType: 'application/json',
            data: data,
            success: function (data) {
                alert(data['title'] + "successfully added to database")
            },
            error: function (e){
                console.log(e);
            },
            then:function (e){
                console.log(e)
            }
        })
    });
</script>
</html>
