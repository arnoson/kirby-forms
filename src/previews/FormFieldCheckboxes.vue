<script>
import FormField from './FormField.vue'
export default {
  extends: FormField,

  computed: {
    component: () => 'k-checkboxes-field',

    defaultValue() {
      return this.content.default?.split(',').map(el => el.trim())
    }
  }
}
</script>
