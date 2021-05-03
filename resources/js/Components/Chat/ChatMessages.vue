<template>
    <ul>
        <li v-for="msg in messages" :key="`msg${msg.id}`">
            <div
                :class="
                    user.id === msg.user_id
                        ? 'ml-12 sm:ml-4 justify-end'
                        : 'mr-12 sm:mr-4 justify-start'
                "
                class="flex"
            >
                <div
                    :class="
                        user.id === msg.user_id
                            ? 'bg-indigo-600'
                            : 'bg-gray-600'
                    "
                    class="text-xs rounded-xl p-3 text-gray-100 mb-2"
                >
                    <div class="font-bold">
                        {{ msg.message }}
                    </div>
                    <span
                        class="block mt-2 text-gray-400 font-extralight"
                        style="font-size: 0.6rem"
                    >
                        sent on {{ msg.created_at }}
                    </span>
                </div>
            </div>
        </li>
        <li
            class="text-center mb-2 text-xs mt-1"
            v-if="
                typingInfo &&
                typingInfo.typing &&
                typingInfo.user_id !== user.id
            "
        >
            {{ typingInfo.username }} is typing...
        </li>
    </ul>
</template>

<script>
export default {
    name: "ChatMessages",
    props: {
        messages: Array,
        user: Object,
        typingInfo: Object,
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
