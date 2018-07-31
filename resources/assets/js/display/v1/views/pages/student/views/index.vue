<template>

    <div>
        <div class="page-container">
            <div class="page-content-wrapper">
                <div class="content">
                    <div class="jumbotron" data-pages="parallax">
                        <div class=" container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
                            <div class="inner">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Fuindy</a></li>
                                    <li class="breadcrumb-item active">Student</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid container-fixed-lg">
                        Student
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import sidebarLayouts from '../../../components/sidebar.vue'

    export default {
        components: {
            'sidebar-layouts': sidebarLayouts
        }
    }
</script>