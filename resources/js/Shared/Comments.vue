<template>
    <div>
        <div class="comments flex border-b-2 py-2" v-for="comment in comments">
            <div class="flex-none mr-2">
                <inertia-link
                    :href="
                        route('show.profile', {
                            username: comment.author.username,
                        })
                    "
                >
                    <img
                        class="h-8 w-8 rounded-full"
                        :src="comment.author.avatar"
                        alt=""
                    />
                </inertia-link>
            </div>
            <div class="flex-grow">
                <span class="text-xs text-gray-800 block w-full">
                    <inertia-link
                        :href="
                            route('show.profile', {
                                username: comment.author.username,
                            })
                        "
                        class="user-name"
                        >{{ comment.author.username }}:
                    </inertia-link>
                    {{ comment.body }}
                </span>
                <div class="mt-2 flex items-center">
                    <div class="mr-2 flex items-center">
                        <button
                            @click="unlike(comment.id)"
                            v-if="comment.liked_by_current_user"
                            :disabled="unlikeForm.processing"
                        >
                            <HeartIcon
                                :class="
                                    unlikeForm.processing &&
                                    comment.id === selectedCommentId &&
                                    'animate-bounce'
                                "
                                class="h-5 w-5 text-red-600 mr-1"
                            />
                        </button>
                        <button
                            @click="like(comment.id)"
                            v-else
                            :disabled="likeForm.processing"
                        >
                            <HeartIcon
                                :class="
                                    likeForm.processing &&
                                    comment.id === selectedCommentId &&
                                    'animate-bounce'
                                "
                                class="h-5 w-5 text-gray-400 mr-1"
                            />
                        </button>
                    </div>
                    {{ "-" }}
                    <div class="ml-2 mr-2">
                        <span class="time-ago inline-block">{{
                            comment.created_at
                        }}</span>
                    </div>
                    {{ "-" }}
                    <div class="ml-2 mr-2">
                        <span class="text-xs"
                            ><span class="font-bold">{{
                                comment.likes.length
                            }}</span>
                            likes</span
                        >
                    </div>
                    <div
                        class="flex items-center"
                        v-if="
                            $page.props.auth.user.id === comment.author.id ||
                            postAuthorId === comment.author.id
                        "
                    >
                        {{ "-" }}
                        <button
                            type="button"
                            @click="openModal(comment.id)"
                            class="ml-2 text-red-600 hover:text-red-400 flex"
                        >
                            <TrashIcon class="h-5 w-5 text-red-400" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <confirm-modal
                @close="showModal = false"
                :open="showModal"
                @confirmed="deleteComment"
                text="Are you sure you want to delete this comment?"
            />
        </div>
    </div>
</template>

<script>
import { TrashIcon, HeartIcon } from "@heroicons/vue/solid/esm";
import ConfirmModal from "@/Shared/ConfirmModal";

const user = {
    name: "Chelsea Hagon",
    email: "chelseahagon@example.com",
    imageUrl:
        "https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
};
export default {
    name: "Comments",
    components: {
        ConfirmModal,
        TrashIcon,
        HeartIcon,
    },
    props: {
        comments: Array,
        postAuthorId: Number,
    },
    setup() {
        return {
            user,
        };
    },
    data() {
        return {
            showModal: false,
            selectedCommentId: null,
            form: this.$inertia.form({
                comment_id: "",
            }),
            likeForm: this.$inertia.form({
                comment_id: "",
            }),
            unlikeForm: this.$inertia.form({
                comment_id: "",
            }),
        };
    },
    methods: {
        like(commentId) {
            this.selectedCommentId = commentId;
            this.likeForm.comment_id = commentId;
            this.likeForm.post(this.route("like.comment"), {
                preserveScroll: true,
            });
        },
        unlike(commentId) {
            this.selectedPostId = commentId;
            this.unlikeForm.comment_id = commentId;
            this.unlikeForm.post(this.route("unlike.comment"), {
                preserveScroll: true,
            });
        },
        openModal(commentId) {
            this.showModal = true;
            this.selectedCommentId = commentId;
        },
        deleteComment() {
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
.comments {
    border-bottom-width: 1px !important;
}

.comments:first-child {
    padding-top: 0 !important;
}

.comments:last-child {
    margin-bottom: 1rem;
}

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
