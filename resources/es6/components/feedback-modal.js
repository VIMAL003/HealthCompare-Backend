// import $ from 'jquery';
// import 'bootstrap';

// $('#feedbackModal').modal({
//     show:true,
//     backdrop:'static'
// });

let blurred = false;
window.addEventListener('focus', (e) => {
  if (!blurred && false) {
    $('#feedbackModal').modal('show');
    blurred = !blurred
  }
})