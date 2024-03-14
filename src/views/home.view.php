<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Hogwards Store: <?php echo $data['name']; ?>
    </title>

    <script>
    const API_URL = "<?php echo APP_URL ?>"
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="assets/main.js"></script>

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
                    <button id="filterByUserId" class="bg-white text-red-500 py-2 px-4 rounded ml-2">Filtar
                        bruxo</button>
                    <button id="filterByStoreId" class="bg-white text-red-500 py-2 px-4 rounded ml-2">Filtar
                        loja</button>
                </div>
            </div>
        </header>
        <main class="container mx-auto p-4 mb-[5rem]">

            <table class="w-full border-collapse">
                <thead>

                </thead>
                <tbody>

                </tbody>
            </table>
        </main>
        <footer class="fixed bottom-0 w-full bg-gray-200 text-gray-800 p-4">
            &copy; 2024 Wladi Granger . All magic spells reserved.
        </footer>
    </body>

</html>