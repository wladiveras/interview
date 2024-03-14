<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Loja Magica do beco diagonal
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
        <header class="bg-red-500 text-white p-4 flex">
            <div class="container mx-auto flex justify-between items-center">
                <h1 id="home-page" class="text-2xl flex font-bold text-white cursor-pointer">
                    <svg class="mr-[0.5rem] mt-[0.1rem]" xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M12 2L1 21h22zm.75 9.47c1.81.4 2.95 2.2 2.55 4.03c-.3 1.25-1.3 2.25-2.55 2.53zM11.25 18c-1.81-.4-2.95-2.2-2.55-4c.3-1.28 1.3-2.28 2.55-2.56zm5.63-3.28A4.874 4.874 0 0 0 12.75 10V6.29L20.4 19.5h-7.33c2.22-.5 3.8-2.47 3.81-4.75zm-5.63-8.43V10c-2.65.4-4.48 2.88-4.07 5.54c.32 1.96 1.79 3.58 3.75 4.01H3.6z" />
                    </svg>
                    Loja Magica
                </h1>
                <div class="flex">
                    <input type="file" id="importFile" class="hidden" accept=".xml,.xlsx" />
                    <label for="importFile" class="bg-white flex text-red-500 py-2 px-4 rounded ml-2">
                        <svg class="mr-[0.2rem] mt-[0.3rem]" xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                            viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M472 168H40a24 24 0 0 1 0-48h432a24 24 0 0 1 0 48m-80 112H120a24 24 0 0 1 0-48h272a24 24 0 0 1 0 48m-96 112h-80a24 24 0 0 1 0-48h80a24 24 0 0 1 0 48" />
                        </svg> Invocar Informações
                    </label>

                    <button id="filterByOrderId" class="bg-white flex text-red-500 py-2 px-4 rounded ml-2">
                        <svg class="mr-[0.2rem] mt-[0.3rem]" xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                            viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M472 168H40a24 24 0 0 1 0-48h432a24 24 0 0 1 0 48m-80 112H120a24 24 0 0 1 0-48h272a24 24 0 0 1 0 48m-96 112h-80a24 24 0 0 1 0-48h80a24 24 0 0 1 0 48" />
                        </svg> Filtrar Pedido
                    </button>
                    <button id="filterByUserId" class="bg-white flex text-red-500 py-2 px-4 rounded ml-2">
                        <svg class="mr-[0.2rem] mt-[0.3rem]" xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                            viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M472 168H40a24 24 0 0 1 0-48h432a24 24 0 0 1 0 48m-80 112H120a24 24 0 0 1 0-48h272a24 24 0 0 1 0 48m-96 112h-80a24 24 0 0 1 0-48h80a24 24 0 0 1 0 48" />
                        </svg> Filtrar bruxo
                    </button>
                    <button id="filterByStoreId" class="bg-white flex text-red-500 py-2 px-4 rounded ml-2">
                        <svg class="mr-[0.2rem] mt-[0.3rem]" xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                            viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M472 168H40a24 24 0 0 1 0-48h432a24 24 0 0 1 0 48m-80 112H120a24 24 0 0 1 0-48h272a24 24 0 0 1 0 48m-96 112h-80a24 24 0 0 1 0-48h80a24 24 0 0 1 0 48" />
                        </svg> Filtrar loja
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