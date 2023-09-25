@extends('layouts.app')

@section('content')

    <body class="flex bg-gray-100">
        <div class="flex-grow text-gray-800">
            <main class="p-6 sm:p-10 space-y-6">
                <div class="flex flex-col space-y-6 md:space-y-0 md:flex-row justify-between">
                    <div class="mr-6">
                        <h1 class="text-4xl font-semibold mb-2">Selamat datang di Menu Administrasi Larapus.</h1>
                        <h2 class="text-gray-600 ml-0.5">Silahkan pilih menu administrasi yang diinginkan</h2>
                    </div>

                </div>
                <section class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
                    <div class="flex items-center p-8 bg-white shadow rounded-lg">
                        <div
                            class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-purple-600 bg-purple-100 rounded-full mr-6">
                            <svg class="h-10 w-10 text-purple-500" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                                <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                                <line x1="3" y1="6" x2="3" y2="19" />
                                <line x1="12" y1="6" x2="12" y2="19" />
                                <line x1="21" y1="6" x2="21" y2="19" />
                            </svg>
                        </div>
                        <div>
                            <span class="block text-2xl font-bold">8</span>
                            <span class="block text-gray-500">Buku</span>
                        </div>
                    </div>

                    <div class="flex items-center p-8 bg-white shadow rounded-lg">
                        <div
                            class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-green-600 bg-green-100 rounded-full mr-6">
                            <svg class="h-10 w-10 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div>
                            <span class="block text-2xl font-bold">6</span>
                            <span class="block text-gray-500">Penulis</span>
                        </div>
                    </div>

                    <div class="flex items-center p-8 bg-white shadow rounded-lg">
                        <div
                            class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-red-600 bg-red-100 rounded-full mr-6">
                            <svg class="h-10 w-10 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div>
                            <span class="inline-block text-2xl font-bold">2</span>
                            <span class="block text-gray-500">Members</span>
                        </div>
                    </div>

                </section>
                <section class="grid md:grid-cols-2 xl:grid-cols-4 xl:grid-rows-3 xl:grid-flow-col gap-6">
                    <div class="flex flex-col md:col-span-2 md:row-span-2 bg-white shadow rounded-lg">
                        <div class="px-6 py-3 font-semibold border-b border-gray-100">Statistik Penulis</div>
                        <div class="p-4 flex-grow">
                            <div
                                class="flex items-center justify-center h-full px-4 text-gray-400 text-3xl font-semibold bg-gray-100 border-2 border-gray-200 border-dashed rounded-md">
                                <canvas id="chartPenulis"></canvas>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </body>
@endsection

@section('scripts')
    {{-- <canvas id="chartPenulis" width="400" height="150"></canvas> --}}
    <script src="/js/Chart.min.js"></script>

    <script>
        var data = {
            labels: {!! json_encode($authors) !!},
            datasets: [{
                label: 'Jumlah buku',
                data: {!! json_encode($books) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(255, 159, 64, 0.8)',
                    'rgba(255, 205, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(201, 203, 207, 0.8)'
                ],
                borderColor: "rgba(151,187,205,0.10)",
            }]
        };
        var options = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }]
            }
        };
        var ctx = document.getElementById("chartPenulis").getContext("2d");
        var authorChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    </script>
@endsection
