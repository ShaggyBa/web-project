// function bookRent(button, id) {
// 	const idInt = parseInt(id);


// }

function openModal(bookId, userName) {

	console.log(bookId, userName)
	// Получаем данные о книге из соответствующего элемента
	const book = document.querySelector(`[data-book-id="${bookId}"]`);
	const bookInfo = book.querySelector('.book__title').textContent;

	// Получаем данные о пользователе
	const name = userName;

	// Получаем сегодняшнюю дату
	const today = new Date();
	const rentDate = today.toLocaleDateString();

	// Заполняем поля формы данными
	document.getElementById('bookInfo').value = bookInfo;
	document.getElementById('name').value = name;
	document.getElementById('rentDate').value = rentDate;


	// Открываем модальное окно
	const modal = document.getElementById('modal');
	modal.style.display = 'block';
}

function closeModal() {
	// Закрываем модальное окно
	const modal = document.getElementById('modal');
	modal.style.display = 'none';
}

// Добавьте обработчик отправки формы
const rentForm = document.getElementById('rentForm');
rentForm.addEventListener('submit', function (event) {
	event.preventDefault();

	// Получаем значения полей формы
	const rentDuration = document.getElementById('rentDuration').value;
	const librarian = document.getElementById('librarian').value;

	// Выполняем отправку данных на сервер
	// Ваш код для отправки данных

	// Закрываем модальное окно после отправки данных
	closeModal();
});

// Добавьте обработчик для кнопки закрытия модального окна
const closeButton = document.querySelector('.close');
closeButton.addEventListener('click', closeModal);