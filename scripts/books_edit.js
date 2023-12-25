function editBook(button) {
	const row = button.parentNode.parentNode;

	const bookNameCells = row.querySelectorAll('td[data-edit=true]');

	const editButton = button

	const deleteButton = button.nextElementSibling

	const submitButton = document.createElement('button');
	submitButton.textContent = 'Сохранить';
	submitButton.addEventListener('click', () => {
		console.log('Сохранить');
		changeStateOfButtons();
	})

	const cancelButton = document.createElement('button');
	cancelButton.textContent = 'Отмена';
	cancelButton.addEventListener('click', () => {
		console.log('Отмена');
		changeStateOfButtons();
	})


	bookNameCells.forEach((cell) => {
		const input = document.createElement('input');
		input.type = 'text';
		input.value = cell.textContent;
		cell.innerHTML = ''; // Очистите содержимое ячейки
		cell.appendChild(input);
	});

	changeStateOfButtons(editButton, deleteButton);

	function changeStateOfButtons(editButton, deleteButton) {
		if (editButton.textContent === 'Изменить' && deleteButton.textContent === 'Удалить') {
			editButton.innerHTML = '';
			deleteButton.innerHTML = '';

			editButton.appendChild(submitButton);
			deleteButton.appendChild(cancelButton);
		}
		else {
			editButton.innerHTML = 'Изменить';
			deleteButton.innerHTML = 'Удалить';
		}
	}


	// Отправка данных на сервер с помощью fetch-запроса
	// fetch("../api/update_role.php", {
	// 	method: "POST",
	// 	headers: {
	// 		"Content-Type": "application/json"
	// 	},
	// 	body: JSON.stringify({ id: id, role: roleSelect })
	// })
	// 	.then(response => response.text())
	// 	.then(data => {
	// 		// Обработка ответа от сервера
	// 		console.log(data); // Вывод ответа в консоль

	// 		switch (roleSelect) {
	// 			case ("librarian"):
	// 				row.querySelector(".role__value > span").textContent = "Библиотекарь";
	// 				break;
	// 			case ("reader"):
	// 				row.querySelector(".role__value > span").textContent = "Читатель";
	// 				break;
	// 		}
	// 	})
	// 	.catch(error => {
	// 		// Обработка ошибок
	// 		console.error(error);
	// 	});
}

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

const modal = document.getElementById("deleteModal");

function onDeleteBook(button) {
	confirmModal(modal, deleteBook, button);
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
			closeModal(modal);
			// Удаление строки из таблицы
			row.remove();
		})
		.catch(error => {
			// Обработка ошибок
			console.error(error);
		});
}

function confirmModal(modal, func, ...args) {
	const confirmDeleteBtn = modal.querySelector("#confirmDeleteBtn");

	confirmDeleteBtn.addEventListener("click", () => func(...args));

	// Обработчик события клика на крестик модального окна
	const closeBtn = modal.querySelector(".close");
	closeBtn.addEventListener("click", function () {
		// Закрываем модальное окно
		modal.style.display = "none";
	});
	openModal(modal);

}

function openModal(modal) {
	modal.style.display = "block";
}

function closeModal(modal) {
	modal.style.display = "none";
}
