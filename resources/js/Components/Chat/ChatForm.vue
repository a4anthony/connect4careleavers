<template>
    <div class="flex">
        <label :for="id" class="hidden"></label>
        <div class="relative mr-2 flex-grow">
            <textarea
                :id="id"
                name="body"
                rows="1"
                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-xl"
                placeholder="Enter message"
                v-model="form.message"
                maxlength="250"
                required
                @input="setHeight"
                ref="textArea"
                @keyup.enter="sendMessage"
                style="resize: none"
            ></textarea>
        </div>
        <div class="w-10 h-10 items-center flex flex-none">
            <button
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing || form.message.length === 0"
                type="submit"
                class="w-full h-full font-bold inline-flex items-center justify-center border border-gray-300 shadow-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
            >
                <PaperAirplaneIcon class="w-5 h-5" />
            </button>
        </div>
    </div>
</template>

<script>
import { PaperAirplaneIcon } from "@heroicons/vue/outline/esm";

const uniqueId = require("lodash.uniqueid");

export default {
    name: "ChatForm",
    components: {
        PaperAirplaneIcon,
    },
    props: {
        id: {
            type: String,
            default() {
                return `chat-message-${uniqueId()}`;
            },
        },
    },
    data() {
        return {
            form: this.$inertia.form({
                message: "",
            }),
        };
    },

    methods: {
        setHeight() {
            if (this.$refs.textArea.scrollHeight < 150) {
                this.$emit("resize");
                this.$refs.textArea.style.height = "";
                this.$refs.textArea.style.height =
                    this.$refs.textArea.scrollHeight + "px";
            }
        },
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
