/*
author: Vikesh Khanna
*/
var script = document.createElement('script');
script.src = "http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js";
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);

function S(id)
{
	return $("#" + id);
}

function hide(id, callback)
{
	S(id).fadeOut('slow', function() {
	 S(id).attr("display","none");
	 (callback ? callback() : 1);
	});
}

function show(id, callback)
{
	S(id).fadeIn('slow', function() {
	 S(id).attr("display","block");
	(callback ? callback() : 1);
	});
}

function replace(sid, hid)
{
	hide(hid, function()
		{
			show(sid);
		}	
	)
}

function request(url) {
    var xhr = new XMLHttpRequest();
    try {
        xhr.onreadystatechange = function(){
            if (xhr.readyState != 4)
                return;

            if (xhr.responseText) {
                console.debug(xhr.responseText);
            }
        }

        xhr.onerror = function(error) {
            console.debug(error);
        }

        xhr.open("GET", url, true);
        xhr.send(null);
    } catch(e) {
        console.error(e);
    }
}

