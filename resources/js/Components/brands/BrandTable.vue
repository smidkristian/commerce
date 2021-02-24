<template>
        <div class="mx-auto w-full p-2 md:w-4/5 bg-gray-200 py-8 flex justify-center rounded-md mt-10 shadow-inner">
            <table class="table-auto w-full mx-auto md:w-4/5 overflow-x-auto xyz-in" xyz="fade-100% duration-10">
                <thead class="bg-gray-100 shadow-sm mb-4">
                    <tr>
                        <th class="text-center py-4 px-2">
                            ID
                        </th>
                        <th class="text-left py-4 px-2">
                            Name
                        </th>
                        <th class="text-left py-4 px-2">
                            Description
                        </th>
                        <th class="text-center py-4 px-2 action">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr :key="brand.id" v-for="brand in brands" :id="brand.name">
                        <td class="text-center py-4 px-2">
                            {{brand.id}}
                        </td>
                        <td class="text-left py-4 px-2">
                            <span>{{brand.name}}</span>
                        </td>
                        <td class="text-left py-4 px-2 description">
                            <span>{{brand.description}}</span>
                        </td>
                        <td class="text-center action">
                            <inertia-link :href="$route('edit-brand', brand.id)" class="btn-header">Edit</inertia-link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
</template>

<script>

    export default {
        props: [
            'brands'
        ],
    }
</script>

<style scoped>

    tr {
        border-bottom: solid 0.5px rgb(209, 209, 209);
    }
    th {
        padding-left: 1rem;
    }
    td {
        padding-left: 1rem;
    }
    td:hover {
        background-color: rgb(235, 235, 235);
    }
    .action {
        padding: 0;
    }
    .action:hover {
        background-color: transparent;
    }
    .description {
        max-width: 5vw !important;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

</style>
