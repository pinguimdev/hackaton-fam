<template>
    <div></div>
</template>

<script>
export default {
    created() {
        localStorage.removeItem('user')
        window.location.href = '/login'
    }
}
</script>

<style scoped>

</style>
