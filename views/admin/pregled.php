<div class="col">
    <div class="container">
        <div class="row">
            <h1 class="h4">Ankete sa najviše odgovora</h1>
            <table class="table table-hover table-bordered table-responsive-sm table-sm tabela-korisnici">
                <tbody id="tabela-korisnici">
                <tr class="thead-dark">
                    <th>RB</th>
                    <th>PITANJE</th>
                    <th>ODGOVOR</th>
                    <th>BROJ ODGOVORA</th>
                </tr>
                <?php
                if(isset($najviseOdgovora)&&is_array($najviseOdgovora)):
                    $br = 0;
                    foreach ($najviseOdgovora as $no):
                        $br++
                        ?>
                        <tr>
                            <td><?=$br?></td>
                            <td><?=$no->pitanje?></td>
                            <td><?=$no->odgovor?></td>
                            <td><?=$no->broj_odgovora?></td>
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
        <div class="row">
            <h4 >Najviše komentarisane vesti:</h4>
            <table class="table table-hover table-bordered table-responsive-sm table-sm tabela-korisnici">
                <tbody id="tabela-korisnici">
                <tr class="thead-dark">
                    <th>RB</th>
                    <th>VEST</th>
                    <th>BROJ KOMENTARA</th>
                </tr>
                <?php
                if(isset($najviseKomentara)&&is_array($najviseKomentara)):
                    $br = 0;
                    foreach ($najviseKomentara as $nk):
                        $br++
                        ?>
                        <tr>
                            <td><?=$br?></td>
                            <td><?=$nk->naslov?></td>
                            <td><?=$nk->broj_komentara?></td>
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