<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Hogwards Store: <?php echo $data['name']; ?>
    </title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
    $(document).ready(function() {
        $("h1").css("color", "#0088ff");

        $("#importFile").change(function() {
            var file = document.getElementById("importFile").files[0];
            var fileType = file.name.split('.').pop().toLowerCase();
            var type;

            if (fileType === 'xml') {
                type = 'text/xml';
            } else if (fileType === 'xlsx') {
                type = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
            } else {
                console.error('Unknown file type: ' + fileType);
                return;
            }

            var formData = new FormData();
            formData.append('data', file);
            formData.append('type', type);

            $.ajax({
                url: "<?php echo APP_URL ?>/import",
                method: "POST",
                processData: false,
                contentType: false,
                data: formData,
                dataType: 'json', // Set the expected dataType to JSON

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
    </script>
</head>

<body>
    <h1>

        <input type="file" id="importFile" class="hidden" accept=".xml,.xlsx" />
        <label for="importFile"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
            Importa dados
        </label>
    </h1>
</body>

</html>

<!-- <pedidos>
<pedido>
<id_loja>001</id_loja>
<nome_loja>Torre de Cristal</nome_loja>
<localizacao>Planeta Zirak</localizacao>
<produto>Cristais Místicos</produto>
<quantidade>50</quantidade>
</pedido>
<pedido>
<id_loja>002</id_loja>
<nome_loja>Floresta Encantada</nome_loja>
<localizacao>Reino de Elyria</localizacao>
<produto>Poções de Juventude</produto>
<quantidade>30</quantidade>
</pedido>
<pedido>
<id_loja>003</id_loja>
<nome_loja>Deserto dos Ventos</nome_loja>
<localizacao>Planeta Kaitos</localizacao>
<produto>Areia Mágica</produto>
<quantidade>70</quantidade>
</pedido>
<pedido>
<id_loja>004</id_loja>
<nome_loja>Cavernas Submersas</nome_loja>
<localizacao>Mundo Aquático de Neptar</localizacao>
<produto>Pérolas de Energia</produto>
<quantidade>40</quantidade>
</pedido>
<pedido>
<id_loja>005</id_loja>
<nome_loja>Vulcões Adormecidos</nome_loja>
<localizacao>Ilhas de Fogo</localizacao>
<produto>Lava Encantada</produto>
<quantidade>20</quantidade>
</pedido>
</pedidos> -->