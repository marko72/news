$(document).ready(function () {
    $(document).on("click","#btnInsertCat",function () {
        var nazivKat = $("#tbCatName").val()
        $.ajax({
            url:"modules/adminCategory.php",
            type:"post",
            data:{
                insertCat : "da",
                nazivKat
            },
            success:function(data){
                var ispis =
                    '<tr class="thead-dark">\n' +
                    '    <th>RB</th>\n' +
                    '    <th>ID</th>\n' +
                    '    <th>NAZIV</th>\n' +
                    '    <th>DELETE</th>\n' +
                    '</tr>'
                $.each(data,function (i,e) {
                    ispis+=
                        '<tr>\n' +
                        '    <td>'+(i+1)+'</td>\n' +
                        '    <td>'+e.id_kat+'</td>\n' +
                        '    <td>'+e.naziv+'</td>\n' +
                        '    <td><a href="#" class="btn btn-danger btnDeleteCat" data-id="'+e.id_kat+'">Obrisi</a></td>' +
                        '</tr>'
                })
                $("#tabelaKategorije").html(ispis)
            },
            error:function (xhr) {
                alert("Neuspesno")
            }
        })
    })
    $(document).on("click",".btnDeleteCat",function (e) {
        e.preventDefault()
        var conf = confirm("Obrisacete sve vesti ove kategorije. Da li to želite?")
        if(conf){
            var idKat = $(this).data('id')
            $.ajax({
                url:"modules/adminCategory.php",
                type:"post",
                data:{
                    delCat : "da",
                    idKat
                },
                success:function(data){
                    var ispis =
                        '<tr class="thead-dark">\n' +
                        '    <th>RB</th>\n' +
                        '    <th>ID</th>\n' +
                        '    <th>NAZIV</th>\n' +
                        '    <th>DELETE</th>\n' +
                        '</tr>'
                    $.each(data,function (i,e) {
                        ispis+=
                            '<tr>\n' +
                            '    <td>'+(i+1)+'</td>\n' +
                            '    <td>'+e.id_kat+'</td>\n' +
                            '    <td>'+e.naziv+'</td>\n' +
                            '    <td><a href="#" class="btn btn-danger btnDeleteCat" data-id="'+e.id_kat+'">Obrisi</a></td>' +
                            '</tr>'
                    })
                    $("#tabelaKategorije").html(ispis)
                },
                error:function (xhr) {
                    alert("Neuspesno")
                }
            })
        }else {
            alert("Otkazano brisanje")
        }
    })

    //UNOS NOVOG PITANJA


    $(document).on('click',"#btnInsertPitanje", function (e) {
        e.preventDefault()
        var pitanje = $("#tbPitanje").val()
        if(pitanje==""){
            $("#invalid-pitanje").html("Unesite tekst pitanja")
        }else {
            $("#invalid-pitanje").html("")
            $.ajax({
                url:'modules/adminAnketa.php',
                method: "POST",
                dataType:"json",
                data:{
                    "insertPitanje":"da",
                    pitanje
                },
                success:function (data) {
                    var ispis = '<tr class="thead-dark">\n' +
                        '                    <th>RB</th>\n' +
                        '                    <th>ID</th>\n' +
                        '                    <th>Pitanje</th>\n' +
                        '                    <th>DELETE</th>\n' +
                        '                </tr>\n'
                    var ispis2 = '<option selected value="0">Izaberite</option>\n'
                    $.each(data,function (i,e) {
                        ispis += '<tr>' +
                            '    <td>'+(i+1)+'</td>' +
                            '    <td>'+e.id_pitanje+'</td>\n' +
                            '    <td>'+e.pitanje+'</td>\n' +
                            '    <td><a href="#" class="btn btn-danger btnDeleteQuestion" data-id="'+e.id_pitanje+'">Obrisi</a></td>\n' +
                            '</tr>'
                        ispis2 += '      <option selected value="'+e.id_pitanje+'">'+e.pitanje+'</option>\n'
                    })
                    $('#tabelaPitanje').html(ispis)
                    $('#ddlPitanja').html(ispis2)
                    $("#ddlPitanja").val(0)
                    var ispis3 = '<tr class="thead-dark">\n' +
                        '                    <th>RB</th>\n' +
                        '                    <th>ID</th>\n' +
                        '                    <th>ODGOVOR</th>\n' +
                        '                    <th>OBRIŠI</th>'+
                        '                </tr>'+
                        '<tr><td colspan="4" class="text-danger">Izaberite  pitanje da bi ste videli odgovore</td></tr>'
                    $('#tabelaOdgovori').html(ispis3)
                },
                error:function () {
                    alert("Neuspesno uneto pitanje!")
                }
            })
        }
    })

    //BRISANJE PITANJA

    $(document).on('click',".btnDeleteQuestion", function (e) {
        e.preventDefault()
        var idPitanja = $(this).data("id")
        $.ajax({
            url:'modules/adminAnketa.php',
            method: "POST",
            dataType:"json",
            data:{
                "deleteQuestion":"da",
                idPitanja
            },
            success:function (data) {
                var ispis = '<tr class="thead-dark">\n' +
                    '                    <th>RB</th>\n' +
                    '                    <th>ID</th>\n' +
                    '                    <th>Pitanje</th>\n' +
                    '                    <th>DELETE</th>\n' +
                    '                </tr>\n'
                var ispis2 = '<option selected value="0">Izaberite</option>\n'
                $.each(data,function (i,e) {
                    ispis += '<tr>' +
                        '    <td>'+(i+1)+'</td>' +
                        '    <td>'+e.id_pitanje+'</td>\n' +
                        '    <td>'+e.pitanje+'</td>\n' +
                        '    <td><a href="#" class="btn btn-danger btnDeleteQuestion" data-id="'+e.id_pitanje+'">Obrisi</a></td>\n' +
                        '</tr>'
                    ispis2 += '      <option selected value="'+e.id_pitanje+'">'+e.pitanje+'</option>\n'
                })
                $('#tabelaPitanje').html(ispis)
                $('#ddlPitanja').html(ispis2)
                $("#ddlPitanja").val(0)
                var ispis3 = '<tr class="thead-dark">\n' +
                    '                    <th>RB</th>\n' +
                    '                    <th>ID</th>\n' +
                    '                    <th>ODGOVOR</th>\n' +
                    '                    <th>OBRIŠI</th>'+
                    '                </tr>'+
                    '<tr><td colspan="4" class="text-danger">Izaberite  pitanje da bi ste videli odgovore</td></tr>'
                $('#tabelaOdgovori').html(ispis3)
            },
            error:function () {
                alert("Neuspesno izbrisano pitanje!")
            }
        })
    })

    //DOHVATANJE ODGOVORA NA PITANJE

    $(document).on("change","#ddlPitanja",function () {
        var idPitanja = $(this).val()
        $.ajax({
            url:'modules/adminAnketa.php',
            method: "POST",
            dataType:"json",
            data:{
                "getAnswersByID":"da",
                idPitanja
            },
            success:function (data) {
                var ispis = '<tr class="thead-dark">\n' +
                    '                    <th>RB</th>\n' +
                    '                    <th>ID</th>\n' +
                    '                    <th>ODGOVOR</th>\n' +
                    '                    <th>OBRIŠI</th>'+
                    '                </tr>'
                $.each(data,function (i,e) {
                    ispis += '<tr>\n' +
                        '    <td>'+(i+1)+'</td>\n' +
                        '    <td>'+e.id_odgovor+'</td>\n' +
                        '    <td>'+e.odgovor+'</td>\n' +
                        '    <td><a href="#" class="btn btn-danger btnDeleteAnswer" data-id="'+e.id_odgovor+'">Obrisi</a></td>\n' +
                        '</tr>'
                })
                $('#tabelaOdgovori').html(ispis)
            },
            error:function () {
                var ispis = '<tr class="thead-dark">\n' +
                    '                    <th>RB</th>\n' +
                    '                    <th>ID</th>\n' +
                    '                    <th>ODGOVOR</th>\n' +
                    '                    <th>OBRIŠI</th>'+
                    '                </tr>'+
                    '<tr><td colspan="4" class="text-danger">Nema odgovora na pitanja</td></tr>'
                $('#tabelaOdgovori').html(ispis)
            }
        })
    })

    //UNOŠENJE ODGOVORA

    $(document).on('click',"#btnInsertAnswer", function (e) {
        e.preventDefault()
        var odgovor = $("#tbOdgpovor").val()
        var idPitanja = $("#ddlPitanja").val()
        if(odgovor==""){
            $("#invalid-odgovor").html("Unesite tekst odgovora")
        }else {
            $("#invalid-pitanje").html("")
            $.ajax({
                url:'modules/adminAnketa.php',
                method: "POST",
                dataType:"json",
                data:{
                    "insertAnswer":"da",
                    odgovor,
                    idPitanja
                },
                success:function (data) {
                    var ispis = '<tr class="thead-dark">\n' +
                        '                    <th>RB</th>\n' +
                        '                    <th>ID</th>\n' +
                        '                    <th>ODGOVOR</th>\n' +
                        '                    <th>OBRIŠI</th>'+
                        '                </tr>'
                    $.each(data,function (i,e) {
                        ispis += '<tr>\n' +
                            '    <td>'+(i+1)+'</td>\n' +
                            '    <td>'+e.id_odgovor+'</td>\n' +
                            '    <td>'+e.odgovor+'</td>\n' +
                            '    <td><a href="#" class="btn btn-danger btnDeleteAnswer" data-id="'+e.id_odgovor+'">Obrisi</a></td>\n' +
                            '</tr>'
                    })
                    $('#tabelaOdgovori').html(ispis)
                },
                error:function () {
                    ispis = '<tr><td colspan="4" class="text-danger">Odaberite pitanje odgovora</td></tr>'
                    $('#tabelaOdgovori').html(ispis)
                }
            })
        }
    })

    //BRISANJE ODGOVORA

    $(document).on('click',".btnDeleteAnswer", function (e) {
        e.preventDefault()
        var idOdg = $(this).data('id')
        var idPitanja = $("#ddlPitanja").val()
        $.ajax({
            url:'modules/adminAnketa.php',
            method: "POST",
            dataType:"json",
            data:{
                "deleteAnswer":"da",
                idOdg,
                idPitanja
            },
            success:function (data) {
                var ispis = '<tr class="thead-dark">\n' +
                    '                    <th>RB</th>\n' +
                    '                    <th>ID</th>\n' +
                    '                    <th>ODGOVOR</th>\n' +
                    '                    <th>OBRIŠI</th>'+
                    '                </tr>'
                $.each(data,function (i,e) {
                    ispis += '<tr>\n' +
                        '    <td>'+(i+1)+'</td>\n' +
                        '    <td>'+e.id_odgovor+'</td>\n' +
                        '    <td>'+e.odgovor+'</td>\n' +
                        '    <td><a href="#" class="btn btn-danger btnDeleteAnswer" data-id="'+e.id_odgovor+'">Obrisi</a></td>\n' +
                        '</tr>'
                })
                $('#tabelaOdgovori').html(ispis)
            },
            error:function (xhr,status,error) {
                var ispis = '<tr class="thead-dark">\n' +
                    '                    <th>RB</th>\n' +
                    '                    <th>ID</th>\n' +
                    '                    <th>ODGOVOR</th>\n' +
                    '                    <th>OBRIŠI</th>'+
                    '                </tr>'+
                 '<tr><td colspan="4" class="text-danger">Nema više odgovora na pitanja</td></tr>'
                $('#tabelaOdgovori').html(ispis)
            }
        })
    })

    //FUNKCIJA KOJA DOHVATA NANOVO PITANJA I UPPISUJE IH U DROP DOWN LISTU UKOLIKO SE UNESE ILI OBRISE NEKO PITANJE

    function dohvatiPitanja() {
        $.ajax({
            url:'modules/adminAnketa.php',
            method: "POST",
            dataType:"json",
            data:{
                "deleteAnswer":"da",
                idOdg,
                idPitanja
            },
            success:function (data) {
                var ispis = '<tr class="thead-dark">\n' +
                    '                    <th>RB</th>\n' +
                    '                    <th>ID</th>\n' +
                    '                    <th>ODGOVOR</th>\n' +
                    '                    <th>OBRIŠI</th>'+
                    '                </tr>'
                $.each(data,function (i,e) {
                    ispis += '<tr>\n' +
                        '    <td>'+(i+1)+'</td>\n' +
                        '    <td>'+e.id_odgovor+'</td>\n' +
                        '    <td>'+e.odgovor+'</td>\n' +
                        '    <td><a href="#" class="btn btn-danger btnDeleteAnswer" data-id="'+e.id_odgovor+'">Obrisi</a></td>\n' +
                        '</tr>'
                })
                $('#tabelaOdgovori').html(ispis)
            },
            error:function (xhr,status,error) {
                var ispis = '<tr class="thead-dark">\n' +
                    '                    <th>RB</th>\n' +
                    '                    <th>ID</th>\n' +
                    '                    <th>ODGOVOR</th>\n' +
                    '                    <th>OBRIŠI</th>'+
                    '                </tr>'+
                    '<tr><td colspan="4" class="text-danger">Nema više odgovora na pitanja</td></tr>'
                $('#tabelaOdgovori').html(ispis)
            }
        })
    }
})