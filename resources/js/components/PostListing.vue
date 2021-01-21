<template>
    <div class="row justify-content-center">
        <div class="col-12">
            <h1 class="mb-3">{{ title }}</h1>
        </div>
        <post-list-item v-for="post in posts.data"
                        :key="post.id"
                        :post="post"
        ></post-list-item>
        <button v-if="haveItems" class="btn btn-secondary" @click="loadPosts">Load more</button>
    </div>
</template>

<script>
import PostListItem from "./PostListItem";

export default {
    components: {PostListItem},
    props: {
        title: {
            type: String,
            default: 'Posts'
        },
        url: {
            type: String,
            required: true,
        },
        perPage: {
            type: Number,
            default: 9
        },
        showMoreButton: {
            type: Boolean,
            default: true
        },
    },
    data() {
        return {
            posts: {
                last_page: 0,
                current_page: 0,
                total: 0,
                data: []
            }
        }
    },
    computed: {
        haveItems() {
            return ((this.posts.current_page < this.posts.last_page) && this.showMoreButton);
        }
    },
    created() {
        this.loadPosts();
    },
    methods: {
        loadPosts() {

            axios.get(this.url, {
                params: {
                    page: this.posts.current_page + 1,
                    per_page: this.perPage,
                }
            })
                .then(({data}) => {
                    this.posts.data = this.posts.data.concat(data.data);
                    this.posts.last_page = data.last_page;
                    this.posts.current_page = data.current_page;
                    this.posts.total = data.total;
                });
        },
    }
}
</script>
