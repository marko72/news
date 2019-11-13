$(document).ready(function () {
    $(document).on('click',".btnGetUser", function (e) {
        e.preventDefault()
        var idKor = $(this).data("id");
        var aktivan = $(this).parent().parent().find("#ddlAktivan").val()
        var uloga = $(this).parent().parent().find("#ddlUloga").val()
        $.ajax({
            url:'modules/ajaxAdmin.php',
            method: "POST",
            dataType:"json",
            data:{
                "updateUsr":"da",
                "idKor": idKor,
                aktivan,
                uloga
            },
            success:function (data) {
                alert("Uspesno promenjen korisnik!")
            },
            error:function () {
                alert("Korisnik sa tim parametrima vec postoji!")
            }
        })
    })
    $(document).on('click',".btnDeleteUser", function (e) {
        e.preventDefault()
        var idKor = $(this).data("id");
        $.ajax({
            url:'modules/ajaxAdmin.php',
            method: "POST",
            dataType:"json",
            data:{
                "deleteUsr":"da",
                "idKor": idKor
            },
            success:function (data) {
                alert("Uspesno izbrisan korisnik!")
                var ispis = "<tr class=\"thead-dark\">" +
                    "                    <th>RB</th>" +
                    "                    <th>ID</th>" +
                    "                    <th>Ime</th>" +
                    "                    <th>Prezime</th>" +
                    "                    <th>Username</th>" +
                    "                    <th>Email</th>" +
                    "                    <th>Aktivan</th>" +
                    "                    <th>Uloga</th>" +
                    "                    <th>Datum registracije</th>" +
                    "                    <th>UPDATE</th>" +
                    "                    <th>DELETE</th>" +
                    "                </tr>"
                $.each(data,function (i,e) {
                    i = i+1;
                    ispis+= "                    \"                <tr>\\n\" +\n" +
                        '<td>'+i+'</td>' +
                        '<td>'+e.id_korisnik+'</td>' +
                        '<td>'+e.ime+'</td>' +
                        '<td>'+e.prezime+'</td>' +
                        '<td>'+e.username+'</td>' +
                        '<td>'+e.email+'</td>' +
                        '<td>' +
                        '<select class="form-control custom-select " id="ddlAktivan" name="ddlAktivan">' +
                        '<option value="0" ';
                    if(e.aktivan==0){
                        ispis+="selected"
                    }
                    ispis+='>Neaktivan'+
                        '</option>'+
                        '<option value="1"';
                    if(e.aktivan==1){
                        ispis+="selected"
                    }
                    ispis+= '>Aktivan</option>' +
                        '<td>' +
                        '    <select class="form-control custom-select " id="ddlUloga" name="ddlUloga">\n' +
                        '       <option value="1" ';
                    if(e.uloga_id==1){
                        ispis+="selected"
                    }
                    ispis+='>Admin</option>'+

                        '       <option value="2" ';
                    if(e.uloga_id==2){
                        ispis+="selected"
                    }
                    ispis+='>Korisnik</option>' +
                        '</select>' +
                        '</td>'+
                        '</select>'+
                        '</td>'+
                        '<td>'+e.datum_reg+'</td>' +
                        '<td><a href="#" class="btn btn-primary btnGetUser" data-id='+e.id_korisnik+'>Izmeni</a></td>' +
                        '<td><a href="#" class="btn btn-danger btnDeleteUser" data-id='+e.id_korisnik+'>Obriši</a></td> '+
                        '</tr>'
                })
                $("#tabela-korisnici").html(ispis)
            },
            error:function () {
                alert("korisnik nije obrisan!")
            }
        })
    })
})