$(document).ready(function () {
	var cursor = document.querySelector('.cursor')
	var a = document.querySelector('a')

	document.addEventListener('mousemove', function (e) {
		var x = e.clientX
		var y = e.clientY
		cursor.style.transform = `translate3d(calc(${e.clientX}px - 50%), calc(${e.clientY}px - 50%), 0)`
	})
})
