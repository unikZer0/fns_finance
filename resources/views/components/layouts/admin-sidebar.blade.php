<aside id="admin-sidebar" class="fns-sidebar">

    {{-- Brand / Logo --}}
    <div class="fns-sidebar-brand">
        <img src="{{ asset('storage/logo fns.jpg') }}" alt="FNS Logo">
        <div class="fns-sidebar-brand-text">
            <span class="brand-title">FNS</span>
            <span class="brand-sub">ລະບົບການເງິນ</span>
        </div>
    </div>

    {{-- Navigation --}}
    <nav style="flex:1; padding: 0.5rem 0; overflow-y: auto;">



        {{-- System Management (admin only) --}}
        @can("admin")
            <div class="fns-nav-section-label">ການຈັດການ</div>
            <div x-data="{ openSystem: false }">
                <button class="fns-nav-group-btn" @click="openSystem = !openSystem">
                    <span style="display:flex; align-items:center; gap:0.6rem;">
                        <x-icons.settings style="width:16px;height:16px;flex-shrink:0;" />
                        ການຈັດການລະບົບ
                    </span>
                    <x-icons.chevron-down style="width:13px;height:13px;transition:transform 0.2s;" :style="openSystem ? 'transform:rotate(180deg)' : ''" />
                </button>

                <div x-show="openSystem" x-transition class="fns-nav-group-children">
                    <a href="{{ route('admin.users.index') }}"
                        class="fns-nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <x-icons.users />
                        ຜູ້ໃຊ້
                    </a>

                    <a href="{{ route('admin.roles.index') }}"
                        class="fns-nav-item {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                        <x-icons.shield-check />
                        ບົດບາດ
                    </a>

                    <a href="{{ route('admin.departments.index') }}"
                        class="fns-nav-item {{ request()->routeIs('admin.departments.*') ? 'active' : '' }}">
                        <x-icons.building-office />
                        ພະແນກ
                    </a>

                    <a href="{{ route('admin.chart-of-accounts.index') }}"
                        class="fns-nav-item {{ request()->routeIs('admin.chart-of-accounts.*') ? 'active' : '' }}">
                        <x-icons.book-open />
                        ແຜນບັນຊີ
                    </a>
                </div>
            </div>
        @endcan

        @can("head_of_finance")
            <div class="fns-nav-section-label">ຫຼັກ</div>
            <a href="{{ route('head_of_finance.home') }}"
                class="fns-nav-item {{ request()->routeIs('head_of_finance.home') ? 'active' : '' }}">
                <x-icons.home />
                ໜ້າຫຼັກ
            </a>
        @endcan

    </nav>

    {{-- Footer --}}
    <div style="padding: 0.75rem 1rem; border-top: 1px solid rgba(255,255,255,0.07);">
        <p style="font-size:0.62rem; color:rgba(255,255,255,0.2); text-align:center; letter-spacing:0.04em;">
            FNS Finance System &copy; {{ date('Y') }}
        </p>
    </div>

</aside>
