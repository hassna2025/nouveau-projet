<template>
  <div class="test-vue">
    <h1>Ma super app Vue</h1>
    <p>Version Vue: {{ version }}</p>
  </div>
</template>

<script>
import { version } from 'vue'
export default {
  data() {
    return { version }
  }
}
</script>

<style>
.test-vue {
  color: blue;
  padding: 2rem;
}
</style>