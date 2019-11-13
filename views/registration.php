
<!--Breadcrumbs-->
<div class="col-lg-12 top2">
    <div class="container">

        <ul class="breadcrumb">

            <li><a href="#">Home</a></li>

            <li class="active">Contact</li>

        </ul>

    </div>
</div>
<!--Breadcrumbs-->
<!--Main Body-->
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1 id="poruka"></h1>
            <form class="form-horizontal" role="form" method="post" action="index.php">
                <div class="form-group row">
                    <label for="tbFirstName" class="col-sm-4 control-label">Ime</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="tbFirstName" name="name" placeholder="Unesite Ime" value="<?php echo(isset($_SESSION['korisnik']))?$_SESSION['korisnik']->ime:"" ?>">
                        <small class="text-danger" id="invalid-name"></small>
                    </div>
                </div>
                <div class="row">
                </div>
                <div class="form-group row">
                    <label for="tbLastName" class="col-sm-4 control-label">Prezime</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="tbLastName" name="Lname" placeholder="Unesite Prezime" value="<?php echo(isset($_SESSION['korisnik']))?$_SESSION['korisnik']->prezime:"" ?>">
                        <small class="text-danger" id="invalid-Lname"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tbUsername" class="col-sm-4 control-label">Korisničko Ime</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="tbUsername" name="tbUsername" placeholder="Unesite korisničko ime" value="<?php echo(isset($_SESSION['korisnik']))?$_SESSION['korisnik']->username:"" ?>">
                        <small class="text-danger" id="invalid-username"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tbEmail" class="col-sm-4 control-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="tbEmail" name="tbEmail" placeholder="example@gmail.com" value="<?php echo(isset($_SESSION['korisnik']))?$_SESSION['korisnik']->email:"" ?>">
                        <small class="text-danger" id="invalid-email"></small>
                    </div>
                </div>
                <?php
                if(isset($_SESSION['korisnik'])):
                    ?>
                    <div class="form-group row">
                        <label for="tbpasswd" class="col-sm-4 control-label">Unesite Trenutnu Lozinku</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="currPass" id="currPass" >
                            <small class="text-danger" id="invalid-passwd"></small>
                        </div>
                    </div>
                <?php
                    else:
                ?>
                    <div class="form-group row">
                        <label for="tbpasswd" class="col-sm-4 control-label">Unesite <?php echo isset($_SESSION['korisnik'])?"Novu":""?> Lozinku</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="passwd" id="tbPasswd" >
                            <small class="text-danger" id="invalid-passwd"></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tbConPasswd" class="col-sm-4 control-label">Ponovite <?php echo isset($_SESSION['korisnik'])?"Novu":""?> Lozinku</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="ConPasswd" id="tbConPasswd" >
                        </div>
                    </div>
                <?php
                    endif;
                ?>
                <div class="form-group row">
                    <?php
                        if(isset($_SESSION['korisnik'])):
                    ?>
                            <input type="hidden" id="idKor" value="<?=$_SESSION['korisnik']->id_korisnik?>">
                            <div class="col-sm-6 justify-content-around">
                                <input id="btnUpdate" name="btnUpdate" type="button" value="Izmeni" class="btn btn-primary btn-hover form-control">
                            </div>
                    <?php
                        else:
                    ?>
                            <div class="col-sm-6 justify-content-around">
                                <input id="btnReg" name="btnReg" type="button" value="Registracija" class="btn btn-primary btn-hover form-control">
                            </div>
                    <?php
                        endif;
                    ?>

                    <div class="col-sm-6 justify-content-around">
                        <input type="reset"id="reset" name="reset" value="Poništi" class="btn btn-danger btn-hover form-control">
                    </div>
                </div>

            </form>
        </div>
    </div>
