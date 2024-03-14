$(document).ready(function () {
  const Toast = Swal.mixin({
    toast: true,
    position: "bottom-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.onmouseenter = Swal.stopTimer;
      toast.onmouseleave = Swal.resumeTimer;
    },
  });

  // Filter by User
  $("#filterByUserId").click(function () {
    Swal.fire({
      icon: "question",
      title: "Invocar Bruxo",
      input: "number",
      inputLabel: "Informe o id do Bruxo para invocar os pedidos",
      inputAttributes: {
        autocapitalize: "off",
      },
      showCancelButton: true,
      confirmButtonText: "Invocar",
      cancelButtonText: "Cancelar",
      showLoaderOnConfirm: true,
      preConfirm: (id) => {
        return fetch(`${API_URL}/order/user/${id}`)
          .then((response) => {
            if (!response.ok) {
              throw new Error(response.statusText);
            }
            return response.json();
          })
          .catch((error) => {
            Toast.fire({
              icon: "error",
              title: "Parece que os dementadores estão atacando.",
            });
          });
      },
      allowOutsideClick: () => !Swal.isLoading(),
    }).then((result) => {
      if (result.value && result.value.data[0]) {
        generateTableData(result.value.data[0].orders, "user");
      } else {
        Toast.fire({
          icon: "error",
          title: "Parece que esse bruxo não está nas redondezas.",
        });
      }
    });
  });

  // Filter by Store
  $("#filterByStoreId").click(async function () {
    Swal.fire({
      icon: "question",
      title: "Invocar Loja",
      input: "number",
      inputLabel: "Informe o id da Loja para invocar os pedidos",
      inputAttributes: {
        autocapitalize: "off",
      },
      showCancelButton: true,
      confirmButtonText: "Invocar",
      cancelButtonText: "Cancelar",
      showLoaderOnConfirm: true,
      preConfirm: (id) => {
        return fetch(`${API_URL}/order/store/${id}`)
          .then((response) => {
            if (!response.ok) {
              throw new Error(response.statusText);
            }
            return response.json();
          })
          .catch((error) => {
            Toast.fire({
              icon: "error",
              title: "Parece que os dementadores estão atacando.",
            });
          });
      },
      allowOutsideClick: () => !Swal.isLoading(),
    }).then((result) => {
      if (result.value && result.value.data[0]) {
        generateTableData(result.value.data[0].orders, "store");
      } else {
        Toast.fire({
          icon: "error",
          title: "Parece que a loja não existe.",
        });
      }
    });
  });

  // Get all orders
  $.ajax({
    url: API_URL + "/all-orders",
    method: "GET",
    dataType: "json",
    success: function (response) {
      var hasError = response.status === "error";

      if (hasError) {
        Toast.fire({
          icon: "error",
          title: "Pedidos Mágicos não invocados!",
        });
        return;
      }

      // Get all orders
      $.ajax({
        url: API_URL + "/all-orders",
        method: "GET",
        dataType: "json",
        success: function (response) {
          var hasError = response.status === "error";
          Toast.fire({
            icon: "success",
            title: "Pedidos Mágicos invocado com sucesso!",
          });
          if (hasError) {
            Toast.fire({
              icon: "error",
              title: "Pedidos Mágicos não invocados!",
            });
            return;
          }

          generateTableData(response.data);
        },
      });
    },
  });

  // Import file
  $("#importFile").change(function () {
    var file = document.getElementById("importFile").files[0];
    var fileType = file.name.split(".").pop().toLowerCase();
    var type;

    if (fileType === "xml") {
      type = "text/xml";
    } else if (fileType === "xlsx") {
      type =
        "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
    } else {
      Toast.fire({
        icon: "error",
        title: "Artefato não identificado!",
      });
      return;
    }

    var formData = new FormData();
    formData.append("data", file);
    formData.append("type", type);

    $.ajax({
      url: API_URL + "/import",
      method: "POST",
      processData: false,
      contentType: false,
      data: formData,
      dataType: "json",

      success: function (response) {
        if (typeof response.message !== "string") {
          console.error("Error parsing response:", response);
          return;
        }

        var hasError = response.status === "error";

        Swal.fire({
          title: hasError ? "Mal feito, feito!" : "Luminous!",
          text: response.message,
          icon: response.status,
          confirmButtonText: hasError ? "Tudo bem..." : "Maravilha!",
        });
      },
    });
  });

  // Generate Table
  function generateTableData(response, type = "all") {
    var allHeaders = "";
    var allOrders = "";

    if (response) {
      for (var i = 0; i < response.length; i++) {
        allOrders += "<tr>";

        allOrders += '<td class="border p-4">' + response[i].id + "</td>";
        if (type === "store" || type === "all") {
          allOrders +=
            '<td class="border p-4">' + response[i].store_id + "</td>";
        }
        if (type === "user" || type === "all") {
          allOrders +=
            '<td class="border p-4">' + response[i].user_id + "</td>";
        }
        allOrders +=
          '<td class="border p-4">' + response[i].product_name + "</td>";
        allOrders += '<td class="border p-4">' + response[i].price + "</td>";
        allOrders += '<td class="border p-4">' + response[i].quantity + "</td>";
        allOrders +=
          '<td class="border p-4">' + response[i].created_at + "</td>";
        allOrders += "</tr>";
      }

      allHeaders += "<tr>";
      allHeaders += '<th class="border p-4 text-left">#ID</th>';
      if (type === "store" || type === "all") {
        allHeaders += '<th class="border p-4 text-left">#ID loja</th>';
      }
      if (type === "user" || type === "all") {
        allHeaders += '<th class="border p-4 text-left">#ID Bruxo</th>';
      }
      allHeaders += '<th class="border p-4 text-left">Produto</th>';
      allHeaders += '<th class="border p-4 text-left">Valor</th>';
      allHeaders += '<th class="border p-4 text-left">Quantidade</th>';
      allHeaders += '<th class="border p-4 text-left">Data</th>';
      allHeaders += "</tr>";

      Toast.fire({
        icon: "success",
        title: "Pedidos Mágicos invocado com sucesso!",
      });

      $(".w-full.border-collapse thead").html(allHeaders);
      $(".w-full.border-collapse tbody").html(allOrders);
    }
  }
});
