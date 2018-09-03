@can('view customer')
    @if(request()->route()->getPrefix()=='/question')
        <li class="open active">
    @else
        <li class="">
            @endif
            <a href="javascript:;">
                <span class="title">Latihan</span>
                @if(request()->route()->getPrefix()=='/question')
                    <span class="arrow open active"></span>
                @else
                    <span class="arrow"></span>
                @endif
            </a>
            <span class="icon-thumbnail"><i data-feather="cpu"></i></span>
            <ul class="sub-menu">
                <li class="">
                    <a href="">Daftar Nilai</a>
                    <span class="icon-thumbnail">dn</span>
                </li>
                <li class="">
                    <a href="">Soal Latihan</a>
                    <span class="icon-thumbnail">sl</span>
                </li>
                @can('view teacher')
                    <li class="">
                        <a href="">Buat Soal</a>
                        <span class="icon-thumbnail">bs</span>
                    </li>
                    <li class="">
                        <a href="">Daftar Soal</a>
                        <span class="icon-thumbnail">ds</span>
                    </li>
                @endcan
            </ul>
        </li>
    @endcan