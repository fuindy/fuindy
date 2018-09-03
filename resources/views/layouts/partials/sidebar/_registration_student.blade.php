@if(request()->route()->getPrefix()=='/register')
    <li class="open active">
@else
    <li class="">
        @endif
        <a href="javascript:;">
            <span class="title">Pendaftaran</span>
            @if(request()->route()->getPrefix()=='/register')
                <span class="arrow open active"></span>
            @else
                <span class="arrow"></span>
            @endif
        </a>
        <span class="icon-thumbnail"><i data-feather="cpu"></i></span>
        <ul class="sub-menu">
            <li class="">
                <a href="">Mendaftar Sekolah</a>
                <span class="icon-thumbnail">ma</span>
            </li>
            <li class="">
                <a href="">Data Pendaftaran</a>
                <span class="icon-thumbnail">dp</span>
            </li>

            @can('view school')
                <li class="">
                    <a href="">Data Pendaftar</a>
                    <span class="icon-thumbnail">ma</span>
                </li>
            @endcan
        </ul>
    </li>
