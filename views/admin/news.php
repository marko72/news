<div class="col-sm-12">
    <div class="container">
        <div class="row">
            <?php
                if(isset($_SESSION['greske'])):
            ?>
            <div class="col">
                <div class="alert alert-danger alert-dismissable fade-show" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                    <h4 class="alert-heading">Greška prilikom unosa vesti:</h4>
                    <?php
                        if(is_array($_SESSION['greske'])):
                    ?>
                    <p>
                        Greske niz:
                        <?php
                            foreach ($_SESSION['greske'] as $g):
                        ?>
                            <?=$g?><br/>
                        <?php
                            endforeach;
                        ?>
                    </p>
                    <?php
                        else:
                    ?>
                    <p>Greske: <?=$_SESSION['greske']?></p>
                    <?php
                        endif;
                    ?>
                </div>
            </div>
            <?php
                unset($_SESSION['greske']);
                elseif (isset($_SESSION['vest'])):
            ?>
                <div class="col">
                    <div class="alert alert-primary alert-dismissable fade-show" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                        <h4 class="alert-heading"><?=$_SESSION['vest']?></h4>
                    </div>
                </div>
            <?php
                unset($_SESSION['vest']);
                endif;
            ?>
        </div>
        <div class="row">
            <table class="table table-hover table-bordered table-responsive-sm table-sm tabela-korisnici">
                <tbody id="tabela-vesti">
                <tr class="thead-dark">
                    <th>RB</th>
                    <th>Naslov</th>
                    <th>Tekst</th>
                    <th>Slika</th>
                    <th>Kategorija</th>
                    <th>Postavio</th>
                    <th>UPDATE</th>
                    <th>DELETE</th>
                </tr>
                <?php
                if(isset($vesti)):
                    $br = 0;
                    foreach ($vesti as $v):
                        $br++
                        ?>
                        <tr>
                            <td><?=$br?></td>
                            <td><?=$v->naslov?></td>
                            <td><div style="width:100%; max-height:250px; overflow:auto"><?=$v->tekst?></div></td>
                            <td>
                                <img src="images/news/<?=$v->putanja?>" alt="<?php ($v->alt=="")?"slika":"$v->alt"?>" class="img-thumbnail">
                            </td>
                            <td><?=$v->naziv?></td>
                            <td><?=$v->ime." ".$v->prezime?></td>
                            <td><a href="#" name="btnGetNews" class="btnGetNews btn btn-primary btnGetUser" data-id="<?=$v->id_vest?>">Izmeni</a></td>
                            <td><a href="#" name="btnDeleteNews" class="btnDeleteNews btn btn-danger btnDeleteUser" data-id="<?=$v->id_vest?>">Obriši</a></td>
                        </tr>
                    <?php
                    endforeach;
                else:
                    ?>
                    <tr><td colspan="4" class="text-danger">Zao nam je nema korisnika</td></tr>
                <?php
                endif;
                ?>
            </table>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal" role="form" method="post" action="modules/insertNews.php"  enctype="multipart/form-data" id="formNews">
                    <div class="form-group row">
                        <label for="tbNaslov" class="col-sm-4 control-label">Naslov</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="tbNaslov" name="tbNaslov" placeholder="Unesite Naslov" value="">
                            <small class="text-danger" id="invalid-name"></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ddlKat" class="col-sm-6 control-label">Odaberite kategoriju vesti</label>
                        <div class="col-sm-6">
                            <select class="form-control custom-select" id="ddlKat" name="ddlKat">
                                <?php
                                foreach ($kategorije as $kat) :
                                    ?>
                                    <option selected value="<?=$kat->id_kat?>"><?=$kat->naziv?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                            <small class="text-danger" id="invalid-kat"></small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="alert alert-danger alert-dismissable fade-show" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                            <h4 class="alert-heading">Molimo vas da kliknete na deo sa tekstom da bi se sacuvala njegova vrednost!</h4>
                        </div>
                    </div>
                    <div class="page-wrapper box-content">
                        <input type="hidden" id="skriveniTkst" name="skriveniTkst" value="">
                        <textarea class="taText" name="taText"></textarea>

                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 justify-content-around">
                            <input type="hidden" name="korisnik" value="<?= $_SESSION['korisnik']->id_korisnik?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 justify-content-around">
                            <input type="hidden" id="idVest" name="idVest" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 justify-content-around">
                            <input type="file" name="slika" id="slika" class="form-control-file">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 justify-content-around">
                            <input id="btnInsertUpdate" name="btnInsertNews" type="submit" value="Unesi vest" class="btn btn-primary btn-hover form-control">
                        </div>
                        <div class="col-sm-6 justify-content-around">
                            <input type="reset"id="reset" name="reset" value="Poništi" class="btn btn-danger btn-hover form-control">
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
</div>
</div>