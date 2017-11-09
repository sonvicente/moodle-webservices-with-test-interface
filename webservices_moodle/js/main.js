/*-------------------------------------------
	Main scripts
---------------------------------------------*/
/*
 *  Function for load content from url and put in $('#ajax-content') block
 */
function LoadAjaxContent(url){
	$('.preloader').show();
         
	$.ajax({
		mimeType: 'text/html; charset=utf-8', /*  set mimeType only when run from local file */
		url: 'webservices/'+url+'.html',
		type: 'POST',
                data: {i: 2},
		success: function(data) {                   
                    $('#ajax-content').html(data);
                    $('.preloader').hide();    
		},
		error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
		},
		dataType: "html",
	});
               
}

/*
 *  Function for load jeson response from url and put in $('#json-content') block
 */
function LoadJsonContent(form_data,url){
    
        console.log(url);
    
	$('.preloader').show();
        
        $.ajax({
                  url: 'webservices/'+url
                , mimeType: 'text/html; charset=utf-8'
                , dataType: 'html'
                , cache: false
                , contentType: false
                , processData: false
                , data: form_data
                , type: 'post'            
                , success: function(data) {
                    
                    var obj = JSON.parse(data);
                    var str = JSON.stringify(obj, undefined, 4);

                    /*
                     * $('#json-content').html(str);
                     * 
                     * output(str);
                     */
                    output(syntaxHighlight(str));
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
        });
         
	
}

function output(inp) {
    $('#json-content').html(inp);
}

function syntaxHighlight(json) {
    json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
        var cls = 'number';
        if (/^"/.test(match)) {
            if (/:$/.test(match)) {
                cls = 'key';
            } else {
                cls = 'string';
            }
        } else if (/true|false/.test(match)) {
            cls = 'boolean';
        } else if (/null/.test(match)) {
            cls = 'null';
        }
        return '<span class="' + cls + '">' + match + '</span>';
    });
}

/* --------------------------------------------
 * --------------------------------------------
 *         MAIN DOCUMENT READY SCRIPT
 * --------------------------------------------
 * --------------------------------------------*/
$(document).ready(function () {    
    
    var ajax_url = location.hash.replace(/^#/, '');
    if (ajax_url.length < 1) {
        ajax_url = 'core_course_create_courses';
    }
    $('.list-group-item').removeClass('active');
    $('.list-group-item[href="'+ajax_url+'"]').addClass('active');
    LoadAjaxContent(ajax_url);
    
    $(".list-group-item").click(function(e) {
        e.preventDefault();
        $('.list-group-item').removeClass('active');
        $(this).addClass('active');
        $('#json-content').html('');

        var url = $(this).attr('href');
        window.location.hash = url;
        LoadAjaxContent(url);
    });
    
    /* -- */
    $('body').on('click', 'a.action-link', function(e){

        e.preventDefault();
        $('.preloader').show();

        var url         = $(this).attr('href');
        var srt_edit_id = $(this).attr('rel');                

        $('.preloader').show();

        $.ajax({
                mimeType: 'text/html; charset=utf-8', /*  set mimeType only when run from local file */
                url: url,
                data:  'srt_edit_id='+ srt_edit_id,
                type: 'POST',
                success: function(data) {
                        $('#ajax-content').html(data);
                        $('.preloader').hide();
                        $('.preloader .alert').remove();                        
                },
                error: function (jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                },
                dataType: 'html'
                /* ,async: false */
        });
    }).on('click', '#button-form-send', function(e){
        e.preventDefault();
        
        var form  = $('#form');
        var url   = form.attr('action')+'.php'; 
        
        var form_data = new FormData();           
        var data = $(form).serializeArray();
        $.each(data,function(key,input){
            form_data.append(input.name,input.value);
        });

        LoadJsonContent(form_data,url);
    });
});