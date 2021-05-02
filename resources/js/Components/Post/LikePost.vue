<template>
    <button
        @click="like(feed.id)"
        class="flex items-center"
        v-else
        :disabled="form.processing"
    >
        <span
            v-if="!form.processing && feed.id !== selectedPostId"
            class="inline-flex items-center justify-center"
        >
            <HeartIcon class="h-5 w-5 text-red-600 mr-1"
        /></span>
        <span
            v-if="!form.processing && feed.id === selectedPostId"
            class="inline-flex items-center justify-center"
        >
            <HeartIcon class="h-5 w-5 text-red-600 mr-1"
        /></span>
        <loading-icon v-if="form.processing && feed.id === selectedPostId" />
    </button>
</template>

<script>
import LoadingIcon from "@/Shared/LoadingIcon";
import { HeartIcon } from "@heroicons/vue/outline";
export default {
    name: "LikePost",
    components: { LoadingIcon, HeartIcon },
    props: {
        feed: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                post_id: "",
            }),
            selectedPostId: null,
        };
    },
    methods: {
        like(postId) {
            this.selectedPostId = postId;
            this.form.post_id = postId;
            this.form.post(this.route("like.post"), {
                preserveScroll: true,
            });
        },
    },
};
</script>

<style scoped>
/* (1366x768) WXGA Display */

@media screen and (min-width: 1366px) and (max-width: 1919px) {
}

@media (min-width: 1198px) and (max-width: 1365.9px) {
}

/* Normal desktop :992px. */

@media (min-width: 992px) and (max-width: 1197px) {
}

/* Normal desktop :991px. */

@media (min-width: 768px) and (max-width: 991px) {
}

/* small mobile :576px. */

@media (min-width: 576px) and (max-width: 767px) {
}

/* extra small mobile 320px. */

@media (max-width: 575px) {
}

/* Large Mobile :480px. */

@media only screen and (min-width: 480px) and (max-width: 575px) {
}

@media only screen and (max-width: 575px) and (min-width: 480px) {
}
</style>
