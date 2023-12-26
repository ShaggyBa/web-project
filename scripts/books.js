// function bookRent(button, id) {
// 	const idInt = parseInt(id);


// }

function openModal(bookId, userName) {

	// Получаем данные о книге из соответствующего элемента
	const book = document.querySelector(`[data-book-id="${bookId}"]`);

	const bookName = book.querySelector('.book__title').textContent;
	const author = book.querySelector('.book__author').textContent;
	const bookImage = book.querySelector('.book__image').getAttribute('src');


	// Получаем сегодняшнюю дату
	const today = new Date();
	const rentDate = today.toLocaleDateString();

	// Заполняем поля формы данными
	const bookPreview = document.querySelector('.bookInfo');
	bookPreview.querySelector('.book__image').setAttribute('src', bookImage);
	bookPreview.querySelector('.book__title').textContent = bookName;
	bookPreview.querySelector('.book__author').textContent = author;

	document.getElementById('name').value = userName;
	document.getElementById('rentDate').value = rentDate;
	document.getElementById('bookId').value = bookId;

	// Открываем модальное окно
	const modal = document.getElementById('modal');
	modal.style.display = 'block';
}

function closeModal() {
	// Закрываем модальное окно
	const modal = document.getElementById('modal');
	modal.style.display = 'none';
}

// Добавьте обработчик для кнопки закрытия модального окна
const closeButton = document.querySelector('.close');
closeButton.addEventListener('click', closeModal);