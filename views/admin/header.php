<div class="container">
    <div class="row">
        <div class="container">
            <div class="navbar navbar-expand-md navbar-light bg-light justify-content-between navbar-fixed-top">
                <a href="index.php?page=home&pg=1" class="navbar-brand"><img src="images/rhps_news.png" alt="logo rhps news"></a>
                <button class="navbar-toggler">
                    <span class="navbar-toggler-icon" data-toggle="collapse" data-target="#headMenu"></span>
                </button>
                <div class="collapse navbar-collapse" id="headMenu">
                    <div class="ml-auto">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" href="<?=$_SERVER['PHP_SELF']?>?page=users">Korisnici</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=$_SERVER['PHP_SELF']?>?page=ostalo">Ostalo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=$_SERVER['PHP_SELF']?>?page=news">Vesti</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=$_SERVER['PHP_SELF']?>?page=pregled">Pregled</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?page=home&pg=1">Početna</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-around">
        <!--<div class="col">
            <div class="navbar navbar-light bg-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href=""data-toggle="collapse" data-target="#dropMenu">Link1</a>
                        <div id="dropMenu" class="collapse navbar-collapse">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link active" href="<?=$_SERVER['PHP_SELF']?>?page=users">Korisnici</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=$_SERVER['PHP_SELF']?>?page=ostalo">Ostalo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=$_SERVER['PHP_SELF']?>?page=vesti">Vesti</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item"><a href="">Link1</a></li>
                </ul>
            </div>
        </div>
-->