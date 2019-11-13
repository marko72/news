<div class="col-md-12">
    <div class="container justify-content-around">
        <div class="row border p-4 mb-2">
            <h4>Unos/Brisanje Kategorije</h4>
            <div class="container">
                <div class="row">
                    <table class="table table-hover table-bordered table-responsive-xs table-sm" id="tabelaKategorije">
                        <tr class="thead-dark">
                            <th>RB</th>
                            <th>ID</th>
                            <th>NAZIV</th>
                            <th>DELETE</th>
                        </tr>
                        <?php
                        if(isset($kategorije)):
                            foreach ($kategorije as $k):
                                $i= 1;
                                ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=$k->id_kat?></td>
                                    <td><?=$k->naziv?></td>
                                    <td><a href="#" class="btn btn-danger btnDeleteCat" data-id="<?=$k->id_kat?>">Obrisi</a></td>
                                </tr>
                                <?php
                                $i++;
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
                        <form class="form-horizontal" role="form" method="post" action="index.php">
                            <div class="form-group row">
                                <label for="tbCatName" class="col-sm-4 control-label">Naziv Kategorije: </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="tbCatName" name="tbCatName" placeholder="Unesite Naziv Kategorije" value="">
                                    <small class="text-danger" id="invalid-category"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 justify-content-around">
                                    <input id="btnInsertCat" name="btnInsertCat" type="button" value="Unesi Kategoriju" class="btn btn-primary btn-hover form-control">
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
        <div class="row border p-4 mb-2">
            <div class="container">
                <div class="row">
                    <h4>Unos/Brisanje Pitanja</h4>
                    <table class="table table-hover table-bordered table-responsive-xs table-sm" id="tabelaPitanje">
                        <tr class="thead-dark">
                            <th>RB</th>
                            <th>ID</th>
                            <th>Pitanje</th>
                            <th>DELETE</th>
                        </tr>
                        <?php
                        if(isset($pitanja)):
                            foreach ($pitanja as $p):
                                $i= 1;
                                ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=$p->id_pitanje?></td>
                                    <td><?=$p->pitanje?></td>
                                    <td><a href="#" class="btn btn-danger btnDeleteQuestion" data-id="<?=$p->id_pitanje?>">Obrisi</a></td>
                                </tr>
                                <?php
                                $i++;
                            endforeach;
                        else:
                            ?>
                            <tr><td colspan="4" class="text-danger">Greška pri dohvatanju pitanja</td></tr>
                        <?php
                        endif;
                        ?>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal" role="form" method="post" action="index.php">
                            <div class="form-group row">
                                <label for="tbPitanje" class="col-sm-4 control-label">Unesite pitanje: </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="tbPitanje" name="tbPitanje" placeholder="Unesite pitanje" value="">
                                    <small class="text-danger" id="invalid-pitanje"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 justify-content-around">
                                    <input id="btnInsertPitanje" name="btnInsertPitanje" type="button" value="Unesi Pitanje" class="btn btn-primary btn-hover form-control">
                                </div>
                                <div class="col-sm-6 justify-content-around">
                                    <input type="reset" id="reset" name="reset" value="Poništi" class="btn btn-danger btn-hover form-control">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col border p-4">
                <h4>Unos/Brisanje Odgovora</h4>
                <div class="form-group row">
                    <label for="ddlPitanja" class="col-sm-6 control-label">Izaberi pitanje</label>
                    <div class="col-sm-6">
                        <select class="form-control custom-select" id="ddlPitanja" name="ddlPitanja">
                            <option selected value="0">Izaberite</option>
                            <?php
                            foreach ($pitanja as $p) :
                                ?>
                                <option selected value="<?=$p->id_pitanje?>"><?=$p->pitanje?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                        <small class="text-danger" id="invalid-question"></small>
                    </div>
                </div>

                <div class="row">
                    <table class="table table-hover table-bordered table-responsive-xs table-sm" id="tabelaOdgovori">
                        <tr class="thead-dark">
                            <th>RB</th>
                            <th>ID</th>
                            <th>ODGOVOR NA PITANJE</th>
                            <th>ODGOVOR</th>
                            <th>IZMENI</th>
                            <th>OBRIŠI</th>
                        </tr>
                        <tr><td colspan="4" class="text-danger">Odaberite pitanje odgovora</td></tr>

                    </table>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal" role="form" method="post" action="index.php">
                            <div class="form-group row">
                                <label for="tbOdgpovor" class="col-sm-4 control-label">Unesite odgovor na pitanje: </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="tbOdgpovor" name="tbOdgpovor" placeholder="Unesite odgovor na pitanje" value="">
                                    <small class="text-danger" id="invalid-odgovor"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 justify-content-around">
                                    <input id="btnInsertAnswer" name="btnInsertAnswer" type="button" value="Unesi Odgovor na pitanje" class="btn btn-primary btn-hover form-control">
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
</div>
</div>