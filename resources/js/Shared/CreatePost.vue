<template>
    <div class="p-0 m-0">
        <breeze-validation-errors class="mb-4" />
        <form @submit.prevent="submit">
            <label for="body" class="hidden" />
            <div>
                <textarea
                    id="body"
                    name="body"
                    rows="5"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                    placeholder="What's happening?"
                    v-model="form.body"
                    maxlength="250"
                    required
                ></textarea>
                <span class="text-sm block mt-2">{{
                    250 - form.body.length
                }}</span>
                <div v-if="imgSrc">
                    <img
                        :src="imgSrc"
                        class="w-1/2 sm:w-1/4 rounded-lg mt-4 shadow-sm"
                        alt="post image"
                    />
                    <button
                        type="button"
                        @click="$refs.imageUpload.remove()"
                        class="text-red-600 hover:text-red-400 flex mt-2"
                    >
                        Remove <TrashIcon class="h-5 w-5 text-red-400" />
                    </button>
                </div>
            </div>
            <div
                class="shadow-sm border flex justify-between mt-4 bg-white rounded-lg p-3"
            >
                <button
                    type="button"
                    @click="$refs.imageUpload.openImageUpload()"
                >
                    <PhotographIcon class="h-5 w-5 text-gray-400" />
                </button>
                <div class="flex items-center">
                    <span
                        class="text-gray-500 text-sm font-semibold capitalize"
                        >{{ form.publicity }}</span
                    >
                    <Menu as="div" class="flex-shrink-0 relative ml-2 mr-4">
                        <div>
                            <MenuButton
                                class="bg-white rounded-full flex focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                <EyeIcon class="h-5 w-5 text-gray-400" />
                            </MenuButton>
                        </div>
                        <transition
                            enter-active-class="transition ease-out duration-100"
                            enter-from-class="transform opacity-0 scale-95"
                            enter-to-class="transform opacity-100 scale-100"
                            leave-active-class="transition ease-in duration-75"
                            leave-from-class="transform opacity-100 scale-100"
                            leave-to-class="transform opacity-0 scale-95"
                        >
                            <MenuItems
                                class="origin-top-right absolute z-10 right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 py-1 focus:outline-none"
                            >
                                <MenuItem
                                    v-for="item in ['public', 'friends']"
                                    :key="item"
                                    v-slot="{ active }"
                                >
                                    <button
                                        type="button"
                                        @click="form.publicity = item"
                                        class="p-2 text-left w-full hover:bg-gray-100 block text-gray-500 text-sm font-semibold capitalize"
                                    >
                                        {{ item }}
                                    </button>
                                </MenuItem>
                            </MenuItems>
                        </transition>
                    </Menu>
                    <button
                        :class="{ 'opacity-25': form.body.length === 0 }"
                        :disabled="form.processing || form.body.length === 0"
                        type="submit"
                        class="font-bold inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        <span
                            v-if="!form.processing"
                            class="inline-flex items-center justify-center"
                        >
                            Post
                        </span>
                        <loading-icon v-else />
                    </button>
                </div>
            </div>
        </form>
        <image-upload ref="imageUpload" @get-image="getImage" />
    </div>
</template>

<script>
import { PhotographIcon, EyeIcon, TrashIcon } from "@heroicons/vue/solid";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import ImageUpload from "@/Shared/ImageUpload";
import BreezeValidationErrors from "@/Components/ValidationErrors";
import LoadingIcon from "@/Shared/LoadingIcon";
const user = {
    name: "Chelsea Hagon",
    email: "chelseahagon@example.com",
    imageUrl:
        "https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
};

export default {
    name: "CreatePost",
    components: {
        LoadingIcon,
        ImageUpload,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
        PhotographIcon,
        EyeIcon,
        TrashIcon,
        BreezeValidationErrors,
    },
    setup() {
        return {
            user,
        };
    },
    data() {
        return {
            imgSrc: null,
            form: this.$inertia.form({
                body: "",
                image: "",
                publicity: "public",
            }),
        };
    },

    methods: {
        submit() {
            this.form.post(this.route("store.post"), {
                onFinish: () => {
                    this.form.reset("processing");
                    if (Object.keys(this.form.errors).length === 0) {
                        this.form.reset("body");
                        this.form.reset("image");
                        this.form.reset("publicity");
                        this.imgSrc = "";
                    }
                },
            });
        },
        getImage(img, file) {
            this.form.image = file;
            this.imgSrc = img;
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
