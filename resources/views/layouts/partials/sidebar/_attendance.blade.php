@can('view customer')
    @if(request()->route()->getPrefix()=='/attendance')
        <li class="open active">
    @else
        <li class="">
            @endif
            <a href="javascript:;">
                <span class="title">Absensi</span>
                @if(request()->route()->getPrefix()=='/attendance')
                    <span class="arrow open active"></span>
                @else
                    <span class="arrow"></span>
                @endif
            </a>
            <span class="icon-thumbnail"><i data-feather="cpu"></i></span>
            <ul class="sub-menu">
                <li class="">
                    <a href="">Data Absensi</a>
                    <span class="icon-thumbnail">da</span>
                </li>

                @can('view chairman')
                    <li class="">
                        <a href="">Ketua Kelas</a>
                        <span class="icon-thumbnail">kk</span>
                    </li>
                @endcan

                @can('view teacher')
                    <li class="">
                        <a href="">Konfirmasi Absensi</a>
                        <span class="icon-thumbnail">ka</span>
                    </li>
                @endcan
            </ul>
        </li>
    @endcan