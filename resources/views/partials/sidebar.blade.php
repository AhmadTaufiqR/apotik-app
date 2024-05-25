<div class="lime-sidebar">
    <div class="lime-sidebar-inner slimscroll">
        <ul class="accordion-menu">
            <li class="sidebar-title">
                Apps
            </li>

            @auth
            @if(Auth::check() && Auth::user()->hasRole('Admin'))
                    <li>
                        <a href="{{ route('apoteker.index') }}" class="{{ request()->is('admins*') ? 'active' : '' }}">
                            <i class="material-icons">group</i>Management Apoteker
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('suplier.index') }}" class="{{ request()->is('reservations*') ? 'active' : '' }}">
                            <i class="material-icons">history</i>Management Suplier
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pelanggan.index') }}" class="{{ request()->is('admins*') ? 'active' : '' }}">
                            <i class="material-icons">group</i>Management pelanggan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pembelian.index') }}" class="{{ request()->is('reservations*') ? 'active' : '' }}">
                            <i class="material-icons">history</i>Pembelian Obat
                        </a>
                    </li>
                    
                @endif
            @endauth

            @if(Auth::check() && Auth::user()->hasAnyRole(['Apoteker', 'Admin']))
            <li>
                <a href="{{ route('obat.index') }}" class="{{ request()->is('bus_stations*') ? 'active' : '' }}">
                    <i class="material-icons">departure_board</i>Fitur Obat
                </a>
            </li>
            @endif

            @auth
            @if(Auth::check() && Auth::user()->hasRole('Apoteker'))
                    <li>
                        <a href="{{ route('penjualan.index') }}" class="{{ request()->is('admins*') ? 'active' : '' }}">
                            <i class="material-icons">group</i>Penjualan
                        </a>
                    </li>
             @endif
            @endauth
        </ul>
    </div>
</div>
