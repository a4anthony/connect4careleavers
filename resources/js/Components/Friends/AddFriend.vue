<template>
    <button
        v-if="
            !currentUser &&
            !user.current_friend &&
            !user.request_received &&
            !user.request_sent
        "
        type="button"
        @click="addFriend(user)"
        class="font-bold inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
    >
        <UserAddIcon class="-ml-0.5 mr-2 h-4 w-4" aria-hidden="true" />
        Add Friend
    </button>
</template>

<script>
import { UserAddIcon } from "@heroicons/vue/outline";

export default {
    name: "AddFriend",
    components: {
        UserAddIcon,
    },
    props: {
        user: Object,
        currentUser: Boolean,
    },
    data() {
        return {
            form: this.$inertia.form({
                friend_id: "",
            }),
        };
    },
    methods: {
        addFriend(friend) {
            this.form.friend_id = friend.id;
            this.form.post(this.route("addFriend.friend"), {
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
