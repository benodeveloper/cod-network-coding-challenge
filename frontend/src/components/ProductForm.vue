<template>
  <div>
    <h1>Create a Product</h1>
    <form @submit.prevent="submitForm">
      <div>
        <label for="name">Name:</label>
        <input type="text" id="name" v-model="product.name" required />
      </div>
      <div>
        <label for="description">Description:</label>
        <textarea id="description" v-model="product.description"></textarea>
      </div>
      <div>
        <label for="price">Price:</label>
        <input type="number" id="price" v-model="product.price" step="0.01" required />
      </div>
      <div>
        <label for="image">Image:</label>
        <input type="file" id="image" @change="handleFileUpload" />
      </div>
      <div>
        <label for="category">Category:</label>
        <select id="category" v-model="product.category_id" required>
          <option value="" disabled>Select a category</option>
          <option v-for="category in categories" :key="category.id" :value="category.id">
            {{ category.name }}
          </option>
        </select>
      </div>
      <button type="submit">Save</button>
      <button type="button" @click="saveAndExit">Save and Exit</button>
    </form>
    <p v-if="errorMessage">{{ errorMessage }}</p>
    <p v-if="successMessage">{{ successMessage }}</p>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

interface Product {
  id?: number
  name: string
  description: string
  price: string
  image?: any
  category_id: string
}

interface Category {
  id: number
  name: string
}

export default defineComponent({
  name: 'ProductForm',
  setup() {
    const product = ref<Product>({
      name: '',
      description: '',
      price: '',
      image: null,
      category_id: ''
    })

    const errorMessage = ref('')
    const successMessage = ref('')

    const categories = ref<Category[]>([])
    const router = useRouter()

    // Fetch categories when component mounts
    onMounted(async () => {
      try {
        const response = await axios.get('http://localhost:8000/api/categories')
        categories.value = response.data
      } catch (error) {
        errorMessage.value = 'Failed to fetch categories.'
      }
    })

    const handleFileUpload = (event: Event) => {
      const input = event.target as HTMLInputElement
      if (input.files && input.files[0]) {
        product.value.image = input.files[0]
      }
    }

    const submitForm = async () => {
      try {
        const formData = new FormData()
        formData.append('name', product.value.name)
        formData.append('description', product.value.description)
        formData.append('price', product.value.price)
        formData.append('category_id', product.value.category_id)

        if (product.value.image) {
          formData.append('image', product.value.image)
        }

        await axios.post<Product>('http://localhost:8000/api/products', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        })

        successMessage.value = 'Product created successfully!'
        errorMessage.value = ''
        product.value = {
          name: '',
          description: '',
          price: '',
          image: null,
          category_id: ''
        }
      } catch (error) {
        errorMessage.value = 'Failed to create product. Please check your input.'
        successMessage.value = ''
      }
    }

    const saveAndExit = async () => {
      await submitForm()
      router.push('/')
    }
    return {
      product,
      categories,
      errorMessage,
      successMessage,
      submitForm,
      saveAndExit,
      handleFileUpload
    }
  }
})
</script>
