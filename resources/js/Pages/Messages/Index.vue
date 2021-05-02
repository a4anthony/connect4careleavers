<template>
    <app>
        <div class="container mx-auto h-full">
            <div class="flex h-full justify-center px-3">
                <!--<div class="bg-blue-500 flex-grow mr-4 h-full"></div>-->
                <div
                    class="border bg-white shadow-sm rounded-lg flex-none w-full sm:w-2/3 h-full relative px-4 py-4"
                >
                    <div class="mb-4 pb-4 border-b-2 border-b-width-1">
                        <chat-header :friend="friend" />
                    </div>
                    <div
                        class="bg-green-200 absolute left-4 right-4 bottom-0 top-20"
                        style="overflow-y: scroll"
                        :style="{ bottom: chatMesssagesHeight }"
                    >
                        <ul>
                            <li v-for="msg in 40">messages {{ msg }}</li>
                        </ul>
                    </div>
                    <div
                        ref="chatForm"
                        class="absolute bg-indigo-400 bottom-0 right-0 left-0 px-4 py-2 rounded-b-lg"
                    >
                        <chat-form @resize="setHeight" />
                    </div>
                </div>
            </div>
            <friends />
        </div>
        <!--<div class="container">-->
        <!--    <div class="row">-->
        <!--        <div class="col-md-8 col-md-offset-2">-->
        <!--            <div class="panel panel-default">-->
        <!--                <div class="panel-heading">Chats</div>-->

        <!--                <div class="panel-body">-->
        <!--                    <chat-messages :messages="messages"></chat-messages>-->
        <!--                </div>-->
        <!--                <div class="panel-footer">-->
        <!--                    <chat-form></chat-form>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <h1>-->
        <!--        <pre>{{ su }}</pre>-->
        <!--    </h1>-->
        <!--    <h1>-->
        <!--        <pre>{{ sm }}</pre>-->
        <!--    </h1>-->
        <!--</div>-->
    </app>
</template>

<script>
import App from "@/Layouts/App";
import ChatMessages from "@/Components/Chat/ChatMessages";
import ChatForm from "@/Components/Chat/ChatForm";
import Friends from "@/Components/Chat/Friends";
import ChatHeader from "@/Components/Chat/ChatHeader";

export default {
    name: "Index",
    components: { ChatHeader, Friends, ChatForm, ChatMessages, App },
    props: {
        messages: Array,
        friend: Array,
        user: Array,
    },
    data() {
        return {
            su: "gg",
            sm: "gg",
            chatMesssagesHeight: 0,
        };
    },
    created() {
        Pusher.logToConsole = true;
        console.log(Pusher.logToConsole);

        var pusher = new Pusher("5c833ecd27bc5d86a4c9", {
            cluster: "eu",
            authEndpoint: "https://connect4careleavers.test/broadcasting/auth",
        });
        //
        var channel = pusher.subscribe("private-chat");
        channel.bind("pusher:subscription_succeeded", function (data) {
            console.log("data");
            console.log(data);
        });
        channel.bind("pusher:subscription_error", function (data) {
            console.log("data");
            console.log(data);
        });
        const that = this;
        channel.bind("newChat", function (data) {
            console.log("data");
            console.log(data);
        });
    },
    mounted() {
        console.log(this.$refs.chatForm.clientHeight);
        this.setHeight();
    },
    methods: {
        setHeight() {
            this.chatMesssagesHeight =
                this.$refs.chatForm.clientHeight + 15 + "px";
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
