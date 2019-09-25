<template>
  <div id="404" class="page-wrap d-flex flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <span class="display-1 d-block">404</span>
                <div class="mb-4 lead">The page you are looking for was not found.</div>
                <a :href="'/dashboard'" class="btn btn-link">Back to Home</a>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
  name: '404'
}

</script>

<style scoped>
body {
    background: #dedede;
}
.page-wrap {
    min-height: 100vh;
}
</style>
