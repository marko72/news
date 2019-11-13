<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <?php
            if(isset($vestiPG)):

                foreach ($vestiPG as $v):
                    ?>
                    <table>
                    <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tr>
                    </table>
                <?php
                endforeach;
                ?>
            <?php
            else:
                foreach($vesti as $v):
                    ?>
                    <div class="col-md-12">
                        <h1><?=$v->naslov?></h1>
                        <div class="entry-meta table">
                    <span>
                        Napisao: <a href="#"><?=$v->ime." ".$v->prezime?></a>
                    </span>
                            <span> / </span>
                            <span> <?=$v->naziv?> </span>
                            <span> / </span>
                            <span> April 07, 2015 </span>
                        </div>
                        <div>
                            <img src="images/news/<?=$v->putanja?>" class="img-responsive" alt="fashion">
                        </div>
                        <div class="media">
                            <p>
                                <?=substr($v->tekst,0,150)."..."?>
                            </p>
                        </div>
                        <div class="read-more padding text-center">
                            <a class="btn btn-default btn-hover" href="<?=$_SERVER['PHP_SELF']?>?page=post&id=<?=$v->id_vest?>" role="button">Procitaj više</a>
                        </div>
                    </div>
                <?php
                endforeach;
                ?>
            <?php
            endif;
            ?>
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
</div>