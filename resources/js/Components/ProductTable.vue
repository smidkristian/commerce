<template>
    <div
            class="mx-auto my-2 w-full p-2 md:w-4/5 bg-gray-200 py-8 px-4 overflow-x-auto rounded-md shadow-inner">
            <table class="table-auto w-full mx-auto md:w-4/5">
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
                        <th class="text-center py-4 px-2">
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
                            <span v-if="productForm.id != product.id">{{product.name}}</span>
                            <span v-else>...</span>
                        </td>
                        <td class="text-left py-4 px-2">
                            <span v-if="productForm.id != product.id">{{product.sku}}</span>
                            <span v-else>...</span>
                        </td>
                        <td class="text-left py-4 px-2">
                            <span v-if="productForm.id != product.id">
                                <span :key="brand.id" v-for="brand in brands">
                                    <span v-if="brand.id == product.brand_id">{{brand.name}}</span>
                                </span>
                            </span>
                            <span v-else>...</span>
                        </td>
                        <td class="text-left py-4 px-2">
                            <span v-if="productForm.id != product.id">{{product.color}}</span>
                            <span v-else>...</span>
                        </td>
                        <td class="text-left py-4 px-2">
                            <span v-if="productForm.id != product.id">{{product.quantity}}</span>
                            <span v-else>...</span>
                        </td>
                        <td class="text-left py-4 px-2">
                            <span v-if="productForm.id != product.id">{{product.weight}}</span>
                            <span v-else>...</span>
                        </td>
                        <td class="text-left py-4 px-2">
                            <span v-if="productForm.id != product.id">{{product.price}}</span>
                            <span v-else>...</span>
                        </td>
                        <td class="text-left py-4 px-2">
                            <span v-if="productForm.id != product.id">{{product.sale_price}}</span>
                            <span v-else>...</span>
                        </td>
                        <td class="text-left py-4 px-2 description">
                            <span v-if="productForm.id != product.id">{{product.description}}</span>
                            <span v-else>...</span>
                        </td>
                        <td class="text-left py-4 px-2">
                            <span v-if="productForm.id != product.id">{{product.status}}</span>
                            <span v-else>...</span>
                        </td>
                        <td class="text-left py-4 px-2">
                            <span v-if="productForm.id != product.id">{{product.featured}}</span>
                            <span v-else>...</span>
                        </td>
                        <td class="text-center px-2">
                            <div v-if="productForm.id != product.id" class="flex justify-center items-center">
                                <button @click="$emit('edit', product)" class="bg-gray-800 uppercase font-semibold text-gray-100 text-xs rounded-md py-2 px-4">Edit</button>
                            </div>
                            <div v-else>
                                <span class="uppercase font-semibold text-gray-500 text-xs py-2 px-4">Editing</span>
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
            'productForm',
            'products',
            'brands'
        ],

    }
</script>

<style scoped>

</style>
