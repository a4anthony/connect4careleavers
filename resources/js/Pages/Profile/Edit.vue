<template>
    <app>
        <div class="container mx-auto">
            <div class="px-3">
                <form
                    @submit.prevent="submit"
                    class="bg-white rounded-lg shadow-sm space-y-8 divide-y divide-gray-200 p-4 sm:p-8"
                >
                    <div
                        class="space-y-8 divide-y divide-gray-200 sm:space-y-5"
                    >
                        <div>
                            <div>
                                <h3
                                    class="text-lg leading-6 font-medium text-gray-900"
                                >
                                    Profile
                                </h3>

                                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                    This information will be displayed publicly
                                    so be careful what you share.
                                </p>
                            </div>

                            <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
                                <div
                                    class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
                                >
                                    <label
                                        for="name"
                                        class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                    >
                                        Name
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <input
                                            type="text"
                                            name="name"
                                            id="name"
                                            v-model="form.name"
                                            autocomplete="given-name"
                                            required
                                            class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md"
                                        />
                                    </div>
                                </div>
                                <div
                                    class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
                                >
                                    <label
                                        for="username"
                                        class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                    >
                                        Username
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <input
                                            type="text"
                                            name="username"
                                            id="username"
                                            v-model="form.username"
                                            autocomplete="given-name"
                                            required
                                            readonly
                                            class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md"
                                        />
                                    </div>
                                </div>
                                <div
                                    class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
                                >
                                    <label
                                        for="email"
                                        class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                    >
                                        Email address
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <input
                                            id="email"
                                            name="email"
                                            type="email"
                                            v-model="form.email"
                                            autocomplete="email"
                                            readonly
                                            class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"
                                        />
                                    </div>
                                </div>
                                <div
                                    class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
                                >
                                    <label
                                        for="about"
                                        class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                    >
                                        Bio
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <textarea
                                            id="about"
                                            name="about"
                                            rows="3"
                                            v-model="form.bio"
                                            class="max-w-lg shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"
                                        />
                                        <p class="mt-2 text-sm text-gray-500">
                                            Write a few sentences about
                                            yourself.
                                        </p>
                                    </div>
                                </div>

                                <div
                                    class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-center sm:border-t sm:border-gray-200 sm:pt-5"
                                >
                                    <label
                                        for="photo"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Photo
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <div class="flex items-center">
                                            <img
                                                v-if="!imgSrc"
                                                :src="user.avatar"
                                                class="h-12 w-12 rounded-full"
                                                alt=""
                                            />
                                            <img
                                                v-else
                                                :src="imgSrc"
                                                class="h-12 w-12 rounded-full"
                                                alt=""
                                            />
                                            <button
                                                type="button"
                                                @click="
                                                    $refs.imageUpload.openImageUpload()
                                                "
                                                class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                            >
                                                Change
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
                                >
                                    <label
                                        for="website"
                                        class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                    >
                                        Website
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <input
                                            id="website"
                                            name="website"
                                            type="text"
                                            v-model="form.website"
                                            autocomplete="email"
                                            class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"
                                        />
                                    </div>
                                </div>
                                <div
                                    class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
                                >
                                    <label
                                        for="country"
                                        class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                    >
                                        Country / Region
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <select
                                            id="country"
                                            name="country"
                                            autocomplete="country"
                                            v-model="form.country"
                                            class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md"
                                        >
                                            <option
                                                v-for="(
                                                    country, index
                                                ) in countries"
                                                :key="index"
                                            >
                                                {{ country }}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div
                                    class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5"
                                >
                                    <label
                                        for="city"
                                        class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                    >
                                        City
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <input
                                            type="text"
                                            name="city"
                                            id="city"
                                            v-model="form.city"
                                            class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-5">
                        <div class="flex justify-end">
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="font-bold ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                <span v-if="!form.processing">
                                    Save Changes
                                </span>
                                <loading-icon v-else />
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <image-upload ref="imageUpload" @get-image="getImage" />
    </app>
</template>

<script>
import App from "@/Layouts/App";
import ImageUpload from "@/Shared/ImageUpload";
import LoadingIcon from "@/Shared/LoadingIcon";
export default {
    name: "Edit",
    components: { LoadingIcon, ImageUpload, App },
    props: {
        user: Object,
        countries: Object,
    },
    mounted() {
        this.form = this.$inertia.form({
            name: this.user.name,
            username: this.user.username,
            email: this.user.email,
            bio: this.user.bio,
            website: this.user.website,
            city: this.user.city,
            country: this.user.country,
            avatar: this.user.avatar,
        });
    },
    data() {
        return {
            form: this.$inertia.form({
                name: "",
                username: "",
                website: "",
                bio: "",
                city: "",
                country: "",
                avatar: "",
                email: "",
            }),
            imgSrc: null,
        };
    },
    methods: {
        getImage(img, file) {
            this.form.avatar = file;
            this.imgSrc = img;
        },
        submit() {
            if (!this.form.name) {
                this.form.name = this.user.name;
            }
            if (!this.form.username) {
                this.form.username = this.user.username;
            }
            if (!this.form.email) {
                this.form.email = this.user.email;
            }
            if (!this.form.avatar) {
                this.form.avatar = this.user.avatar;
            }
            this.form.post(
                this.route("update.profile", { username: this.user.username }),
                {
                    onFinish: () => {
                        this.form.reset("processing");
                    },
                }
            );
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
