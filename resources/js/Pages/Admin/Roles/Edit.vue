<script setup>
import AdminLayoutVue from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import VueMultiselect from 'vue-multiselect'
import Table from '@/Components/Table.vue'
import TableHeaderCell from '@/Components/TableDataCell.vue'
import TableDataCell from '@/Components/TableDataCell.vue'
import TableRow from '@/Components/TableRow.vue'
import { onMounted, watch } from 'vue';

const props = defineProps({
    role: {
        type: Object,
        required: true
    },
    permissions: Array
})

const form = useForm({
    name: props.role.name,
    permissions: []
})

onMounted(() => {
form.permissions = props.role.permissions
})

watch(
    () => props.role,
   () => (form.permissions = props.role.permissions)
)
</script>

<template>
    <Head title="Update role" />

    <AdminLayoutVue>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <Link :href="route('roles.index')"
                    class="text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded p-3">Back</Link>
            </div>
            <div class="mt-6 bg-slate-100 shadow-lg rounded-lg p-3">
                <div class="mb-2">
                    <h1 class="text-indigo-600 font-semibold text-2xl">Update Role</h1>
                </div>
                <form @submit.prevent="form.put(route('roles.update', role.id))">
                    <div>
                        <InputLabel for="name" value="Name" />

                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                            autocomplete="username" />

                        <InputError class="mt-2" :message="form.errors.name" />
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
                        <TableRow v-for="rolePermission in role.permissions" :key="rolePermission.id" class="border-b">
                            <TableDataCell>{{ rolePermission.id }}</TableDataCell>
                            <TableDataCell>{{ rolePermission.name }}</TableDataCell>
                            <TableDataCell>
                                <Link :href="route('permissions.destroy', [role.id, rolePermission.id])" method="DELETE" as="button"
                                    class="text-red-400 hover:text-red-600 mr-5">Revoke</Link>
                            </TableDataCell>
                        </TableRow>
                    </template>
                </Table>
            </div>
        </div>
    </AdminLayoutVue>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
