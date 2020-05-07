// import $ from 'jquery';
// import 'bootstrap';

// $('#feedbackModal').modal({
//     show:true,
//     backdrop:'static'
// });
if ( document.querySelector('#feedbackModal') ){

  let blurred = false;
  window.addEventListener('focus', (e) => {
    if (!blurred) {
      $('#feedbackModal').modal('show');
      blurred = !blurred
    }
  })
}