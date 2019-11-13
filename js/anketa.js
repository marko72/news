$(document).on("click",".btnAnketa",function () {
    var odgovor = $(this).data('id')
    var idKor = $("#idKor").val()
    if(idKor==0){
        alert("Da bi ste mogli da glasate u anketi, morate se ulogovati");
    }else {
        $.ajax({
            url:"modules/anketa.php",
            type:"post",
            data:{
                poslato : "da",
                odgovor,
                idKor
            },
            success:function(data){
                alert("Vaš odgovor je sačuvan")
            },
            error:function (xhr) {
                alert("Vec ste odgovorili na ovu anketu")
            }
        })
    }
})