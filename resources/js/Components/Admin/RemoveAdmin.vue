<template>
    <button
        v-if="user.is_admin"
        type="button"
        @click="openModal(user)"
        class="font-bold inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-400 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-red-500"
    >
        <span
            v-if="!form.processing && !showModal"
            class="inline-flex items-center justify-center"
        >
            Remove Admin</span
        >
        <loading-icon v-if="showModal || form.processing" />

        <confirm-modal
            :open="showModal"
            @confirmed="removeAdmin"
            :text="modalText"
            @close="showModal = false"
        />
    </button>
</template>

<script>
import ConfirmModal from "@/Shared/ConfirmModal";
import LoadingIcon from "@/Shared/LoadingIcon";
export default {
    name: "RemoveAdmin",
    components: {
        LoadingIcon,
        ConfirmModal,
    },
    props: {
        user: Object,
        currentUser: Boolean,
    },
    data() {
        return {
            form: this.$inertia.form({
                user_id: "",
            }),
            selectedUserId: "",
            showModal: false,
            modalText: "",
        };
    },
    methods: {
        openModal(user) {
            this.modalText = `Are you sure you want to remove ${user.name} as an admin user?`;
            this.showModal = true;
            this.selectedUserId = user.id;
        },
        removeAdmin() {
            this.showModal = false;
            this.form.user_id = this.selectedUserId;
            this.form.post(this.route("removeAdmin.admin"), {
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
