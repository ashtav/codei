const BASEURL = window.location.origin+'/codei'

function _baseUrl(app){
    return BASEURL+'/'+app
}

const spin = '<i class="fa fa-spin fa-spinner"></i>'

var interval;
function timer(time, callback){
    interval = setInterval(function(){
        time -= 1; time <= 0 && clearInterval(interval) | callback()
    }, 1000);
}

// toast('message')
function toast(msg){
    if( msg == undefined ){ msg = '' }
    $('.fn-toast').remove();
    $('body').append( '<div class="fn-toast toastSlide"> '+msg+' </div>' );
  
    clearInterval(interval);
    timer(5, function(){
      $('.fn-toast').fadeOut(500);
    });
}

// to('/dashboard')
function to(url, time = 10){
    setTimeout(function(){
      location.href = url;
    }, time);
}

function reload(time = 700){
    setTimeout(function(){
      location.reload();
    }, time);
}

function consl(value){
    console.log(value)
}

class Fn{

    constructor() {
        
    }

    request(params = {}){
        
        // properties required
        let required = ['url']
        
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

        if(params.data == null){

            $.ajax({
                url: _baseUrl(params.url),
                type: params.method || 'post',
                success: (res) => {
                    _setDefaultButton()
                    if(params.success != null) params.success(res) 
                }, 
                error: (err) => {
                    _setDefaultButton()

                    if(params.error != null){
                        params.error(err)
                    }else{
                        console.log(err)
                        toast(err.statusText)
                    }
                }
            });

        }else{
        
            $.ajax({
                url: _baseUrl(params.url),
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

    confirm(params = {}){

        $('.popup-confirmation').remove()

        $('body').append(
            `
                <div class="popup-confirmation">
                    <div class="backdrop" onclick="$('.popup-confirmation').fadeOut(300)"></div>
                    <div class="popup-content">

                        <div class="message">
                            `+(params.message || '')+`
                        </div>

                        <div class="control">
                            <button onclick="$('.popup-confirmation').fadeOut(300)">Batal</button>
                            <button id="__confirm">`+(params.textConfirm || 'Confirm')+`</button>
                        </div>
                    </div>
                </div>
            `
        )

        $('#__confirm').click(params.confirm.bind(params, $('#__confirm')))
    }

    modal(params = {}){
        if(params.id == null) throw('modal id is required.')

        let mod = $('#'+params.id)

        mod.modal('show') // show modal

        mod.find('.modal-title').html((params.title || 'Title'))

        if(params.data != null){
            mod.find('input').each(function(){ // loop setiap input
                let nameAttr = $(this).attr('name'),
                    type = $(this).attr('type')

                // check input type
                switch (type) {
                    case 'radio':
                        $(this).each(function(){
                            let radioValue = $(this).val();
                            if(radioValue == params.data[nameAttr]){
                                $(this).prop('checked',true)
                            }
                        })
                        break;
                
                    default:
                        if(type != 'file'){
                            if(params.data[nameAttr] != null){
                                $(this).val(params.data[nameAttr])
                            }
                        }

                        break;
                }
            })

            mod.find('select').each(function(){ // loop setiap select
                let nameAttr = $(this).attr('name')
                if(params.data[nameAttr] != null){
                    $(this).val(params.data[nameAttr])
                }
            });
        }else{
            mod.find('form')[0].reset()
        }

        mod.find('form').submit(params.submit.bind(params, mod))

        if(params.script != null){
            params.script(mod)
        }

    }

    onFile(input, id){

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
              $('#'+id).attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    // dataURLtoFile('base64:blabla','file.png')
    dataURLtoFile(dataurl, filename) {
        var arr = dataurl.split(','),
            mime = arr[0].match(/:(.*?);/)[1],
            bstr = atob(arr[1]), 
            n = bstr.length, 
            u8arr = new Uint8Array(n);
            
        while(n--){
            u8arr[n] = bstr.charCodeAt(n);
        }
        
        return new File([u8arr], filename, {type:mime});
    }

    ucwords(str, firstOnly){
        if(firstOnly == null){
            return str.replace(/\b[a-z]/g, (letter) => {
                return letter.toUpperCase();
            });
        }else{
            return str.toLowerCase().replace(/\b[a-z]/g, (letter) => {
                return letter.toUpperCase();
            });
        }
    }


}

let fn = new Fn()