// import $ from 'jquery'
// import 'bootstrap'
import 'bootstrap/js/dist/collapse'

let clickBuffered = true
const clickBufferTime = 750

if ( document.querySelector('#navbarContent') ){

	$('#navbarContent').collapse({
		toggle: false
	})

	$('#navbarContent').on('show.bs.collapse', function () {
		document.querySelector('#navbarContent').classList.replace('closed-sidebar','opening-sidebar')
	})
	$('#navbarContent').on('shown.bs.collapse', function () {
		document.querySelector('#navbarContent').classList.replace('opening-sidebar','open-sidebar')
	})
	$('#navbarContent').on('hide.bs.collapse', function () {
		document.querySelector('#navbarContent').classList.replace('open-sidebar','closing-sidebar')
	})
	$('#navbarContent').on('hidden.bs.collapse', function () {
		document.querySelector('#navbarContent').classList.replace('closing-sidebar','closed-sidebar')
	})

	$('#menuIcon').click(function(){
		if ( clickBuffered ){
			clickBuffered = false

			$(this).toggleClass('open')

			document.querySelector('main').classList.toggle('sidebar-active')

			$('#navbarContent').collapse('toggle')

			setTimeout(()=>{
				clickBuffered = true
			}, clickBufferTime)

		}
	})
}