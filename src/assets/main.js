$(document).ready(function() {

    const Toast = Swal.mixin({
        toast: true,
        position: "bottom-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });

    $.ajax({
        url: API_URL + "/all-orders",
        method: "GET",
        dataType: 'json',
        success: function(response) {
            var hasError = response.status === "error";
            Toast.fire({
                icon: "success",
                title: "Pedidos Mágicos invocado com sucesso!"
            });
            if (hasError) {
                Toast.fire({
                    icon: "error",
                    title: "Pedidos Mágicos não invocados!"
                });
                return;
            }

            var allOrders = '';
            for (var i = 0; i < response.data.length; i++) {
                allOrders += '<tr>';
                allOrders += '<td class="border p-4">' + response.data[i].id + '</td>';
                allOrders += '<td class="border p-4">' + response.data[i].store_id + '</td>';
                allOrders += '<td class="border p-4">' + response.data[i].user_id + '</td>';
                allOrders += '<td class="border p-4">' + response.data[i].product_name +
                    '</td>';
                allOrders += '<td class="border p-4">' + response.data[i].price + '</td>';
                allOrders += '<td class="border p-4">' + response.data[i].quantity + '</td>';
                allOrders += '<td class="border p-4">' + response.data[i].created_at + '</td>';
                allOrders += '</tr>';
            }
            $('.w-full.border-collapse tbody').html(allOrders);
        },
    });

    // Import file
    $("#importFile").change(function() {
        var file = document.getElementById("importFile").files[0];
        var fileType = file.name.split('.').pop().toLowerCase();
        var type;

        if (fileType === 'xml') {
            type = 'text/xml';
        } else if (fileType === 'xlsx') {
            type = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
        } else {
            Toast.fire({
                icon: "error",
                title: "Artefato não identificado!"
            });
            return;
        }

        var formData = new FormData();
        formData.append('data', file);
        formData.append('type', type);

        $.ajax({
            url: API_URL + "/import",
            method: "POST",
            processData: false,
            contentType: false,
            data: formData,
            dataType: 'json',

            success: function(response) {
                if (typeof response.message !== 'string') {
                    console.error('Error parsing response:', response);
                    return;
                }

                var hasError = response.status === "error";

                Swal.fire({
                    title: hasError ? 'Mal feito, feito!' : 'Luminous!',
                    text: response.message,
                    icon: response.status,
                    confirmButtonText: hasError ?
                        'Tudo bem...' : 'Maravilha!'
                })

            },
        });
    });
});