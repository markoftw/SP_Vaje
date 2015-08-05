$(document).ready(function(){
        
    function nl2br(str, is_xhtml) {   
        var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
    }
    
    function getParameterByName(name) {
        var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
        return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
    }
    var USER = $("#user").val();
    var UporIme = $("#uporIme").text();
    /*$("#VsiKomentarji").load("komentarji.php?user=" + USER + "&id=" + getParameterByName("id"));*/
    
    function loadComments(){
        $.ajax({
            method: "GET",
            url: "restful.php",
            data: $.param({
                'komentarji'    : getParameterByName("id")
            })
        }).done(function(data){
            for(var i = 0; i < data.length; i++){
                if(UporIme === data[i].uporabnik_id){
                    $("#VsiKomentarji").append('<div style="color:cyan;font-size:1em;">'+ data[i].uporabnik_id +'<span style="color:black;"> - Ocena: '+ (data[i].ocena > 0 ? Math.round((data[i].ocena / data[i].st_ocen)*100)/ 100 : "0.00") +'</span> <button id="odstrani" value="'+data[i].id+'">Odstrani</button><button id="uredi" value="'+data[i].id+'">Uredi</button></div>');
                } else {
                    $("#VsiKomentarji").append('<div style="color:cyan;font-size:1em;">'+ data[i].uporabnik_id +'<span style="color:black;"> - Ocena: '+ (data[i].ocena > 0 ? Math.round((data[i].ocena / data[i].st_ocen)*100)/ 100 : "0.00") +'</span></div>');   
                }
                $("#VsiKomentarji").append('<form name="oceniKomentar" action="index.php?stran=oglas&id='+ getParameterByName("id") +'" method="POST"><input type="radio" name="ocena1" value="1">1<input type="radio" name="ocena1" value="2">2<input type="radio" name="ocena1" value="3" checked>3<input type="radio" name="ocena1" value="4">4<input type="radio" name="ocena1" value="5">5<input type="hidden" name="komentar" value="'+ data[i].id +'"><input type="submit" name="OceniKomentar" value="Oceni"></form>');
                $("#VsiKomentarji").append('<br/>'+ nl2br(data[i].komentar) +'<br/><hr>');
            }
        });
    }
    loadComments();
    
    $("#komentiraj").click(function(e){
        $('#komentiraj').attr("disabled", "disabled");
        var empty = false;
        if (!$.trim($("#komentar").val())) {
            empty = true;
        }
        if (empty) {
            alert("Polje je prazno!");
            $('#komentiraj').removeAttr("disabled", "disabled");
        } else {
            var Komentar = $("#komentar").val();
            var ID = getParameterByName("id");
            $.ajax({
                method: "POST",
                url: "restful.php",
                data: { Message:Komentar, ID:ID, USER:USER }
            }).done(function(){
                $("#komentar").val("");
                $('#komentiraj').removeAttr("disabled", "disabled");
                $("#VsiKomentarji").empty();
                loadComments();
                //alert("Komentar objavljen!");
            });
        }
    });
    
    $(document).on('click', '#odstrani', function() {
        var Komentar = $(this).attr("value");
        var ID = getParameterByName("id");
        $.ajax({
            method: "DELETE",
            url: "restful.php",
            data: $.param({
                'id' : Komentar
            })
        }).done(function(){
            $("#VsiKomentarji").empty();
            loadComments();
        });
    });
    $(document).on('click', '#uredi', function() {
        var KomentarID = $(this).attr("value");
        $.ajax({
            method: "GET",
            url: "restful.php",
            data: $.param({
                'komentar' : KomentarID 
            })
        }).done(function(data){
            $("#urejanje").append('<form>');
            $("#urejanje form").append('<br/><div>Uredi komentar</div>');
            $("#urejanje form").append('<textarea rows="7" cols="70" id="komentar1">'+ data.komentar +'</textarea><br>');
            $("#urejanje form").append('<input type="button" id="save" value="Shrani"/><br/><br/><br/>');
        });
        
        $(document).on('click', '#save', function() {
            var Komentar = $("#komentar1").val();
            $.ajax({
                method: "POST",
                url: "restful.php",
                data: { UrediID:KomentarID, Komentar:Komentar }
            }).done(function(){
                $("#urejanje").empty();
                $("#VsiKomentarji").empty();
                loadComments();
            });
        });
    });
});