<section class="grid md:grid-cols-2 xl:grid-cols-4 xl:grid-rows-3 xl:grid-flow-col gap-6">
    <div class="flex flex-col md:col-span-2 md:row-span-2 bg-white shadow rounded-lg">
        <div class="px-6 py-5 font-semibold border-b border-gray-100">Statistik Penulis</div>
        <div class="p-4 flex-grow">
            <div class="flex items-center justify-center h-full px-4 py-16 text-gray-400 text-3xl font-semibold bg-gray-100 border-2 border-gray-200 border-dashed rounded-md">
                <canvas id="chartPenulis" width="400" height="150"></canvas>
            </div>
        </div>
    </div>
    <div class="flex items-center p-8 bg-white shadow rounded-lg">
        <div
            class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-yellow-600 bg-yellow-100 rounded-full mr-6">
            <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="h-6 w-6">
                <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" />
                <path fill="#fff"
                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
            </svg>
        </div>
        <div>
            <span class="block text-2xl font-bold">25</span>
            <span class="block text-gray-500">Lections left</span>
        </div>
    </div>
    <div class="flex items-center p-8 bg-white shadow rounded-lg">
        <div
            class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-teal-600 bg-teal-100 rounded-full mr-6">
            <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <span class="block text-2xl font-bold">139</span>
            <span class="block text-gray-500">Hours spent on lections</span>
        </div>
    </div>
    <div class="row-span-3 bg-white shadow rounded-lg">
        <div class="flex items-center justify-between px-6 py-5 font-semibold border-b border-gray-100">
            <span>Students by average mark</span>
            <button type="button"
                class="inline-flex justify-center rounded-md px-1 -mr-1 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-600"
                id="options-menu" aria-haspopup="true" aria-expanded="true">
                Descending
                <svg class="-mr-1 ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
            <!-- Refer here for full dropdown menu code: https://tailwindui.com/components/application-ui/elements/dropdowns -->
        </div>
        <div class="overflow-y-auto" style="max-height: 24rem;">
            <ul class="p-6 space-y-6">
                <li class="flex items-center">
                    <div class="h-10 w-10 mr-3 bg-gray-100 rounded-full overflow-hidden">
                        <img src="https://randomuser.me/api/portraits/women/82.jpg"
                            alt="Annette Watson profile picture">
                    </div>
                    <span class="text-gray-600">Annette Watson</span>
                    <span class="ml-auto font-semibold">9.3</span>
                </li>
                <li class="flex items-center">
                    <div class="h-10 w-10 mr-3 bg-gray-100 rounded-full overflow-hidden">
                        <img src="https://randomuser.me/api/portraits/men/81.jpg"
                            alt="Calvin Steward profile picture">
                    </div>
                    <span class="text-gray-600">Calvin Steward</span>
                    <span class="ml-auto font-semibold">8.9</span>
                </li>
                <li class="flex items-center">
                    <div class="h-10 w-10 mr-3 bg-gray-100 rounded-full overflow-hidden">
                        <img src="https://randomuser.me/api/portraits/men/80.jpg"
                            alt="Ralph Richards profile picture">
                    </div>
                    <span class="text-gray-600">Ralph Richards</span>
                    <span class="ml-auto font-semibold">8.7</span>
                </li>
                <li class="flex items-center">
                    <div class="h-10 w-10 mr-3 bg-gray-100 rounded-full overflow-hidden">
                        <img src="https://randomuser.me/api/portraits/men/79.jpg"
                            alt="Bernard Murphy profile picture">
                    </div>
                    <span class="text-gray-600">Bernard Murphy</span>
                    <span class="ml-auto font-semibold">8.2</span>
                </li>
                <li class="flex items-center">
                    <div class="h-10 w-10 mr-3 bg-gray-100 rounded-full overflow-hidden">
                        <img src="https://randomuser.me/api/portraits/women/78.jpg"
                            alt="Arlene Robertson profile picture">
                    </div>
                    <span class="text-gray-600">Arlene Robertson</span>
                    <span class="ml-auto font-semibold">8.2</span>
                </li>
                <li class="flex items-center">
                    <div class="h-10 w-10 mr-3 bg-gray-100 rounded-full overflow-hidden">
                        <img src="https://randomuser.me/api/portraits/women/77.jpg"
                            alt="Jane Lane profile picture">
                    </div>
                    <span class="text-gray-600">Jane Lane</span>
                    <span class="ml-auto font-semibold">8.1</span>
                </li>
                <li class="flex items-center">
                    <div class="h-10 w-10 mr-3 bg-gray-100 rounded-full overflow-hidden">
                        <img src="https://randomuser.me/api/portraits/men/76.jpg"
                            alt="Pat Mckinney profile picture">
                    </div>
                    <span class="text-gray-600">Pat Mckinney</span>
                    <span class="ml-auto font-semibold">7.9</span>
                </li>
                <li class="flex items-center">
                    <div class="h-10 w-10 mr-3 bg-gray-100 rounded-full overflow-hidden">
                        <img src="https://randomuser.me/api/portraits/men/75.jpg"
                            alt="Norman Walters profile picture">
                    </div>
                    <span class="text-gray-600">Norman Walters</span>
                    <span class="ml-auto font-semibold">7.7</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="flex flex-col row-span-3 bg-white shadow rounded-lg">
        <div class="px-6 py-5 font-semibold border-b border-gray-100">Students by type of studying</div>
        <div class="p-4 flex-grow">
            <div
                class="flex items-center justify-center h-full px-4 py-24 text-gray-400 text-3xl font-semibold bg-gray-100 border-2 border-gray-200 border-dashed rounded-md">
                Chart</div>
        </div>
    </div>
</section>