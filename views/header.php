<div class="overlay"></div>
<div id="modal1" class="modal">
    <p class="closeBtn">Close</p>
    <div class="container-fluid">
        <form action="modules/login.php" method="post">
            <div class="form-group">
                <input type="text" name="tbUser" placeholder="Unesite username" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" name="tbPasswd" placeholder="Unesite lozinku" class="form-control">
            </div>
            <?php
            if(isset($_SESSION['greska'])&&is_array($_SESSION['greska'])):
                foreach ($_SESSION['greska'] as $g):
                    ?>
                    <p class="error-p"><?=$g?></p>
                <?php
                endforeach;
            elseif (isset($_SESSION['greska'])):
                ?>
                <p class="error-p"><?=$_SESSION['greska']?></p>
                <?php
                unset($_SESSION['greska']);
            endif;
            ?>
            <div class="form-group">
                <input type="submit" name="btnLogin" value="Login" class="btn btn-primary">
            </div>
        </form>
    </div>

</div>
<!--Top Header-->
<header class="header">
    <div class="container">
        <nav class="navbar navbar-inverse" role="navigation">
            <div class="navbar-header">
                <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <a href="<?=$_SERVER['PHP_SELF'].'?page=home'?>" class="navbar-brand scroll-top logo animated bounceInLeft rollIn"><b><img
                                src="images/rhps_news.png" alt="logo for rhps news"></b></a></div>
            <div id="main-nav" class="collapse navbar-collapse">
                <ul class="nav navbar-nav" id="mainNav">
                    <li class="active"><a href="<?=$_SERVER['PHP_SELF'].'?page=home&pg=1'?>">Početna</a></li>
                    <li><a href="<?=$_SERVER['PHP_SELF'].'?page=all-posts'?>&id=6">Politika</a></li>
                    <li><a href="<?=$_SERVER['PHP_SELF'].'?page=all-posts'?>&pop">Najpopularnije</a></li>
                    <li><a href="<?=$_SERVER['PHP_SELF'].'?page=all-posts'?>&id=7">Sport</a></li>
                    <li><a href="<?=$_SERVER['PHP_SELF'].'?page=all-posts'?>&pg=1">Sve vesti</a></li>
                    <?php
                        if(isset($_SESSION['korisnik'])):
                    ?>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Logout | Izmena <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="modules/logout.php" class="error-p">Logout</a></li>
                                    <li><a href="<?= $_SERVER['PHP_SELF']."?page=registration"?>">Profil</a></li>
                                </ul>
                            </li>
                    <?php
                        else:
                    ?>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Logovanje | Registracija <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a class="modalLink" href="#modal1">Logovanje</a></li>
                            <li><a href="<?= $_SERVER['PHP_SELF']."?page=registration"?>">Registracija</a></li>
                        </ul>
                    </li>
                    <?php
                        endif;
                    ?>
                    <?php
                        if(isset($_SESSION['korisnik'])&&$_SESSION['korisnik']->naziv=="admin"):
                    ?>
                            <li><a href="admin.php?page=users">Admin Panel</a></li>
                    <?php
                        endif;
                    ?>
                </ul>
            </div>
        </nav>
    </div>
</header>
<!--Top Header End-->