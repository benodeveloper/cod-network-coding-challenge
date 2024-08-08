<template>
  <div>
    <h1>Add New Product</h1>
    <ProductForm />
  </div>
</template>

<script lang="ts">
import ProductForm from '@/components/ProductForm.vue'
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'AddProductPage',
  components: {
    ProductForm
  }
})
</script>
