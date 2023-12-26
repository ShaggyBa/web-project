function addBook(button) {
	const row = button.closest('tr');
	const bookName = row.querySelector('.book__name--input');
	const author = row.querySelector('.book__author--input');
	const count = row.querySelector('.book__count--input');
	const image = row.querySelector('.book__image--input');

	const book = {
		book_name: bookName.value,
		author: author.value,
		count: count.value,
		image: image.value
	};

	for (const [key, value] of Object.entries(book)) {
		if (value === '') {
			alert('Заполните все поля');
			return;
		}
	}

	// Отправка данных на сервер с помощью fetch-запроса
	fetch("../../api/add_book.php", {
		method: "POST",
		headers: {
			"Content-Type": "application/json"
		},
		body: JSON.stringify(book)
	})
		.then(response => response.text())
		.then(jsonData => {
			// Обработка ответа от сервера
			const data = JSON.parse(jsonData);

			bookName.value = '';
			author.value = '';
			count.value = '';
			image.value = '';

			const table = document.querySelector('.table');
			const newRow = table.insertRow(row.rowIndex); // Вставляем новую строку перед текущей строкой
			newRow.className = 'table__row';
			newRow.setAttribute('data-id', data.id);

			// Заполняем новую строку данными из объекта data
			for (const key in data) {
				const cell = newRow.insertCell();
				cell.dataset.edit = 'true';
				cell.innerHTML = data[key];
			}

			// Добавляем ячейку с кнопками "Изменить" и "Удалить"
			const actionsCell = newRow.insertCell();
			actionsCell.className = 'table__actions';
			actionsCell.innerHTML = `
                <button onclick="editBook(this)">Изменить</button>
                <button onclick="onDeleteBook(this)">Удалить</button>
            `;

		})
		.catch(error => {
			// Обработка ошибок
			console.error(error);
		});
}

const deleteModal = document.getElementById("deleteModal");

const editModal = document.getElementById("editModal");

const editForm = document.getElementById("editForm");

function onEditBook(button) {
	const row = button.closest('.table__row');
	const bookId = row.getAttribute('data-id');
	const bookName = row.querySelector('.book__name').innerText;
	const author = row.querySelector('.book__author').innerText;
	const count = row.querySelector('.book__count').innerText;
	const image = row.querySelector('.book__image').innerText;

	editForm.querySelector('.book__name').value = bookName;
	editForm.querySelector('.book__author').value = author;
	editForm.querySelector('.book__count').value = count;
	editForm.querySelector('.book__image').value = image;

	editForm.querySelector('#bookId').value = bookId;

	confirmModal(editModal, editBook, button, editForm);


}

function onDeleteBook(button) {
	confirmModal(deleteModal, deleteBook, button);
}

function editBook(button, editForm) {
	console.log(editBook)
}

function deleteBook(button) {
	const row = button.closest('.table__row');
	const bookId = row.getAttribute('data-id');
	// Отправка данных на сервер с помощью fetch-запроса
	fetch("../../api/delete_book.php", {
		method: "POST",
		headers: {
			"Content-Type": "application/json"
		},
		body: JSON.stringify({ id: bookId })
	})
		.then(response => response.text())
		.then(data => {
			// Обработка ответа от сервера
			closeModal(deleteModal);
			// Удаление строки из таблицы
			row.remove();
		})
		.catch(error => {
			// Обработка ошибок
			console.error(error);
		});
}

function confirmModal(modal, func, ...args) {
	const confirmBtn = modal.querySelector("#confirmBtn");
	if (confirmBtn) {
		confirmBtn.addEventListener("click", () => {
			func(...args);
		});
	}

	const closeBtn = modal.querySelector(".close");
	closeBtn.addEventListener("click", function (event) {
		closeModal(event.target.parentNode.parentNode);
	});
	openModal(modal);
}

function openModal(modal) {
	modal.style.display = "block";
}

function closeModal(modal) {
	modal.style.display = "none";
}
