<template>
  <table class="k-structure-table">
    <thead>
      <tr>
        <th class="k-structure-table-column">Field</th>
        <th class="k-structure-table-column">Value</th>
      </tr>
    </thead>
    <tr v-for="(value, field) in entry" :key="field">
      <td class="k-structure-table-column">
        <p class="k-structure-table-text">{{ field }}</p>
      </td>
      <td class="k-structure-table-column">
        <p class="k-structure-table-text">{{ value }}</p>
      </td>
    </tr>
  </table>
</template>

<script>
export default {
  props: ['entry']
}
</script>

<style lang="scss" scoped>
.k-structure-table {
  th:last-child {
    width: 100%;
  }
  &-column {
    height: 38px;
  }
}
</style>
