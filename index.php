<?php
namespace view;

use database\model\Movie;

require_once("./database/model/Movie.php");

$movie = new Movie();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
        <form>
            <table>
                <tr>
                    <td>
                        <label>Enter Title</label>
                        <input class="form-input" type="text">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Genre</label>
                        <select name="genre" id="genre" form="genre">
                            <option value="Action">Action</option>
                            <option value="Horror">Horror</option>
                            <option value="Drama">Drama</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Enter Rating</label>
                        <input class="form-input" type="text">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Is it Serial ?</label>
                        <input class="form-input form-input-content" type="text">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Enter Release Date</label>
                        <input class="form-input form-input-content" type="date">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Enter Synopsis</label>
                        <textarea rows="4" cols="50" class="form-input form-input-longtext"></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center">
                        <input type="submit" class="button-submit" style="width: 100%" value="Submit">
                    </td>
                </tr>
            </table>
        </form>
    </div>

</div>
</body>
</html>
