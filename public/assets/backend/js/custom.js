//! Design The DataTable
for (let i = 0; i < 100; i++) {
    let table = new DataTable("#table" + i, {
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
        buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5", "print"],
    });
}
//! Calculate The Year
const currentYear = new Date().getFullYear();
document.getElementById("year").innerHTML = currentYear;
//! WOW Animation
new WOW().init();

let SelectedOption = document.getElementById("duration");
let SelectedDonation = document.querySelectorAll(".donationType");
if (SelectedOption) {
    SelectedOption.addEventListener("change", function () {
        var selectedOption = this.options[this.selectedIndex].value;
        var otherCraftInput = document.getElementsByName("other_duration")[0];
        otherCraftInput.value = "";
        otherCraftInput.disabled = selectedOption !== "أخرى";
    });
}
if (SelectedDonation) {
    SelectedDonation.forEach(function (selectedDonation) {
        selectedDonation.addEventListener("change", function () {
            let selectedOption = this.options[this.selectedIndex].value;
            let otherCraftInput = this.closest('.record').querySelector("[name='other_type']");
            let moneyType = this.closest('.record').querySelector("[name='money_type']");
            if (selectedOption == "أخرى") {
                otherCraftInput.classList.remove("d-none");
                moneyType.classList.add("d-none");
            } else if (selectedOption == "نقدي") {
                moneyType.classList.remove("d-none");
                otherCraftInput.classList.add("d-none");
            } else {
                moneyType.classList.add("d-none");
                otherCraftInput.classList.add("d-none");
            }
        });
    });
}
