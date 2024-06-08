$(function () {
    //! Calculate The Total Amount of the Donations
    let table = $("#table2").DataTable();
    let totalAmount = 0;
    table.rows().every(function () {
        let row = this.data();
        let amount = parseFloat(row[7].replace(",", ""));
        if (!isNaN(amount)) {
            totalAmount += amount;
        }
    });
    $("#totalAmount").text(totalAmount.toFixed(2));
    //! Calculate The Total Income of The Case
    $('input[name="monthly_income"], input[name="another_source"], input[name="retire_income"]').on("input", function () {
        let monthly_income =parseInt($('input[name="monthly_income"]').val()) || 0;
        let another_source =parseInt($('input[name="another_source"]').val()) || 0;
        let retire_income =parseInt($('input[name="retire_income"]').val()) || 0;
        let total = monthly_income + another_source + retire_income;
        $('input[name="total_income"]').val(total);
    });
    //! Calculate the total amount of kfala cases monthly income
    let table30 = $("#table30").DataTable();
    let kfalaTotal = 0;
    table30.rows().every(function () {
        let row = this.data();
        let amounts = parseFloat(row[3].replace(",", ""));
        if (!isNaN(amounts)) {
            kfalaTotal += amounts;
        }
    });
    $("#kfalaTotal").text(kfalaTotal.toFixed(2));
});
$(function () {
    $(document).on("change", "#region", function () {
        let selectedRegion = $(this).val();
        let option = "";
        $.ajax({
            type: "get",
            url: "get-tombs",
            data: { name: selectedRegion },
            dataType: "json",
            success: function (data) {
                let option = "";
                option += '<option value="" selected>المقبرة</option>';
                for (let i = 0; i < data.length; i++) {
                    let tomb = data[i];
                    let tombName = tomb.name;
                    let tombId = tomb.id;
                    let tombPower = tomb.power;
                    let allRoomsDisabled = true;
                    $.ajax({
                        type: "get",
                        url: `get-rooms-by-tomb-id/${tombId}`,
                        data: { tombId: tombId },
                        dataType: "json",
                        success: function (response) {
                            let rooms = response.rooms;
                            let disabledRoomsCount = 0;
                            for (let j = 0; j < rooms.length; j++) {
                                if (rooms[j].disabled) {
                                    disabledRoomsCount++;
                                } else {
                                    allRoomsDisabled = false;
                                }
                            }
                            let Disabled =
                                disabledRoomsCount === tombPower
                                    ? "disabled"
                                    : "";
                            option +=
                                '<option value="' +
                                tombName +
                                '" ' +
                                Disabled +
                                ">" +
                                tombName +
                                "</option>";
                            $(".regionTomb").empty();
                            $(".regionTomb").append(option);
                        },
                        error: function () {
                            alert("Error fetching rooms for tomb.");
                        },
                    });
                }
            },
            error: function () {
                alert("Error fetching rooms for tomb: " + tomb.name);
            },
        });
    });
    $(document).on("change", "#regionTomb", function () {
        let selectedTomb = $(this).val();
        let options = "";
        $.ajax({
            type: "get",
            url: "get-rooms",
            data: { name: selectedTomb },
            dataType: "json",
            success: function (data) {
                options += '<option value="" selected>الغرفة</option>';
                for (let i = 0; i < data.length; i++) {
                    let room = data[i];
                    let roomName = room.name;
                    let roomCapacity = room.capacity;
                    $.ajax({
                        type: "get",
                        url: "get-deceased-sum",
                        data: { name: roomName },
                        dataType: "json",
                        success: function (response) {
                            let sumSize = response.sumSize;
                            let isDisabled = sumSize === roomCapacity ? "disabled" : "";
                            options += '<option value="' + roomName + '" ' + isDisabled + ">" + roomName + "</option>";
                            $(".roomTomb").empty();
                            $(".roomTomb").append(options);
                        },
                        error: function () {
                            alert( "Error fetching deceased data for room: " + roomName );
                        },
                    });
                }
            },
            error: function () {
                alert("Error fetching rooms data");
            },
        });
    });
});
