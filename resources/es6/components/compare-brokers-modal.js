// import $ from 'jquery';
// import 'bootstrap';

$('#compareBrokersModal').modal({
    show:false,
    backdrop:'static'
});

const modal_trigger = document.querySelector('.compare-brokers-modal-trigger')

modal_trigger.addEventListener('click',(e)=>{
  e.preventDefault();
  $('#compareBrokersModal').modal('show')
})