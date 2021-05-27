<script>
import FormField from './FormField.vue'
export default {
  extends: FormField,

  computed: {
    component: () => 'k-textarea-field',
    buttons: () => false
  }
}
</script>
