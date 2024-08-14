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
        buttons: [
            { extend: "excelHtml5" },
            {
                extend: "print",
                footer: true,
                customize: function (win) {
                    $(win.document.body).prepend('<p class="fw-bold fs-3 text-decoration-underline" style="text-align: center; margin-bottom: 19px">تقرير المصروفات الشهرية</p>').prepend('<div style="text-align: center; margin-bottom: 10px; font-weight: bold;">تم إصداره في تاريخ: ' + new Date().toLocaleDateString('en-GB') + '</div>').prepend('<img src="https://kfala.adendan.com/icons/download.png" style="width: 100px">').prepend('<hr>');
                    const tfoot = $(win.document.body).find("tfoot");
                    $(win.document.body).find("body").find("h1").addClass("d-none")
                    if (tfoot.length > 0) {
                        tfoot.show();
                    } else {
                        const table = $(win.document.body).find("table");
                        table.append($(this.table().footer().clone()));
                    }
                    $(win.document.body).css({
                        "font-size": "10pt",
                        "line-height": "1.6",
                        "direction": 'rtl',
                        "text-align": "center",
                    });
                    $(win.document.body).find("table").addClass("compact mt-4 w-100");
                    $(win.document.body).find("table").find("th").addClass("text-center");
                },
            },
        ],
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
success.forEach((suc) => {
    setTimeout(function () {
        suc.style.display = "none";
    }, 5000);
});
