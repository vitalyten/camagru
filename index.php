<?php
	session_start();
	include("header.php");
?>
<div id="content">
	<div id="video">
		<canvas id="canvas"></canvas>
		<video></video>
	</div>
	<button id="pic">Take Picture</button>
	<div id="images">
		<img src="img/ano.png" title="Ano" alt="ano" class="img">
		<img src="img/chat.png" title="Chat" alt="chat" class="img">
		<img src="img/ele.png" title="ele" alt="ele" class="img">
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
		})

		document.getElementById("pic").addEventListener("click", function() {
			canvas.width = video.videoWidth;
			canvas.height = video.videoHeight;
			context.drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
			var data = encodeURIComponent(canvas.toDataURL());
			// console.log(data);
			var xhr = new XMLHttpRequest();
			xhr.open("POST", "savepic.php", true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
			xhr.send("pic=" + data);

			// ratio = video.videoWidth / video.videoHeight;
			// w = video.videoWidth - 100;
			// h = parseInt(w / ratio, 10);
			// canvas.width = w;
			// canvas.height = h;
			// context.fillRect(0, 0, w, h);
			// canvas.style.display = "none";
			// var xhr = new XMLHttpRequest();
// xhr.open("POST", '/server', true);

//Send the proper header information along with the request
// xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

// xhr.onreadystatechange = function() {//Call a function when the state changes.
//     if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
//         // Request finished. Do processing here.
//     }
// }
// xhr.send("foo=bar&lorem=ipsum");
// xhr.send('string');
// xhr.send(new Blob());
// xhr.send(new Int8Array());
// xhr.send({ form: 'data' });
// xhr.send(document);



			console.log("click");
		});
	</script>
</div>
<?php
	include("footer.php");
?>
