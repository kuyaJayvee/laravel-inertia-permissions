<script setup>
import AdminLayoutVue from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const form = useForm({
    name: ''
})
</script>

<template>
    <Head title="Create new role" />

    <AdminLayoutVue>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <h1>Create new role</h1>
                <Link :href="route('roles.index')"
                    class="text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded p-3">Back</Link>
            </div>
            <div class="mt-6 max-w-md mx-auto">
                <form @submit.prevent="form.post(route('roles.store'))">
                    <div>
                        <InputLabel for="name" value="Name" />

                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                            autocomplete="username" />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div class="flex items-center mt-4">
                        <PrimaryButton class="bg-slate-900 text-white px-5 font-semibold py-2 rounded cursor-pointer"  :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Create
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayoutVue>
</template>
