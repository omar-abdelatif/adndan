//! Design The DataTable
for (let i = 0; i < 100; i++) {
    new DataTable("#table" + i, {
        paging: true,
        scrollY: "auto",
        ordering: true,
        select: true,
        autoWidth: true,
        searching: true,
        pagingTag: "button",
        pagingType: "simple_numbers",
        dom: "Bfrtip",
        select: true,
        buttons: ["excelHtml5", "print"],
    });
}
//! Calculate The Year
const currentYear = new Date().getFullYear();
document.getElementById("year").innerHTML = currentYear;
//! WOW Animation
new WOW().init();
//! Logging Out When Pressing Escape Button In The KeyBoard
document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
        document.getElementById("logout-form").submit();
    }
});
//! Set Timeout To Alert Notification
const errors = document.querySelectorAll(".alert-danger");
errors.forEach((error) => {
    setTimeout(function () {
        error.style.display = "none";
    }, 5000);
});
//! Set Timeout To Alert Notification
const success = document.querySelectorAll(".alert-success");
success.forEach((error) => {
    setTimeout(function () {
        error.style.display = "none";
    }, 5000);
});
