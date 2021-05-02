<template>
    <button
        v-if="user.current_friend"
        type="button"
        @click="openModal(user)"
        class="font-bold inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-400 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-red-500"
    >
        <span
            v-if="!form.processing && !showModal"
            class="inline-flex items-center justify-center"
        >
            <UserRemoveIcon class="-ml-0.5 mr-2 h-4 w-4" aria-hidden="true" />
            Unfriend</span
        >
        <loading-icon v-if="showModal || form.processing" />

        <confirm-modal
            :open="showModal"
            @confirmed="unfriend"
            :text="modalText"
            @close="showModal = false"
        />
    </button>
</template>

<script>
import ConfirmModal from "@/Shared/ConfirmModal";
import { UserRemoveIcon } from "@heroicons/vue/outline";
import LoadingIcon from "@/Shared/LoadingIcon";
export default {
    name: "Unfriend",
    components: {
        LoadingIcon,
        ConfirmModal,
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
            selectedFriendId: "",
            showModal: false,
            modalText: "",
        };
    },
    methods: {
        openModal(friend) {
            this.modalText = `Are you sure you want to remove ${friend.name} as your friend?`;
            this.showModal = true;
            this.selectedFriendId = friend.id;
        },
        unfriend() {
            this.showModal = false;
            this.form.friend_id = this.selectedFriendId;
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
