<template>
    <button
        v-if="user.request_sent"
        type="button"
        @click="cancelRequest(user)"
        class="font-bold inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
    >
        <UserRemoveIcon class="-ml-0.5 mr-2 h-4 w-4" aria-hidden="true" />
        Cancel Request
    </button>
</template>

<script>
import { UserRemoveIcon } from "@heroicons/vue/outline/esm";

export default {
    name: "CancelRequest",
    components: {
        UserRemoveIcon,
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
        cancelRequest(friend) {
            this.form.friend_id = friend.id;
            this.form.post(this.route("unfriend.friend"), {
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
