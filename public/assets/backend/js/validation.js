//! Validation Form Function
function validateForm(form) {
    let isValid = true;
    let inputs = form.querySelectorAll(
        "input[type='number'][required],input[type='text'][required]"
    );
    inputs.forEach(function (input) {
        let inputError = input.nextElementSibling;
        if (input.value.trim() === "") {
            input.classList.add("error");
            inputError.classList.remove("d-none");
            isValid = false;
        } else {
            input.classList.remove("error");
            input.classList.add("good");
            inputError.classList.add("d-none");
        }
    });
    const categorySelects = form.querySelectorAll("select[required]");
    categorySelects.forEach(function (select) {
        let categoryErrorMsg = select.nextElementSibling;
        if (
            select.value === "التصنيف" ||
            select.value === "المنطقة" ||
            select.value === "نوع المتبرع" ||
            select.value === "نوع التبرع النقدي" ||
            select.value === "نوع التبرع" ||
            select.value === "قوة المقبرة (بالغرف)" ||
            select.value === "نوع المقبرة" ||
            select.value === "المقبرة" ||
            select.value === "الغرفة" ||
            select.value === "جنس المتوفي" ||
            select.value === "حجم المتوفي" ||
            select.value === "سن المتوفي" ||
            select.value === "تخصص المقبره"
        ) {
            select.classList.add("error");
            select.classList.remove("good");
            categoryErrorMsg.classList.remove("d-none");
            isValid = false;
        } else {
            select.classList.remove("error");
            select.classList.add("good");
            categoryErrorMsg.classList.add("d-none");
        }
    });
    const inputImg = form.querySelectorAll('input[type="file"][required]');
    inputImg.forEach((img) => {
        let imgError = img.nextElementSibling;
        if (img.files.length === 0) {
            img.classList.add("error");
            imgError.classList.remove("d-none");
            isValid = false;
        }
    });
    const InputDates = form.querySelectorAll('input[type="date"][required]');
    InputDates.forEach((date) => {
        let dateErrorMsg = date.nextElementSibling;
        if (date.value === "") {
            date.classList.add("error");
            dateErrorMsg.classList.remove("d-none");
            isValid = false;
        } else {
            date.classList.remove("error");
            dateErrorMsg.classList.add("d-none");
        }
    });
    const textareas = form.querySelectorAll("textarea[required]");
    textareas.forEach(function (text) {
        let textareaErrorMsg = text.nextElementSibling;
        if (text.value.trim() === "") {
            text.classList.add("error");
            textareaErrorMsg.classList.remove("d-none");
            isValid = false;
        } else {
            text.classList.remove("error");
            text.classList.add("good");
            textareaErrorMsg.classList.add("d-none");
        }
    });
    return isValid;
}
//! Validation Image Function
function validateImage(img, imgReq, imgExt, invoice_img, imgSizeMsg) {
    const allowedExtensions = [
        "image/jpeg",
        "image/jpg",
        "image/png",
        "image/webp",
    ];
    imgReq.classList.add("d-none");
    imgExt.classList.add("d-none");
    imgSizeMsg.classList.add("d-none");
    if (!img) {
        invoice_img.classList.remove("good");
        invoice_img.classList.add("error");
        imgReq.classList.remove("d-none");
        return false;
    } else {
        invoice_img.classList.add("good");
        invoice_img.classList.remove("error");
        imgReq.classList.add("d-none");
    }
    if (!allowedExtensions.includes(img.type)) {
        invoice_img.classList.add("error");
        invoice_img.classList.remove("good");
        imgExt.classList.remove("d-none");
        return false;
    } else {
        invoice_img.classList.remove("error");
        invoice_img.classList.add("good");
        imgExt.classList.add("d-none");
    }
    const sizeLimit = 2048;
    if (img.size / 1024 > sizeLimit) {
        invoice_img.classList.add("error");
        invoice_img.classList.remove("good");
        imgSizeMsg.classList.remove("d-none");
        return false;
    } else {
        invoice_img.classList.remove("error");
        invoice_img.classList.add("good");
        imgSizeMsg.classList.add("d-none");
    }
}
//! Validation Files Function
function validateFile(file, fileReq, fileExt, fileMsg, pdfs) {
    const allowedExtensions = ["application/pdf"];
    fileReq.classList.add("d-none");
    fileExt.classList.add("d-none");
    fileMsg.classList.add("d-none");
    if (!file) {
        pdfs.classList.remove("good");
        pdfs.classList.add("error");
        fileReq.classList.remove("d-none");
        return false;
    } else {
        pdfs.classList.add("good");
        pdfs.classList.remove("error");
        fileReq.classList.add("d-none");
    }
    if (!allowedExtensions.includes(file.type)) {
        pdfs.classList.add("error");
        pdfs.classList.remove("good");
        fileExt.classList.remove("d-none");
        return false;
    } else {
        pdfs.classList.remove("error");
        pdfs.classList.add("good");
        fileExt.classList.add("d-none");
    }
    const sizeLimit = 2048;
    if (file.size / 1024 <= sizeLimit) {
        pdfs.classList.add("error");
        pdfs.classList.remove("good");
        fileMsg.classList.remove("d-none");
        return false;
    } else {
        pdfs.classList.remove("error");
        pdfs.classList.add("good");
        fileMsg.classList.add("d-none");
    }
    return true;
}
//! Cases Creation Form
let CaseTable = document.getElementById("CaseTable");
if (CaseTable) {
    //! Full Name Validation
    const CaseFullName = document.getElementById("CaseFullName");
    const CaseReq = document.getElementById("CaseReq");
    const CaseSubMsg = document.getElementById("CaseMsg");
    CaseFullName.addEventListener("input", function () {
        let letters = /^[\u0600-\u06FF\s]{3,}$/;
        if (this.value.trim() === "") {
            CaseReq.classList.remove("d-none");
            CaseSubMsg.classList.add("d-none");
            CaseFullName.classList.remove("good");
            CaseFullName.classList.add("error");
        } else {
            if (letters.test(this.value)) {
                CaseFullName.classList.add("good");
                CaseFullName.classList.remove("error");
                CaseSubMsg.classList.add("d-none");
                CaseReq.classList.add("d-none");
            } else {
                CaseFullName.classList.remove("good");
                CaseFullName.classList.add("error");
                CaseSubMsg.classList.remove("d-none");
                CaseReq.classList.add("d-none");
            }
        }
    });
    //! Validation Subscriber SSN
    const ssn = document.getElementById("ssn");
    const ssnMsg = document.getElementById("ssnMsg");
    const ssnReq = document.getElementById("ssnReq");
    ssn.addEventListener("input", function () {
        let letters = /^[0-9]{14}/;
        if (this.value.trim() === "") {
            ssnReq.classList.remove("d-none");
            ssnMsg.classList.add("d-none");
            ssn.classList.remove("good");
            ssn.classList.add("error");
        } else {
            if (letters.test(this.value)) {
                ssn.classList.add("good");
                ssn.classList.remove("error");
                ssnMsg.classList.add("d-none");
                ssnReq.classList.add("d-none");
                f1 = 1;
                if (f1 === 1 && f2 === 1 && f3 === 1 && f4 === 1) {
                    document.getElementById("nextbtn").disabled = false;
                } else {
                    document.getElementById("nextbtn").disabled = true;
                }
            } else {
                ssn.classList.remove("good");
                ssn.classList.add("error");
                ssnMsg.classList.remove("d-none");
                ssnReq.classList.add("d-none");
                f1 = 0;
                document.getElementById("nextbtn").disabled = true;
            }
        }
    });
    //! Validation Subscriber Mobile
    const mobile = document.getElementById("mobile_no");
    const mobReq = document.getElementById("mobileReq");
    const mobMsg = document.getElementById("mobileMsg");
    mobile.addEventListener("input", function () {
        let letters = /^[0-9]{11}/;
        if (mobile.value.trim() === "") {
            mobReq.classList.remove("d-none");
            mobMsg.classList.add("d-none");
            mobile.classList.remove("good");
            mobile.classList.add("error");
        } else {
            if (letters.test(mobile.value)) {
                mobile.classList.add("good");
                mobile.classList.remove("error");
                mobMsg.classList.add("d-none");
                mobReq.classList.add("d-none");
            } else {
                mobile.classList.remove("good");
                mobile.classList.add("error");
                mobMsg.classList.remove("d-none");
                mobReq.classList.add("d-none");
            }
        }
    });
    //! Validation For Age
    const age = document.getElementById("age");
    const ageReq = document.getElementById("ageReq");
    const ageMsg = document.getElementById("ageMsg");
    age.addEventListener("input", function () {
        let letters = /^\d{2}$/;
        if (age.value.trim() === "") {
            ageReq.classList.remove("d-none");
            ageMsg.classList.add("d-none");
            age.classList.remove("good");
            age.classList.add("error");
        } else {
            if (letters.test(age.value)) {
                age.classList.add("good");
                age.classList.remove("error");
                ageMsg.classList.add("d-none");
                ageReq.classList.add("d-none");
            } else {
                age.classList.remove("good");
                age.classList.add("error");
                ageMsg.classList.remove("d-none");
                ageReq.classList.add("d-none");
            }
        }
    });
    //! Validation For Address
    const address = document.getElementById("address");
    const addressReq = document.getElementById("addressReq");
    const addressMsg = document.getElementById("addressMsg");
    address.addEventListener("input", function () {
        let letters = /^[\u0600-\u06FF\s]{3,}$/;
        if (this.value.trim() === "") {
            addressReq.classList.remove("d-none");
            addressMsg.classList.add("d-none");
            address.classList.remove("good");
            address.classList.add("error");
        } else {
            if (letters.test(this.value)) {
                address.classList.add("good");
                address.classList.remove("error");
                addressMsg.classList.add("d-none");
                addressReq.classList.add("d-none");
            } else {
                address.classList.remove("good");
                address.classList.add("error");
                addressMsg.classList.remove("d-none");
                addressReq.classList.add("d-none");
            }
        }
    });
    //! Validation For Files Upload
    const Files = document.getElementById("files");
    const FilesReq = document.getElementById("filesReq");
    const FilesSize = document.getElementById("filesSize");
    const FilesExt = document.getElementById("filesExt");
    Files.addEventListener("change", function () {
        const img = Files.files[0];
        if (img) {
            validateImage(img, FilesReq, FilesExt, Files, FilesSize);
        } else {
            Files.classList.add("error");
            Files.classList.remove("good");
            FilesReq.classList.remove("d-none");
            FilesSize.classList.add("d-none");
            FilesExt.classList.add("d-none");
        }
    });
    //! Submit Case Form
    const CaseFormSubmit = document.getElementById("CaseForm");
    CaseFormSubmit.addEventListener("click", function (e) {
        e.preventDefault();
        if (validateForm(CaseTable)) {
            CaseTable.submit();
        }
    });
}
//! Validation For Donators Creation
let newDonators = document.getElementById("newDonators");
if (newDonators) {
    //! New Donators Name
    const DonatorName = document.getElementById("DonatorName");
    const DonatorReq = document.getElementById("DonatorReq");
    const DonatorMsg = document.getElementById("DonatorMsg");
    DonatorName.addEventListener("input", function () {
        let letters = /^[\u0600-\u06FF\s]{3,}$/;
        if (this.value.trim() === "") {
            DonatorReq.classList.remove("d-none");
            DonatorMsg.classList.add("d-none");
            DonatorName.classList.remove("good");
            DonatorName.classList.add("error");
        } else {
            if (letters.test(this.value)) {
                DonatorName.classList.add("good");
                DonatorName.classList.remove("error");
                DonatorMsg.classList.add("d-none");
                DonatorReq.classList.add("d-none");
            } else {
                DonatorName.classList.remove("good");
                DonatorName.classList.add("error");
                DonatorMsg.classList.remove("d-none");
                DonatorReq.classList.add("d-none");
            }
        }
    });
    //! Donators Mobile Numbers
    const DonatorMobile = document.getElementById("DonatorMobile");
    const donatorMobileReq = document.getElementById("donatorMobileReq");
    const donatorMobileMsg = document.getElementById("donatorMobileMsg");
    DonatorMobile.addEventListener("input", function () {
        let letters = /^[0-9]{11}$/;
        if (this.value.trim() === "") {
            donatorMobileReq.classList.remove("d-none");
            donatorMobileMsg.classList.add("d-none");
            DonatorMobile.classList.remove("good");
            DonatorMobile.classList.add("error");
        } else {
            if (letters.test(this.value)) {
                DonatorMobile.classList.add("good");
                DonatorMobile.classList.remove("error");
                donatorMobileMsg.classList.add("d-none");
                donatorMobileReq.classList.add("d-none");
            } else {
                DonatorMobile.classList.remove("good");
                DonatorMobile.classList.add("error");
                donatorMobileMsg.classList.remove("d-none");
                donatorMobileReq.classList.add("d-none");
            }
        }
    });
    //! Duration Donation Validation
    const DonationDuration = document.getElementById("duration");
    const DurationReq = document.getElementById("durationReq");
    DonationDuration.addEventListener("change", function () {
        if (this.options[this.selectedIndex].value === "نوع المتبرع") {
            DonationDuration.classList.add("error");
            DonationDuration.classList.remove("good");
            DurationReq.classList.remove("d-none");
        } else {
            DonationDuration.classList.remove("error");
            DonationDuration.classList.add("good");
            DurationReq.classList.add("d-none");
        }
        if (this.options[this.selectedIndex].value === "أخرى") {
            otherDuration.disabled = false;
            if (otherDuration.value.trim() === "") {
                otherDurationReq.classList.remove("d-none");
                otherDuration.classList.remove("good");
                otherDuration.classList.add("error");
            }
        } else {
            otherDuration.disabled = true;
            otherDuration.classList.remove("good");
            otherDuration.classList.remove("error");
            otherDurationReq.classList.add("d-none");
        }
    });
    //! Other Duration Validation
    const otherDuration = document.getElementById("otherDuration");
    const otherDurationReq = document.getElementById("otherReq");
    const otherDurationMsg = document.getElementById("otherMsg");
    otherDuration.addEventListener("input", function () {
        let letters = /^[\u0600-\u06FF\s]{3,}$/;
        if (this.value.trim() === "") {
            otherDurationReq.classList.remove("d-none");
            otherDurationMsg.classList.remove("d-none");
            otherDuration.classList.remove("good");
            otherDuration.classList.add("error");
        } else {
            if (letters.test(this.value)) {
                otherDuration.classList.add("good");
                otherDuration.classList.remove("error");
                otherDurationReq.classList.add("d-none");
                otherDurationMsg.classList.add("d-none");
            } else {
                otherDuration.classList.remove("good");
                otherDuration.classList.add("error");
                otherDurationReq.classList.add("d-none");
                otherDurationMsg.classList.remove("d-none");
            }
        }
    });
    //! Submit Case Form
    const DonatorsSubmitForm = document.getElementById("DonatorsSubmit");
    DonatorsSubmitForm.addEventListener("click", function (e) {
        e.preventDefault();
        if (validateForm(newDonators)) {
            newDonators.submit();
        }
    });
}
//! Validation for Donations
let DonationsForm = document.querySelectorAll("[data-donation-id]");
if (DonationsForm) {
    DonationsForm.forEach((form) => {
        let DonationType = form.querySelectorAll("[data-donationtype-id]");
        let DonationMoneyType = form.querySelectorAll(
            "[data-donationmoneytype-id]"
        );
        let DonationOtherType = form.querySelectorAll(
            "[data-donationothertype-id]"
        );
        let DonationAmount = form.querySelectorAll("[data-donationamount-id]");
        let DonationInvoice = form.querySelectorAll("[data-inv-id]");
        let DonationDuration = form.querySelectorAll("[data-duration-id]");
        //! Donation Type Validation
        DonationType.forEach((type) => {
            const typeSelect = form.querySelector(
                `select[name="donation_type"][data-donationtype-id="${type.dataset.donationtypeId}"]`
            );
            const typeReq = form.querySelector(
                `p.donationtypeReq[data-donationtype-id="${type.dataset.donationtypeId}"]`
            );
            if (typeSelect) {
                typeSelect.addEventListener("change", function () {
                    let selectedDonation =
                        typeSelect.options[typeSelect.selectedIndex].value;
                    if (selectedDonation === "نقدي") {
                        typeSelect.classList.add("good");
                        typeSelect.classList.remove("error");
                        typeReq.classList.add("d-none");
                        DonationMoneyType.forEach((other) => {
                            const otherSelect = form.querySelector(
                                `select[name="money_type"][data-donationmoneytype-id="${other.dataset.donationmoneytypeId}"]`
                            );
                            const otherSelectReq = form.querySelector(
                                `p.donationmoneytype[data-donationmoneytype-id="${other.dataset.donationmoneytypeId}"]`
                            );
                            const otherOptions =
                                otherSelect.options[otherSelect.selectedIndex]
                                    .value;
                            if (otherOptions === "نوع التبرع النقدي") {
                                otherSelect.classList.remove("d-none");
                                otherSelect.classList.add("error");
                                otherSelectReq.classList.remove("d-none");
                            } else {
                                otherSelect.classList.remove("d-none");
                                otherSelect.classList.remove("error");
                                otherSelectReq.classList.add("d-none");
                                otherSelect.classList.add("good");
                            }
                        });
                        DonationOtherType.forEach((other) => {
                            const OtherType = form.querySelector(
                                `input[name="other_type"][data-donationothertype-id="${other.dataset.donationothertypeId}"]`
                            );
                            const OtherTypeReq = form.querySelector(
                                `p.donationothertype[data-donationothertype-id="${other.dataset.donationothertypeId}"]`
                            );
                            if (OtherType) {
                                OtherType.classList.add("d-none");
                                OtherType.classList.remove("error");
                                OtherTypeReq.classList.add("d-none");
                            } else {
                                OtherType.classList.remove("d-none");
                                OtherType.classList.add("error");
                                OtherTypeReq.classList.remove("d-none");
                            }
                        });
                    } else if (selectedDonation === "أخرى") {
                        typeSelect.classList.add("good");
                        typeSelect.classList.remove("error");
                        typeReq.classList.add("d-none");
                        DonationMoneyType.forEach((money) => {
                            const MoneyType = form.querySelector(
                                `select[name="money_type"][data-donationmoneytype-id="${money.dataset.donationmoneytypeId}"]`
                            );
                            const MoneyTypeReq = form.querySelector(
                                `p.donationmoneytype[data-donationmoneytype-id="${money.dataset.donationmoneytypeId}"]`
                            );
                            if (MoneyType) {
                                MoneyType.classList.add("d-none");
                                MoneyType.classList.remove("error");
                                MoneyTypeReq.classList.add("d-none");
                            }
                        });
                        DonationOtherType.forEach((other) => {
                            const OtherDonationType = form.querySelector(
                                `input[name="other_type"][data-donationothertype-id="${other.dataset.donationothertypeId}"]`
                            );
                            const OtherTypeReq = form.querySelector(
                                `p.donationothertype[data-donationothertype-id="${other.dataset.donationothertypeId}"]`
                            );
                            if (OtherDonationType) {
                                OtherDonationType.classList.remove("d-none");
                                if (OtherDonationType.value.trim() === "") {
                                    OtherDonationType.classList.add("error");
                                    OtherTypeReq.classList.remove("d-none");
                                } else {
                                    OtherDonationType.classList.remove("error");
                                    OtherDonationType.classList.add("good");
                                    OtherTypeReq.classList.add("d-none");
                                }
                            }
                        });
                    }
                });
            }
        });
        //! Other Donation Money Type Validation
        DonationMoneyType.forEach((other) => {
            const otherSelect = form.querySelector(
                `select[name="money_type"][data-donationmoneytype-id="${other.dataset.donationmoneytypeId}"]`
            );
            const otherReq = form.querySelector(
                `p.donationmoneytype[data-donationmoneytype-id="${other.dataset.donationmoneytypeId}"]`
            );
            if (otherSelect) {
                otherSelect.addEventListener("change", function () {
                    let selectedDonation =
                        otherSelect.options[otherSelect.selectedIndex].value;
                    if (selectedDonation === "نوع التبرع النقدي") {
                        otherSelect.classList.remove("good");
                        otherSelect.classList.add("error");
                        otherReq.classList.remove("d-none");
                    } else {
                        otherSelect.classList.remove("error");
                        otherSelect.classList.add("good");
                        otherReq.classList.add("d-none");
                    }
                });
            }
        });
        //! Other Donation Validation
        DonationOtherType.forEach((other) => {
            const otherInput = form.querySelector(
                `input[name="other_type"][data-donationothertype-id="${other.dataset.donationothertypeId}"]`
            );
            const otherInputReq = form.querySelector(
                `p.donationothertype[data-donationothertype-id="${other.dataset.donationothertypeId}"]`
            );
            if (otherInput) {
                otherInput.addEventListener("input", function () {
                    let letters = /(?=.{3,})/;
                    if (this.value.trim() === "") {
                        otherInput.classList.add("error");
                        otherInput.classList.remove("good");
                        otherInputReq.classList.remove("d-none");
                    } else {
                        if (letters.test(this.value)) {
                            otherInput.classList.remove("error");
                            otherInput.classList.add("good");
                            otherInputReq.classList.add("d-none");
                        } else {
                            otherInput.classList.add("error");
                            otherInput.classList.remove("good");
                            otherInputReq.classList.remove("d-none");
                        }
                    }
                });
            }
        });
        //! Donation Amount Validation
        DonationAmount.forEach((amount) => {
            const amountInput = form.querySelector(
                `input[name="amount"][data-donationamount-id="${amount.dataset.donationamountId}"]`
            );
            const amountInputReq = form.querySelector(
                `p.donationamountReq[data-donationamount-id="${amount.dataset.donationamountId}"]`
            );
            const amountInputMsg = form.querySelector(
                `p.donationamountMsg[data-donationamount-id="${amount.dataset.donationamountId}"]`
            );
            if (amountInput) {
                amountInput.addEventListener("input", function () {
                    let letters = /^\d{2,}$/;
                    if (this.value.trim() === "") {
                        amountInputReq.classList.remove("d-none");
                        amountInputMsg.classList.add("d-none");
                        amountInput.classList.remove("good");
                        amountInput.classList.add("error");
                    } else {
                        if (letters.test(this.value)) {
                            amountInput.classList.add("good");
                            amountInput.classList.remove("error");
                            amountInputMsg.classList.add("d-none");
                            amountInputReq.classList.add("d-none");
                        } else {
                            amountInput.classList.remove("good");
                            amountInput.classList.add("error");
                            amountInputMsg.classList.remove("d-none");
                            amountInputReq.classList.add("d-none");
                        }
                    }
                });
            }
        });
        //! Donation Invoice Validation
        DonationInvoice.forEach((inv) => {
            const invInput = form.querySelector(
                `input[name="invoice_no"][data-inv-id="${inv.dataset.invId}"]`
            );
            const invInputReq = form.querySelector(
                `p.invReq[data-inv-id="${inv.dataset.invId}"]`
            );
            const invInputMsg = form.querySelector(
                `p.invMsg[data-inv-id="${inv.dataset.invId}"]`
            );
            if (invInput) {
                invInput.addEventListener("input", function () {
                    let letters = /^\d{5}$/;
                    if (this.value.trim() === "") {
                        invInputReq.classList.remove("d-none");
                        invInputMsg.classList.add("d-none");
                        invInput.classList.remove("good");
                        invInput.classList.add("error");
                    } else {
                        if (letters.test(this.value)) {
                            invInput.classList.add("good");
                            invInput.classList.remove("error");
                            invInputMsg.classList.add("d-none");
                            invInputReq.classList.add("d-none");
                        } else {
                            invInput.classList.remove("good");
                            invInput.classList.add("error");
                            invInputMsg.classList.remove("d-none");
                            invInputReq.classList.add("d-none");
                        }
                    }
                });
            }
        });
        //! Donation Duration Validation
        DonationDuration.forEach((dur) => {
            const durInput = form.querySelector(`.duration`);
            const durInputReq = form.querySelector(
                `p.durReq[data-duration-id="${dur.dataset.durationId}"]`
            );
            if (durInput) {
                durInput.addEventListener("change", function () {
                    if (dur.selectedOptions.length === 0) {
                        durInputReq.classList.remove("d-none");
                        durInput.classList.remove("good");
                        durInput.classList.add("error");
                    } else {
                        durInput.classList.add("good");
                        durInput.classList.remove("error");
                        durInputReq.classList.add("d-none");
                    }
                });
            }
        });
        //! Donation Submition Validation
        const AllDonationSubmit = form.querySelectorAll(
            "[data-donationSubmit-id]"
        );
        if (AllDonationSubmit) {
            AllDonationSubmit.forEach((donation) => {
                donation.addEventListener("click", function (event) {
                    event.preventDefault();
                    if (validateForm(form)) {
                        form.submit();
                    }
                });
            });
        }
    });
}
//! Add Tombs Validation
const tombForm = document.getElementById("newTombForm");
if (tombForm) {
    //! Tomb Name Validation
    const tombName = tombForm.querySelector("#tombName");
    const tombReq = tombForm.querySelector("#tombReq");
    const tombMsg = tombForm.querySelector("#tombMsg");
    if (tombName) {
        tombName.addEventListener("input", function () {
            let letters = /^[\u0600-\u06FF\s\d\/\-\.\,]{3,}$/;
            if (this.value.trim() === "") {
                tombReq.classList.remove("d-none");
                tombMsg.classList.add("d-none");
                tombName.classList.remove("good");
                tombName.classList.add("error");
            } else {
                if (letters.test(this.value)) {
                    tombName.classList.add("good");
                    tombName.classList.remove("error");
                    tombMsg.classList.add("d-none");
                    tombReq.classList.add("d-none");
                } else {
                    tombName.classList.remove("good");
                    tombName.classList.add("error");
                    tombMsg.classList.remove("d-none");
                    tombReq.classList.add("d-none");
                }
            }
        });
    }
    //! Tomb Power Validation
    const tombPower = tombForm.querySelector("#tombPower");
    const tombPowerReq = tombForm.querySelector("#powerReq");
    if (tombPower) {
        tombPower.addEventListener("change", function () {
            const selectedIndexValue = this.options[this.selectedIndex].value;
            if (selectedIndexValue === "قوة المقبرة (بالغرف)") {
                tombPower.classList.add("error");
                tombPower.classList.remove("good");
                tombPowerReq.classList.remove("d-none");
            } else {
                tombPower.classList.remove("error");
                tombPower.classList.add("good");
                tombPowerReq.classList.add("d-none");
            }
            if (selectedIndexValue === "أخرى") {
                otherPower.disabled = false;
                otherPower.classList.remove("d-none");
                otherPower.classList.add("error");
                otherPowerReq.classList.remove("d-none");
            } else {
                otherPower.disabled = true;
                otherPower.classList.add("d-none");
                otherPower.classList.remove("error");
                otherPowerReq.classList.add("d-none");
            }
        });
    }
    //! Other Tomb Power Validation
    const otherPower = tombForm.querySelector("#otherPower");
    const otherPowerReq = tombForm.querySelector("#otherPowerReq");
    if (otherPower) {
        otherPower.addEventListener("input", function () {
            let letters = /^[0-9]+$/;
            if (this.value.trim() === "") {
                otherPower.classList.remove("good");
                otherPower.classList.add("error");
                otherPowerReq.classList.remove("d-none");
            } else {
                if (letters.test(this.value)) {
                    otherPower.classList.add("good");
                    otherPower.classList.remove("error");
                    otherPowerReq.classList.add("d-none");
                } else {
                    otherPower.classList.remove("good");
                    otherPower.classList.add("error");
                    otherPowerReq.classList.add("d-none");
                }
            }
        });
    }
    //! Update Other Tomb Power Validation
    const updateOtherPowerForm = document.querySelectorAll(
        "[data-tombPower-id]"
    );
    if (updateOtherPowerForm) {
        updateOtherPowerForm.forEach((power) => {
            const powerSelect = power.querySelectorAll("[data-powerselect-id]");
            const otherPowerSelect = power.querySelectorAll("[data-otherpowerselect-id]");
            //! Update Tomb Power Validation
            function handleUpdateTombOtherPower(updateSelect) {
                const selectedIndexValue = updateSelect.options[updateSelect.selectedIndex].value;
                if (selectedIndexValue === "شهري") {
                    otherPowerSelect.forEach((input) => {
                        input.disabled = true;
                        input.classList.add("d-none");
                    });
                } else if (selectedIndexValue === "0") {
                    otherPowerSelect.forEach((input) => {
                        input.disabled = false;
                        input.classList.remove("d-none");
                    });
                }
            }
            powerSelect.forEach((inputSelect) => {
                const updateSelect = power.querySelector(`select[name="power"][data-powerselect-id="${inputSelect.dataset.powerselectId}"]`);
                if (updateSelect) {
                    handleUpdateTombOtherPower(updateSelect);
                    updateSelect.addEventListener("change", function () {
                        handleUpdateTombOtherPower(updateSelect);
                    });
                }
            })
        });
    }
    //! Tomb Type Validation
    const tombType = tombForm.querySelector("#tombType");
    const tombTypeReq = tombForm.querySelector("#typeReq");
    if (tombType) {
        tombType.addEventListener("change", function () {
            const selectedIndexValue = this.options[this.selectedIndex].value;
            if (selectedIndexValue === "نوع المقبرة") {
                tombType.classList.add("error");
                tombType.classList.remove("good");
                tombTypeReq.classList.remove("d-none");
            } else {
                tombType.classList.remove("error");
                tombType.classList.add("good");
                tombTypeReq.classList.add("d-none");
            }
        });
    }
    //! Tomb Specefices Validation
    const tombSpecifices = tombForm.querySelector("#tombSpecifices");
    const tombSpecificesReq = tombForm.querySelector("#tombSpecificesReq");
    if (tombSpecifices) {
        tombSpecifices.addEventListener("change", function () {
            const selectedIndexValue = this.options[this.selectedIndex].value;
            if (selectedIndexValue === "تخصص المقبره") {
                tombSpecifices.classList.add("error");
                tombSpecifices.classList.remove("good");
                tombSpecificesReq.classList.remove("d-none");
            } else {
                tombSpecifices.classList.remove("error");
                tombSpecifices.classList.add("good");
                tombSpecificesReq.classList.add("d-none");
            }
        });
    }
    //! Tomb Region Validation
    const tombRegion = tombForm.querySelector("#tombRegion");
    const tombRegionReq = tombForm.querySelector("#regionReq");
    if (tombRegion) {
        tombRegion.addEventListener("change", function () {
            const selectedIndexValue = this.options[this.selectedIndex].value;
            if (selectedIndexValue === "المنطقة") {
                tombRegion.classList.add("error");
                tombRegion.classList.remove("good");
                tombRegionReq.classList.remove("d-none");
            } else {
                tombRegion.classList.remove("error");
                tombRegion.classList.add("good");
                tombRegionReq.classList.add("d-none");
            }
        });
    }
    //! Tomb Annual Cost Validation
    const tombCost = tombForm.querySelector("#tombCost");
    const costReq = tombForm.querySelector("#costReq");
    const costMsg = tombForm.querySelector("#costMsg");
    if (tombCost) {
        tombCost.addEventListener("input", function () {
            let letters = /^[0-9]{2,}$/;
            if (this.value.trim() === "") {
                costReq.classList.remove("d-none");
                costMsg.classList.add("d-none");
                tombCost.classList.remove("good");
                tombCost.classList.add("error");
            } else {
                if (letters.test(this.value)) {
                    tombCost.classList.add("good");
                    tombCost.classList.remove("error");
                    costMsg.classList.add("d-none");
                    costReq.classList.add("d-none");
                } else {
                    tombCost.classList.remove("good");
                    tombCost.classList.add("error");
                    costMsg.classList.remove("d-none");
                    costReq.classList.add("d-none");
                }
            }
        });
    }
    //! Tomb Power Validation
    //! Tomb Type Validation
    //! Tomb Region Validation
    //! Tomb Annual Cost Validation
    //! Tomb Submition Validation
    const tombSubmition = tombForm.querySelector("#tombSubmit");
    if (tombSubmition) {
        tombSubmition.addEventListener("click", function (event) {
            event.preventDefault();
            if (validateForm(tombForm)) {
                tombForm.submit();
            }
        });
    }
}
//! Old Deceased Validation
const OldDeceasedForm = document.getElementById("OldDeceasedForm");
if (OldDeceasedForm) {
    //! Old Deceased Name Validation
    const oldDeceasedName = OldDeceasedForm.querySelector("#oldDeceasedName");
    const nameReq = OldDeceasedForm.querySelector("#oldReq");
    const nameMsg = OldDeceasedForm.querySelector("#oldMsg");
    if (oldDeceasedName) {
        oldDeceasedName.addEventListener("input", function () {
            let letters = /^[\u0600-\u06FF\s]{3,}$/;
            if (this.value.trim() === "") {
                nameReq.classList.remove("d-none");
                nameMsg.classList.add("d-none");
                oldDeceasedName.classList.remove("good");
                oldDeceasedName.classList.add("error");
            } else {
                if (letters.test(this.value)) {
                    oldDeceasedName.classList.add("good");
                    oldDeceasedName.classList.remove("error");
                    nameMsg.classList.add("d-none");
                    nameReq.classList.add("d-none");
                } else {
                    oldDeceasedName.classList.remove("good");
                    oldDeceasedName.classList.add("error");
                    nameMsg.classList.remove("d-none");
                    nameReq.classList.add("d-none");
                }
            }
        });
    }
    //! Old Deceased Region Select Validation
    const oldDeceasedRegion = OldDeceasedForm.querySelector("#region");
    const regionReq = OldDeceasedForm.querySelector("#regionSelectReq");
    if (oldDeceasedRegion) {
        oldDeceasedRegion.addEventListener("change", function () {
            const selectedIndexValue = this.options[this.selectedIndex].value;
            if (selectedIndexValue === "المنطقة") {
                oldDeceasedRegion.classList.add("error");
                oldDeceasedRegion.classList.remove("good");
                regionReq.classList.remove("d-none");
            } else {
                oldDeceasedRegion.classList.remove("error");
                oldDeceasedRegion.classList.add("good");
                regionReq.classList.add("d-none");
            }
        });
    }
    //! Old Deceased Tomb Select Validation
    const oldDeceasedTomb = OldDeceasedForm.querySelector("#regionTomb");
    const tombReq = OldDeceasedForm.querySelector("#tombSelectReq");
    if (oldDeceasedTomb) {
        oldDeceasedTomb.addEventListener("change", function () {
            const selectedIndexValue = this.options[this.selectedIndex].value;
            if (selectedIndexValue === "المقبرة") {
                oldDeceasedTomb.classList.add("error");
                oldDeceasedTomb.classList.remove("good");
                tombReq.classList.remove("d-none");
            } else {
                oldDeceasedTomb.classList.remove("error");
                oldDeceasedTomb.classList.add("good");
                tombReq.classList.add("d-none");
            }
        });
    }
    //! Old Deceased Death Date Validation
    const oldDeceasedDeathDate =
        OldDeceasedForm.querySelector("#deceasedDeath");
    const deathDateReq = OldDeceasedForm.querySelector("#deathDateReq");
    if (oldDeceasedDeathDate) {
        oldDeceasedDeathDate.addEventListener("change", function () {
            const deathDateValue = oldDeceasedDeathDate.value;
            if (deathDateValue === "") {
                oldDeceasedDeathDate.classList.add("error");
                oldDeceasedDeathDate.classList.remove("good");
                deathDateReq.classList.remove("d-none");
            } else {
                oldDeceasedDeathDate.classList.remove("error");
                oldDeceasedDeathDate.classList.add("good");
                deathDateReq.classList.add("d-none");
            }
        });
    }
    //! Old Deceased Burial Date Validation
    const oldDeceasedBurialDate =
        OldDeceasedForm.querySelector("#deceasedBurial");
    const burialDateReq = OldDeceasedForm.querySelector("#burialReq");
    if (oldDeceasedBurialDate) {
        oldDeceasedBurialDate.addEventListener("change", function () {
            const deathDateValue = oldDeceasedBurialDate.value;
            if (deathDateValue === "") {
                oldDeceasedBurialDate.classList.add("error");
                oldDeceasedBurialDate.classList.remove("good");
                burialDateReq.classList.remove("d-none");
            } else {
                oldDeceasedBurialDate.classList.remove("error");
                oldDeceasedBurialDate.classList.add("good");
                burialDateReq.classList.add("d-none");
            }
        });
    }
    //! Old Deceased Submitition Validation
    const OldSubmit = OldDeceasedForm.querySelector("#OldSubmit");
    if (OldSubmit) {
        OldSubmit.addEventListener("click", function (event) {
            event.preventDefault();
            if (validateForm(OldDeceasedForm)) {
                OldDeceasedForm.submit();
            }
        });
    }
}
//! Region Form Validation
const RegionForm = document.getElementById("regionForm");
if (RegionForm) {
    //! Region Name Validation
    const regionName = RegionForm.querySelector("#regionName");
    const regionNameReq = RegionForm.querySelector("#regionNameReq");
    if (regionName) {
        regionName.addEventListener("input", function () {
            let letters = /^[\u0600-\u06FF\s]+$/;
            if (this.value.trim() === "") {
                regionNameReq.classList.remove("d-none");
                regionName.classList.remove("good");
                regionName.classList.add("error");
            } else {
                if (letters.test(this.value)) {
                    regionName.classList.add("good");
                    regionName.classList.remove("error");
                    regionNameReq.classList.add("d-none");
                } else {
                    regionName.classList.remove("good");
                    regionName.classList.add("error");
                    regionNameReq.classList.add("d-none");
                }
            }
        });
    }
    //! Region Power Validation
    const regionPower = RegionForm.querySelector("#regionPower");
    const regionPowerReq = RegionForm.querySelector("#regionPowerReq");
    const regionPowerMsg = RegionForm.querySelector("#regionPowerMsg");
    if (regionPower) {
        regionPower.addEventListener("input", function () {
            let letters = /^[0-9]{2}$/;
            if (this.value.trim() === "") {
                regionPower.classList.remove("good");
                regionPower.classList.add("error");
                regionPowerReq.classList.remove("d-none");
                regionPowerMsg.classList.add("d-none");
            } else {
                if (letters.test(this.value)) {
                    regionPower.classList.add("good");
                    regionPower.classList.remove("error");
                    regionPowerReq.classList.add("d-none");
                    regionPowerMsg.classList.add("d-none");
                } else {
                    regionPower.classList.remove("good");
                    regionPower.classList.add("error");
                    regionPowerReq.classList.add("d-none");
                    regionPowerMsg.classList.remove("d-none");
                }
            }
        });
    }
    //! Region Submition Validation
    const regionSubmition = RegionForm.querySelector("#regionSubmition");
    if (regionSubmition) {
        regionSubmition.addEventListener("click", function (event) {
            event.preventDefault();
            if (validateForm(RegionForm)) {
                RegionForm.submit();
            }
        });
    }
}
//! Deceased Form Validation
const deceasedForm = document.getElementById("deceasedForm");
if (deceasedForm) {
    //! Deceased Name
    let DeceasedName = deceasedForm.querySelector("#deceasedName");
    let DeceasedNameReq = deceasedForm.querySelector("#deceasedNameReq");
    let DeceasedNameMsg = deceasedForm.querySelector("#deceasedNameMsg");
    if (DeceasedName) {
        DeceasedName.addEventListener("input", function () {
            let letters = /^[\u0600-\u06FF\s]{3,}$/;
            if (this.value.trim() === "") {
                DeceasedNameReq.classList.remove("d-none");
                DeceasedNameMsg.classList.add("d-none");
                DeceasedName.classList.remove("good");
                DeceasedName.classList.add("error");
            } else {
                if (letters.test(this.value)) {
                    DeceasedName.classList.add("good");
                    DeceasedName.classList.remove("error");
                    DeceasedNameMsg.classList.add("d-none");
                    DeceasedNameReq.classList.add("d-none");
                } else {
                    DeceasedName.classList.remove("good");
                    DeceasedName.classList.add("error");
                    DeceasedNameMsg.classList.remove("d-none");
                    DeceasedNameReq.classList.add("d-none");
                }
            }
        });
    }
    //! Deceased Death Place
    let DeceasedDeathPlace = deceasedForm.querySelector("#death_place");
    let DeceasedDeathPlaceReq = deceasedForm.querySelector("#deathPlaceReq");
    if (DeceasedDeathPlace) {
        DeceasedDeathPlace.addEventListener("input", function () {
            let letters = /^[\u0600-\u06FF\s]+$/;
            if (this.value.trim() === "") {
                DeceasedDeathPlace.classList.remove("good");
                DeceasedDeathPlace.classList.add("error");
                DeceasedDeathPlaceReq.classList.remove("d-none");
            } else {
                if (letters.test(this.value)) {
                    DeceasedDeathPlace.classList.add("good");
                    DeceasedDeathPlace.classList.remove("error");
                    DeceasedDeathPlaceReq.classList.add("d-none");
                } else {
                    DeceasedDeathPlace.classList.remove("good");
                    DeceasedDeathPlace.classList.add("error");
                    DeceasedDeathPlaceReq.classList.add("d-none");
                }
            }
        });
    }
    //! Deceased Death Date
    const DeceasedDeathDate = deceasedForm.querySelector("#death_date");
    const DeceasedDeathReq = deceasedForm.querySelector("#death_date_req");
    if (DeceasedDeathDate) {
        DeceasedDeathDate.addEventListener("change", function () {
            const deathDateValue = DeceasedDeathDate.value;
            if (deathDateValue === "") {
                DeceasedDeathDate.classList.add("error");
                DeceasedDeathDate.classList.remove("good");
                DeceasedDeathReq.classList.remove("d-none");
            } else {
                DeceasedDeathDate.classList.remove("error");
                DeceasedDeathDate.classList.add("good");
                DeceasedDeathReq.classList.add("d-none");
            }
        });
    }
    //! Deceased Burial Date
    const BurialDate = deceasedForm.querySelector("#burial_date");
    const BurialDateReq = deceasedForm.querySelector("#burial_date_req");
    if (BurialDate) {
        BurialDate.addEventListener("change", function () {
            const deathDateValue = BurialDate.value;
            if (deathDateValue === "") {
                BurialDate.classList.add("error");
                BurialDate.classList.remove("good");
                BurialDateReq.classList.remove("d-none");
            } else {
                BurialDate.classList.remove("error");
                BurialDate.classList.add("good");
                BurialDateReq.classList.add("d-none");
            }
        });
    }
    //! Deceased Burial Cost
    let BurialCost = deceasedForm.querySelector("#burial_cost");
    let BurialCostReq = deceasedForm.querySelector("#burial_cost_req");
    if (BurialCost) {
        BurialCost.addEventListener("input", function () {
            let letters = /^\d+$/;
            if (this.value.trim() === "") {
                BurialCostReq.classList.remove("d-none");
                BurialCost.classList.remove("good");
                BurialCost.classList.add("error");
            } else {
                if (letters.test(this.value)) {
                    BurialCost.classList.add("good");
                    BurialCost.classList.remove("error");
                    BurialCostReq.classList.add("d-none");
                } else {
                    BurialCost.classList.remove("good");
                    BurialCost.classList.add("error");
                    BurialCostReq.classList.add("d-none");
                }
            }
        });
    }
    //! Deceased Gender
    const DeceasedGender = deceasedForm.querySelector("#gender");
    const GenderReq = deceasedForm.querySelector("#genReq");
    if (DeceasedGender) {
        DeceasedGender.addEventListener("change", function () {
            const selectedIndexValue = this.options[this.selectedIndex].value;
            if (selectedIndexValue === "جنس المتوفي") {
                DeceasedGender.classList.add("error");
                DeceasedGender.classList.remove("good");
                GenderReq.classList.remove("d-none");
            } else {
                DeceasedGender.classList.remove("error");
                DeceasedGender.classList.add("good");
                GenderReq.classList.add("d-none");
            }
        });
    }
    //! Deceased Size
    const DeceasedSize = deceasedForm.querySelector("#size");
    const SizeReq = deceasedForm.querySelector("#sizeReq");
    if (DeceasedSize) {
        DeceasedSize.addEventListener("change", function () {
            const selectedIndexValue = this.options[this.selectedIndex].value;
            if (selectedIndexValue === "حجم المتوفي") {
                DeceasedSize.classList.add("error");
                DeceasedSize.classList.remove("good");
                SizeReq.classList.remove("d-none");
            } else {
                DeceasedSize.classList.remove("error");
                DeceasedSize.classList.add("good");
                SizeReq.classList.add("d-none");
            }
        });
    }
    //! Deceased Age
    const DeceasedAge = deceasedForm.querySelector("#age");
    const AgeReq = deceasedForm.querySelector("#ageReq");
    if (DeceasedAge) {
        DeceasedAge.addEventListener("change", function () {
            const selectedIndexValue = this.options[this.selectedIndex].value;
            if (selectedIndexValue === "سن المتوفي") {
                DeceasedAge.classList.add("error");
                DeceasedAge.classList.remove("good");
                AgeReq.classList.remove("d-none");
            } else {
                DeceasedAge.classList.remove("error");
                DeceasedAge.classList.add("good");
                AgeReq.classList.add("d-none");
            }
        });
    }
    //! Deceased Images
    const DeceasedImgsFiles = deceasedForm.querySelector("#imgs");
    const DeceasedImgsFilesReq = deceasedForm.querySelector("#ImgsReq");
    const DeceasedImgsFilesSize = deceasedForm.querySelector("#ImgsSize");
    const DeceasedImgsFilesExt = deceasedForm.querySelector("#ImgsExt");
    if (DeceasedImgsFiles) {
        DeceasedImgsFiles.addEventListener("change", function () {
            const img = DeceasedImgsFiles.files[0];
            if (img) {
                validateImage(
                    img,
                    DeceasedImgsFilesReq,
                    DeceasedImgsFilesExt,
                    DeceasedImgsFiles,
                    DeceasedImgsFilesSize
                );
            } else {
                DeceasedImgsFiles.classList.remove("good");
                DeceasedImgsFiles.classList.add("error");
                DeceasedImgsFilesReq.classList.remove("d-none");
                DeceasedImgsFilesSize.classList.add("d-none");
                DeceasedImgsFilesExt.classList.add("d-none");
            }
        });
    }
    //! Deceased PDF
    const DeceasedPdfFiles = deceasedForm.querySelector("#pdfs");
    const DeceasedPdfFilesReq = deceasedForm.querySelector("#PdfReq");
    const DeceasedPdfFilesSize = deceasedForm.querySelector("#PdfSize");
    const DeceasedPdfFilesExt = deceasedForm.querySelector("#PdfExt");
    if (DeceasedPdfFiles) {
        DeceasedPdfFiles.addEventListener("change", function () {
            const file = DeceasedPdfFiles.files[0];
            if (file) {
                validateFile(
                    file,
                    DeceasedPdfFilesReq,
                    DeceasedPdfFilesExt,
                    DeceasedPdfFilesSize,
                    DeceasedPdfFiles
                );
            } else {
                DeceasedPdfFiles.classList.remove("good");
                DeceasedPdfFiles.classList.add("error");
                DeceasedPdfFilesReq.classList.remove("d-none");
                DeceasedPdfFilesSize.classList.add("d-none");
                DeceasedPdfFilesExt.classList.add("d-none");
            }
        });
    }
    //! Deceased Washer
    const DeceasedWasher = deceasedForm.querySelector("#the_washer");
    const DeceasedWasherReq = deceasedForm.querySelector("#washerReq");
    if (DeceasedWasher) {
        DeceasedWasher.addEventListener("input", function () {
            let letters = /^[\u0600-\u06FF\s\d\/\-\.\,]+$/;
            if (this.value.trim() === "") {
                DeceasedWasher.classList.remove("good");
                DeceasedWasher.classList.add("error");
                DeceasedWasherReq.classList.remove("d-none");
            } else {
                if (letters.test(this.value)) {
                    DeceasedWasher.classList.add("good");
                    DeceasedWasher.classList.remove("error");
                    DeceasedWasherReq.classList.add("d-none");
                } else {
                    DeceasedWasher.classList.remove("good");
                    DeceasedWasher.classList.add("error");
                    DeceasedWasherReq.classList.add("d-none");
                }
            }
        });
    }
    //! Deceased Transporter
    const DeceasedCarrier = deceasedForm.querySelector("#the_carrier");
    const DeceasedCarrierReq = deceasedForm.querySelector("#carrierReq");
    if (DeceasedCarrier) {
        DeceasedCarrier.addEventListener("input", function () {
            let letters = /^[\u0600-\u06FF\s]+$/;
            if (this.value.trim() === "") {
                DeceasedCarrier.classList.remove("good");
                DeceasedCarrier.classList.add("error");
                DeceasedCarrierReq.classList.remove("d-none");
            } else {
                if (letters.test(this.value)) {
                    DeceasedCarrier.classList.add("good");
                    DeceasedCarrier.classList.remove("error");
                    DeceasedCarrierReq.classList.add("d-none");
                } else {
                    DeceasedCarrier.classList.remove("good");
                    DeceasedCarrier.classList.add("error");
                    DeceasedCarrierReq.classList.add("d-none");
                }
            }
        });
    }
    //! Deceased Region Name
    const DeceasedRegion = deceasedForm.querySelector("#region");
    const RegionReq = deceasedForm.querySelector("#regionReq");
    if (DeceasedRegion) {
        DeceasedRegion.addEventListener("change", function () {
            const selectedIndexValue = this.options[this.selectedIndex].value;
            if (selectedIndexValue === "المنطقة") {
                DeceasedRegion.classList.add("error");
                DeceasedRegion.classList.remove("good");
                RegionReq.classList.remove("d-none");
            } else {
                DeceasedRegion.classList.remove("error");
                DeceasedRegion.classList.add("good");
                RegionReq.classList.add("d-none");
            }
        });
    }
    //! Deceased Tomb Name
    const DeceasedTomb = deceasedForm.querySelector("#regionTomb");
    const TombReq = deceasedForm.querySelector("#tombReq");
    if (DeceasedTomb) {
        DeceasedTomb.addEventListener("change", function () {
            const selectedIndexValue = this.options[this.selectedIndex].value;
            if (selectedIndexValue === "المنطقة") {
                DeceasedTomb.classList.add("error");
                DeceasedTomb.classList.remove("good");
                TombReq.classList.remove("d-none");
            } else {
                DeceasedTomb.classList.remove("error");
                DeceasedTomb.classList.add("good");
                TombReq.classList.add("d-none");
            }
        });
    }
    //! Deceased Room Name
    const DeceasedRoom = deceasedForm.querySelector("#room");
    const RoomReq = deceasedForm.querySelector("#roomReq");
    if (DeceasedRoom) {
        DeceasedRoom.addEventListener("change", function () {
            const selectedIndexValue = this.options[this.selectedIndex].value;
            if (selectedIndexValue === "المنطقة") {
                DeceasedRoom.classList.add("error");
                DeceasedRoom.classList.remove("good");
                RoomReq.classList.remove("d-none");
            } else {
                DeceasedRoom.classList.remove("error");
                DeceasedRoom.classList.add("good");
                RoomReq.classList.add("d-none");
            }
        });
    }
    //! Deceased Notes
    const DeceasedNotes = deceasedForm.querySelector("#notes");
    const DeceasedNotesReq = deceasedForm.querySelector("#notesReq");
    if (DeceasedNotes) {
        DeceasedNotes.addEventListener("input", function () {
            let letters = /^[\u0600-\u06FF\s]+$/;
            if (this.value.trim() === "") {
                DeceasedNotes.classList.remove("good");
                DeceasedNotes.classList.add("error");
                DeceasedNotesReq.classList.remove("d-none");
            } else {
                if (letters.test(this.value)) {
                    DeceasedNotes.classList.add("good");
                    DeceasedNotes.classList.remove("error");
                    DeceasedNotesReq.classList.add("d-none");
                } else {
                    DeceasedNotes.classList.remove("good");
                    DeceasedNotes.classList.add("error");
                    DeceasedNotesReq.classList.add("d-none");
                }
            }
        });
    }
    //! Deceased Submition
    const DeceasedSubmition = deceasedForm.querySelector("#deceasedSubmit");
    if (DeceasedSubmition) {
        DeceasedSubmition.addEventListener("click", function (event) {
            event.preventDefault();
            if (validateForm(deceasedForm)) {
                deceasedForm.submit();
            }
        });
    }
}
//! Village Deceaseds Validation
const VillageForm = document.getElementById("villageForm");
if (VillageForm) {
    //! Village Deceased Name
    const VillageDeceasedName = VillageForm.querySelector("#villageDeceasedName");
    if (VillageDeceasedName) {
        const VillageDeceasedNameReq = VillageForm.querySelector(
            "#villageDeceasedNameReq"
        );
        const VillageDeceasedNameMsg = VillageForm.querySelector(
            "#villageDeceasedNameMsg"
        );
        VillageDeceasedName.addEventListener("input", function () {
            let letters = /^[\u0600-\u06FF\s\d\/\-\.\,]{3,}$/;
            if (VillageDeceasedName.value.trim() === "") {
                VillageDeceasedNameReq.classList.remove("d-none");
                VillageDeceasedNameMsg.classList.add("d-none");
                VillageDeceasedName.classList.remove("good");
                VillageDeceasedName.classList.add("error");
            } else {
                if (letters.test(VillageDeceasedName.value)) {
                    VillageDeceasedName.classList.add("good");
                    VillageDeceasedName.classList.remove("error");
                    VillageDeceasedNameMsg.classList.add("d-none");
                    VillageDeceasedNameReq.classList.add("d-none");
                } else {
                    VillageDeceasedName.classList.remove("good");
                    VillageDeceasedName.classList.add("error");
                    VillageDeceasedNameMsg.classList.remove("d-none");
                    VillageDeceasedNameReq.classList.add("d-none");
                }
            }
        })
    }
    //! Village Deceased Gender
    const VillageDeceasedGender = VillageForm.querySelector("#villageDeceasedGender");
    if (VillageDeceasedGender) {
        VillageDeceasedGender.addEventListener("change", function () {
            const VillageDeceasedGenderReq =
                VillageForm.querySelector("#villageGenReq");
            const selectedIndexValue = this.options[this.selectedIndex].value;
            if (selectedIndexValue === "جنس المتوفي") {
                VillageDeceasedGender.classList.add("error");
                VillageDeceasedGender.classList.remove("good");
                VillageDeceasedGenderReq.classList.remove("d-none");
            } else {
                VillageDeceasedGender.classList.remove("error");
                VillageDeceasedGender.classList.add("good");
                VillageDeceasedGenderReq.classList.add("d-none");
            }
        });
    }
    //! Village Deceased Death Place
    const VillageDeceasedDeathPlace = VillageForm.querySelector("#villageDeceasedDeathPlace");
    if (VillageDeceasedDeathPlace) {
        const VillageDeceasedDeathPlaceReq = VillageForm.querySelector(
            "#villageDeathPlaceReq"
        );
        VillageDeceasedDeathPlace.addEventListener("input", function () {
            let letters = /^[\u0600-\u06FF\s\d\/\-\.\,]{3,}$/;
            if (this.value.trim() === "") {
                VillageDeceasedDeathPlaceReq.classList.remove("d-none");
                VillageDeceasedDeathPlace.classList.remove("good");
                VillageDeceasedDeathPlace.classList.add("error");
            } else {
                if (letters.test(this.value)) {
                    VillageDeceasedDeathPlace.classList.add("good");
                    VillageDeceasedDeathPlace.classList.remove("error");
                    VillageDeceasedDeathPlaceReq.classList.add("d-none");
                } else {
                    VillageDeceasedDeathPlace.classList.remove("good");
                    VillageDeceasedDeathPlace.classList.add("error");
                    VillageDeceasedDeathPlaceReq.classList.add("d-none");
                }
            }
        });
    }
    //! Village Deceased Death Date
    const VillageDeceasedDeathDate = VillageForm.querySelector("#villageDeceasedDeathDate");
    if (VillageDeceasedDeathDate) {
        const VillageDeceasedDeathDateReq = VillageForm.querySelector("#village_death_date_req");
        VillageDeceasedDeathDate.addEventListener("change", function () {
            const deathDateValue = VillageDeceasedDeathDate.value;
            if (deathDateValue === "") {
                VillageDeceasedDeathDate.classList.add("error");
                VillageDeceasedDeathDate.classList.remove("good");
                VillageDeceasedDeathDateReq.classList.remove("d-none");
            } else {
                VillageDeceasedDeathDate.classList.remove("error");
                VillageDeceasedDeathDate.classList.add("good");
                VillageDeceasedDeathDateReq.classList.add("d-none");
            }
        });
    }
    //! Village Deceased Burial Date
    const VillageDeceasedBurialDate = VillageForm.querySelector("#villageDeceasedBurialDate");
    if (VillageDeceasedBurialDate) {
        const VillageDeceasedBurialDateReq = VillageForm.querySelector("#village_burial_date_req");
        VillageDeceasedBurialDate.addEventListener("change", function () {
            const burialDateValue = VillageDeceasedBurialDate.value;
            if (burialDateValue === "") {
                VillageDeceasedBurialDate.classList.add("error");
                VillageDeceasedBurialDate.classList.remove("good");
                VillageDeceasedBurialDateReq.classList.remove("d-none");
            } else {
                VillageDeceasedBurialDate.classList.remove("error");
                VillageDeceasedBurialDate.classList.add("good");
                VillageDeceasedBurialDateReq.classList.add("d-none");
            }
        });
    }
    //! Village Deceased Submittion
    const VillageFormSubmition = VillageForm.querySelector("#villageDeceasedSubmit");
    if (VillageFormSubmition) {
        VillageFormSubmition.addEventListener("click", function (event) {
            event.preventDefault();
            if (validateForm(VillageForm)) {
                VillageForm.submit();
            }
        })
    }
}
//! New Tomb Donators Validation
const NewDonatorsForm = document.getElementById("newTombDonatorsForm");
if (NewDonatorsForm) {
    //! New Tomb Donators Name Validations
    const NewDonatorsName = NewDonatorsForm.querySelector("#tombDonatorName");
    if (NewDonatorsName) {
        const NewDonatorsNameReq =
            NewDonatorsForm.querySelector("#tombDonatorReq");
        const NewDonatorsNameMsg =
            NewDonatorsForm.querySelector("#tombDonatorMsg");
        NewDonatorsName.addEventListener("input", function () {
            let letters = /^[\u0600-\u06FF\s\d\/\-\.\,]{3,}$/;
            if (NewDonatorsName.value.trim() === "") {
                NewDonatorsNameReq.classList.remove("d-none");
                NewDonatorsNameMsg.classList.add("d-none");
                NewDonatorsName.classList.remove("good");
                NewDonatorsName.classList.add("error");
            } else {
                if (letters.test(NewDonatorsName.value)) {
                    NewDonatorsName.classList.add("good");
                    NewDonatorsName.classList.remove("error");
                    NewDonatorsNameMsg.classList.add("d-none");
                    NewDonatorsNameReq.classList.add("d-none");
                } else {
                    NewDonatorsName.classList.remove("good");
                    NewDonatorsName.classList.add("error");
                    NewDonatorsNameMsg.classList.remove("d-none");
                    NewDonatorsNameReq.classList.add("d-none");
                }
            }
        });
    }
    //! New Tomb Donators Mobile Number Validation
    const NewDonatorsMobile =
        NewDonatorsForm.querySelector("#tombDonatorMobile");
    if (NewDonatorsMobile) {
        const NewDonatorsMobileReq = NewDonatorsForm.querySelector(
            "#tombdonatorMobileReq"
        );
        const NewDonatorsMobileMsg = NewDonatorsForm.querySelector(
            "#tombdonatorMobileMsg"
        );
        NewDonatorsMobile.addEventListener("input", function () {
            let letters = /^[0-9]{12}$/;
            if (this.value.trim() === "") {
                NewDonatorsMobileReq.classList.remove("d-none");
                NewDonatorsMobileMsg.classList.add("d-none");
                NewDonatorsMobile.classList.remove("good");
                NewDonatorsMobile.classList.add("error");
            } else {
                if (letters.test(this.value)) {
                    NewDonatorsMobile.classList.add("good");
                    NewDonatorsMobile.classList.remove("error");
                    NewDonatorsMobileMsg.classList.add("d-none");
                    NewDonatorsMobileReq.classList.add("d-none");
                } else {
                    NewDonatorsMobile.classList.remove("good");
                    NewDonatorsMobile.classList.add("error");
                    NewDonatorsMobileMsg.classList.remove("d-none");
                    NewDonatorsMobileReq.classList.add("d-none");
                }
            }
        });
    }
    //! New Tomb DOnators Duration Validation
    const NewDonatorsDuration =
        NewDonatorsForm.querySelector("#donationDuration");
    if (NewDonatorsDuration) {
        const NewDonatorsDurationReq =
            NewDonatorsForm.querySelector("#tombDurationReq");
        NewDonatorsDuration.addEventListener("change", function () {
            const selectedIndexValue = this.options[this.selectedIndex].value;
            if (selectedIndexValue === "نوع المتبرع") {
                NewDonatorsDuration.classList.add("error");
                NewDonatorsDuration.classList.remove("good");
                NewDonatorsDurationReq.classList.remove("d-none");
            } else {
                NewDonatorsDuration.classList.remove("error");
                NewDonatorsDuration.classList.add("good");
                NewDonatorsDurationReq.classList.add("d-none");
            }
            if (selectedIndexValue === "أخرى") {
                NewDonatorsOtherDonation.disabled = false;
                NewDonatorsOtherDonation.classList.remove("d-none");
                if (NewDonatorsOtherDonation.value.trim() === "") {
                    NewDonatorsOtherDonationReq.classList.remove("d-none");
                    NewDonatorsOtherDonation.classList.remove("good");
                    NewDonatorsOtherDonation.classList.add("error");
                }
            } else {
                NewDonatorsOtherDonation.disabled = true;
                NewDonatorsOtherDonation.value = "";
                NewDonatorsOtherDonation.classList.add("d-none");
                NewDonatorsOtherDonation.classList.remove("good");
                NewDonatorsOtherDonation.classList.remove("error");
                NewDonatorsOtherDonationReq.classList.add("d-none");
            }
        });
    }
    //! New Tomb Donators Other Duration
    const NewDonatorsOtherDonation =
        NewDonatorsForm.querySelector("#tombOtherDuration");
    const NewDonatorsOtherDonationReq =
        NewDonatorsForm.querySelector("#tombOtherReq");
    if (NewDonatorsOtherDonation) {
        NewDonatorsOtherDonation.addEventListener("input", function () {
            let letters = /^[\u0600-\u06FF\s]+$/;
            if (this.value.trim() === "") {
                NewDonatorsOtherDonationReq.classList.remove("d-none");
                NewDonatorsOtherDonation.classList.remove("good");
                NewDonatorsOtherDonation.classList.add("error");
            } else {
                if (letters.test(this.value)) {
                    NewDonatorsOtherDonation.classList.add("good");
                    NewDonatorsOtherDonation.classList.remove("error");
                    NewDonatorsOtherDonationReq.classList.add("d-none");
                } else {
                    NewDonatorsOtherDonation.classList.remove("good");
                    NewDonatorsOtherDonation.classList.add("error");
                    NewDonatorsOtherDonationReq.classList.add("d-none");
                }
            }
        });
    }
    //! Tomb From Submition Validation
    const TombFormSubmition =
        NewDonatorsForm.querySelector("#tombFormSubmition");
    if (TombFormSubmition) {
        TombFormSubmition.addEventListener("click", function (event) {
            event.preventDefault();
            if (validateForm(NewDonatorsForm)) {
                NewDonatorsForm.submit();
            }
        });
    }
}
//! New Tomb Donator Update Validation
const NewDonatorsFormUpdate = document.querySelectorAll("[data-newdonator-id]");
if (NewDonatorsFormUpdate.length > 0) {
    NewDonatorsFormUpdate.forEach((newdonation) => {
        const UpdateDonatorType = newdonation.querySelectorAll("[data-donatortype-id]");
        const UpdateOtherDonationType = newdonation.querySelectorAll("[data-donatorduration-id]");

        function handleValidationDonation(updateSelect) {
            const selectedDonatorType = updateSelect.options[updateSelect.selectedIndex].value;
            if (selectedDonatorType === "شهري") {
                UpdateOtherDonationType.forEach((input) => {
                    input.disabled = true;
                    input.classList.add("d-none");
                });
            } else if (selectedDonatorType === "أخرى") {
                UpdateOtherDonationType.forEach((input) => {
                    input.disabled = false;
                    input.classList.remove("d-none");
                });
            }
        }

        UpdateDonatorType.forEach((update) => {
            const updateSelect = newdonation.querySelector(`select[name="donator_type"][data-donatortype-id="${update.dataset.donatortypeId}"]`);
            if (updateSelect) {
                handleValidationDonation(updateSelect);
                updateSelect.addEventListener("change", function () {
                    handleValidationDonation(updateSelect);
                });
            }
        });
    });
}
//! Validation For Tomb Donation History Insertion
const TombDonationForm = document.getElementById("TombDonationForm");
if (TombDonationForm) {
    //! New Tomb Donations Durations
    const tombDonatorDonationDuration = TombDonationForm.querySelector("#tombDonatorDonationDuration");
    if (tombDonatorDonationDuration) {
        const tombDonatorDonationDurationReq = TombDonationForm.querySelector("#tombDonatorDonationDurationReq");
        tombDonatorDonationDuration.addEventListener("input", function () {
            let letters = /^[\u0600-\u06FF\s]+$/;
            if (this.value.trim() === "") {
                tombDonatorDonationDurationReq.classList.remove("d-none");
                tombDonatorDonationDuration.classList.remove("good");
                tombDonatorDonationDuration.classList.add("error");
            } else {
                if (letters.test(this.value)) {
                    tombDonatorDonationDuration.classList.add("good");
                    tombDonatorDonationDuration.classList.remove("error");
                    tombDonatorDonationDurationReq.classList.add("d-none");
                } else {
                    tombDonatorDonationDuration.classList.remove("good");
                    tombDonatorDonationDuration.classList.add("error");
                    tombDonatorDonationDurationReq.classList.add("d-none");
                }
            }
        })
    }
    //! New Tomb Donations Amount
    const tombDonatorDonationAmount = TombDonationForm.querySelector("#tombDonatorAmount");
    if (tombDonatorDonationAmount) {
        const tombDonatorDonationAmountReq = TombDonationForm.querySelector("#tombDonatorDonationAmountReq");
        const tombDonatorDonationAmountMsg = TombDonationForm.querySelector("#tombDonatorDonationAmountMsg");
        tombDonatorDonationAmount.addEventListener("input", function () {
            let letters = /^[0-9]{5}/;
            if (this.value.trim() === "") {
                tombDonatorDonationAmount.classList.remove("good");
                tombDonatorDonationAmount.classList.add("error");
                tombDonatorDonationAmountReq.classList.remove("d-none");
                tombDonatorDonationAmountMsg.classList.add("d-none");
            } else {
                if (letters.test(this.value)) {
                    tombDonatorDonationAmount.classList.add("good");
                    tombDonatorDonationAmount.classList.remove("error");
                    tombDonatorDonationAmountMsg.classList.add("d-none");
                    tombDonatorDonationAmountReq.classList.add("d-none");
                } else {
                    tombDonatorDonationAmount.classList.remove("good");
                    tombDonatorDonationAmount.classList.add("error");
                    tombDonatorDonationAmountMsg.classList.remove("d-none");
                    tombDonatorDonationAmountReq.classList.add("d-none");
                }
            }
        })
    }
    //! New Tomb Donations Invoice Number
    const tombDonatorDonationInvoice = TombDonationForm.querySelector("#tombDonatorDonationInvoice");
    if (tombDonatorDonationInvoice) {
        const tombDonatorDonationInvoiceReq = TombDonationForm.querySelector("#tombDonatorDonationInvoiceReq");
        const tombDonatorDonationInvoiceMsg = TombDonationForm.querySelector("#tombDonatorDonationInvoiceMsg");
        tombDonatorDonationInvoice.addEventListener("input", function () {
            let letters = /^[0-9]{5}/;
            if (this.value.trim() === "") {
                tombDonatorDonationInvoice.classList.remove("good");
                tombDonatorDonationInvoice.classList.add("error");
                tombDonatorDonationInvoiceReq.classList.remove("d-none");
                tombDonatorDonationInvoiceMsg.classList.add("d-none");
            } else {
                if (letters.test(this.value)) {
                    tombDonatorDonationInvoice.classList.add("good");
                    tombDonatorDonationInvoice.classList.remove("error");
                    tombDonatorDonationInvoiceMsg.classList.add("d-none");
                    tombDonatorDonationInvoiceReq.classList.add("d-none");
                } else {
                    tombDonatorDonationInvoice.classList.remove("good");
                    tombDonatorDonationInvoice.classList.add("error");
                    tombDonatorDonationInvoiceMsg.classList.remove("d-none");
                    tombDonatorDonationInvoiceReq.classList.add("d-none");
                }
            }
        })
    }
    //! Tomb Donator Form Submition
    const TombDonatorFormSubmition = TombDonationForm.querySelector("#TombDonationFormSubmition");
    if (TombDonatorFormSubmition) {
        TombDonatorFormSubmition.addEventListener("click", function (event) {
            event.preventDefault();
            if (validateForm(TombDonationForm)) {
                TombDonationForm.submit();
            }
        });
    }
}
