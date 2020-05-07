// import $ from 'jquery';
// import 'bootstrap';
import 'bootstrap/js/dist/modal';

// $('#feedbackModal').modal({
//     show:true,
//     backdrop:'static'
// });
if ( document.querySelector('#feedbackModal') && false ){

  let blurred = false;
  window.addEventListener('focus', (e) => {
    if (!blurred) {
      $('#feedbackModal').modal('show');
      blurred = !blurred
    }
  })
}