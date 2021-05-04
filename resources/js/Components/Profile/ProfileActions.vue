<template>
    <div
        class="mt-6 flex flex-none flex-col-reverse justify-stretch space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-reverse sm:space-y-0 sm:space-x-3 md:mt-0 md:flex-row md:space-x-3"
    >
        <!--send message -->
        <inertia-link
            v-if="!currentUser"
            type="button"
            :href="route('messages', { friendUsername: user.username })"
            class="font-bold inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
        >
            <MailIcon class="-ml-0.5 mr-2 h-4 w-4" aria-hidden="true" />
            Send Message
        </inertia-link>
        <!--unfriend user-->
        <unfriend :current-user="currentUser" :user="user" />
        <!--add friend-->
        <add-friend :current-user="currentUser" :user="user" />
        <!--cancel request-->
        <cancel-request :current-user="currentUser" :user="user" />
        <!--confirm request-->
        <confirm-request :current-user="currentUser" :user="user" />
        <!--edit profile-->
        <inertia-link
            v-if="currentUser"
            :href="route('edit.profile', { username: user.username })"
            class="font-bold inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
        >
            Edit Profile
        </inertia-link>
    </div>
</template>

<script>
import { MailIcon, FlagIcon } from "@heroicons/vue/outline";
import AddFriend from "@/Components/Friends/AddFriend";
import Unfriend from "@/Components/Friends/Unfriend";
import CancelRequest from "@/Components/Friends/CancelRequest";
import ConfirmRequest from "@/Components/Friends/ConfirmRequest";

export default {
    name: "ProfileActions",
    components: {
        ConfirmRequest,
        CancelRequest,
        Unfriend,
        AddFriend,
        MailIcon,
        FlagIcon,
    },
    props: {
        user: Object,
        currentUser: Boolean,
    },
    data() {
        return {};
    },
    methods: {},
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
