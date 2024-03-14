<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Hogwards Magic Worlds
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
                <h1 id="home-page" class="text-2xl font-bold text-white cursor-pointer">Hogwords</h1>
                <div>
                    <input type="file" id="importFile" class="hidden" accept=".xml,.xlsx" />
                    <label for="importFile" class="bg-white text-red-500 py-2 px-4 rounded ml-2 cursor-pointer">
                        Invocar Informações
                    </label>

                    <button id="filterByOrderId" class="bg-white text-red-500 py-2 px-4 rounded ml-2">
                        Filtrar Pedido
                    </button>
                    <button id="filterByUserId" class="bg-white text-red-500 py-2 px-4 rounded ml-2">
                        Filtrar bruxo
                    </button>
                    <button id="filterByStoreId" class="bg-white text-red-500 py-2 px-4 rounded ml-2">
                        Filtrar loja
                    </button>
                </div>
            </div>
        </header>
        <main class="container mx-auto p-4 mb-[5rem]">
            <div id="data-info" class="grid grid-cols-1 gap-4 items-center justify-center bg-transparent hidden">
                <div class="bg-white p-8 rounded-lg flex justify-center items-center">
                    <div class="ml-3">
                        <div class="mb-3">
                            <img class="h-50 w-50 rounded-full m-auto" src="https://source.unsplash.com/random/100x100"
                                alt="Random User" />
                        </div>
                        <div class="ml-3">
                            <p id="name" class="text-sm font-medium text-slate-900 text-center"></p>
                            <p id="description" class="text-sm text-slate-700 text-center"></p>
                        </div>
                    </div>
                </div>
            </div>
            <table class="w-full border-collapse">
                <thead></thead>
                <tbody></tbody>
            </table>
        </main>
        <footer class="fixed bottom-0 w-full bg-gray-200 text-gray-800 p-4">
            &copy; 2024 Wladi Granger . All magic spells reserved.
        </footer>
    </body>

</html>