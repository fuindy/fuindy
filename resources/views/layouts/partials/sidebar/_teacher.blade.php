@can('view customer')
    @if(request()->route()->getPrefix()=='/teacher')
        <li class="open active">
    @else
        <li class="">
            @endif
            <a href="javascript:;">
                <span class="title">Guru</span>
                @if(request()->route()->getPrefix()=='/teacher')
                    <span class="arrow open active"></span>
                @else
                    <span class="arrow"></span>
                @endif
            </a>
            <span class="icon-thumbnail"><i data-feather="cpu"></i></span>
            <ul class="sub-menu">
                <li class="">
                    <a href="">Daftar Guru</a>
                    <span class="icon-thumbnail">dg</span>
                </li>
                <li class="">
                    <a href="">Galery Guru</a>
                    <span class="icon-thumbnail">gs</span>
                </li>
            </ul>
        </li>
    @endcan