<template>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-indigo-800"
    >
        <div>
            <inertia-link href="/">
                <logo />
            </inertia-link>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>

<script>
import BreezeApplicationLogo from "@/Components/ApplicationLogo";
import Logo from "@/Shared/Logo";

export default {
    components: {
        Logo,
        BreezeApplicationLogo,
    },
};
</script>
