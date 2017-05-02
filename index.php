<?php
	session_start();
	include("header.php");
?>
<div id="content">

	<div id="video" ondrop="drop(event)" ondragover="allowDrop(event)">
		<div id="test">
			<div id="super">
				<img id="video_overlays" draggable="true">
			</div>
			<video poster="img/ano.png"></video>
		</div>



		<canvas id="canvas"></canvas>

		<button id="pic">Take Picture</button>
		<div id="images">
			<?php
				$pics = scandir("img");
				foreach ($pics as $pic) {
					if (strpos($pic, ".png"))
						echo "<img src='img/".$pic."' class='img' draggable='false' onclick='usepic(this.src)'>";
				}
			?>
		</div>
	</div>
	<div>
		<img id="preview">
	</div>

</div>
<script>

function allowDrop(e) {
	e.preventDefault();
}

function usepic(pic) {
	console.log(pic);
	document.getElementById("video_overlays").src = pic;
}

function drop(e) {
	e.preventDefault();
	var img = document.getElementById("video_overlays");
	x = e.clientX;
	y = e.clientY;
	img.style.left = x + 'px';
	img.style.top = y + 'px';
}

var video = document.querySelector('video');
var canvas = document.querySelector('canvas');
var context = canvas.getContext('2d');
var pic = document.getElementById("video_overlays");

navigator.getMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia);
navigator.getMedia(
	{video:true, audio:false},
	function (mediaStream) {
		video.src = window.URL.createObjectURL(mediaStream);
		video.play();
	},
	function (error) {
		console.log(error);
});

document.getElementById("pic").addEventListener("click", function() {
	document.getElementById("preview").src = "";
	canvas.width = video.videoWidth;
	canvas.height = video.videoHeight;
	context.drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
	var data = encodeURIComponent(canvas.toDataURL());
	var xhr = new XMLHttpRequest();
	xhr.open("POST", "savepic.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
	xhr.onreadystatechange = function() {//Call a function when the state changes.
		if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
			document.getElementById("preview").src = "res.jpeg?" + new Date().getTime();
			console.log("click");
		}
	}
	console.log(pic.offsetLeft);
	console.log(pic.offsetTop);
	xhr.send("pic=" + data + "&top=" + pic.src + "&x=" + pic.offsetLeft + "&y=" + pic.offsetTop);
});

</script>
<?php
	include("footer.php");
?>
