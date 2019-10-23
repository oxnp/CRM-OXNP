$(document).ready(function(){
    /*Edit forms fields*/
    $('a.edit_fields').click(function(){
        $(this).hide();
        var bl = $(this).closest('.whbg');
        bl.find('a.save_fields').show();
        bl.find('input').removeAttr('readonly');
        bl.find('select').removeAttr('readonly');
        bl.find('select').removeAttr('disabled');
        bl.find('textarea').removeAttr('readonly');
    });
    $('a.save_fields').click(function(){
        var form = $(this).closest('form');
        var bl = $(this).closest('.whbg');
        form.find('select').removeAttr('disabled');
        $.ajax({
            type:"POST",
            url:form.attr('action'),
            data:form.serialize(),
            dataType:"html",
            beforeSend: function(){
                bl.find('a.loader').show();
                bl.find('a.save_fields').hide();
            },
            success: function(data){
                form.find('select').attr('disabled','disabled');
                $('.global_success').addClass('vis');
                bl.find('a.loader').hide();
                bl.find('a.edit_fields').show();
                bl.find('input').attr('readonly','readonly');
                bl.find('select').attr('readonly','readonly');
                bl.find('textarea').attr('readonly','readonly');
                setTimeout(function(){
                    $('.global_success').removeClass('vis');
                },3000)
            }
        })
    });
    /*End edit form fields*/

    /*Project menu*/
    let i = 1;
    $('ul.project_menu>li a[href="#"]').click(function(){
        $(this).next('ul').addClass('vis');
        $(this).closest('.project_menu').addClass('level'+i+'');
        i++;
    });
    $('ul.project_menu a.goback').click(function(){
        i--;
        $(this).closest('.project_menu').removeClass('level'+i+'');
        $(this).parent().removeClass('vis');
    });
    let a = 1;
    $('ul.sprint_menu>li a[href="#"]').click(function(){
        $(this).next('ul').addClass('vis');
        $(this).closest('.sprint_menu').addClass('level'+a+'');
        a++;
    });
    $('ul.sprint_menu a.goback').click(function(){
        a--;
        $(this).closest('.sprint_menu').removeClass('level'+a+'');
        $(this).parent().removeClass('vis');
    });
    $('.leftfix .sort input#sort').change(function(){
        if($(this).is(":checked")){
            $('ul.sprint_menu').show();
            $('ul.project_menu').hide();
        }else{
            $('ul.sprint_menu').hide();
            $('ul.project_menu').show();
        }
    });
    $('.leftfix li.list.files>span').click(function(){
        $('.leftfix li.list.files>span.op').not(this).next('ul').slideToggle();
        $('.leftfix li.list.files>span').not(this).removeClass('op');
        $(this).toggleClass('op');
        $(this).next('ul').slideToggle();
    });
    /*End Project menu*/

    /*Global*/
    $('select').change(function(){
      $(this).blur();
    });
    $('select[readonly="readonly"]').click(function(e){
        e.preventDefault();
    });
    /*End global*/
})