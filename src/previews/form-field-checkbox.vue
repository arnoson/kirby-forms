<script>
import FormField from './form-field.vue'
export default {
  extends: FormField,

  computed: {
    component: () => 'k-checkboxes-field',
    options() {
      return [{ text: this.content.text }]
    },
  },
}
</script>
