<template>
    <div>
        <Toolbar/>
        <router-view></router-view>
        <AppFooter/>
    </div>
</template>

<script>
    import Toolbar from './Toolbar'
    import AppFooter from "./AppFooter";

    export default {
        components: {
            Toolbar,
            AppFooter
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
