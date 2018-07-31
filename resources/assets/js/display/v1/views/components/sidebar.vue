<template>
    <nav class="page-sidebar" data-pages="sidebar">
        <div class="sidebar-overlay-slide from-top" id="appMenu"></div>
        <div class="sidebar-header"></div>
        <div class="sidebar-menu">
            <ul class="menu-items">

                <dashboard-sidebar></dashboard-sidebar>
                <student-sidebar></student-sidebar>

            </ul>
            <div class="clearfix"></div>
        </div>
    </nav>
</template>

<script>
    import dashboard from './sidebar/dashboard.vue'
    import student from './sidebar/student.vue'

    export default {
        components: {
            'dashboard-sidebar': dashboard,
            'student-sidebar': student
        }
    }
</script>

