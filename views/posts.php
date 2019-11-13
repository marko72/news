
<!--Breadcrumbs-->
<div class="col-lg-12 top2">
    <div class="container">

        <ul class="breadcrumb">

            <li><a href="<?=$_SERVER['PHP_SELF']?>?page=home&pg=1">Početna</a></li>

            <li class="active">Sve vesti</li>

        </ul>

    </div>
</div>
<!--Breadcrumbs-->

<!--Blog Body-->

<div class="container">
    <div class="row">

        <div class="col-md-8">
            <div class="panel">
                <div class="panel-body">


                    <!--/Blog Posts-->
                    <?php
                        if(isset($vestiPOP)):
                        foreach ($vestiPOP as $v):
                    ?>

                            <div class="row posts">
                                <br>
                                <div class="col-md-2 col-sm-3 text-center">
                                    <a class="story-img" href="#"><img src="images/news/<?=$v->putanja?>" style="width:100px;height:100px" class="img-circle" alt="<?=$v->alt?>"></a>
                                </div>
                                <div class="col-md-10 col-sm-9">
                                    <h3><?=$v->naslov?></h3>
                                    <div class="row">
                                        <div class="col-xs-9">
                                            <p><?php substr($v->tekst,0,150)?></p>
                                            <p class="lead">
                                                <a href="<?=$_SERVER['PHP_SELF']?>?page=post&id=<?=$v->id_vest?>" class="btn btn-default btn-hover">Pročitaj vise</a>
                                            <p class="pull-right"><span class="label label-default"><?=$v->naziv?></span></p>
                                            <ul class="list-inline"><li><a href="#"><?php date("d.m.y h:i")?></a></li><li><a href="#"><i class="fa fa-comment"></i> <?=$v->broj_komentara?></a></li>></ul>
                                        </div>
                                        <div class="col-xs-3"></div>
                                    </div>
                                    <br><br>
                                </div>
                            </div>

                    <?php
                            endforeach;
                            elseif(isset($vestiPG)):
                                foreach ($vestiPG as $v):
                                    ?>
                                    <div class="row posts">
                                        <br>
                                        <div class="col-md-2 col-sm-3 text-center">
                                            <a class="story-img" href="#"><img src="images/news/<?=$v->putanja?>" style="width:100px;height:100px" class="img-circle" alt="<?=$v->alt?>"></a>
                                        </div>
                                        <div class="col-md-10 col-sm-9">
                                            <h3><?=$v->naslov?></h3>
                                            <div class="row">
                                                <div class="col-xs-9">
                                                    <p><?php substr($v->tekst,0,150)?></p>
                                                    <p class="lead">
                                                        <a href="<?=$_SERVER['PHP_SELF']?>?page=post&id=<?=$v->id_vest?>" class="btn btn-default btn-hover">Pročitaj vise</a>
                                                    <p class="pull-right"><span class="label label-default"><?=$v->naziv?></span></p>
                                                    <ul class="list-inline"><li><a href="#"><?php date("d.m.y h:i")?></a></li><li><a href="#"><i class="fa fa-comment"></i> <?=$v->broj_komentara?> Comments</a></li>></ul>
                                                </div>
                                                <div class="col-xs-3"></div>
                                            </div>
                                            <br><br>
                                        </div>
                                    </div>
                                <?php
                                    endforeach;
                                    else:
                                ?>

                    <?php
                        foreach ($vesti as $v):
                    ?>
                    <div class="row posts">
                        <br>
                        <div class="col-md-2 col-sm-3 text-center">
                            <a class="story-img" href="#"><img src="images/news/<?=$v->putanja?>" style="width:100px;height:100px" class="img-circle" alt="<?=$v->alt?>"></a>
                        </div>
                        <div class="col-md-10 col-sm-9">
                            <h3><?=$v->naslov?></h3>
                            <div class="row">
                                <div class="col-xs-9">
                                    <p><?php substr($v->tekst,0,150)?></p>
                                    <p class="lead">
                                        <a href="<?=$_SERVER['PHP_SELF']?>?page=post&id=<?=$v->id_vest?>" class="btn btn-default btn-hover">Pročitaj vise</a>
                                    <p class="pull-right"><span class="label label-default"><?=$v->naziv?></span></p>
                                    <ul class="list-inline"><li><a href="#"><?php date("d.m.y h:i")?></a></li><li><a href="#"><i class="fa fa-comment"></i> <?=$v->broj_komentara?> Comments</a></li>></ul>
                                </div>
                                <div class="col-xs-3"></div>
                            </div>
                            <br><br>
                        </div>
                    </div>
                    <?php
                        endforeach;
                        endif;
                    ?>
                    <!--/Blog Posts-->





                </div>
                <!--Pagniation-->
                <?php if(isset($_GET['pg'])):?>
                <div class="container">
                    <div class="row table">
                        <div class="text-center col-lg-8">
                            <a class="btn btn-default btn-hover btn-block toggle-pagination"><i class="glyphicon glyphicon-plus"></i> Toggle Pagination</a>
                            <ul class="pagination pagination-responsive pagination-lg">
                                <?php for ($i=0;$i<$brojStrana;$i++):?>
                                <li><a href="index.php?page=all-posts&pg=<?=($i+1)?>"><?=($i+1)?></a></li>
                                <?php endfor;?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php endif;?>
                <!--Pagniation End-->
            </div>



        </div>
        <!--/col-8-->
        <div class="col-md-4">
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
    </div>
</div>