<?php
require './config.php';

if(!(isset($_SESSION["logged"]) && $_SESSION["logged"] == true)) {
    header("Location: ./index.php");
    exit();
}

if(isset($_POST["title"]) && isset($_POST["content"])) {
    $title = mysqli_escape_string($conn, $_POST["title"]);
    $content = mysqli_escape_string($conn, $_POST["content"]);

    if(strlen($title) > 5 && strlen($content) > 10) {
        $sql = "INSERT INTO `comics`(`title`, `content`) VALUES('".$title."', '".$content."')";
        $result = $conn->query($sql);
        if($result === TRUE) {
            header("Location: ./index.php");
            die();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm truyện</title>
    <link rel="shortcut icon" type="image/png" href="./logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <?php
    include_once './header.php';
    ?>

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="text-center w-100">Thêm Truyện</h4>
                    </div>
                    <div class="card-body">
                    <form method="POST" action="./add.php">
                        <div class="form-group">
                            <label for="title">Tiêu đề truyện</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title">
                        </div>
                        <div class="form-group">
                            <label for="content">Nội dung truyện</label>
                            <textarea class="form-control" id="content" name="content" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </form>
                    </div>
                    <div class="card-footer text-muted text-center">
                        Đề tài Amazon Polly © HCMUTE 2022
                    </div>
                </div>
            </div>
        </div>  
    </div>
</body>
</html>