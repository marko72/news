$(document).ready(function () {
    $(document).on("click",".btnGetNews",function (e) {
    e.preventDefault()
    var idNews = $(this).data("id");
    $.ajax({
        url:'modules/adminNews.php',
        method: "POST",
        dataType:"json",
        data:{
            "getNews":"da",
            idNews
        },
        success:function (data) {
            $("#tbNaslov").val(data.naslov)
            $(".richText-editor").html(data.tekst);
            $("#btnInsertUpdate").attr("value","Izmeni vest");
            $("#btnInsertUpdate").attr("name","btnIzmeni");
            $("#ddlKat").val(data.kategorija_id)
            var idVest = data.id_vest
            $("#idVest").attr("value", idVest);
            $("#formNews").attr("action", "modules/insertNews.php");
            alert("Uspesno dohvacena vest");
        },
        error:function () {
            alert("Doslo je do greske prilikom dohvatanja podataka o korisniku!")
        }
    })
})


    $(document).on('click',".btnDeleteNews", function (e) {
        e.preventDefault()
        var idVest = $(this).data("id");
        $.ajax({
            url:'modules/adminNews.php',
            method: "POST",
            dataType:"json",
            data:{
                "delNews":"da",
                idVest
            },
            success:function (data) {
                var ispis ='<tr class="thead-dark">\n' +
                    '                    <th>RB</th>\n' +
                    '                    <th>Naslov</th>\n' +
                    '                    <th>Tekst</th>\n' +
                    '                    <th>Slika</th>' +
                    '                    <th>Kategorija</th>'+
                    '                    <th>Postavio</th>\n' +
                    '                    <th>UPDATE</th>\n' +
                    '                    <th>DELETE</th>\n' +
                    '                </tr>'
                $.each(data,function (i,e) {
                    ispis+= '<tr>\n' +
                        '     <td>'+(i+1)+'</td>\n' +
                        '     <td>'+e.naslov+'</td>\n' +
                        '     <td><div style="width:100%; max-height:250px; overflow:auto">'+e.tekst+'</div></td>\n' +
                        '     <td>\n' +
                        '         <img src="images/news/'+e.putanja+'" alt="'+e.alt+'" class="img-thumbnail">\n' +
                        '     </td>\n' +
                        '     <td>'+e.naziv+'</td>'+
                        '     <td>'+e.ime+' '+e.prezime+'</td>\n' +
                        '     <td><a href="#" name="btnGetNews" class="btnGetNews btn btn-primary btnGetUser" data-id="'+e.id_vest+'">Izmeni</a></td>\n' +
                        '     <td><a href="#" name="btnDeleteNews" class="btnDeleteNews btn btn-danger btnDeleteUser" data-id="'+e.id_vest+'">Obriši</a></td>\n' +
                        ' </tr>'
                })
                $("#tabela-vesti").html(ispis)
            },
            error:function () {
                alert("Vest nije obrisana!")
            }
        })
    })
})