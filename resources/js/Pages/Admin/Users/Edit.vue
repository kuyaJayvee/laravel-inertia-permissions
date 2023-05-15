<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3'
import VueMultiselect from 'vue-multiselect'
import Table from '@/Components/Table.vue'
import TableHeaderCell from '@/Components/TableDataCell.vue'
import TableDataCell from '@/Components/TableDataCell.vue'
import TableRow from '@/Components/TableRow.vue'
import { onMounted, watch } from 'vue';


const props = defineProps({
    user: {
        type: Object,
        required: true
    },
    roles: Array,
    permissions: Array
})

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: props.user.password,
    roles: [],
    permissions: []
});

onMounted(() => {
    form.permissions = props.user.permissions
    form.roles = props.user.roles
})

watch(
    () => props.role,
    () => {
        form.permissions = props.user.permissions,
        form.roles = props.user.roles
    }
)
</script>

<template>
     <Head title="Update user" />

        <AdminLayout>
            <div class="max-w-7xl mx-auto py-4">
                <div class="flex justify-between">
                    <Link :href="route('users.index')"
                        class="text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded p-3">Back</Link>
                </div>
                <div class="mt-6 bg-slate-100 shadow-lg rounded-lg p-3">
                    <div class="mb-2">
                        <h1 class="text-indigo-600 font-semibold text-2xl">Update User</h1>
                    </div>
                    <form @submit.prevent="form.put(route('users.update', user.id))">
                        <div>
                            <InputLabel for="name" value="Name" />

                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                                autocomplete="username" />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div class="mt-4">
                                <InputLabel for="name" value="Permissions" />
                                <VueMultiselect v-model="form.roles" :options="roles" :multiple="true"
                                    :close-on-select="true" placeholder="List of Permissions" label="name" track-by="name" />
                            </div>
                        <div class="mt-4">
                            <InputLabel for="name" value="Permissions" />
                            <VueMultiselect v-model="form.permissions" :options="permissions" :multiple="true"
                                :close-on-select="true" placeholder="List of Permissions" label="name" track-by="name" />
                        </div>
                        <div class="flex items-center mt-4">
                            <PrimaryButton class="bg-slate-900 text-white px-5 font-semibold py-2 rounded cursor-pointer"
                                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Update
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
                 <div class="mt-6">
                        <div class="mb-2">
                            <h1 class="text-indigo-600 font-semibold text-2xl">Roles</h1>
                        </div>
                        <Table>
                            <template #header>
                                <TableRow>
                                    <TableHeaderCell>ID</TableHeaderCell>
                                    <TableHeaderCell>Name</TableHeaderCell>
                                    <TableHeaderCell>Action</TableHeaderCell>
                                </TableRow>
                            </template>
                            <template #default>
                                <TableRow v-for="userRoles in user.roles" :key="userRoles.id" class="border-b">
                                    <TableDataCell>{{ userRoles.id }}</TableDataCell>
                                    <TableDataCell>{{ userRoles.name }}</TableDataCell>
                                    <TableDataCell>
                                        <Link :href="route('permissions.destroy',[user.id, userRoles.id])" method="DELETE" as="button"
                                            class="text-red-400 hover:text-red-600 mr-5">Revoke</Link>
                                    </TableDataCell>
                                </TableRow>
                            </template>
                        </Table>
                    </div>
                <div class="mt-6">
                    <div class="mb-2">
                        <h1 class="text-indigo-600 font-semibold text-2xl">Permissions</h1>
                    </div>
                    <Table>
                        <template #header>
                            <TableRow>
                                <TableHeaderCell>ID</TableHeaderCell>
                                <TableHeaderCell>Name</TableHeaderCell>
                                <TableHeaderCell>Action</TableHeaderCell>
                            </TableRow>
                        </template>
                        <template #default>
                            <TableRow v-for="userPermission in user.permissions" :key="userPermission.id" class="border-b">
                                <TableDataCell>{{ userPermission.id }}</TableDataCell>
                                <TableDataCell>{{ userPermission.name }}</TableDataCell>
                                <TableDataCell>
                                    <Link :href="route('permissions.destroy', [user.id, userPermission.id])" method="DELETE" as="button"
                                        class="text-red-400 hover:text-red-600 mr-5">Revoke</Link>
                                </TableDataCell>
                            </TableRow>
                        </template>
                    </Table>
                </div>
            </div>
        </AdminLayout>
</template>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>
