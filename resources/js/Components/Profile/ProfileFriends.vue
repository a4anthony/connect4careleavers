<template>
    <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-2">
        <li
            v-for="person in friends"
            :key="person.email"
            class="col-span-1 bg-white rounded-lg shadow divide-gray-200"
        >
            <div class="p-4">
                <div class="w-full flex items-center justify-between space-x-6">
                    <div class="flex-1 truncate">
                        <div class="flex items-center space-x-3">
                            <h3
                                class="text-gray-900 text-sm font-medium truncate"
                            >
                                {{ person.name }}
                            </h3>
                        </div>
                        <inertia-link
                            class="block user-name"
                            :href="
                                route('show.profile', {
                                    username: person.username,
                                })
                            "
                        >
                            {{ person.username }}
                        </inertia-link>
                    </div>
                    <inertia-link
                        class="block user-name"
                        :href="
                            route('show.profile', {
                                username: person.username,
                            })
                        "
                    >
                        <img
                            class="w-10 h-10 bg-gray-300 rounded-full flex-shrink-0"
                            :src="person.avatar"
                            alt=""
                    /></inertia-link>
                </div>
                <div class="text-left mt-4">
                    <!--unfriend user-->
                    <unfriend :current-user="currentUser" :user="person" />
                    <!--add friend-->
                    <add-friend :current-user="currentUser" :user="person" />
                    <!--cancel request-->
                    <cancel-request
                        :current-user="currentUser"
                        :user="person"
                    />
                    <!--confirm request-->
                    <confirm-request
                        :current-user="currentUser"
                        :user="person"
                    />
                </div>
            </div>
        </li>
        <confirm-modal
            :open="showModal"
            @confirmed="unfriend"
            :text="modalText"
            @close="showModal = false"
        />
    </ul>
</template>

<script>
import { UserRemoveIcon, UserAddIcon } from "@heroicons/vue/outline";
import ConfirmModal from "@/Shared/ConfirmModal";
import CancelRequest from "@/Components/Friends/CancelRequest";
import ConfirmRequest from "@/Components/Friends/ConfirmRequest";
import AddFriend from "@/Components/Friends/AddFriend";
import Unfriend from "@/Components/Friends/Unfriend";
export default {
    name: "ProfileFriends",
    components: {
        Unfriend,
        AddFriend,
        ConfirmRequest,
        CancelRequest,
        ConfirmModal,
        UserRemoveIcon,
        UserAddIcon,
    },
    props: {
        friends: Array,
        currentUser: Boolean,
        sortKey: String,
    },
    data() {
        return {
            confirmFriendForm: this.$inertia.form({
                user_id: "",
            }),
            unfriendForm: this.$inertia.form({
                friend_id: "",
            }),
            selectedFriendId: "",
            showModal: false,
            modalText: "",
        };
    },
    methods: {
        confirmFriend(friendId) {
            this.selectedFriendId = friendId;
            this.confirmFriendForm.user_id = friendId;
            this.confirmFriendForm.post(this.route("confirm.friend"), {
                preserveScroll: true,
            });
        },
        unfriend() {
            this.showModal = false;
            this.unfriendForm.friend_id = this.selectedFriendId;
            this.unfriendForm.post(this.route("unfriend.friend"), {
                preserveScroll: true,
            });
        },
        openModal(friend) {
            this.modalText = `Are you sure you want to remove ${friend.name} as your friend?`;
            this.showModal = true;
            this.selectedFriendId = friend.id;
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
