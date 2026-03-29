<aside id="admin-sidebar" class="w-64 bg-white border-r min-h-screen md:sticky md:top-0">
    <nav class="p-4 space-y-4">
        <!-- Dashboard Section -->
        <!-- <div class="space-y-1">
            <a href="#" {{-- <a href="{{ route('admin.index') }}" --}}
                class="{{ request()->routeIs('admin.index') ? 'flex items-center px-3 py-2 rounded-md text-sm font-medium bg-blue-100 text-gray-900' : 'flex items-center px-3 py-2 rounded-md text-sm text-gray-900' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                </svg>
                ແດຊບອດ
            </a>
        </div> -->

        <!-- Divider Line -->
        <hr class="border-gray-200">

        <!-- Section Header: MANAGEMENT -->
        <div>
            <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">
                ການຈັດການ
            </h3>

            <div x-data="{ open: false }" class="space-y-1">

                @can ("admin")
                <a href="{{ route('admin.users.index') }}"
                    class="{{ request()->routeIs('admin.users.*') ? 'flex items-center px-3 py-2 rounded-md text-sm font-medium bg-blue-100 text-gray-900' : 'flex items-center px-3 py-2 rounded-md text-sm text-gray-900' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    ຜູ້ໃຊ້
                </a>

                <a href="{{ route('admin.roles.index') }}"
                    class="{{ request()->routeIs('admin.roles.*') ? 'flex items-center px-3 py-2 rounded-md text-sm font-medium bg-blue-100 text-gray-900' : 'flex items-center px-3 py-2 rounded-md text-sm text-gray-900' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                    </svg>
                    ບົດບາດ
                </a>

                <a href="{{ route('admin.departments.index') }}"
                    class="{{ request()->routeIs('admin.departments.*') ? 'flex items-center px-3 py-2 rounded-md text-sm font-medium bg-blue-100 text-gray-900' : 'flex items-center px-3 py-2 rounded-md text-sm text-gray-900' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                    </svg>
                    ພະແນກ
                </a>

                <a href="{{ route('admin.chart-of-accounts.index') }}"
                    class="{{ request()->routeIs('admin.chart-of-accounts.*') ? 'flex items-center px-3 py-2 rounded-md text-sm font-medium bg-blue-100 text-gray-900' : 'flex items-center px-3 py-2 rounded-md text-sm text-gray-900' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>
                    ແຜນບັນຊີ
                </a>
                @endcan



                @can ("head_of_finance")
                <div x-data="{ openSystem: false }" class="space-y-1 mt-4">
                    <button @click="openSystem = !openSystem"
                        class=" w-full flex items-center justify-between px-3 py-2 rounded-md text-sm font-medium text-gray-900 hover:focus:outline-none">
                        <span class="flex items-center gap-2 ">
                            <!-- Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.941.56.941 1.109v1.094c0 .55-.398 1.02-.941 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.27 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.527-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            ການຈັດການແຜນ
                        </span>
                        <!-- Arrow -->
                        <svg :class="{ 'rotate-180': openSystem }"
                            class="w-4 h-4 text-gray-500 transform transition-transform duration-200" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown container -->
                    <div x-show="openSystem" x-transition class="pl-6 mt-1 space-y-1 border-l border-gray-200">

                        <a href="{{ route('head_of_finance.annual-budget.index') }}"
                            class="{{ request()->routeIs('head_of_finance.annual-budget.*') ? 'flex items-center px-3 py-2 rounded-md text-sm font-medium bg-blue-100 text-gray-900' : 'flex items-center px-3 py-2 rounded-md text-sm text-gray-900' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>
                            ແຜນງົບປະມານປະຈຳປີ
                        </a>

                    </div>
                    @endcan

                </div>
                
                @can ("head_of_department")
                <div class="space-y-1 mt-4">
                    <a href="{{ route('head_of_department.annual-budget.index') }}"
                        class="{{ request()->routeIs('head_of_department.annual-budget.*') ? 'flex items-center px-3 py-2 rounded-md text-sm font-medium bg-blue-100 text-gray-900' : 'flex items-center px-3 py-2 rounded-md text-sm text-gray-900' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                        ກວດສອບແຜນງົບປະມານ
                    </a>
                </div>
                @endcan

                @can ("deputy_head_of_faculty")
                <div class="space-y-1 mt-4">
                    <a href="{{ route('deputy_head_of_faculty.annual-budget.index') }}"
                        class="{{ request()->routeIs('deputy_head_of_faculty.annual-budget.*') ? 'flex items-center px-3 py-2 rounded-md text-sm font-medium bg-blue-100 text-gray-900' : 'flex items-center px-3 py-2 rounded-md text-sm text-gray-900' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                        ກວດສອບແຜນງົບປະມານ
                    </a>
                </div>
                @endcan
    </nav>
</aside>