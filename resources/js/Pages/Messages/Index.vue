<template>
    <app :page-title="$page.props.pageTitle">
        <div class="container mx-auto h-full">
            <div class="flex h-full justify-center px-3">
                <div
                    class="border bg-white shadow-sm rounded-lg flex-none w-full sm:w-2/3 h-full relative px-4 py-4"
                >
                    <div class="mb-4 pb-4 border-b-2 border-b-width-1">
                        <chat-header :friend="friend" />
                    </div>
                    <div
                        id="chatMessages"
                        ref="chatMessages"
                        class="bg-gray-100 absolute left-4 right-4 bottom-0 top-20 px-2"
                        style="overflow-y: scroll"
                        :style="{ bottom: chatMessagesHeight }"
                    >
                        <div>
                            <chat-messages
                                :typing-info="typingInfo"
                                @scroll="scrollToElement"
                                :messages="messagesArr"
                                :user="user"
                            />
                        </div>
                    </div>
                    <div
                        ref="chatForm"
                        class="absolute bg-indigo-400 bottom-0 right-0 left-0 px-4 py-2 rounded-b-lg"
                    >
                        <chat-form
                            @typing="isTyping"
                            @scroll="scrollToElement"
                            @resize="setHeight"
                            :friend-id="friend.id"
                        />
                    </div>
                </div>
            </div>
        </div>
    </app>
</template>

<script>
import App from "@/Layouts/App";
import ChatMessages from "@/Components/Chat/ChatMessages";
import ChatForm from "@/Components/Chat/ChatForm";
import ChatHeader from "@/Components/Chat/ChatHeader";

export default {
    name: "Index",
    components: { ChatHeader, ChatForm, ChatMessages, App },
    props: {
        messages: Array,
        friend: Object,
        user: Object,
    },
    data() {
        return {
            messagesArr: [],
            chatMessagesHeight: 0,
            typingInfo: null,
        };
    },
    created() {
        Pusher.logToConsole = true;

        var pusher = new Pusher(process.env.MIX_PUSHER_APP_KEY, {
            cluster: process.env.MIX_PUSHER_APP_CLUSTER,
            authEndpoint: "/broadcasting/auth",
        });
        var channel = pusher.subscribe("private-chat");
        channel.bind("pusher:subscription_succeeded", function (data) {
            console.log(data);
        });
        channel.bind("pusher:subscription_error", function (data) {
            console.log(data);
        });

        channel.bind("client-typing", function (data) {
            that.typingInfo = data;
            setTimeout(function () {
                that.scrollToElement();
            }, 100);
            setTimeout(function () {
                that.typingInfo = null;
                that.scrollToElement();
            }, 2000);
        });
        const that = this;
        channel.bind("newChat", function (data) {
            if (
                (data.message.user_id === that.user.id &&
                    data.message.friend_id === that.friend.id) ||
                (data.message.user_id === that.friend.id &&
                    data.message.friend_id === that.user.id)
            ) {
                that.messagesArr.push(data.message);
                setTimeout(function () {
                    that.scrollToElement();
                }, 100);
            }
        });
    },
    mounted() {
        this.messagesArr = this.messages;
        this.setHeight();
        const that = this;

        setTimeout(function () {
            that.scrollToElement();
        }, 100);
    },
    methods: {
        isTyping() {
            let channel = Echo.private("chat");
            const that = this;
            if (this.typingInfo) {
                return;
            }
            setTimeout(function () {
                channel.whisper("typing", {
                    user_id: that.user.id,
                    username: that.user.username,
                    typing: true,
                });
            }, 300);
        },
        setHeight() {
            this.chatMessagesHeight =
                this.$refs.chatForm.clientHeight + 15 + "px";
        },
        scrollToElement() {
            const el = this.$refs.chatMessages;
            if (el) {
                el.scrollTo({
                    top: el.scrollHeight,
                    behavior: "smooth",
                });
            }
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
