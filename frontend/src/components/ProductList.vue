<template>
  <div>
    <h1>Product List</h1>

    <div>
      <label for="category">Filter by Category:</label>
      <select id="category" v-model="selectedCategory" @change="fetchProducts">
        <option value="">All Categories</option>
        <option v-for="category in categories" :key="category.id" :value="category.id">
          {{ category.name }}
        </option>
      </select>

      <label for="sort_by">Sort by:</label>
      <select id="sort_by" v-model="sortBy" @change="fetchProducts">
        <option value="name">Name</option>
        <option value="price">Price</option>
      </select>

      <label for="order">Order:</label>
      <select id="order" v-model="order" @change="fetchProducts">
        <option value="asc">Ascending</option>
        <option value="desc">Descending</option>
      </select>
    </div>

    <table v-if="products.length">
      <thead>
        <tr>
          <th>Image</th>
          <th>Name</th>
          <th>Description</th>
          <th>Price</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="product in products" :key="product.id">
          <td>
            <img :src="product.image" alt="Product Image" width="100" />
          </td>
          <td>{{ product.name }}</td>
          <td>{{ product.description }}</td>
          <td>\${{ product.price }}</td>
        </tr>
      </tbody>
    </table>

    <div class="pagination">
      <button @click="previousPage" :disabled="!canPrevious">Previous</button>
      <span>Page {{ page }} of {{ totalPages }}</span>
      <button @click="nextPage" :disabled="!canNext">Next</button>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted } from 'vue'
import axios from 'axios'

export default defineComponent({
  name: 'ProductList',
  setup() {
    const products = ref<Array<any>>([])
    const categories = ref<Array<any>>([])
    const selectedCategory = ref<string>('')
    const sortBy = ref<string>('name')
    const order = ref<string>('asc')
    const page = ref<number>(1)
    const totalPages = ref<number>(1)
    const canPrevious = ref<boolean>(false)
    const canNext = ref<boolean>(true)

    const fetchCategories = async () => {
      try {
        const response = await axios.get('http://localhost:8000/api/categories')
        categories.value = response.data
      } catch (error) {
        console.error('Failed to fetch categories', error)
      }
    }

    const fetchProducts = async () => {
      try {
        const response = await axios.get('http://localhost:8000/api/products', {
          params: {
            category_id: selectedCategory.value,
            sort_by: sortBy.value,
            order: order.value,
            page: page.value
          }
        })
        products.value = response.data.data
        totalPages.value = response.data.last_page
        canPrevious.value = response.data.current_page > 1
        canNext.value = response.data.current_page < response.data.last_page
      } catch (error) {
        console.error('Failed to fetch products', error)
      }
    }

    const nextPage = async () => {
      if (page.value < totalPages.value) {
        page.value += 1
        await fetchProducts()
      }
    }

    const previousPage = async () => {
      if (page.value > 1) {
        page.value -= 1
        await fetchProducts()
      }
    }

    onMounted(async () => {
      await fetchCategories()
      await fetchProducts()
    })

    return {
      products,
      categories,
      selectedCategory,
      sortBy,
      order,
      page,
      totalPages,
      canPrevious,
      canNext,
      fetchProducts,
      nextPage,
      previousPage
    }
  }
})
</script>
