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
            select.value === "الحرفة" ||
            select.value === "السنة" ||
            select.value === "نوع المتبرع" ||
            select.value === "نوع التبرع النقدي" ||
            select.value === "نوع التبرع"
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
        let letters = /(?=.{14,})/;
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
        let letters = /(?=.{11,})/;
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
        let DonationMoneyType = form.querySelectorAll("[data-donationmoneytype-id]");
        let DonationOtherType = form.querySelectorAll("[data-donationothertype-id]");
        //! Donation Type Validation
        DonationType.forEach((type) => {
            const typeSelect = form.querySelector(`select[name="donation_type"][data-donationtype-id="${type.dataset.donationtypeId}"]`);
            const typeReq = form.querySelector(`p.donationtypeReq[data-donationtype-id="${type.dataset.donationtypeId}"]`);
            if (typeSelect) {
                typeSelect.addEventListener("change", function () {
                    let selectedDonation = typeSelect.options[typeSelect.selectedIndex].value;
                    if (selectedDonation === "نقدي") {
                        typeSelect.classList.add("good");
                        typeSelect.classList.remove("error");
                        typeReq.classList.add("d-none");
                        DonationMoneyType.forEach((other) => {
                            const otherSelect = form.querySelector(`select[name="money_type"][data-donationmoneytype-id="${other.dataset.donationmoneytypeId}"]`);
                            const otherSelectReq = form.querySelector(`p.donationmoneytype[data-donationmoneytype-id="${other.dataset.donationmoneytypeId}"]`);
                            const otherOptions = otherSelect.options[otherSelect.selectedIndex].value;
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
                            const OtherType = form.querySelector(`input[name="other_type"][data-donationothertype-id="${other.dataset.donationothertypeId}"]`);
                            const OtherTypeReq = form.querySelector(`p.donationothertype[data-donationothertype-id="${other.dataset.donationothertypeId}"]`);
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
                            const MoneyType = form.querySelector(`select[name="money_type"][data-donationmoneytype-id="${money.dataset.donationmoneytypeId}"]`);
                            const MoneyTypeReq = form.querySelector(`p.donationmoneytype[data-donationmoneytype-id="${money.dataset.donationmoneytypeId}"]`)
                            if (MoneyType) {
                                MoneyType.classList.add("d-none");
                                MoneyType.classList.remove("error");
                                MoneyTypeReq.classList.add("d-none");
                            }
                        });
                        DonationOtherType.forEach((other) => {
                            const OtherDonationType = form.querySelector(`input[name="other_type"][data-donationothertype-id="${other.dataset.donationothertypeId}"]`);
                            const OtherTypeReq = form.querySelector(`p.donationothertype[data-donationothertype-id="${other.dataset.donationothertypeId}"]`);
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
            const otherSelect = form.querySelector(`select[name="money_type"][data-donationmoneytype-id="${other.dataset.donationmoneytypeId}"]`);
            const otherReq = form.querySelector(`p.donationmoneytype[data-donationmoneytype-id="${other.dataset.donationmoneytypeId}"]`);
            if (otherSelect) {
                otherSelect.addEventListener("change", function () {
                    let selectedDonation = otherSelect.options[otherSelect.selectedIndex].value;
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
            const otherInput = form.querySelector(`input[name="other_type"][data-donationothertype-id="${other.dataset.donationothertypeId}"]`);
            const otherInputReq = form.querySelector(`p.donationothertype[data-donationothertype-id="${other.dataset.donationothertypeId}"]`);
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
                })
            }
        })
        //! Donation Submition Validation
        const AllDonationSubmit = form.querySelectorAll("[data-donationSubmit-id]");
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
