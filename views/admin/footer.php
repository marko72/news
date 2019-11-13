
<footer class="container">
    <div class="row bg-light">
        <div class="col-sm-4 navbar">
            <ul class="navbar-nav">
                <li class="nav-item"><h6>Najvise komentarisane vesti</h6>
                <?php
                $upit = "SELECT *, COUNT(vest_id) AS broj_komentara FROM komentar kom INNER JOIN vest v ON kom.vest_id=v.id_vest GROUP BY vest_id ORDER BY broj_komentara DESC LIMIT 0,5";
                $populars = executeQuery($upit);
                foreach ($populars as $p):
                    ?>
                    <li><a href="index.php?page=post&id=<?=$p->id_vest?>"><?=substr($p->naslov,0,25)?>...</a></li>
                <?php
                endforeach;
                ?>
            </ul>
        </div>
        <div class="col-sm-4 navbar">

        </div>
        <div class="col-sm-4 navbar">
            <ul class="navbar-nav">
                <li class="nav-item"><h6>Najnovije vesti</h6></li>
                <?php
                $upit = "SELECT * FROM vest v INNER JOIN slika_vest sv ON v.id_vest=sv.vest_id INNER JOIN kategorija kat ON v.kategorija_id=kat.id_kat
                                                  INNER JOIN korisnik k ON v.korisnik_id=k.id_korisnik GROUP BY v.id_vest ORDER BY datum DESC LIMIT 0,3";
                $poslednjeVesti = executeQuery($upit);
                foreach ($poslednjeVesti as $v):

                    ?>
                    <li class="nav-item"><a href="index.php?page=post&id=<?=$v->id_vest?>"><?=substr($v->naslov,0,25)?>...</a></li>
                <?php
                endforeach;
                ?>
            </ul>
        </div>
    </div>
</footer>

<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
<?php
    if(isset($_GET["page"])&&$_GET["page"]=="ostalo"):
?>
        <script src="js/insert_other.js"></script>
<?php
    endif;
?>
<?php
if(isset($_GET["page"])&&$_GET["page"]=="users"):
    ?>
    <script src="js/admin.js"></script>
<?php
endif;
?>
<?php
if(isset($_GET['page'])&&$_GET['page']=='news'):
    ?>
    <script src="js/adminNews.js"></script>
    <script src="js/jquery.richtext.js"></script>
    <script>
        $(document).ready(function() {
            $('.taText').richText();
        });
    </script>
<?php
endif;
?>
</body>
</html>