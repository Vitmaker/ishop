$(document).ready(function(){
    
    /* ===Аккордеон=== */
    var openItem = false;
	if(jQuery.cookie("openItem") && jQuery.cookie("openItem") != 'false'){
		openItem = parseInt(jQuery.cookie("openItem"));
	}	
	jQuery("#accordion").accordion({
		active: openItem,
		collapsible: true,
        autoHeight: false,
        header: 'h3'
	});
	jQuery("#accordion h3").click(function(){
		jQuery.cookie("openItem", jQuery("#accordion").accordion("option", "active"));
	});	
	jQuery("#accordion > li").click(function(){
		jQuery.cookie("openItem", null);
        var link = jQuery(this).find('a').attr('href');
        window.location = link;
	});
    /* ===Аккордеон=== */

    //Переключение видов категории
    if($.cookie('display') == null){
        $.cookie('display', 'grid');
    }

    $('.grid_list').click(function(){
        var display = $(this).attr('id');
        display = (display == 'grid') ? 'grid' : 'list';
        if(display == $.cookie('display')){
            return false;
        }else{
            $.cookie('display', display);
            window.location = '?' + query;
            return false;
        }
    });
    //Переключение видов категории

    // Авторизация через Ajax
    //$("#auth").click(function(e){
    //    e.preventDefault();
    //    var login = $("#login").val();
    //    var pass = $("#pass").val();
    //    var auth = $("#auth").val();
    //    console.log(login+' | '+pass+' | '+auth);
    //    $.ajax = ({
    //        url: './',
    //        type: 'POST',
    //        data: {auth: auth, login: login, pass: pass},
    //        success: function(res){
    //            console.log(res);
    //            if(res != 'Поля логин/пароль не заполнены.' && res != 'Введенные Вами данные неверны.'){
    //                $(".authform").hide().fadeIn(500).html(res + '<a href="?do=logout">Выйти</a>');
    //            } else{
    //                $(".error").remove();
    //                $(".authform").append('<div class="error"></div>');
    //                $(".error").hide().fadeIn(500).html(res);
    //            }
    //        },
    //        error: function(){
    //            alert("ERROR!");
    //        }
    //    });
    //
    //});
    // Авторизация через Ajax
});