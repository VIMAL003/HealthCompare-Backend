const shown = false

const rating_elem = document.querySelector('ul.rating')
const rating_input_elem = document.querySelector('input[name="rating"]')

const rating_star_elems = rating_elem.querySelectorAll('li.star')

rating_star_elems.forEach( (rating_star_elem, index)=>{
  rating_star_elem.addEventListener('click', (e)=>{
    ratingStarClickHandler(e, index)
  })
})

function ratingStarClickHandler(e,active_index){
  if ( shown ) return false;
  // add filled to all < = index
  rating_star_elems.forEach( (rating_star_elem, star_index) => {
    const toggle_filled = star_index <= active_index
    rating_star_elem.classList.toggle('filled', toggle_filled)
  })
  // rating_elem.querySelectorAll('li').classList.remove('filled')
  // rating_elem.querySelectorAll(`li:nth-child(${index+1}n - 1)`).classList.add('filled')
  // update rating input value
  rating_input_elem.value = active_index + 1
}

