<!--Footer Start-->
<footer>
    <div class="row">
        <div class="col-lg-4">
            <h1>Najviše komentarisane vesti</h1>
            <ul class="list-unstyled">
                <?php
                    $upit = "SELECT *, COUNT(vest_id) AS broj_komentara FROM komentar kom INNER JOIN vest v ON kom.vest_id=v.id_vest GROUP BY vest_id ORDER BY broj_komentara DESC LIMIT 0,5";
                    $populars = executeQuery($upit);
                    foreach ($populars as $p):
                ?>
                    <li><a href="<?=$_SERVER['PHP_SELF']?>?page=post&id=<?=$p->id_vest?>"><?=substr($p->naslov,0,25)?>...</a></li>
                <?php
                    endforeach;
                ?>
            </ul>
        </div>
        <div class="col-lg-4">
            <div class="fb-page" data-href="https://www.facebook.com/themesrefinery" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/themesrefinery"><a href="<?=$_SERVER['PHP_SELF']?>?page=author">Autor</a></blockquote></div></div>
            <h1>Lajkujte nas</h1>
            <div class="fb-page" data-href="https://www.facebook.com/themesrefinery" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/themesrefinery"><a href="https://www.facebook.com/themesrefinery">ThemesRefinery</a></blockquote></div></div>
            <div class="text-center">
                <a href="https://www.facebook.com/themesrefinery"><i class="fa fa-facebook square"></i></a>
                <a href="https://twitter.com/themesrefinery"><i class="fa fa-twitter square"></i></a>
                <a href="#"><i class="fa fa-github square"></i></a>
                <a href="https://plus.google.com/b/101108467301668768757/+Themesrefinery57/posts"><i class="fa fa-google-plus square"></i></a>
            </div>
        </div>
        <div class="col-lg-4">
            <h1>Najnovije vesti</h1>
            <ul class="list-unstyled">
                <?php
                    $upit = "SELECT * FROM vest v INNER JOIN slika_vest sv ON v.id_vest=sv.vest_id INNER JOIN kategorija kat ON v.kategorija_id=kat.id_kat
                                                  INNER JOIN korisnik k ON v.korisnik_id=k.id_korisnik GROUP BY v.id_vest ORDER BY datum DESC LIMIT 0,3";
                    $poslednjeVesti = executeQuery($upit);
                    foreach ($poslednjeVesti as $v):

                ?>
                <li><a href="<?=$_SERVER['PHP_SELF']?>?page=post&id=<?=$v->id_vest?>"><?=substr($v->naslov,0,25)?>...</a></li>
                <?php
                    endforeach;
                ?>
            </ul>
        </div>
    </div>
    <div class="col-lg-12 top2 bottom2">
        <div class="text-center">Copy Right &copy; 2015.Design By <a href="http://www.themesrefinery.net/"><i class="fa  fa-file-code">Themesrefinery</i></a></div>
    </div>
</footer>
<!--Footer End-->
</div>
<!--Main Body End-->

<script src="js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<?php
if(isset($_GET['page'])&&$_GET['page']=="home"):
?>
<script src="js/jssor.js" type="text/javascript"></script>
<script src="js/jssor.slider.js" type="text/javascript"></script>
<script src="js/slider.js" type="text/javascript"></script>
    <script src="js/anketa.js" type="text/javascript"></script>
<?php
endif;
?>
<?php
    if(isset($_GET['page'])&&$_GET['page']=="registration"):
?>
        <script src="js/registration.js" type="text/javascript"></script>
<?php
endif;
?>
<?php
if(isset($_GET['page'])&&$_GET['page']=="post"):
    ?>
    <script src="js/komentari.js" type="text/javascript"></script>
<?php
endif;
?>
<script type='text/javascript' src='js/jquery.modal.js'></script>
<script type='text/javascript' src='js/site.js'></script>

</body>
</html>