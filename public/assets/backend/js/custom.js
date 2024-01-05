//! Design The DataTable
const tables = [
    "table",
    "table1",
    "table2",
    "table3",
    "table4",
    "table5",
    "table6",
    "table7",
];

for (let i = 0; i < tables.length; i++) {
    let table = new DataTable("#table" + i, {
        paging: true,
        scrollY: tables[i],
        ordering: true,
        select: true,
        autoWidth: true,
        searching: true,
        pagingTag: "button",
        pagingType: "simple_numbers",
    });
}

//! Calculate The Year
const currentYear = new Date().getFullYear();
document.getElementById("year").innerHTML = currentYear;
//! WOW Animation
new WOW().init();
