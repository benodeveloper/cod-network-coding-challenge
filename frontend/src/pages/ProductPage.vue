<template>
  <div>
    <h1>Product List</h1>
    <button @click="goToAddProduct">Add Product</button>

    <ProductList />
  </div>
</template>

<script lang="ts">
import ProductList from '@/components/ProductList.vue'
import { defineComponent } from 'vue'
import { useRouter } from 'vue-router'

export default defineComponent({
  name: 'ProductPage',
  components: {
    ProductList
  },
  setup() {
    const router = useRouter()

    const goToAddProduct = () => {
      router.push('/add-product')
    }

    return {
      goToAddProduct
    }
  }
})
</script>
