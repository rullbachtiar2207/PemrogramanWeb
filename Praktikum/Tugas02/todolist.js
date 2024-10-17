// Fungsi untuk menambahkan task baru ke dalam daftar
function addTask() {
  const taskInput = document.getElementById("new-task");
  const taskList = document.getElementById("task-list");

  // Cek jika input tidak kosong
  if (taskInput.value.trim() !== "") {
    const listItem = document.createElement("li");

    // Buat elemen teks dan tombol-tombol edit dan hapus
    listItem.innerHTML = `
      <span class="task">${taskInput.value}</span>
      <button class="edit" onclick="editTask(this)">Edit</button>
      <button onclick="removeTask(this)">Remove</button>
    `;

    taskList.appendChild(listItem); // Tambahkan task ke dalam daftar
    taskInput.value = ""; // Kosongkan input setelah ditambahkan
  } else {
    alert("Task cannot be empty!");
  }
}

// Fungsi untuk menghapus task
function removeTask(button) {
  const listItem = button.parentElement;
  listItem.remove();
}

// Fungsi untuk mengedit task
function editTask(button) {
  const listItem = button.parentElement;
  const taskSpan = listItem.querySelector(".task");
  const newTask = prompt("Edit your task:", taskSpan.textContent);

  // Update task jika pengguna memasukkan sesuatu
  if (newTask !== null && newTask.trim() !== "") {
    taskSpan.textContent = newTask;
  }
}
