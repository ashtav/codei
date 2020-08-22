const spin = '<i class="fa fa-spin fa-spinner"></i>'

var interval;
function timer(time, callback){
    interval = setInterval(function(){
        time -= 1; time <= 0 && clearInterval(interval) | callback()
    }, 1000);
}

function toast(msg){
    if( msg == undefined ){ msg = '' }
    $('.fn-toast').remove();
    $('body').append( '<div class="fn-toast toastSlide"> '+msg+' </div>' );
  
    clearInterval(interval);
    timer(5, function(){
      $('.fn-toast').fadeOut(500);
    });
}

function to(url, time = 10){
    setTimeout(function(){
      location.href = url;
    }, time);
}

class Fn{

    constructor() {
        
    }

    signin(params = {}){
        
        // properties required
        let required = ['url','data']
        
        // check properties
        required.forEach((k) => {
            if(params[k] == null) throw(k+' is required.')
        })

        // animasi button submit
        let _btn

        if(params.spiner != null){
            _btn = $(params.spiner).html()
            $(params.spiner).html(spin).prop('disabled',true)
        }

        function _setDefaultButton(){
            if(params.spiner != null){
                $(params.spiner).html(_btn).prop('disabled',false)
            }
        }
        
        $.ajax({
            url: params.url,
            type: 'post', data: params.data,
            contentType: false, processData: false,
            success: (res) => {
                _setDefaultButton()
                if(params.success != null) params.success(res) 
            }, 
            error: (err) => {
                _setDefaultButton()

                if(params.error != null){
                    params.error(err)
                }else{
                    toast(err.statusText)
                }
            }
        });
    }

    create(params = {}){
        
        // properties required
        let required = ['url','data']
        
        // check properties
        required.forEach((k) => {
            if(params[k] == null) throw(k+' is required.')
        })

        // animasi button submit
        let _btn

        if(params.spiner != null){
            _btn = $(params.spiner).html()
            $(params.spiner).html(spin).prop('disabled',true)
        }

        function _setDefaultButton(){
            if(params.spiner != null){
                $(params.spiner).html(_btn).prop('disabled',false)
            }
        }
        
        $.ajax({
            url: params.url,
            type: 'post', data: params.data,
            contentType: false, processData: false,
            success: (res) => {
                _setDefaultButton()
                if(params.success != null) params.success(res) 
            }, 
            error: (err) => {
                _setDefaultButton()

                if(params.error != null){
                    params.error(err)
                }else{
                    toast(err.statusText)
                }
            }
        });
    }


}

let fn = new Fn()