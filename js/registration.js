$(document).ready(function () {
    $("#btnReg").click(function (e) {
        proveriPodatke(e);
    })
    $("#btnUpdate").click(function (e) {
        proveriPodatke(e,1);
    })



})

function proveriPodatke(e,izmena=0) {
    e.preventDefault()
    var ime = $("#tbFirstName").val()
    var prezime = $("#tbLastName").val()
    var username = $("#tbUsername").val()
    var email = $("#tbEmail").val()
    var greske =[]
    var paternImePrezime = /^[A-ZŠĐŽĆČ][a-zšđćžč]{2,13}(\s[A-ZŠĐŽĆČ][a-zšđćžč]{2,13}){0,2}$/;
    var paternEmail = /^[A-z]{3,13}((\_|\.){0,1}[0-9]{0,4}){0,2}((\.|\_){0,1}[A-z]{3,13}){0,2}((\.|\_){0,1}[0-9]{0,4}){0,2}\@(gmail|ymail|yahoo|rocketmail|outlock)\.(com|net|rs|fr|it)$/;
    var paternPasswd = /[\w\S]{5,}[\d]{1,10}/;
    var paternUser = /^[A-z]{3,12}[0-9]{0,8}(((\_|\.|\-)|\_{0,3})([A-z]{1,12}|[0-9]{1,8}){1,2}){0,2}$/;

    if(!paternImePrezime.test(ime)){
        greske.push("Ime nije u skladu sa paternom")
        $("#invalid-name").html("Ime nije u skladu sa pravilima")
    }
    else {
        $("#invalid-name").html("")
    }
    if(!paternImePrezime.test(prezime)){
        greske.push("Prezime nije u skladu sa paternom")
        $("#invalid-Lname").html("Prezime nije u skladu sa pravilima")
    }
    else {
        $("#invalid-Lname").html("")
    }
    if(!paternUser.test(username)){
        greske.push("Username nije u formatu kakvom bi trebalo da bude")
        $("#invalid-username").html("Username moze sadrzati slova, brojeve, _, ., -, a ne sme imati razmake")
    }else{
        $("#invalid-username").html("")
    }
    if(!paternEmail.test(email)){
        greske.push("Email nije u skladu sa paternom")
        $("#invalid-email").html("Email mora biti u formatu example@gamil.com")
    }else{
        $("#invalid-email").html("")
    }
    if(greske.length==0){
        if(izmena==1){
            var idKor = $("#idKor").val()
            var currPass = $("#currPass").val()
            var data = {
                poslato : "da",
                ime,
                prezime,
                email,
                username,
                idKor,
                currPass,
                izmena
            };
            posaljiPodatke(data)
        }else {
            var passwd = $("#tbPasswd").val()
            var data = {
                poslato : "da",
                ime,
                prezime,
                email,
                passwd,
                username
            };
            posaljiPodatke(data)
        }
    }
}
function posaljiPodatke(data) {
    $.ajax({
        url:"modules/registration.php",
        type:"post",
        data: data,
        success:function (data,status, xhr) {
            if(xhr.status==201){
                alert("Uspesno ste se registrovali")
            }else {
                alert("Uspesna izmena!")
                $("#poruka").html('Izlogujte se da bi se sacuvali novi podaci')
            }
        },
        error:function (status, xhr, error) {
            alert("Korisnik nije unet, greska: "+xhr.status)
        }
    })
}