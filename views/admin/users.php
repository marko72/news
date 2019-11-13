<div class="col">
    <div class="container">
        <div class="row">
            <table class="table table-hover table-bordered table-responsive-sm table-sm tabela-korisnici">
                <tbody id="tabela-korisnici">
                <tr class="thead-dark">
                    <th>RB</th>
                    <th>ID</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Aktivan</th>
                    <th>Uloga</th>
                    <th>Datum registracije</th>
                    <th>UPDATE</th>
                    <th>DELETE</th>
                </tr>
                <?php
                if(isset($korisnici)):
                    $br = 0;
                    foreach ($korisnici as $u):
                        $br++
                        ?>
                        <tr>
                            <td><?=$br?></td>
                            <td><?=$u->id_korisnik?></td>
                            <td><?=$u->ime?></td>
                            <td><?=$u->prezime?></td>
                            <td><?=$u->username?></td>
                            <td><?=$u->email?></td>
                            <td>
                                <select class="form-control custom-select " id="ddlAktivan" name="ddlAktivan">
                                    <option value="0" <?php echo($u->aktivan==0)?"selected":""?>>Neaktivan</option>
                                    <option value="1" <?php echo($u->aktivan==1)?"selected":""?>>Aktivan</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control custom-select " id="ddlUloga" name="ddlUloga">
                                    <option value="1" <?php echo($u->uloga_id==1)?"selected":""?>>Admin</option>
                                    <option value="2" <?php echo($u->uloga_id==2)?"selected":""?>>Korisnik</option>
                                </select>
                            </td>
                            <td><?php echo date("d.m.Y",$u->datum_reg)?></td>
                            <td><a href="#" class="btn btn-primary btnGetUser" data-id="<?=$u->id_korisnik?>">Izmeni</a></td>
                            <td><a href="#" class="btn btn-danger btnDeleteUser" data-id="<?=$u->id_korisnik?>">Obriši</a></td>
                        </tr>
                    <?php
                    endforeach;
                else:
                    ?>
                    <tr><td colspan="4" class="text-danger">Zao nam je nema korisnika</td></tr>
                <?php
                endif;
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>