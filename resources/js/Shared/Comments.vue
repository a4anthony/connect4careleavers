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
                        <unlike-comment
                            v-if="comment.liked_by_current_user"
                            :comment="comment"
                        />
                        <like-comment v-else :comment="comment" />
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
                        <delete-comment :comment="comment" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { TrashIcon, HeartIcon } from "@heroicons/vue/solid/esm";
import UnlikeComment from "@/Components/Comment/UnlikeComment";
import LikeComment from "@/Components/Comment/LikeComment";
import DeleteComment from "@/Components/Comment/DeleteComment";

export default {
    name: "Comments",
    components: {
        DeleteComment,
        LikeComment,
        UnlikeComment,
        TrashIcon,
        HeartIcon,
    },
    props: {
        comments: Array,
        postAuthorId: Number,
    },
    data() {
        return {};
    },
    methods: {},
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
