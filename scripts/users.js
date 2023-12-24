function updateUserRole(button) {
	let row = button.parentNode.parentNode;
	let id = row.getAttribute("data-id");
	let roleSelect = row.querySelector(".role__select").value;

	// Отправка данных на сервер с помощью fetch-запроса
	fetch("../api/update_role.php", {
		method: "POST",
		headers: {
			"Content-Type": "application/json"
		},
		body: JSON.stringify({ id: id, role: roleSelect })
	})
		.then(response => response.text())
		.then(data => {
			// Обработка ответа от сервера
			console.log(data); // Вывод ответа в консоль

			switch (roleSelect) {
				case ("librarian"):
					row.querySelector(".role__value > span").textContent = "Библиотекарь";
					break;
				case ("reader"):
					row.querySelector(".role__value > span").textContent = "Читатель";
					break;
			}
		})
		.catch(error => {
			// Обработка ошибок
			console.error(error);
		});
}