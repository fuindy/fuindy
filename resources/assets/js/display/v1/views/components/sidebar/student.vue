<template>
    <li class="">
        <a  href="javascript:;"class="">
            <span class="title">Student</span>
            <span class="arrow"></span>
        </a>
        <span class="icon-thumbnail"><i data-feather="cpu"></i></span>
        <ul class="sub-menu">
            <li class="">
                <router-link to="/student">Dashboard </router-link>
                <span class="icon-thumbnail">Ds</span>
            </li>
            <li class="">
                <router-link to="/student/registration">Register Oneself </router-link>
                <span class="icon-thumbnail">Ro</span>
            </li>
        </ul>
    </li>
</template>