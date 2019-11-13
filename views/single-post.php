<!--Breadcrumbs-->
<div class="col-lg-12 top2">
    <div class="container">

        <ul class="breadcrumb">

            <li><a href="<?=$_SERVER['PHP_SELF']?>?page=home&pg=1">Početna</a></li>
            <li><a href="<?=$_SERVER['PHP_SELF']?>?page=all-posts&id=<?=$vest->id_kat?>"><?=$vest->naziv?></a></li>

            <li class="active"><?=substr($vest->naslov,0,50)?>...</li>

        </ul>
    </div>

</div>
<!--Breadcrumbs-->
<!--Main Body-->
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="col-md-12">
                <h1><?=$vest->naslov?></h1>
                <div class="entry-meta table">
        	<span>
            Napisao
            <a href="#"><?=$vest->ime?> <?=$vest->prezime?></a>
            </span>
                    <span> / </span>
                    <span> <?=$vest->naziv?> </span>
                    <span> / </span>
                    <span> <?php date("d.m.y h:i")?> </span>
                </div>
                <div>
                    <img src="images/news/<?=$vest->putanja?>" class="img-responsive" alt="<?=$vest->alt?>">
                </div>
                <div class="media">
                    <?=$vest->tekst?>
                </div>

            </div>


        </div>

        <!--Sidebar Start-->
        <div class="col-md-4 top3">

            <!-- Blog Categories Well -->
            <div class="well">
                <h4>Kategorije vesti</h4>
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-unstyled">
                            <?php
                                foreach ($kategorije as $k):
                            ?>
                                <li>
                                    <a href="<?=$_SERVER['PHP_SELF']?>?page=all-posts&id=<?=$k->id_kat?>"><?=$k->naziv?></a>
                                </li>
                            <?php
                                endforeach;
                            ?>
                        </ul>
                    </div>
                </div>
                <!-- /.row -->
            </div>

            <!-- Side Widget Well -->
            <div class="well">
                <h4>RHPS NEWS</h4>
                <p>Čitajte najnovije vesti, pouzdane, tačne! Jednostavno RHPS NEWS!</p>
            </div>

        </div>
        <!--Sidebar End-->

        <!--Comment-->
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="page-header">Comments</h2>
                    <section class="comment-list">
                        <!-- First Comment -->
                        <?php
                            if (!is_string($komentari[0])):
                                foreach ($komentari  as $kom):
                        ?>
                        <div class="row" id="ispisKomentara">
                            <div class="col-md-12 col-sm-12">
                                <div class="panel panel-default arrow left">
                                    <div class="panel-body">
                                        <header class="text-left">
                                            <div class="row justify-content-between">
                                                <div class="col-sm-4">
                                                    <div class="comment-user"><i class="fa fa-user"></i> <?=$kom->username?></div>
                                                    <time class="comment-date" datetime="<?=date("d.m.y. i:h:s",$kom->date)?>"><i class="fa fa-clock-o"></i> <?=date("d.m.y. i:h:s",$kom->date)?></time>
                                                </div>
                                                <div class="col-sm-4">
                                                    <a href="#" id="btnDelComm" name="btnDelComm" class="btn btn-danger btn-sm float-right -align-right" data-id="<?=$kom->id_komentar?>">Obrisi</a>
                                                </div>
                                            </div>
                                        </header>
                                        <div class="comment-post">
                                            <p>
                                                <?=$kom->text_komentara?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            endforeach;
                            else:
                        ?>
                            <div class="row"><p>Trenutno nema komentara</p></div>
                        <?php
                            endif;
                            if(isset($_SESSION['korisnik'])):
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <form action="" class="">
                                    <div class="form-group row">
                                        <div class="col-md-12 justify-content-around">
                                            <input type="hidden" id="idVest" value="<?=$vest->id_vest?>">
                                            <textarea name="taKomentar" id="taKomentar" cols="30" rows="10" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class=col-md12">
                                            <a href="#" id="btnComment" name="btnComment" class="btn btn-primary" data-id="<?php echo (isset($_SESSION['korisnik'])?$_SESSION['korisnik']->id_korisnik:"")?>">Komentarisi</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php
                            endif;
                        ?>
                    </section>
                </div>
            </div>
        </div>
        <!--Comment End-->
    </div>
</div>