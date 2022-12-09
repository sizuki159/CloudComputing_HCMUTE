<!-- Header -->
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

        <div class="nav-item dropdown mr-5">
        <div class="dropdown-toggle my-2 my-lg-0 mr-sm-2" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
            <?php
                if(isset($_SESSION["logged"]) && $_SESSION["logged"] == true) {
                    echo $_SESSION["username"];
                } else {
                    echo "User";
                }
            ?>
        </div>
        <div class="dropdown-menu">
            <?php
                if(isset($_SESSION["logged"]) && $_SESSION["logged"] == true) {
                    echo '<a class="dropdown-item" href="./logout.php">Logout</a>';
                } else {
                    echo '<a class="dropdown-item" href="./login.php">Login</a>';
                    echo '<a class="dropdown-item" href="./register.php">Sign up</a>';
                }
            ?>
        </div>
        </div>
    </div>
</nav>
<!-- End Header -->
