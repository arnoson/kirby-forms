<script>
import FormField from './form-field.vue'
export default {
  extends: FormField,

  computed: {
    component: () => 'k-textarea-field',
    buttons: () => false,
  },
}
</script>
