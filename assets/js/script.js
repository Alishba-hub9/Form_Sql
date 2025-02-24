var fetchRecords = () => {
  $.ajax({
    url: "update_delete.php",
    method: "GET",
    success: (data) => $(".user-records-body").html(data),
    error: (err) => console.error("Error fetching records:", err),
  });
};

$(".user-details-form").on("submit", function (e) {
  e.preventDefault();
  $.ajax({
    url: "submit.php",
    method: "POST",
    data: $(this).serialize(),
    success: (response) => {
      showToast(response, "success");
      $(".user-details-form")[0].reset();
      fetchRecords();
    },
    error: (err) => {
      console.error("Error submitting form:", err);
      showToast("Error submitting form!", "error");
    },
  });
});

$(".user-records-body").on("click", ".edit-btn", function () {
  var row = $(this).closest("tr");
  var form = $(".user-details-form");
  var formData = new FormData();
  formData.set("id", $(this).data("id"));

  row.find("td[data-key]").each(function () {
    formData.set($(this).attr("data-key"), $(this).text().trim());
  });

  formData.forEach((value, key) => form.find(`[name='${key}']`).val(value));
});

$(".user-records-body").on("click", ".delete-btn", function () {
  $.ajax({
    url: "update_delete.php",
    method: "POST",
    data: { deleteId: $(this).data("id") },
    success: (response) => {
      showToast(response, "success");
      fetchRecords();
    },
    error: (err) => {
      console.error("Error deleting record:", err);
      showToast("Error deleting record!", "error");
    },
  });
});

var showToast = (message, type) => {
  Toastify({
    text: message,
    duration: 3000,
    gravity: "top",
    position: "right",
    backgroundColor: type === "success" ? "#4CAF50" : "#FF5733",
  }).showToast();
};

fetchRecords();
