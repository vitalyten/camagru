<?php
	session_start();
	include("header.php");
?>
<div id="content">
	<img src="img/ano.png" title="Ano" alt="ano" class="img" draggable="true" id="video_overlays">
	<div id="video">
		<canvas id="canvas"></canvas>
		<video poster="img/ano.png"></video>
	</div>
	<button id="pic">Take Picture</button>
	<div id="images">
		<img src="img/ano.png" title="Ano" alt="ano" class="img">
		<img src="img/chat.png" title="Chat" alt="chat" class="img">
		<img src="img/ele.png" title="ele" alt="ele" class="img">
	</div>
</div>
<script>
	var video = document.querySelector('video');
	var canvas = document.querySelector('canvas');
	var context = canvas.getContext('2d');
	var w, h, ratio;

	navigator.getMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia);
	navigator.getMedia(
		{video:true, audio:false},
		function (mediaStream) {
			// var video = document.getElementsByTagName('video')[0];
			video.src = window.URL.createObjectURL(mediaStream);
			video.play();
		},
		function (error) {
			console.log(error);
	});

	var pic = document.getElementById("video_overlays");
	pic.style.width = "400px";//video.videoWidth;
	// pic.style.height = video.videoHeight;
	console.log(video.videoWidth);

	document.getElementById("pic").addEventListener("click", function() {
		canvas.width = video.videoWidth;
		canvas.height = video.videoHeight;
		console.log(video.videoWidth);
		context.drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
		var data = encodeURIComponent(canvas.toDataURL());
		var xhr = new XMLHttpRequest();
		xhr.open("POST", "savepic.php", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
		xhr.onreadystatechange = function() {//Call a function when the state changes.
			if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
				// Request finished. Do processing here.
			}
		}
		xhr.send("pic=" + data);


		console.log("click");
	});
	console.log(video.videoWidth);


	// function startDrag(e) {// determine event object
	// 	if (!e) {
	// 		var e = window.event;
	// 	}

	// 	// IE uses srcElement, others use target
	// 	var targ = e.target ? e.target : e.srcElement;

	// 	if (targ.className != 'dragme') {return};
	// 	// calculate event X, Y coordinates
	// 	offsetX = e.clientX;
	// 	offsetY = e.clientY;

	// 	// assign default values for top and left properties
	// 	if (!targ.style.left) { targ.style.left='0px'};
	// 	if (!targ.style.top) { targ.style.top='0px'};

	// 	// calculate integer values for top and left
	// 	// properties
	// 	coordX = parseInt(targ.style.left);
	// 	coordY = parseInt(targ.style.top);
	// 	drag = true;

	// 	// move div element
	// 	document.onmousemove=dragDiv;
	// 	return false;
	// }

	// function dragDiv(e) {
	// 	if (!drag) {return};
	// 	if (!e) { var e= window.event};
	// 	var targ=e.target?e.target:e.srcElement;
	// 	// move div element
	// 	targ.style.left=coordX+e.clientX-offsetX+'px';
	// 	targ.style.top=coordY+e.clientY-offsetY+'px';
	// 	return false;
	// }

	// function stopDrag() {
	// 	drag=false;
	// }

	// window.onload = function() {
	// 	console.log("load");
	// 	document.onmousedown = startDrag;
	// 	document.onmouseup = stopDrag;
	// }

</script>
<?php
	include("footer.php");
?>
