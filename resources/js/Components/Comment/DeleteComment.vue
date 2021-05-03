<template>
    <button
        type="button"
        @click="openModal(comment.id)"
        class="text-red-600 hover:text-red-400 flex"
    >
        <span v-if="showModal && selectedCommentId !== comment.id">
            <TrashIcon class="h-5 w-5 text-red-400" />
        </span>
        <span v-if="!form.processing && !showModal">
            <TrashIcon class="h-5 w-5 text-red-400" />
        </span>
        <loading-icon
            v-if="
                selectedCommentId === comment.id &&
                (showModal || form.processing)
            "
        />

        <confirm-modal
            @close="showModal = false"
            :open="showModal"
            @confirmed="deletePost"
            text="Are you sure you want to delete this comment?"
        />
    </button>
</template>

<script>
import LoadingIcon from "@/Shared/LoadingIcon";
import { TrashIcon } from "@heroicons/vue/solid";
import ConfirmModal from "@/Shared/ConfirmModal";
export default {
    name: "DeleteComment",
    components: { ConfirmModal, LoadingIcon, TrashIcon },
    props: {
        comment: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                comment_id: "",
            }),
            selectedCommentId: null,
            showModal: false,
        };
    },
    methods: {
        openModal(commentId) {
            this.showModal = true;
            this.selectedCommentId = commentId;
        },
        deletePost() {
            this.showModal = false;
            this.form.comment_id = this.selectedCommentId;
            this.form.delete(this.route("destroy.comment"), {
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
