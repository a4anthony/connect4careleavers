<template>
    <div class="input-group">
        <input
            id="btn-input"
            type="text"
            name="message"
            class="form-control input-sm"
            placeholder="Type your message here..."
            v-model="form.message"
            @keyup.enter="sendMessage"
        />

        <span class="input-group-btn">
            <button
                class="btn btn-primary btn-sm"
                id="btn-chat"
                @click="sendMessage"
            >
                Send
            </button>
        </span>
    </div>
</template>

<script>
export default {
    name: "ChatForm",
    props: ["user"],

    data() {
        return {
            form: this.$inertia.form({
                message: "",
            }),
        };
    },

    methods: {
        sendMessage() {
            this.form.post(this.route("send.messages"), {
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
