// import $ from 'jquery';
// import 'bootstrap';
import 'bootstrap/js/dist/modal';
if ( document.querySelector( '#compareBrokersModal' ) ){
  const modal_trigger = document.querySelector('.compare-brokers-modal-trigger')
  if ( modal_trigger ){

    $('#compareBrokersModal').modal({
      show:false,
      backdrop:'static'
    });


    modal_trigger.addEventListener('click',(e)=>{
      e.preventDefault();
      $('#compareBrokersModal').modal('show')
    })
  }
}