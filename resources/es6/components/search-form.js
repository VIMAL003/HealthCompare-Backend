const search_form_elem = document.querySelector('.search-form')

if ( search_form_elem ){
  const postcode_elem = search_form_elem.querySelector('[name="postcode"]')
  postcode_elem.addEventListener( 'change', (e)=>{
    postcodeChangeHandler(e)
  })
}

function postcodeChangeHandler( e ){
  const postcode_elem = e.currentTarget
  const distance_elem = search_form_elem.querySelector('.distance-group')
  if ( postcode_elem.value.length > 0 && distance_elem.classList.contains('d-none') ){
    showDistanceInput()
  } else {
    hideDistanceInput()
  }
}

function showDistanceInput(){
  search_form_elem.querySelector('.distance-group').classList.remove('d-none')

  search_form_elem.querySelector('.treatment-group').classList.replace('col-lg-4', 'col-lg-3')
  search_form_elem.querySelector('.postcode-group').classList.replace('col-lg-4', 'col-lg-3')
  search_form_elem.querySelector('.distance-group').classList.replace('col-lg-4', 'col-lg-3')

  search_form_elem.querySelector('.submit-group').classList.replace('col-lg-4', 'col-lg-3')

}
function hideDistanceInput(){
  search_form_elem.querySelector('.distance-group').classList.add('d-none')

  search_form_elem.querySelector('.treatment-group').classList.replace('col-lg-3', 'col-lg-4')
  search_form_elem.querySelector('.postcode-group').classList.replace('col-lg-3', 'col-lg-4')
  search_form_elem.querySelector('.distance-group').classList.replace('col-lg-3', 'col-lg-4')

  search_form_elem.querySelector('.submit-group').classList.replace('col-lg-3', 'col-lg-4')
}