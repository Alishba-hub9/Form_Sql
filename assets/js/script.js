var usersDataTemplate = (row) => `
  <tr>
    <td>${row.name}</td>
    <td>${row.age}</td>
    <td>${row.phone}</td>
    <td>${row.company}</td>
    <td>${row.country}</td>
    <td>
      <button class="edit-btn" data-id="${row.id}"><i class="fas fa-pencil-alt"></i></button>
      <button class="delete-btn" data-id="${row.id}"><i class="fa-solid fa-trash"></i></button>
    </td>
  </tr>`;

var fetchRecords = () => {
  $.ajax({
    url: "includes/formdata.php",
    method: "GET",
    dataType: "json",
    success: (response) => {
      $(".user-records-body").html(response.data.map(usersDataTemplate).join(""));
    },
    error: () => showToast("Error fetching records", "error"),
  });
};

var showToast = (message, type) => {
  Toastify({
    text: message,
    duration: 3000,
    gravity: "top",
    position: "right",
    backgroundColor: type === "success" ? "#4CAF50" : "#FF5733",
  }).showToast();
};

if (document.URL.includes("admin.php")) {
  fetchRecords();
}

$(".users-registration-form").on("submit", function (e) {
  e.preventDefault();
  var formData = new FormData(this);
  var id = formData.get("id");

  if (!id) {
    $.ajax({
      url: "includes/formdata.php",
      method: "POST",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: (response) => {
        showToast(response.message, "success");
        e.target.reset();
        fetchRecords();
      },
      error: () => showToast("Error adding record", "error"),
    });
  } else {
    var formJSON = Object.fromEntries(formData.entries());

    $.ajax({
      url: "includes/formdata.php",
      method: "PATCH",
      data: JSON.stringify(formJSON),
      contentType: "application/json",
      dataType: "json",
      success: (response) => {
        showToast(response.message, "success");
        e.target.reset();
        fetchRecords();
      },
      error: () => showToast("Error updating record", "error"),
    });
  }
});

$(".user-records-body").on("click", ".edit-btn", function () {
  var id = $(this).data("id");
  $.ajax({
    url: "includes/formdata.php",
    method: "GET",
    dataType: "json",
    data: { action: "get_single", id },
    success: (response) => {
      Object.keys(response.data).forEach((key) => {
        $(`.users-registration-form [name='${key}']`).val(response.data[key]);
      });
    },
    error: () => showToast("Error fetching record", "error"),
  });
});

$(".user-records-body").on("click", ".delete-btn", (e) => {
  var id = $(e.currentTarget).data("id");
  var row = $(e.currentTarget).closest("tr");

  $.ajax({
    url: "includes/formdata.php",
    method: "DELETE",
    data: JSON.stringify({ id }),
    contentType: "application/json",
    dataType: "json",
    success: (response) => {
      showToast(response.message, "success");
      row.remove();
    },
    error: () => showToast("Error deleting record", "error"),
  });
});

$(".login-form").on("submit", (e) => {
  e.preventDefault();
  var formData = $(e.currentTarget).serialize();

  $.ajax({
    url: "includes/login.php",
    method: "POST",
    data: formData,
    dataType: "json",
    success: (response) => {
      if (response.success) {
        window.location.href = "admin.php";
      } else {
        showToast(response.message, "error");
      }
    },
  });
});

$(".register-form").on("submit", (e) => {
  e.preventDefault();

  var formData = $(e.currentTarget).serialize();

  $.ajax({
    url: "register.php",
    method: "POST",
    data: formData,
    dataType: "json",
    success: (response) => {
      showToast(response.message, response.success ? "success" : "error");
      if (response.success) {
        $(".register-form")[0].reset();
      }
    },
    error: () => {
      showToast("Something went wrong. Try again.", "error");
    },
  });
});
