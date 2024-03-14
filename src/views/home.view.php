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


        const {
            value: ipAddress
        } = await Swal.fire({
            title: "Informe o id do usuario",
            input: "text",
            inputLabel: "Id do usuario",
            inputValue,
            showCancelButton: true,
            inputValidator: (value) => {
                if (!value) {
                    return "Digite um id valido";
                }
            }
        });
        if (ipAddress) {
            Swal.fire(`Your IP address is ${ipAddress}`);
        }

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

    <body>
        <header class="bg-red-500 text-white p-4">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-2xl font-bold text-white">Hogwords</h1>
                <div>
                    <input type="file" id="importFile" class="hidden" accept=".xml,.xlsx" />
                    <label for="importFile" class="bg-white text-red-500 py-2 px-4 rounded ml-2 cursor-pointer">
                        Importa dados
                    </label>
                    <button class="bg-white text-red-500 py-2 px-4 rounded ml-2">Ações</button>
                </div>
            </div>
        </header>
        <main class="container mx-auto p-4">

            <table class="w-full border-collapse">
                <thead>
                    <tr>
                        <th class="border p-4 text-left">Column 1</th>
                        <th class="border p-4 text-left">Column 2</th>
                        <th class="border p-4 text-left">Column 3</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border p-4">Row 1, Column 1</td>
                        <td class="border p-4">Row 1, Column 2</td>
                        <td class="border p-4">Row 1, Column 3</td>
                    </tr>
                    <tr>
                        <td class="border p-4">Row 2, Column 1</td>
                        <td class="border p-4">Row 2, Column 2</td>
                        <td class="border p-4">Row 2, Column 3</td>
                    </tr>
                    <tr>
                        <td class="border p-4">Row 3, Column 1</td>
                        <td class="border p-4">Row 3, Column 2</td>
                        <td class="border p-4">Row 3, Column 3</td>
                    </tr>
                </tbody>
            </table>
        </main>
        <footer class="fixed bottom-0 w-full bg-gray-200 text-gray-800 p-4">
            &copy; 2024 Wladi Granger . All magic spells reserved.
        </footer>
    </body>

</html>