const spin = '<i class="fa fa-spin fa-spinner"></i>',
    pencil = '<i class="fa fa-pencil"></i>',
    trash = '<i class="fa fa-trash"></i>',
    plus = '<i class="fa fa-plus"></i>';

$(document).ready(function(){
  $('input[type=tel]').on('keypress', function(e){
    if (e.which != 8 && e.which != 0 && e.which < 48 || e.which > 57) {
      e.preventDefault();
    }
  })
});

$.fn.par = function(num) {
    var elem = [];
    this.each(function() {
        var el = this;
        while (num > 0) {
        if (el.parentNode) el = el.parentNode;
        num--;
        }
        elem.push(el);
    });
    return $(elem || this);
};

$.fn.dist = function(){
  $(this).prop('disabled', true);
}

$.fn.disf = function(){
  $(this).prop('disabled', false);
}

var interval;
function timer(time, callback){
    interval = setInterval(function(){
        time -= 1; time <= 0 && clearInterval(interval) | callback()
    }, 1000);
}

function toast(msg){
  if( msg == undefined ){ msg = '' }
  $('.fn-toast').remove(); var time = 5;
  $('body').append( '<div class="fn-toast toastSlide"> '+msg+' </div>' );

  clearInterval(interval);
  timer(5, function(){
    $('.fn-toast').fadeOut(500);
  });
}

function refresh(time = 700){
  setTimeout(function(){
    location.reload();
  }, time);
}

function goto(url, time = 700){
  setTimeout(function(){
    location.href = url;
  }, time);
}

function setImg(input, el){
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $(el).attr('src', e.target.result)
    }
    reader.readAsDataURL(input.files[0]);
  }
}

// each select option
$.fn.setOption = function(data) {
  $(this).each(function(){
    $(this).removeAttr('selected');
    if( $(this).attr('value') == data ){
      $(this).attr('selected', 'selected');
    }
  });
}

// Fn Class
class Fn {
  constructor() {
    this.public_id, this.el, this.url, this.successMsg;
  }

  // create
  new(el, params){
    let btn = $(el).find('button:submit'), btnLabel = btn.html();
    btn.html(spin).dist();

    $.ajax({
      url: params.url,
      type: 'post', data: new FormData($(el)[0]),
      contentType: false, processData: false,
      success: function(res){
        toast(params.successMsg ? params.successMsg : 'Success');
        refresh();
      }, error: function(err){
        toast(err.status+' - '+err.statusText);
        btn.html(btnLabel).disf();
      }
    });
  }

  // update
  get(el, url, mod){
    let btn = $(el), btnLabel = $(el).html(), data = false;
    btn.html(spin).dist();

    $.ajax({
      url: url, async: false,
      success: function(res){
        data = res;
        let json = JSON.parse(res);

        Object.keys(json).forEach(function(key) {
          let inp = mod.find('input[name='+key+'], select[name='+key+']');
          switch (inp.attr('type')) {
            case 'text': case 'tel': case 'number': case 'email':
              inp.val(json[key]); break;

            default: if(inp.attr('type') != 'file') inp.val(json[key]); break;
          }
        });

        btn.html(btnLabel).disf();
      }, error: function(err){
        toast(err.status+' - '+err.statusText);
        btn.html(btnLabel).disf();
      }
    });

    return JSON.parse(data);
  }

  edit(params){
    params.form.setAttribute('onsubmit','return fn.update(this)');
    this.url = params.url;
    this.successMsg = params.successMsg ? params.successMsg : 'Success';
  }

  update(f){
    let btn = $(f).find('button:submit'), btnLabel = btn.html(), self = this;
    btn.html(spin).dist();

    $.ajax({
      url: this.url,
      type: 'post', data: new FormData($(f)[0]),
      contentType: false, processData: false,
      success: function(res){
        toast(self.successMsg);
        refresh();
      }, error: function(err){
        toast(err.status+' - '+err.statusText);
        btn.html(btnLabel).disf();
      }
    });

    return false;
  }

  // delete
  del(params){
    let msg = !params.message ? 'Are you sure want to delete this data?' : params.message;
    let cancel = !params.cancel ? 'Cancel' : params.cancel;
    let ok = !params.ok ? 'Yes' : params.ok;

    this.url = params.url;
    this.successMsg = params.successMsg ? params.successMsg : 'Success';

    $('body').append(
      '<div class="xlert">' +
        '<div class="xlert-body">' +
          '<div class="message">'+ msg +'</div>' +
          '<div class="control text-right">' +
            '<button type="button" class="btn btn-outline-secondary" onclick="$(\'.xlert\').remove()">'+ cancel +'</button> ' +
            '<button type="button" class="btn btn-outline-danger" onclick="fn._del(this)">'+ ok +'</button>' +
          '</div>' +
        '</div>' +
      '</div>'
    ); $('.xlert-body').hide().fadeIn(300);
  }

  _del(a){
    let btn = $(a), btnLabel = $(a).html(), self = this;
    btn.html(spin).dist();

    $.ajax({
      url: this.url,
      success: function(){
        toast(self.successMsg);
        refresh();
      }, error: function(err){
        toast(err.status+' - '+err.statusText);
        btn.html(btnLabel).disf();
      }
    });
  }

}

const fn = new Fn();

function example(f){
  let btn = $(f).find('button:submit'), btnDefault = btn.html();
  btn.html(spin).dist();

  $.ajax({
    url: 'controller/method/params',
    type: 'post', data: new FormData($(f)[0]),
    contentType: false, processData: false,
    success: function(res){

    }, error: function(err){
      toast(err.status+' - '+err.statusText);
      btn.html(spin).disf();

    }
  });

  return false;
}
