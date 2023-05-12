panel.plugin('my/custom-form-fields', {
  blocks: {
    'form-field-range': {
      props: ['content'],
      template: `
        <k-range-field class="arnoson-forms-preview" v-bind="fieldProps"/>
      `,
      computed: {
        fieldProps() {
          return {
            label: this.content.label || this.content.name,
            required: this.content.required,
            value: this.content.default,
            min: this.content.min,
            max: this.content.max,
            step: this.content.step,
          }
        }
      }
    }
  }
})