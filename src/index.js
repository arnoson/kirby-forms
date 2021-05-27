import FormFieldText from './previews/FormFieldText.vue'
import FormFieldTextarea from './previews/FormFieldTextarea.vue'
import FormFieldNumber from './previews/FormFieldNumber.vue'
import FormFieldEmail from './previews/FormFieldEmail.vue'
import FormFieldDate from './previews/FormFieldDate.vue'
import FormFieldCheckboxes from './previews/FormFieldCheckboxes.vue'
import FormFieldRadio from './previews/FormFieldRadio.vue'
import FormFieldSelect from './previews/FormFieldSelect.vue'

panel.plugin('arnoson/kirby-forms', {
  blocks: {
    'form-field-text': FormFieldText,
    'form-field-email': FormFieldEmail,
    'form-field-number': FormFieldNumber,
    'form-field-date': FormFieldDate,
    'form-field-checkboxes': FormFieldCheckboxes,
    'form-field-radio': FormFieldRadio,
    'form-field-select': FormFieldSelect,
    'form-field-textarea': FormFieldTextarea
  }
})
