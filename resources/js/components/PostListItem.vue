<template>
    <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <p class="card-text">{{ post.title }}</p>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        post: {
            type: Object,
            required: true,
        },
    },
}
</script>
