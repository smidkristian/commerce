<template>
    <div class="mx-auto my-2 w-full p-2 md:w-4/5 bg-gray-200 py-8 px-4 overflow-x-auto rounded-md shadow-inner">
        <table class="table-auto w-full mx-auto md:w-11/12">
            <thead class="bg-gray-100 shadow-sm mb-4">
                <tr>
                    <th class="text-center py-4 px-2">
                        ID
                    </th>
                    <th class="text-left py-4 px-2">
                        Name
                    </th>
                    <th class="text-left py-4 px-2">
                        SKU
                    </th>
                    <th class="text-left py-4 px-2">
                        Brand
                    </th>
                    <th class="text-left py-4 px-2">
                        Color
                    </th>
                    <th class="text-left py-4 px-2">
                        Quantity
                    </th>
                    <th class="text-left py-4 px-2">
                        Weight
                    </th>
                    <th class="text-left py-4 px-2">
                        Price
                    </th>
                    <th class="text-left py-4 px-2">
                        Sale
                    </th>
                    <th class="text-left py-4 px-2">
                        Descritpion
                    </th>
                    <th class="text-left py-4 px-2">
                        Status
                    </th>
                    <th class="text-left py-4 px-2">
                        Featured
                    </th>
                    <th class="text-center py-4 px-2 action">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr :key="product.id" v-for="product in products" :id="product.name">
                    <td class="text-center py-4 px-2">
                        {{product.id}}
                    </td>
                    <td class="text-left py-4 px-2">
                        <span>{{product.name}}</span>
                    </td>
                    <td class="text-left py-4 px-2">
                        <span>{{product.sku}}</span>
                    </td>
                    <td class="text-left py-4 px-2">
                        <span>
                            <span :key="brand.id" v-for="brand in brands">
                                <span v-if="brand.id == product.brand_id">{{brand.name}}</span>
                            </span>
                        </span>
                    </td>
                    <td class="text-left py-4 px-2">
                        <span>{{product.color}}</span>
                    </td>
                    <td class="text-left py-4 px-2">
                        <span>{{product.quantity}}</span>
                    </td>
                    <td class="text-left py-4 px-2">
                        <span>{{product.weight}}</span>
                    </td>
                    <td class="text-left py-4 px-2">
                        <span>{{product.price}}</span>
                    </td>
                    <td class="text-left py-4 px-2">
                        <span>{{product.sale_price}}</span>
                    </td>
                    <td class="text-left py-4 px-2 description">
                        <span>{{product.description}}</span>
                    </td>
                    <td class="text-left py-4 px-2">
                        <span>{{product.status}}</span>
                    </td>
                    <td class="text-left py-4 px-2">
                        <span>{{product.featured}}</span>
                    </td>
                    <td class="text-center px-2 action">
                        <div class="flex justify-center items-center">
                            <inertia-link :href="$route('edit-product', product.id)" class="bg-gray-800 uppercase font-semibold text-gray-100 text-xs rounded-md py-2 px-4">Edit</inertia-link>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

    export default {

        props: [
            'products',
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
