<template>
  <div>
    <table class="k-structure-table">
      <thead>
        <tr>
          <th class="k-structure-table-index">#</th>
          <th
            class="k-structure-table-column"
            v-for="column in displayColumns"
            :key="column.name"
          >
            {{ column.label || column.name }}
          </th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="(entry, index) of paginatedEntries"
          :key="`row_${index}`"
          @click="$emit('select', realIndex(index))"
        >
          <td class="k-structure-table-index">
            <span class="k-structure-table-index-number">{{
              realIndex(index) + 1
            }}</span>
          </td>
          <td
            class="k-structure-table-column"
            v-for="column in displayColumns"
            :key="column.name"
          >
            <p class="k-structure-table-text">{{ entry[column.name] }}</p>
          </td>
          <td class="k-structure-table-option">
            <k-button
              icon="remove"
              @click.stop="$emit('remove', realIndex(index))"
            />
          </td>
        </tr>
      </tbody>
    </table>
    <k-pagination
      align="center"
      :details="true"
      :total="entries.length"
      :limit="20"
      @paginate="paginate"
    />
  </div>
</template>

<script>
export default {
  props: {
    entries: { default: () => ({}) },
    columns: { default: () => [] }
  },

  data() {
    return {
      pagination: { start: 1, end: 20 }
    }
  },

  computed: {
    displayColumns() {
      return this.columns
    },

    paginatedEntries() {
      return this.entries.slice(this.pagination.start - 1, this.pagination.end)
    }
  },

  methods: {
    paginate(pagination) {
      this.pagination = pagination
    },

    realIndex(paginatedIndex) {
      return this.pagination.start + paginatedIndex - 1
    }
  }
}
</script>
