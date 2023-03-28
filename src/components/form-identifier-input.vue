<script>
export default {
  extends: 'k-slug-input',

  data() {
    return { wasEmptyOnCreate: false }
  },

  created() {
    this.wasEmptyOnCreate = !this.value
  },

  computed: {
    sync() {
      // Only enable sync if the field was empty. This will be the case when
      // creating new form fields in the panel, where we want the sync behavior.
      // If we re-edit an existing field changing the label shouldn't change
      // an already existing identifier.
      return this.wasEmptyOnCreate ? this.$options.propsData.sync : null
    },
  },

  methods: {
    sluggify(value) {
      // Overwrite `k-slug-input`'s built in slugify method, so it uses an
      // underscore as separator. This is important when working with php
      // email templates where an identifier with a dash wouldn't be a valid
      // php variable (e.g.: `$my-field`)
      return this.$helper.slug(
        value,
        [this.slugs, this.$system.ascii],
        this.allow,
        '_'
      )
    },
  },
}
</script>
