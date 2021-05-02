<template>
    <app>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Chats</div>

                        <div class="panel-body">
                            <chat-messages :messages="messages"></chat-messages>
                        </div>
                        <div class="panel-footer">
                            <chat-form></chat-form>
                        </div>
                    </div>
                </div>
            </div>
            <h1>
                <pre>{{ su }}</pre>
            </h1>
            <h1>
                <pre>{{ sm }}</pre>
            </h1>
        </div>
    </app>
</template>

<script>
import App from "@/Layouts/App";
import ChatMessages from "@/Components/Chat/ChatMessages";
import ChatForm from "@/Components/Chat/ChatForm";

export default {
    name: "Index",
    components: { ChatForm, ChatMessages, App },
    props: {
        messages: Array,
    },
    data() {
        return {
            su: "gg",
            sm: "gg",
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
    mounted() {},
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
