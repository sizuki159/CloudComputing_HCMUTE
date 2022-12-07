<?php
require './config.php';

$comicInfo = null;

$sql = "SELECT * FROM `comics`";
if(isset($_GET["id"]) && is_numeric($_GET["id"])) {
  $sqlInfo = "SELECT * FROM `comics` WHERE `id` = " . $_GET["id"];
  $result = $conn->query($sqlInfo);
  if ($result->num_rows == 1) {
    $comicInfo = $result->fetch_assoc();
  }
}

$result = $conn->query($sql);

$xhtmlMenu = "";
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $classActive = "";
    if($comicInfo && $row["id"] == $comicInfo["id"]) {
      $classActive = "active";
    }
    $xhtmlMenu .= '<a href="?id='. $row["id"] .'" class="list-group-item list-group-item-action '.$classActive.'" aria-current="true">';
    $xhtmlMenu .= $row["title"];
    $xhtmlMenu .= '</a>';
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazon Polly</title>
    <link rel="shortcut icon" type="image/png" href="./logo.png" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
        <a class="navbar-brand" href="./index.php">
            <i class="fa fa-home fa-2x" aria-hidden="true"></i>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="./index.php">Home <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div>
    </nav>

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <h4 class="card-header">
                      Danh sách truyện
                    </h4>

                    <div class="list-group list-group-flush">
                      <?php
                        echo $xhtmlMenu;
                      ?>
                    </div>
                    
                  </div>
            </div>
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 id="title-content">
                          <?php
                            if($comicInfo != null) echo $comicInfo["title"];
                            else echo "Hãy chọn truyện cần đọc";
                          ?>
                        </h4>
                        <div>
                          <button class="ml-1" style="border: none;" onclick="convertTextToAudio('Joanna')">
                            <i class="fa fa-volume-up" aria-hidden="true"></i>
                          </button>
                          <!-- Example single danger button -->
                          <div class="btn-group ml-5">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                              Translate
                            </button>

                            <div class="dropdown-menu">
                              <a class="dropdown-item" value="ar" onclick="return translateContent('ar');">Arabic (arb)</a>
                              <a class="dropdown-item" value="ca" onclick="return translateContent('ca');">Catalan (ca-ES)</a>
                              <a class="dropdown-item" value="zh" onclick="return translateContent('zh');">Chinese, Mandarin (cmn-CN)</a>
                              <a class="dropdown-item" value="da" onclick="return translateContent('da');">Danish (da-DK)</a>
                              <a class="dropdown-item" value="nl" onclick="return translateContent('nl');">Dutch (nl-NL)</a>
                              <a class="dropdown-item" value="en" onclick="return translateContent('en');">English (US) (en-US)</a>
                              <a class="dropdown-item" value="fr" onclick="return translateContent('fr');">French (fr-FR)</a>
                              <a class="dropdown-item" value="de" onclick="return translateContent('de');">German (de-DE)</a>
                              <a class="dropdown-item" value="hi" onclick="return translateContent('hi');">Hindi (hi-IN)</a>
                              <a class="dropdown-item" value="is" onclick="return translateContent('is');">Icelandic (is-IS)</a>
                              <a class="dropdown-item" value="it" onclick="return translateContent('it');">Italian (it-IT)</a>
                              <a class="dropdown-item" value="ja" onclick="return translateContent('ja');">Japanese (ja-JP)</a>
                              <a class="dropdown-item" value="ko" onclick="return translateContent('ko');">Korean (ko-KR)</a>
                              <a class="dropdown-item" value="no" onclick="return translateContent('no');">Norwegian (nb-NO)</a>
                              <a class="dropdown-item" value="pl" onclick="return translateContent('pl');">Polish (pl-PL)</a>
                              <a class="dropdown-item" value="pt" onclick="return translateContent('pt');">Portuguese (European) (pt-PT)</a>
                              <a class="dropdown-item" value="ro" onclick="return translateContent('ro');">Romanian (ro-RO)</a>
                              <a class="dropdown-item" value="ru" onclick="return translateContent('ru');">Russian (ru-RU)</a>
                              <a class="dropdown-item" value="es" onclick="return translateContent('es');">Spanish (European) (es-ES)</a>
                              <a class="dropdown-item" value="sv" onclick="return translateContent('sv');">Swedish (sv-SE)</a>
                              <a class="dropdown-item" value="tr" onclick="return translateContent('tr');">Turkish (tr-TR)</a>
                              <a class="dropdown-item" value="cy" onclick="return translateContent('cy');">Welsh (cy-GB)</a>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text" id="main-content">
                        <?php
                          if($comicInfo != null) echo $comicInfo["content"];
                        ?>
                        </p>

                        <div class="polly" style="text-align: center;">
                          <audio controls class="audioPolly" id="audioPlayback">
                            <source id="audioSource" src="" type="audio/mp3">
                            Your browser does not support the audio element.
                          </audio>
                      </div>
                    </div>
                    <div class="card-footer text-muted text-center">
                        Đề tài Amazon Polly © HCMUTE 2022
                    </div>
                </div>
            </div>
        </div>  
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

    <script src="https://sdk.amazonaws.com/js/aws-sdk-2.1135.0.min.js"></script>

    <script src="./scripts/aws.js"></script>
</body>


</html>



<?php
mysqli_close($conn);
?>