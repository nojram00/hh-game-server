<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-400 leading-tight">Add Section</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <AddSectionForm class="max-w-xl" :teachers="teachers" :in-production="production_mode"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AddSectionForm from './Partials/AddSectionForm.vue';

defineProps({
    teachers : {
        type: Object
    },
    production_mode : {
        type: Boolean
    }
})


</script>
<style lang="">

</style>
