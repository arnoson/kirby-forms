<template>
  <k-field
    class="arnoson-form-entries"
    :class="{ 'form-entry-selected': currentEntry }"
  >
    <header slot="header" class="k-field-header">
      <label class="k-field-label" @click="deselectEntry"
        ><button class="arnoson-label">{{ label }}</button>
        <template v-if="currentEntry">
          <span class="arnoson-separator">/</span>
          <span>#{{ currentEntryIndex + 1 }}</span>
        </template>
      </label>
    </header>
    <k-empty v-if="!entries.length" icon="list-bullet">{{
      $t('arnoson.forms.no-entries')
    }}</k-empty>
    <keep-alive v-else>
      <form-entries-table
        v-if="!currentEntry"
        :entries="value"
        :columns="columns"
        @select="selectEntry"
        @remove="removeEntry"
      />
      <form-entry-table v-else :entry="currentEntry" />
    </keep-alive>
  </k-field>
</template>

<script>
import FormEntriesTable from '../components/FormEntriesTable.vue'
import FormEntryTable from '../components/FormEntryTable.vue'
export default {
  props: ['value', 'columns', 'label'],

  components: { FormEntriesTable, FormEntryTable },

  data() {
    return {
      currentEntryIndex: null
    }
  },

  computed: {
    entries() {
      return this.value
    },

    currentEntry() {
      return this.entries[this.currentEntryIndex]
    }
  },

  methods: {
    selectEntry(index) {
      this.currentEntryIndex = index
    },

    deselectEntry() {
      this.currentEntryIndex = null
    },

    removeEntry(index) {
      this.$emit(
        'input',
        this.value.filter((_, elIndex) => elIndex !== index)
      )
    }
  }
}
</script>

<style lang="scss">
.arnoson-form-entries {
  .k-structure-table {
    // box-shadow: none;

    th {
      color: #5c5c5c;
      background: #ddd;
      border-color: #d6d6d6;
      border-bottom: none;
    }

    &-option {
      text-align: center;
    }
  }
}

.arnoson {
  &-separator {
    margin: 0 8px;
    font-weight: lighter;
  }

  &-label {
    font-weight: inherit;
  }

  .form-entry-selected &-label {
    font-weight: lighter;
  }
}
</style>
