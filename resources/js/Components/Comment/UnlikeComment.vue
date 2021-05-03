<template>
    <button
        @click="like(comment.id)"
        class="flex items-center"
        :disabled="form.processing"
    >
        <span
            v-if="!form.processing && comment.id !== selectedCommentId"
            class="inline-flex items-center justify-center"
        >
            <HeartIcon class="h-5 w-5 text-red-700"
        /></span>
        <span
            v-if="!form.processing && comment.id === selectedCommentId"
            class="inline-flex items-center justify-center"
        >
            <HeartIcon class="h-5 w-5 text-red-700"
        /></span>
        <loading-icon
            v-if="form.processing && comment.id === selectedCommentId"
        />
    </button>
</template>

<script>
import LoadingIcon from "@/Shared/LoadingIcon";
import { HeartIcon } from "@heroicons/vue/solid";
export default {
    name: "UnlikeComment",
    components: { LoadingIcon, HeartIcon },
    props: {
        comment: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                comment_id: "",
            }),
            selectedCommentId: null,
        };
    },
    methods: {
        like(commentId) {
            this.selectedCommentId = commentId;
            this.form.comment_id = commentId;
            this.form.post(this.route("unlike.comment"), {
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
