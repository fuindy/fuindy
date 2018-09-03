@if(request()->route()->getPrefix()=='/school')
    <li class="open active">
@else
    <li class="">
        @endif
        <a href="javascript:;">
            <span class="title">Sekolah</span>
            @if(request()->route()->getPrefix()=='/school')
                <span class="arrow open active"></span>
            @else
                <span class="arrow"></span>
            @endif
        </a>
        <span class="icon-thumbnail"><i data-feather="cpu"></i></span>
        <ul class="sub-menu">
            <li class="">
                <a href="{{ route('school.view.add') }}">Daftarkan Sekolah</a>
                <span class="icon-thumbnail">ds</span>
            </li>

            @can('view customer')
                <li class="">
                    <a href="">Sekolah Aktif</a>
                    <span class="icon-thumbnail">sa</span>
                </li>

                @can('view school')
                    <li class="">
                        <a href="">Pengaturan</a>
                        <span class="icon-thumbnail">pa</span>
                    </li>
                @endcan
            @endcan
        </ul>
    </li>