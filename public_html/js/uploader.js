/* 
version :0.1
requeriment: jquery.Jcrop.min.js
jquery.js




*/
$(document).ready(function() {

	if ($(".images_holder")[0]){
		
		var containerouter = document.createElement('div'); 
		containerouter.className= "upload_container_outer";
		
		var controlcarucel = document.createElement('div');
		controlcarucel.className = "control_lista-imagenes";
		
		var controlpreview = document.createElement('a');
		controlpreview.id = "prev";
		controlpreview.onclick = function() { 
		CarrucelPrevClick(); };
		
		var controlnext = document.createElement('a');
		controlnext.id = "next";
		controlnext.onclick = function() { 
		CarrucelNextClick(); };
		
		controlcarucel.appendChild(controlpreview);
		controlcarucel.appendChild(controlnext);
		//containerouter.appendChild(controlcarucel);
		$(".images_holder").append(controlcarucel);
		var containerinner = document.createElement('div'); 
		containerinner.className= "upload_container_inner";
		containerouter.appendChild(containerinner);
		
		var ul_images = document.createElement('ul'); 
		ul_images.className = "uploader_lista-imagenes";
		ul_images.id = "lista-imagenes";
		containerinner.appendChild(ul_images);
		
		
		
		
		$(".images_holder").append(containerouter);
		
		var containinput = document.createElement('div'); 
		containinput.className = "upload_container_input";
		
		var label_add_img = document.createElement('label'); 
		label_add_img.onclick = function() { 
		HandleUploadClick(); };
		
		var span_add_img = document.createElement('span'); 
		span_add_img.className = "uploader_btn";
		span_add_img.innerHTML = "+";
		
		label_add_img.appendChild(span_add_img);
		containinput.appendChild(label_add_img);
		
		
		var file_input = document.createElement('input'); 
		file_input.className = "uploader_oculto";
		file_input.id = "testinput";
		file_input.type = "file";
		file_input.name = "pic";
		file_input.accept = "image/*";
		file_input.onchange = function() { 
		addFile();
		this.value=null;
		return false;
		};
		
		containinput.appendChild(file_input);
		$(".images_holder").append(containinput);
		
		
		var containcropcontrols = document.createElement('div'); 
		containcropcontrols.className = "upload_container_crop_controls";
		
		var div_cortar = document.createElement('div'); 
		div_cortar.className = "uploader_modalDialog";
		div_cortar.id = "cortar";
		containcropcontrols.appendChild(div_cortar);
		
		
		var input_x = document.createElement('input'); 
		input_x.type = "hidden";
		input_x.id = "x";
		input_x.name = "x";
		containcropcontrols.appendChild(input_x);
		
		var input_y = document.createElement('input'); 
		input_y.type = "hidden";
		input_y.id = "y";
		input_y.name = "y";
		containcropcontrols.appendChild(input_y);
		
		var input_w = document.createElement('input'); 
		input_w.type = "hidden";
		input_w.id = "w";
		input_w.name = "w";
		containcropcontrols.appendChild(input_w);
		
		var input_h = document.createElement('input'); 
		input_h.type = "hidden";
		input_h.id = "h";
		input_h.name = "h";
		containcropcontrols.appendChild(input_h);
		
		var input_src = document.createElement('input'); 
		input_src.type = "hidden";
		input_src.id = "src";
		input_src.name = "src";
		containcropcontrols.appendChild(input_src);
		$(".images_holder").append(containcropcontrols);
		
		var divg = document.createElement('div'); 
		divg.id = ('inSide');
		var cerrar = document.createElement('a');
		cerrar.href = "#close";
		cerrar.className = "uploader_close";
		cerrar.innerHTML = "X";	
		cerrar.addEventListener('click', function(e) {  
				 	$.Jcrop('#modimagen').destroy();											   
					 $('#modimagencont').html("");
			         $('#divMod').html("");
					}, false);
		var divb = document.createElement('div'); 
		divb.style.clear = "both";
		divb.id = "divMod";
		var upload_img2  = document.createElement('div'); 
		upload_img2.id = "modimagencont";	
		cortar = document.getElementById('cortar');	
		divg.appendChild(cerrar);
		divg.appendChild(upload_img2);
		divg.appendChild(divb);
		cortar.appendChild(divg);	
		
	} 
	
});
function borrarBarras(){
	$( ".progresoCont" ).empty();
}
function HandleUploadClick(){
    var clickHandle = document.getElementById("testinput");
    clickHandle.click();
}
function showCoords(c){
	$('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
}
function addFile(){
	location.href = "#cortar";
	var file = document.getElementById('testinput').files[0];
	if ((/\.(jpg|png|gif|jpeg)$/i).test(file.name)) {
	if (file.size < 1024 * 1024 * 2) {
	if($('#progreso').length)
	{
		progresss = document.getElementById('uploader_progreso');
	}else
	{
	var progresss = document.createElement('div'); 
		progresss.className = "uploader_progreso";
		progresss.id = "uploader_progreso";
    var progressBarr = document.createElement('div'); 
		progressBarr.className = "uploader_barra";
		progressBarr.appendChild(progresss);
	var progreso = document.createElement('div');
		progreso.id = "progreso";
		progreso.className = "uploader_progresoCont";
		progreso.appendChild(progressBarr);
	var inSide = document.getElementById('inSide');
		inSide.appendChild(progreso);
	}
	var xhr = new XMLHttpRequest();
	var formData = new FormData();
	formData.append('file', file);
	xhr.open('POST', '/execution/fileuploader/');
	xhr.upload.onprogress = function (e) {
		
	if (e.lengthComputable) {	
		progresss.style.width=(e.loaded/e.total)*100+"%"; 
		}
	}
	xhr.upload.onloadstart = function (e) {
		$(".barra").value = 0;
	}
	xhr.upload.onloadend = function (e) {
		$(".barra").value = e.loaded;
	}
	xhr.onreadystatechange = function() {
	 if (xhr.readyState == 4 && xhr.status == 200) {
		borrarBarras(); 
		 if (xhr.responseText.substring(0, 5) != "Error") { 
			 $('#modimagencont').html('<img src="' + xhr.responseText + '" id="modimagen">');
			 $('.jcrop-holder').remove();
			 $('#modimagen').Jcrop({
             	bgColor: 'transparent',
				addClass: 'jcrop-centered',
				onSelect: showCoords,
           	 	onChange: showCoords,
				aspectRatio: 1,
			    setSelect: [ 0, 0,100, 100 ],
				minSize: [ 50,50 ],
				maxSize: [ 200,200 ]
        	 },function(){
				jcrop_api = this;
             });
			 $('#src').val(xhr.responseText);
			var divCortar = document.createElement('div'); 
				divCortar.className = ('uploader_guardar');	
				divCortar.innerHTML = ('guardar');
				divCortar.addEventListener('click', function(e) {  			    
					cropFile();
					}, false);
			var divCancelar = document.createElement('div'); 
				divCancelar.className = ('uploader_cancelar');	
				divCancelar.innerHTML = ('cancelar');
				divCancelar.addEventListener('click', function(e) {  
				     $.Jcrop('#modimagen').destroy();		
				 	 $('.jcrop-holder').remove();
					 $('#modimagencont').html("");
			         $('#divMod').html("");
					 location.href = "#close";	
					}, false);
			var divMod = document.getElementById('divMod'); 	
				divMod.appendChild(divCortar);
				divMod.appendChild(divCancelar);			 
		}
		}	
	}
	xhr.send(formData);
	} else { alert('Error, la imagen pesa mas de 2 mb'); }	
	} else { alert('Error, el archivo seleccionado no es una imagen valida'); }
 }
 
function cropFile(){
	var x = document.getElementById('x').value;
	var y = document.getElementById('y').value;
	var w = document.getElementById('w').value;
	var h = document.getElementById('h').value;
	var src = document.getElementById('src').value;
	var xhr2 = new XMLHttpRequest();
	var formData2 = new FormData();
	formData2.append('x', x);
	formData2.append('y', y);
	formData2.append('w', w);
	formData2.append('h', h);
	formData2.append('src', src);
	xhr2.open('POST', '/execution/filecrop/');
	xhr2.onreadystatechange = function() {
	 if (xhr2.readyState == 4 && xhr2.status == 200) {		 
		 if (xhr2.responseText.substring(0, 5) != "Error") {
		 
			AddImageUploader(xhr2.responseText);
			$.Jcrop('#modimagen').destroy();	
			 $('.jcrop-holder').remove();
			 $('#modimagencont').html("");
			 $('#divMod').html("");
			 location.href = "#close";	
		}
		}	
	}
	xhr2.send(formData2);
}

function AddImageUploader(path_url)
{
	var list = document.getElementById('lista-imagenes');
	var eliminar  = document.createElement('div'); 
	eliminar.innerHTML = "X";	
	eliminar.className = "uploader_eliminar";
	eliminar.addEventListener('click', function(e) 
	{ 
		this.parentNode.parentNode.removeChild(this.parentNode);
		if(parseFloat($( "#lista-imagenes" ).css('top')) < 0)
		{
			$( "#lista-imagenes" ).css('top', (parseFloat($( "#lista-imagenes" ).css('top')) + 120) + 'px');
		}
	}, false);
	var	row_img = document.createElement('li');	
	var upload_img  = document.createElement('div'); 
	upload_img.style.background = "url('"+ path_url +"')";
	upload_img.style.backgroundSize = "100px 100px";
	upload_img.className = "uploader_clasethumb";
	row_img.appendChild(upload_img);
	row_img.appendChild(eliminar);	
	list.appendChild(row_img);
		// add url value 
	var input_url = document.createElement('input'); 
	input_url.type = "hidden";
	input_url.id = "url_img[]";
	input_url.name = "url_img[]";
	input_url.value = "'"+ path_url +"'";
	row_img.appendChild(input_url);
	
}

function previewImgs()
{
	if (typeof pre_photos === 'undefined' || pre_photos === null) {
		return;
	}
		for (var i = 0; i < pre_photos.length; i++) {
			AddImageUploader(pre_photos[i]);
		}	
		$('#foundlost').val('<?php echo $foundlost; ?>');
		$('#item_category').val('<?php echo $item_category; ?>');
		$('#item_country').val('<?php echo $item_country; ?>');
		
}

function CarrucelNextClick()
{
	
	var count = $("#lista-imagenes li").size();
	var p = parseInt( $( "#lista-imagenes" ).css('top'));
	var topp = 0;
	if(count > 1)
	{
	if(p<= (count-1) * -120)
	{
		$('#lista-imagenes').animate({
		top: "+="+(count-1) * 120 }, 200, function() {
		// Animation complete.
			});
		}else
		{
			$('#lista-imagenes').animate({
		top: "-=120" }, 200, function() {
		// Animation complete.
	  });
		}
	}
}

function CarrucelPrevClick()
{
	var count = $("#lista-imagenes li").size();
	var p = parseInt( $( "#lista-imagenes" ).css('top'));
	var topp = 0;
	if(count > 1)
	{
		if(p>=0)
		{
			topp = -(count-1) * 120;
			$('#lista-imagenes').animate({
			top: "+="+topp }, 200, function() {
		// Animation complete.
			});
		}else
		{
			$('#lista-imagenes').animate({
		top: "+=120" }, 200, function() {
		// Animation complete.
		});
		}
	}
	
	 
}
 $(document).ready(function()
 {	
   previewImgs();
 });
