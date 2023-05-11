var app = {
    counter: function(){
        $('#counter').countdown({
            image: 'img/digits.png',
            startTime: '18 54 00'
        });
    },
    fancy: function(){
        //fancybox
        $('.bye_link, .review-add-button').fancybox({
            padding: '0'
        });
        $('#privacy-policy').fancybox();
    },
    voiting: function(){
        $('.vbl-stars').rating({
            fx: 'float',
            image: '../../../img/stars1.png',
            loader: '../../../img/ajax-loader.gif',
            minimal: 0.6,
            //url: 'rating.php',
            click: function(){
                var tv = $('.vbl-total-voiters span').text();
                $('.vbl-total-voiters span').text(++tv);

                $('.vbl-thanks').css({"visibility":"visible"});
            },
            callback: function(responce){
                alert(1);
                this.vote_success.fadeOut(2000);
                if(responce.msg) alert(responce.msg);
            }
        });
    },
    maskinput: function(){
        $('input[name="_phone"]').mask("+7(999) 999-99-99");
    },
    init: function(){
        this.counter();
        this.fancy();
        this.maskinput();
        this.voiting();
    }
};

$(document).ready(function(){

    app.init();

    // ���������� ������
    $('a.scrollTop').on('click', function (e) {
        e.preventDefault();
        var target = this.hash,
            $target = $(target);
        $('html, body').animate({
            'scrollTop': $target.offset().top - 50
        }, 900, 'swing', function () {
            window.location.hash = target;
        });
    });

    // �����
    $('.form-arrow, input[name=_method]').click(function(){
        $('.select-up').toggle();
    });

    // �������� ������
    var stopSend = false;
    $('.rbu-send img').click(function(e){
        $(".rbu-input").each(function(index, el){
            if ($.trim($(el).val()) == '')
            {
                stopSend = true;
            }
        });

        if (stopSend){
            alert("�� �� ����� ��� ��� ���� ������");
        }else{
            $.fancybox.open($('.sendSuccess'));
        }

        stopSend = false;
    });

    // �������� ������ ��������
    $('.select-up ul li').click(function(){
        var methodVal = $(this).text();
        $('input[name="_method"]').val(methodVal);
        //$(this).parent('.select-up').hide();
        $('.select-up').hide();
        $(this).closest('._method').find('.field-status').css({'visibility':'visible'}).attr('src', 'img/form_true.png');
        $('input[name="_method"]').css({'border':'none'});
    });

});

function toOrderForm(elId, caption, descr, cost, pid, note){
    // ����
    $('#order-block .right .right-block .new-price span').text(cost);
    // ��������
    $('#order-block .right .left-block .caption').text(caption);
    // ��������
    $('#order-block .right .left-block .sub-caption').text(descr);

    var oldPrice = cost * 1.25;
    oldPrice = (10 - (oldPrice % 10)) + oldPrice;
    // ������ ����
    $('#order-block .right .right-block .old-price').text(oldPrice);

    //id ������ � �����
    $("#order-form input[name='pid']").val(pid);
    // ����������
    $("#order-form input[name='note']").val(note);
    // ���� ������
    $("#order-form input[name='cost']").val(cost);
    // �������� ������
    $("#order-form input[name='prodName']").val(caption);
}

function addRating(el, elIncr) {
    var elVal;

    elVal = $(el).siblings('.'+elIncr).text();
    $(el).siblings('.'+elIncr).text(++elVal);
}

function checkForm(el){
    var reg;
    var fieldName = $(el).attr('name');

    switch(fieldName)
    {
        case '_name':
            reg = /[�-��-� ]{3,}/;
            break;
        case '_phone':
            reg = /^\+7 ?\(\d{3}\) ?\d{3}-?\d{2}-?\d{2}$/;
            break;
        case '_method':
            reg = /[�-��-� ]{10,}/;
            break;
    }


    // �������� �������� �����
    if ( reg.test($(el).val()))
    {
        $(el).removeClass('active');
        $(el).closest('.'+fieldName).find('.field-status').css({'visibility':'visible'}).attr('src', 'img/form_true.png');

        return '1';
    }else
    {
        $(el).addClass('active');
        $(el).closest('.'+fieldName).find('.field-status').css({'visibility':'visible'}).attr('src', 'img/form_false.png');

        return '-1';
    }

}

function sendOrder(){
    var error = false;

    var formName  = $('input[name="_name"]');
    var formPhone = $('input[name="_phone"]');
    var formMethod = $('input[name="_method"]');

    if (checkForm(formName)=='-1') error = true;
    if (checkForm(formPhone)=='-1') error = true;
   
    if (error) {
        return;
    } else {
        $('form#order-form').submit();
    }

}
$(function() {
 /* Кнопка наверх */
 $(window).scroll(function () {
    if ($(this).scrollTop() != 0)
       $('#toTop').fadeIn();
       else
       $('#toTop').fadeOut();
 });
 $('#toTop').click(function () {
    $('body,html').animate({
       scrollTop: 0
    }, 800);
 });
 
});

function fixedNav() {
    const nav = document.querySelector('nav')
    //тут указываем в пикселях, сколько нужно проскролить чтобы наше меню стало фиксированным
    const breakpoint = 1
    if (window.scrollY >= breakpoint) {
       nav.classList.add('fixed__nav')
    } else {
       nav.classList.remove('fixed__nav')
    }
 }
 window.addEventListener('scroll', fixedNav);
