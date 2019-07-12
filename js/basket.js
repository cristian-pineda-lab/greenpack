let basketContainer = document.getElementsByClassName('basket-container').item(0)
document.getElementById('btn-basket').onclick = () => {
  basketContainer.setAttribute('class', 'basket-container show')
}
document.getElementsByClassName('close-basket').item(0).onclick = () => {
  basketContainer.setAttribute('class', 'basket-container')
  basketContainer.style.zIndex = 100000000
}
renderCart()

function renderCart() {
  $.get('/services/fill-basket.php', (data, status) => {
    $('.basket-body').html(data)
  })
}

function showCart() {
  basketContainer.setAttribute('class', 'basket-container show')
}

function hideCart() {
  basketContainer.setAttribute('class', 'basket-container')
}

function deleteItem(idItem) {
  $.post('/shop/api/remove_item.php', {
    id_item: idItem
  }, (data, status) => {
    if (status == 'success') {
      alert('borrado')
      renderCart()
    }
  })
}