$(document).on("click","#btnComment",function (e) {
    e.preventDefault()
    var idKor = $("#btnComment").data('id')
    var tekst = $("#taKomentar").val()
    var idVest = $("#idVest").val()
    $.ajax({
        url:"modules/insertComment.php",
        method:"post",
        data:{
            'insertComm':"da",
            idKor,
            idVest,
            tekst
        },
        success:function (data,status,xhr) {
            console.log(data)
            var ispis = "";
            $.each(data,function (i,e) {
                ispis+=' <div class="row"> ' +
                    ' <div class="col-md-12 col-sm-12">\n' +
                    '                                <div class="panel panel-default arrow left">\n' +
                    '                                    <div class="panel-body">\n' +
                    '                                        <header class="text-left">\n' +
                    '                                            <div class="comment-user"><i class="fa fa-user"></i> '+e.username+'</div>\n' +
                    '                                            <time class="comment-date" datetime="'+e.date+'"><i class="fa fa-clock-o"></i> '+e.date+'</time>\n' +
                    '                                        </header>\n' +
                    '                                        <div class="comment-post">\n' +
                    '                                            <p>\n' +
                    '                                                '+e.tekst_komentara+'\n' +
                    '                                            </p>\n' +
                    '                                        </div>\n' +
                    '                                    </div>\n' +
                    '                                </div>\n' +
                    '                            </div>\n'+
                    '</div>'
            })
            ispis+='<div class="row">\n' +
                '                            <div class="col-md-12">\n' +
                '                                <form action="" class="">\n' +
                '                                    <div class="form-group row">\n' +
                '                                        <div class="col-md-12 justify-content-around">\n' +
                '                                            <input type="hidden" id="idVest" value="'+idVest+'">\n' +
                '                                            <textarea name="taKomentar" id="taKomentar" cols="30" rows="10" class="form-control"></textarea>\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                    <div class="form-group row">\n' +
                '                                        <div class=col-md12">\n' +
                '                                            <a href="#" id="btnComment" name="btnComment" class="btn btn-primary" data-id="'+idKor+'">Komentarisi</a>\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                </form>\n' +
                '                            </div>\n' +
                '                        </div>'
            $(".comment-list").html(ispis)
        },
        error:function (xhr, data, status) {
            alert("Greška pri komentarisanju!")
        }
    })
})