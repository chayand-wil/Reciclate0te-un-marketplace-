<template>
  <div>    
    <header class="glass-header">
      <div >
        <h1 class="title">Recicla0te</h1>
      </div>
      <div class="right">
        <UserDropdown />
      </div>
    </header>

  </div>
</template>

<script setup>
import UserDropdown from './UserDropdown.vue'
</script>


<style scoped>
.glass-header {
  width: 100%;
  position: sticky;
  top: 0;
  z-index: 100;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 2rem;
  background: rgba(255, 255, 255, 0.2); /* Para modo claro */
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border-bottom: 1px solid var(--color-border);
  color: var(--color-heading);
}

@media (prefers-color-scheme: dark) {
  .glass-header {
    background: rgba(24, 24, 24, 0.2); /* Para modo oscuro */
  }
}

.title {
  font-size: 1.25rem;
  font-weight: 600;
}
/* pte agregar el icono */

</style>
