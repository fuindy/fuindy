@can('view customer')
    @if(request()->route()->getPrefix()=='/student')
        <li class="open active">
    @else
        <li class="">
            @endif
            <a href="javascript:;">
                <span class="title">Siswa</span>
                @if(request()->route()->getPrefix()=='/student')
                    <span class="arrow open active"></span>
                @else
                    <span class="arrow"></span>
                @endif
            </a>
            <span class="icon-thumbnail"><i data-feather="cpu"></i></span>
            <ul class="sub-menu">
                <li class="">
                    <a href="">Daftar Siswa</a>
                    <span class="icon-thumbnail">ds</span>
                </li>
                <li class="">
                    <a href="">Galery Siswa</a>
                    <span class="icon-thumbnail">gs</span>
                </li>
            </ul>
        </li>
    @endcan