<!--Slider Start-->
<div class="slider_outer">
    <div id="slider1_container" style="position: relative; margin: 0 auto;
        top: 0px; left: 0px; width: 1300px; height: 500px; overflow: hidden;">
        <!-- Loading Screen -->
        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block;
                top: 0px; left: 0px; width: 100%; height: 100%;">
            </div>
            <div style="position: absolute; display: block; background: url(images/loading.gif) no-repeat center center;
                top: 0px; left: 0px; width: 100%; height: 100%;">
            </div>
        </div>
        <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1300px;
            height: 500px; overflow: hidden;">
            <?php
            $poslednjeVesti = $v->getLatestNews($conn);
            foreach ($poslednjeVesti as $v):

                ?>
                <div>
                    <img u="image" src="images/news/<?=$v->putanja?>" />

                    <div style="position: absolute; width: 480px; height: 120px; top: 30px; left: 30px; padding: 5px;
                    text-align: left; line-height: 60px; text-transform: uppercase; font-size: 50px;
                        color: #FFFFFF;"><?=$v->naziv?>
                    </div>
                    <div style="position: absolute; width: 480px; height: 120px; top: 300px; left: 30px; padding: 5px;
                    text-align: left; line-height: 36px; font-size: 30px;
                        color: #FFFFFF;"><?=$v->tekst?>
                    </div>
                </div>
            <?php
            endforeach;
            ?>
        </div>


        <!-- bullet navigator container -->
        <div u="navigator" class="jssorb21" style="bottom: 26px; right: 6px;">
            <!-- bullet navigator item prototype -->
            <div u="prototype"></div>
        </div>


        <span u="arrowleft" class="jssora21l" style="top: 123px; left: 8px;">
        </span>

        <span u="arrowright" class="jssora21r" style="top: 123px; right: 8px;">
        </span>

    </div>
</div>
<!--Slider Start-->

<!--Main Body-->
        <!--Sidebar Start-->
        <div class="col-md-6 top3">
            <input type="hidden" id="idKor" value="<?php echo (isset($_SESSION['korisnik']))?$_SESSION['korisnik']->id_korisnik:0?>">
            <?php
                $pitanja = $p->dohvatiPitanja($conn);
                //$pitanja = executeQuery("SELECT * FROM pitanje p INNER JOIN odgovor o on p.id_pitanje=o.pitanje_id");
            if (is_array($pitanja)):
                foreach ($pitanja as $p):
                    $odgovori = $o->getAnswersByID($p->id_pitanje,$conn);
            ?>
            <div class="well">
                <h4><?= $p->pitanje?></h4>
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-unstyled">
                            <?php
                            if(!is_array($odgovori)):
                                ?>
                                Za ovo pitanje nema odgovora
                            <?php
                            else:
                                foreach ($odgovori as $odg):
                                    ?>
                                    <li>
                                        <a href="#" data-id="<?=$odg->id_odgovor?>" class="btnAnketa"><?=$odg->odgovor?></a>
                                    </li>
                                <?php
                                endforeach;
                            endif;
                            ?>
                        </ul>
                    </div>
                </div>
                <!-- /.row -->
            </div>

            <?php
                endforeach;
                else:
                    $odgovori = $o->getAnswersByID($p->id_pitanje,$conn);
                    echo $odgovori;
            ?>
                    <div class="well">
                        <h4><?php $pitanja->pitanje?></h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="list-unstyled">
                                    <?php
                                    if($odgovori!=null):
                                    ?>
                                        Za ovo pitanje nema odgovora
                                    <?php
                                    else:
                                    foreach ($odgovori as $o):
                                        ?>
                                        <li>
                                            <a href="#" data-id="<?=$o->id_odgovor?>" class="btnAnketa"><?=$o->odgovor?></a>
                                        </li>
                                    <?php
                                    endforeach;
                                    endif;
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
            <?php
                endif;
            ?>
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
                <h4>RHPS NEEWS</h4>
                <p>U pravom trenutku na pravom mestu. U pravom trenutku, tacno, pouzdano OBJEKTIVNO, jednostavno RHPS NEWS</p>
            </div>

        </div>
        <!--Sidebar End-->

    </div>
    <!--Pagniation-->
    <?php
        if(isset($_GET['pg'])){
            $ukupnoVesti = count($vesti);
            $brojVestiPoStrani = 3;
            $brojStrana = ceil($ukupnoVesti/$brojVestiPoStrani);
            $pg=$_GET['pg'];
            $prikaziOd= ($pg-1)*$brojVestiPoStrani;
            $vestiPG = $v->paginateNews($prikaziOd,3,$conn);
        }
    ?>
    <?php if(isset($_GET['pg'])):?>
        <div class="container">
            <div class="row table">
                <div class="text-center col-lg-8">
                    <a class="btn btn-default btn-hover btn-block toggle-pagination"><i class="glyphicon glyphicon-plus"></i> Toggle Pagination</a>
                    <ul class="pagination pagination-responsive pagination-lg">
                        <?php for ($i=0;$i<$brojStrana;$i++):?>
                            <li><a href="index.php?page=home&pg=<?=($i+1)?>"><?=($i+1)?></a></li>
                        <?php endfor;?>
                    </ul>
                </div>
            </div>
        </div>
    <?php endif;?>
    <!--Pagniation End-->
</div>
